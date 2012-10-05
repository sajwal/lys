<?php

class Aureatelabs_Disableshipmethod_Model_Service_Quote extends Mage_Sales_Model_Service_Quote
{    
    protected function _validate()
    {
        $helper = Mage::helper('sales');
        if (!$this->getQuote()->isVirtual()) {
            $address = $this->getQuote()->getShippingAddress();
            $addressValidation = $address->validate();
//            if ($addressValidation !== true) {
//                Mage::throwException(
//                    $helper->__('Please check shipping address information. %s', implode(' ', $addressValidation))
//                );
//            }
//            $method= $address->getShippingMethod();
//            $rate  = $address->getShippingRateByCode($method);
//            if (!$this->getQuote()->isVirtual() && (!$method || !$rate)) {
//                Mage::throwException($helper->__('Please specify a shipping method.'));
//            }
        }
    }  
}