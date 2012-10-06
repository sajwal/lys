<?php

/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE-COMMUNITY.txt
 * 
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This package designed for Magento COMMUNITY edition
 * aheadWorks does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * aheadWorks does not provide extension support in case of
 * incorrect edition usage.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Searchautocomplete
 * @copyright  Copyright (c) 2009-2010 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE-COMMUNITY.txt
 */
class AW_Searchautocomplete_AjaxController extends Mage_Core_Controller_Front_Action
{
    public static function findNearest($haystack, $needles, $offset)
    {
        $haystackL = strtolower($haystack);
        $nearestWord = '';
        $nearestPos = 999999;
        foreach($needles as $needle)
            if( $needle
            &&  false !== ($pos = strpos($haystackL, strtolower($needle), $offset))
            &&  $nearestPos > $pos
            ) {
                $nearestPos = $pos;
                $nearestWord = substr($haystack, $pos, strlen($needle));
            }
        if($nearestWord) return array('pos' => $nearestPos, 'word' => $nearestWord);
        else return false;
    }

    public static function decorateWords($words, $subject, $before, $after)
    {
        $replace = array();
        for($pos=0; $pos<strlen($subject) && (false !== $nearest = self::findNearest($subject, $words, $pos)); )
        {
            $replace[$nearest['pos']] = $nearest['word'];
            $pos = $nearest['pos'] + strlen($nearest['word']);
        }

        $res = '';
        $pos = 0;
        foreach($replace as $start => $word)
        {
            $res .= substr($subject, $pos, $start-$pos).$before.$word.$after;
            $pos = $start + strlen($word);
        }
        $res .= substr($subject, $pos);

        return $res;
    }

    public function suggestAction()
    {
        $qParam = $this->getRequest()->getParam('q');
        $storeIdParam = $this->getRequest()->getParam('storeId');
        if (is_null($qParam) || is_null($storeIdParam)) return;
        
        $q = Mage::helper('core')->htmlEscape($qParam);
        $q = htmlspecialchars_decode($q);
        $storeId = Mage::helper('core')->htmlEscape($storeIdParam);

        $_productCollection = Mage::getModel('catalog/product')->setStoreId($storeId)->getCollection();

        $template = Mage::getStoreConfig('searchautocomplete/interface/item_template');

        $allAttributes = AW_Searchautocomplete_Model_Source_Product_Attribute::getProductAttributeList();

        // deciding which attributes are used in the template
        $usedAttributes = array();
        foreach($allAttributes as $id => $attrData)
            if(false !== strpos($template, '{'.$attrData['code'].'}'))
                $usedAttributes[] = $attrData['code'];

        $searchableAttributes = explode(',', Mage::getStoreConfig('searchautocomplete/interface/searchable_attributes'));
        $searchedWords = explode(' ', trim($q));

        $attributes = array();
        foreach($searchableAttributes as $attrId)
            if(array_key_exists($attrId, $allAttributes))
                $attributes[$attrId] = $allAttributes[$attrId]['type'];

        $productIds = AW_Searchautocomplete_Model_Source_Product_Attribute::getProductIds($attributes, $searchedWords, $storeId);

        if(!count($productIds)) return $this->printResults(array());

        $_productCollection->getSelect()->where('`e`.`entity_id` IN ('.implode(',', $productIds).')');

        $_productCollection
           ->addAttributeToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
           ->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)
           ->addUrlRewrite()
           ->setPageSize(Mage::getStoreConfig('searchautocomplete/interface/show_top_x'))
            ->load();

        $thumbnailSize = (int) Mage::getStoreConfig('searchautocomplete/interface/thumbnail_size');
        if(!$thumbnailSize) $thumbnailSize = 75;

        $thumbnailUrlPresents = (false !== strpos($template, '{thumbnail_url}'));

        $_res = array();
        foreach($_productCollection as $_product)
        {
            $_product = Mage::getModel('catalog/product')->setStoreId($storeId)->load($_product->getData('entity_id'));
            $productUrl = $_product->getProductUrl();
            $info = $template;

            foreach($usedAttributes as $code)
            {
                $data = $_product->getData($code);

                if(!is_string($data)) continue;
                $data = self::decorateWords($searchedWords, $data, '<strong class="searched-words">', '</strong>');
                $info = str_replace('{'.$code.'}', $data, $info);
            }
//             adding special fields
            $info = str_replace('{product_url}', $productUrl, $info);

            if($thumbnailUrlPresents)
                $info = str_replace('{thumbnail_url}', $_product->getThumbnailUrl($thumbnailSize, $thumbnailSize), $info);

            array_push($_res, array(
                'content'   => str_replace('"', '\'', $info),
                'url'       => $productUrl,
            ));
        }
        $this->printResults($_res);
    }

    private function printResults($_res)
    {
        $callbackParam = $this->getRequest()->getParam('callback');
        if (is_null($callbackParam)) return;
        
        $callback = Mage::helper('core')->htmlEscape($callbackParam);
        $total_res = count($_res);

        $res = $callback . '({"ResultSet":{"totalResultsAvailable":"' . count($_res) . '","totalResultsReturned":'.$total_res.',"firstResultPosition":1,"Result": [';
        $c = 0;
        foreach ($_res as $item_id => $item){
            if ($c != 0){
                $res .= ',';
            }
            $res .= '{"content":"'.$item['content'].'","url":"'.$item['url'].'"}';
            $c++;
        }
        $res .= ']}})';
        $res = str_replace("\n", '', $res);
        $res = str_replace("\r", '', $res);
        $res = str_replace("\t", '', $res);
        echo $res;
    }
}