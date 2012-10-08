<?php

class Aureatelabs_Extra_Helper_Data extends Mage_Core_Helper_Abstract{
    
    public function getSocialCount($url =''){
        $counts = array();
        if($url != ''){
            $json = file_get_contents("http://api.sharedcount.com/?url=" . rawurlencode($url));
            $counts = json_decode($json, true);
        }
        return $counts;
    }
}