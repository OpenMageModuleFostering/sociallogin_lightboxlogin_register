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


class Rootinfo_SocialConnect_Block_Google_Account extends Mage_Core_Block_Template
{
    protected $client = null;
    protected $userInfo = null;

    protected function _construct() {
        parent::_construct();

        $this->client = Mage::getSingleton('rootinfo_socialconnect/google_client');
        if(!($this->client->isEnabled())) {
            return;
        }

        $this->userInfo = Mage::registry('rootinfo_socialconnect_google_userinfo');

        $this->setTemplate('rootinfo/socialconnect/google/account.phtml');

    }

    protected function _hasUserInfo()
    {
        return (bool) $this->userInfo;
    }

    protected function _getGoogleId()
    {
        return $this->userInfo->id;
    }

    protected function _getStatus()
    {
        if(!empty($this->userInfo->link)) {
            $link = '<a href="'.$this->userInfo->link.'" target="_blank">'.
                    $this->htmlEscape($this->userInfo->name).'</a>';
        } else {
            $link = $this->userInfo->name;
        }

        return $link;
    }

    protected function _getEmail()
    {
        return $this->userInfo->email;
    }

    protected function _getPicture()
    {
        if(!empty($this->userInfo->picture)) {
            return Mage::helper('rootinfo_socialconnect/google')
                    ->getProperDimensionsPictureUrl($this->userInfo->id,
                            $this->userInfo->picture);
        }

        return null;
    }

    protected function _getName()
    {
        return $this->userInfo->name;
    }

    protected function _getGender()
    {
        if(!empty($this->userInfo->gender)) {
            return ucfirst($this->userInfo->gender);
        }

        return null;
    }

    protected function _getBirthday()
    {
        if(!empty($this->userInfo->birthday)) {
            if((strpos($this->userInfo->birthday, '0000')) === false) {
                $birthday = date('F j, Y', strtotime($this->userInfo->birthday));
            } else {
                $birthday = date(
                    'F j',
                    strtotime(
                        str_replace('0000', '1970', $this->userInfo->birthday)
                    )
                );
            }

            return $birthday;
        }

        return null;
    }

}
