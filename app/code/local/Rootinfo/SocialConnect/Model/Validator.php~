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
 * Model class for Validate user data..
 * Class Rootinfo_SocialConnect_Model_Validator
 * @author Root Info Solution Pvt Ltd.
 */

class Rootinfo_SocialConnect_Model_Validator extends Varien_Object
{
    /**
     * @var string
     */
    protected $_userEmail;

    /**
     * @var string
     */
    protected $_userPassword;

    /**
     * @var string
     */
    protected $_userFirstName;

    /**
     * @var string
     */
    protected $_userLastName;

    /**
     * @var bool
     */
    protected $_userNewsletter;

    /**
     * @var int
     */
    protected $_userId;

    /**
     * @var string
     */
    protected $_result;

    /**
     * Init.
     */
    public function _construct() 
    {
        parent::_construct();
    }

    /**
     * Validate email address.
     * @param string $email
     */
    protected function setEmail($email = '')
    {
        if (!Zend_Validate::is($email, 'EmailAddress')) {
            $this->_result .= 'wrongemail,';
        } else {
            $this->_userEmail = $email;
        }
    }

    /**
     * Validate user password.
     * @param $password string
     */
    protected function setSinglePassword($password)
    {
        $rootinfoitizedPassword = str_replace(array('\'', '%', '\\', '/', ' '), '', $password);
        
        if (strlen($rootinfoitizedPassword) > 16 || $rootinfoitizedPassword != trim($password)) {
            $this->_result .= 'wrongemail,';
        }
        
        $this->_userPassword = $rootinfoitizedPassword;
    }

    /**
     * Parsing passwords. Retrieve TRUE if there is an error. The error string
     * code will be saved into the property.
     * @param string $password
     * @param string $confirmation
     * @return bool|null
     */
    protected function setPassword($password = '', $confirmation = '')
    {
        // Sanitize password
        $rootinfoitizedPassword = str_replace(array('\'', '%', '\\', '/', ' '), '', $password);

        // Special characters
        if ($password != $rootinfoitizedPassword) {
            $this->_result .= 'novalidpassword,';
            return true;
        }

        // Too short
        if (strlen($rootinfoitizedPassword) < 6) {
            $this->_result .= 'shortpassword,';
            return true;
        }

        // Too long
        if (strlen($rootinfoitizedPassword) > 16) {
            $this->_result .= 'longpassword,';
            return true;
        }

        // Two passwords does not match
        if ($rootinfoitizedPassword != $confirmation) {
            $this->_result .= 'notsamepasswords,';
            return true;
        }
        
        $this->_userPassword = $rootinfoitizedPassword;
    }

    /**
     * Rootinfo and validate user personal data.
     * @param string $firstname
     * @param string $lastname
     * @return bool|null
     */
    protected function setName($firstname = '', $lastname = '')
    {
        $firstname = trim($firstname);
        $lastname = trim($lastname);

        // Validate process
        $stop = false;

        // There is no first name
        if ($firstname == '') {
            $this->_result .= 'nofirstname,';
            $stop = true;
        }

        // There is no last name
        if ($lastname == '') {
            $this->_result .= 'nolastname,';
            $stop = true;
        }

        // Error, stop process
        if ($stop == true) {
            return true;
        }

        // Clear first name
        $rootinfoitizedFname = str_replace(array('\'', '%', '\\', '/'), '', $firstname);

        // Validate first name
        if ($rootinfoitizedFname != $firstname) {
            $this->_result .= 'novalidfirstname,';
            $stop = true;
        }

        // Clear last name
        $rootinfoitizedLname = str_replace(array('\'', '%', '\\', '/'), '', $lastname);

        // Validate last name
        if ($rootinfoitizedLname != $lastname) {
            $this->_result .= 'novalidlastname,';
            $stop = true;
        }

        // User data are valid, set to property
        if ($stop != true) {
            $this->_userFirstName = $firstname;
            $this->_userLastName = $lastname;
        }
    }

    /**
     * @param string $newsletter
     */
    protected function setNewsletter($newsletter = 'no')
    {
        if ($newsletter == 'ok') {
            $this->_userNewsletter = true;
        } else {
            $this->_userNewsletter = false;
        }
    }

    /**
     * Validate email. Retrieve TRUE if email is already exist.
     * @return bool
     */
    protected function isEmailExist()
    {
        $customer = Mage::getModel('customer/customer');
        
        $customer->setWebsiteId(Mage::app()->getWebsite()->getId());
        $customer->loadByEmail($this->_userEmail);
        
        if($customer->getId()) {
            return true;
        }

        return false;
    }

    /**
     * Retrieve result.
     * @return string
     */
    public function getResult()
    {
        return $this->_result;
    }
}
