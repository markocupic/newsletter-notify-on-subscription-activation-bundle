<?php

/**
 * Send notifications on newsletter subscription activation
 * extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2019, markocupic
 * @author     markocupic <m.cupic@gmx.ch>
 * @link https://github.com/markocupic/newsletter-notify-on-subscription-activation-bundle
 * @license    MIT
 */

namespace Markocupic;

/**
 * Class BeforeNotifyOnSubscriptionActivation
 * @package Markocupic
 */
class BeforeNotifyOnSubscriptionActivation
{

    /**
     * Pass $arrTokens by reference!!!
     * @param $arrTokens
     * @param $objSubscriber
     * @param $objChannel
     * @param $objNotification
     * @return bool
     */
    public function beforeNotifyOnSubscriptionActivation(&$arrTokens, $objSubscriber, $objChannel, $objNotification)
    {
        $arrTokens['recipient_email'] = 'hans_muster@foofoo.bar';
        $arrTokens['newsletter_title'] = 'My incredible newsletter';

        // Return true, if notification should be sent
        return true;
    }

}
