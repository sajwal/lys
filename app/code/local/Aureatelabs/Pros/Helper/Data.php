<?php

class Aureatelabs_Pros_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getCfg($optionString)
    {
        return Mage::getStoreConfig('pros/' . $optionString);
    }
	
	public function getCfgGeneral($optionString)
    {
        return Mage::getStoreConfig('pros/general/' . $optionString);
    }
}
