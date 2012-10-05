<?php

class Aureatelabs_Disableshipmethod_Block_Onepage_Shipping_Method extends Mage_Checkout_Block_Onepage_Shipping_Method
{

    public function isShow()
    {
        return false;
//        return !$this->getQuote()->isVirtual();
    }    
}