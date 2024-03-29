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
 *  Handler ajax login and registration 
 *  Class Rootinfo_SocialConnect_AjaxController
 *  @see Mage_Customer_AccountController
 *  @author Root Info Solution Pvt Ltd.
 */


class Rootinfo_SocialConnect_AjaxController extends Mage_Core_Controller_Front_Action
{
    /**
     * Root: ajaxlogin/ajax/index
     */
    
    
    public function indexAction()
    {
        if (isset($_POST['ajax'])){
            // Login request
            if ($_POST['ajax'] == 'login' && Mage::helper('customer')->isLoggedIn() != true) {
                $login = Mage::getSingleton('rootinfo_socialconnect/ajaxlogin');
                echo $login->getResult();
            // Register request
            } else if ($_POST['ajax'] == 'register' && Mage::helper('customer')->isLoggedIn() != true) {
                $register = Mage::getSingleton('rootinfo_socialconnect/ajaxregister');
                echo $register->getResult();
            }
        }
    }
    
    public function viewAction()
    {
    }
}
