<?php

/**
* Rootinfo
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@magentocommerce.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* However,* Rootinfo *guarantee functional accuracy of
* specific extension behavior. Additionally we take no responsibility
* for any possible issue(s) resulting from extension usage.
* We reserve the full right not to provide any kind of support for our free extensions.
* Thank you for your understanding.
* @category   Rootinfo
* @package    Rootinfo_SocialConnect
* @author     Shekhar <shekhar@rootinfosol.com>
* @copyright  Copyright (c) 2014-2015 (http://rootinfosol.com/)
* @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
*/


/**
 * Model class for Register user.
 * Class Rootinfo_SocialConnect_Model_Ajaxregister
 * @author Root Info Solution Pvt Ltd.
 */


class Rootinfo_SocialConnect_Model_Ajaxregister
    extends Rootinfo_SocialConnect_Model_Validator
{
    /**
     * Initilization for login.
     */
    public function _construct() 
    {
        parent::_construct();

        // Result for Javascript
        $this->_result = '';
        $this->_userId = -1;

        // Terms and conditions has been accepted
        if ($_POST['licence'] == 'ok') {
            $this->setEmail($_POST['email']);

            // If this email is already exist
            if ($this->isEmailExist()) {
                $this->_result .=  'emailisexist,';
            // If this email is not exist yet.
            } else {
                $this->setPassword($_POST['password'], $_POST['passwordsecond']);
                $this->setName($_POST['firstname'], $_POST['lastname']);
                $this->setNewsletter($_POST['newsletter']);

                // If there are no errors
                if ($this->_result == '') {
                    // Try register user
                    $this->_registerUser();

                    // Try subscribe user to newsletter
                    if ($this->_userNewsletter == true) {
                        $this->_subscribeUser();
                    }
                }
            }
        // Terms and conditions has not been accepted
        } else {
            $this->_result = 'nolicence,';
        }        
    }

    /**
     * Register user BY Mage's API.
     */
    protected function _registerUser()
    {
            $privatekey = Mage::getStoreConfig("rootinfoajaxlogin/googlerecaptcha/private_key");
              // check response
          
            $resp = Mage::helper("rootinfo_socialconnect")->recaptcha_check_answer(  $privatekey,
                $_SERVER["REMOTE_ADDR"],
                $_POST["recaptcha_challenge_field"],
                $_POST["recaptcha_response_field"]
            );

            
        if ($resp == true) {
           //$this->_result = "Captcha is correct";  
        
        
        // Empty customer object
        $customer = Mage::getModel('customer/customer');

        $customer->setWebsiteId(Mage::app()->getWebsite()->getId());

        // Set customer
        $customer->setEmail($this->_userEmail);
        $customer->setPassword($this->_userPassword);
        $customer->setFirstname($this->_userFirstName);
        $customer->setLastname($this->_userLastName);

        // Try create customer
        try {
            $customer->save();
            $customer->setConfirmation(null);
            $customer->save();
            
            $storeId = $customer->getSendemailStoreId();
            $customer->sendNewAccountEmail('registered', '', $storeId);
            
            Mage::getSingleton('customer/session')->loginById($customer->getId());
            
            $this->_userId = $customer->getId();
            
            $this->_result = 'success';
        // Error by injected HTML/JS
        } catch (Exception $ex) {
            $this->_result .= 'frontendhackerror,';
        }
        
        }
            else{
             $this->_result .= "Captcha is not correct"; 
                
            }
    }

    /**
     * Subscribe user to newsletter.
     * @throws Exception
     */
    protected function _subscribeUser() {
        $subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($this->_userEmail);

        if (!$subscriber->getId()) {
            $subscriber->setStatus(Mage_Newsletter_Model_Subscriber::STATUS_SUBSCRIBED);
            $subscriber->setSubscriberEmail($this->_userEmail);
            $subscriber->setSubscriberConfirmCode($subscriber->RandomSequence());
        }

        $subscriber->setStoreId(Mage::app()->getStore()->getId());
        $subscriber->setCustomerId($this->_userId);

        // Try to save the subscribe
        try {
            $subscriber->save();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
