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
* @package    Rootinfo_Socialconnect
* @author     Shekhar <shekhar@rootinfosol.com>
* @copyright  Copyright (c) 2014-2015 (http://rootinfosol.com/)
* @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
*/

/**
 *  Override Customer Account controller. 
 *  Class Rootinfo_Ajaxlogin_AccountController
 *  @see Mage_Customer_AccountController
 *  @author Root Info Solution Pvt Ltd.
 */

require_once Mage::getModuleDir('controllers', 'Mage_Customer') . DS . 'AccountController.php';



class Rootinfo_SocialConnect_AccountController extends Mage_Customer_AccountController
{
    /**
     * @var string
     */
    protected $_url;

    /**
     * Before actions.
     * @return Mage_Core_Controller_Front_Action|void
     */
    public function preDispatch()
    {
        $this->_url = Mage::getBaseUrl() . '?lightboxlogin';
        
        parent::preDispatch();
    }

    /**
     * Disable login action.
     */
    public function loginAction()
    {
        $this->_setLocation();
    }

    /**
     * Disable create action.
     */
    public function createAction()
    {
        $this->_setLocation();
    }

    /**
     * Redirect to home.
     */
    protected function _setLocation()
    {
        Mage::app()->getFrontController()->getResponse()->setRedirect($this->_url);
    }



public function preDispatch()
    {
        parent::preDispatch();

        if (!$this->getRequest()->isDispatched()) {
            return;
        }
        
        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->setFlag('', 'no-dispatch', true);
        }
    }    

    public function googleAction()
    {        
        $userInfo = Mage::getSingleton('rootinfo_socialconnect/google_userinfo')
                ->getUserInfo();
        
        Mage::register('rootinfo_socialconnect_google_userinfo', $userInfo);
        
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function facebookAction()
    {        
        $userInfo = Mage::getSingleton('rootinfo_socialconnect/facebook_userinfo')
            ->getUserInfo();
        
        Mage::register('rootinfo_socialconnect_facebook_userinfo', $userInfo);
        
        $this->loadLayout();
        $this->renderLayout();
    }    
    
    public function twitterAction()
    {        
        // Cache user info inside customer session due to Twitter window frame rate limits
        if(!($userInfo = Mage::getSingleton('customer/session')
                ->getInchooSocialconnectTwitterUserinfo())) {
            $userInfo = Mage::getSingleton('rootinfo_socialconnect/twitter_userinfo')
                ->getUserInfo();
            
            Mage::getSingleton('customer/session')->setInchooSocialconnectTwitterUserinfo($userInfo);
        }
        
        Mage::register('rootinfo_socialconnect_twitter_userinfo', $userInfo);
        
        $this->loadLayout();
        $this->renderLayout();
    }    
}
