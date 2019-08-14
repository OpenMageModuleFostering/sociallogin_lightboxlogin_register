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
 * Model class for lOGIN User.
 * Class Rootinfo_SocialConnect_Model_Ajaxlogin
 * @author Root Info Solution Pvt Ltd.
 */


class Rootinfo_SocialConnect_Model_Ajaxlogin extends Rootinfo_SocialConnect_Model_Validator
{
    /**
     * Initilization Constructor .
     */
    public function _construct() 
    {
        parent::_construct();
        
        $this->setEmail($_POST['email']);
        $this->setSinglePassword($_POST['password']);

        // Start login process.
        if ($this->_result == '') {
            $this->_loginUser();
        }
    }

    /**
     * For login user.
     */
    protected function _loginUser() {
        $session = Mage::getSingleton('customer/session');

        try {
            $session->login($this->_userEmail, $this->_userPassword);
            $customer = $session->getCustomer();
            
            $session->setCustomerAsLoggedIn($customer);
            
            $this->_result .= 'success';
        } catch(Exception $ex) {
            $this->_result .= 'wronglogin,';
        }
    }

    /**
     * String result.
     * @return string
     */
    public function getResult()
    {
        return $this->_result;
    }
}
