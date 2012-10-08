<?php

require_once 'Mage'.DS.'Checkout'.DS.'controllers'.DS.'OnepageController.php';
class Aureatelabs_Disableshipmethod_OnepageController extends Mage_Checkout_OnepageController
{
	public function saveBillingAction()
    {
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
//            $postData = $this->getRequest()->getPost('billing', array());
//            $data = $this->_filterPostData($postData);
            $data = $this->getRequest()->getPost('billing', array());
            $customerAddressId = $this->getRequest()->getPost('billing_address_id', false);

            if (isset($data['email'])) {
                $data['email'] = trim($data['email']);
            }
            $result = $this->getOnepage()->saveBilling($data, $customerAddressId);

            if (!isset($result['error'])) {
                /* check quote for virtual */
                if ($this->getOnepage()->getQuote()->isVirtual()) {
                    $result['goto_section'] = 'payment';
                    $result['update_section'] = array(
                        'name' => 'payment-method',
                        'html' => $this->_getPaymentMethodsHtml()
                    );
                } elseif (isset($data['use_for_shipping']) && $data['use_for_shipping'] == 1) {
                    $result['goto_section'] = 'payment';
                    $result['update_section'] = array(
                        'name' => 'payment-method',
                        'html' => $this->_getPaymentMethodsHtml()
                    );

                    $result['allow_sections'] = array('shipping');
                    $result['duplicateBillingInfo'] = 'true';
                } else {
                    $result['goto_section'] = 'shipping';
                }
            }

            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
	
	public function saveShippingAction()
    {
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('shipping', array());
            $customerAddressId = $this->getRequest()->getPost('shipping_address_id', false);
            $result = $this->getOnepage()->saveShipping($data, $customerAddressId);

            if (!isset($result['error'])) {
                 $result['goto_section'] = 'payment';
                $result['update_section'] = array(
                    'name' => 'payment-method',
                    'html' => $this->_getPaymentMethodsHtml()
                );
			}
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
	public function savePaymentAction()
    {
        if ($this->_expireAjax()) {
            return;
        }
        try {
            if (!$this->getRequest()->isPost()) {
                $this->_ajaxRedirectResponse();
                return;
            }

            // set payment to quote
            $result = array();
            $data = $this->getRequest()->getPost('payment', array());
            $result = $this->getOnepage()->savePayment($data);
			if(isset($data['method'])){
				//if($data['method']=='cashondelivery'){
					$non_servicable_pincodes = explode(',',Mage::getStoreConfig('payment/general/disallowedpincodes'));
					$current_pin = $this->getOnepage()->getQuote()->getShippingAddress()->getPostcode();
					if(in_array($current_pin,$non_servicable_pincodes)){
						$result['error'] = $this->__('Sorry! Cash on delivery method is not available on %s Pincode',$current_pin);
					}
				//}
			}
            // get section and redirect data
            $redirectUrl = $this->getOnepage()->getQuote()->getPayment()->getCheckoutRedirectUrl();
            if (empty($result['error']) && !$redirectUrl) {
                $this->loadLayout('checkout_onepage_review');
                $result['goto_section'] = 'review';
                $result['update_section'] = array(
                    'name' => 'review',
                    'html' => $this->_getReviewHtml()
                );
            }
            if ($redirectUrl) {
                $result['redirect'] = $redirectUrl;
            }
        } catch (Mage_Payment_Exception $e) {
            if ($e->getFields()) {
                $result['fields'] = $e->getFields();
            }
            $result['error'] = $e->getMessage();
        } catch (Mage_Core_Exception $e) {
            $result['error'] = $e->getMessage();
        } catch (Exception $e) {
            Mage::logException($e);
            $result['error'] = $this->__('Unable to set Payment Method.');
        }
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }
    //protected $_sectionUpdateFunctions = array(
//        'payment-method'  => '_getPaymentMethodsHtml',
////        'shipping-method' => '_getShippingMethodsHtml',
//        'review'          => '_getReviewHtml',
//    );
//    
//    
//    /**
//     * save checkout billing address
//     */
//    public function saveBillingAction()
//    {
//        if ($this->_expireAjax()) {
//            return;
//        }
//        if ($this->getRequest()->isPost()) {
////            $postData = $this->getRequest()->getPost('billing', array());
////            $data = $this->_filterPostData($postData);
//            $data = $this->getRequest()->getPost('billing', array());
//            $customerAddressId = $this->getRequest()->getPost('billing_address_id', false);
//
//            if (isset($data['email'])) {
//                $data['email'] = trim($data['email']);
//            }
//            $result = $this->getOnepage()->saveBilling($data, $customerAddressId);
//
//            if (!isset($result['error'])) {
//                /* check quote for virtual */
//                if ($this->getOnepage()->getQuote()->isVirtual()) {
//                    $result['goto_section'] = 'payment';
//                    $result['update_section'] = array(
//                        'name' => 'payment-method',
//                        'html' => $this->_getPaymentMethodsHtml()
//                    );
//                }
////                } elseif (isset($data['use_for_shipping']) && $data['use_for_shipping'] == 1) {
////                    $result['goto_section'] = 'shipping_method';
////                    $result['update_section'] = array(
////                        'name' => 'shipping-method',
////                        'html' => $this->_getShippingMethodsHtml()
////                    );
////
////                    $result['allow_sections'] = array('shipping');
////                    $result['duplicateBillingInfo'] = 'true';
////                }
//                else {
//                    $result['goto_section'] = 'payment';
//                }
//            }
//
//            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
//        }
//    }
}