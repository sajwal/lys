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
class AW_Searchautocomplete_Model_Source_Product_Attribute
{
    public static $_entityTypeId;
    public static $_productAttributes;
    public static $_productAttributeOptions;

    public static function getProductAttributeList()
    {
        if(is_array(self::$_productAttributes))
            return self::$_productAttributes;

        $resource = Mage::getSingleton('core/resource');
        $db = $resource->getConnection('core_read');

        $select = $db->select()
            ->from($resource->getTableName('eav/entity_type'), 'entity_type_id')
            ->where('entity_type_code=?', 'catalog_product')
            ->limit(1);

        self::$_entityTypeId = $db->fetchOne($select);

        $select = $db->select()
            ->from($resource->getTableName('eav/attribute'), array(
                    'title' => 'frontend_label',    // for admin part
                    'id'    => 'attribute_id',      // for applying filter to collection
                    'code'  => 'attribute_code',    // as a tip for constructing {attribute_name}
                    'type'  => 'backend_type',      // for table name
                ))
            ->where('entity_type_id=?', self::$_entityTypeId)
            ->where('frontend_label<>""')
            ->where('find_in_set(backend_type, "text,varchar")')
            ->order('frontend_label');

        foreach($db->fetchAll($select) as $v)
            self::$_productAttributes[$v['id']] = array(
                    'title' => $v['title'],
                    'code'  => $v['code'],
                    'type'  => $v['type'],
            );

        return self::$_productAttributes;
    }

    public static function getProductIds($attributes, $attrValues, $storeId)
    {
        $ids = array();
        $resource = Mage::getSingleton('core/resource');
        $db = $resource->getConnection('core_read');

        // list of tables used for selecting
        $usedTables = array();
        foreach($attributes as $attrId => $attrType)
            $usedTables[$attrType] = true;

        foreach(array_keys($usedTables) as $tableName)
        {
            $select = $db->select();

            $select
                ->distinct()
                ->from($resource->getTableName('catalog/product').'_'.$tableName, 'entity_id')
                ->where('entity_type_id=?', self::$_entityTypeId)
                ->where('store_id=0 OR store_id=?', $storeId)
                ->where('attribute_id IN ('.implode(',', array_keys($attributes)).')');

            foreach($attrValues as $value)
                $select->where('`value` LIKE "%'.addslashes($value).'%"');

            $ids = array_merge($ids, $db->fetchCol($select));
        }
        return array_unique($ids);
    }

    public static function toOptionArray()
    {
        if(is_array(self::$_productAttributeOptions)) return self::$_productAttributeOptions;

        self::$_productAttributeOptions = array();

        foreach(self::getProductAttributeList() as $id => $data)
            self::$_productAttributeOptions[] = array(
                'value' => $id,
                'label' => $data['title'].' ('.$data['code'].')'
            );

        return self::$_productAttributeOptions;
    }
}