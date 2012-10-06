<?php
class Aureatelabs_Pros_Block_Pros extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
	
	public function getCurrentProductObject()
	{
		return Mage::registry('current_product'); //TODO: check if it's 100% correct!
	}
}