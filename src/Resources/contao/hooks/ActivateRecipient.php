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

use Contao\Config;
use Contao\Controller;
use Contao\Date;
use Contao\NewsletterChannelModel;
use Contao\NewsletterRecipientsModel;
use NotificationCenter\Model\Notification;

/**
 * Class ActivateRecipient
 * @package Markocupic
 */
class ActivateRecipient
{
    /**
     * Send notification via terminal42/notification_center when newsletter recipent activates its newsletter subscription
     * @param $strEmail
     * @param $arrAdd
     * @param $arrCids
     */
    public function activateRecipient($strEmail, $arrAdd, $arrCids)
    {
        global $objPage;

        if (!empty($arrAdd) && is_array($arrAdd) && !empty($arrCids) && is_array($arrCids))
        {
            foreach ($arrCids as $channelId)
            {
                $subscriberId = null;

                if (($objChannel = NewsletterChannelModel::findByPk($channelId)) !== null)
                {
                    if ($objChannel->notifyOnSubscriptionActivation)
                    {
                        if (($objNotification = Notification::findByPk($objChannel->onSubscriptionActivationNotification)) !== null)
                        {
                            $subscriberId = null;

                            // Fill newsletter channel token from tl_newsletter_channel
                            $arrTokens = array();
                            $arrRow = $objChannel->row();
                            foreach ($arrRow as $k => $v)
                            {
                                $arrTokens['newsletter_' . $k] = html_entity_decode($v);
                            }
                            // Convert timestamp to date
                            $arrTokens['newsletter_tstamp'] = Date::parse(Config::get('datimFormat'), $objChannel->tstamp);

                            // Fill recipient token from tl_newsletter_recipients
                            foreach ($arrAdd as $id)
                            {
                                if (($objSubscriber = NewsletterRecipientsModel::findByPk($id)) !== null)
                                {
                                    if ($objSubscriber->pid === $objChannel->id)
                                    {
                                        $subscriberId = $objSubscriber->id;
                                        foreach ($objSubscriber->row() as $k => $v)
                                        {
                                            $arrTokens['recipient_' . $k] = html_entity_decode($v);
                                        }
                                        // Convert timestamps to date
                                        $arrTimestamps = array('tstamp', 'addedOn');
                                        foreach ($arrTimestamps as $k)
                                        {
                                            if ($arrTokens['recipient_' . $k] != '')
                                            {
                                                $arrTokens['recipient_' . $k] = Date::parse(Config::get('datimFormat'), $objSubscriber->{$k});
                                            }
                                        }
                                    }
                                }
                            }

                            $blnSend = true;
                            if ($objNotification !== null && ($objSubscriber = NewsletterRecipientsModel::findByPk($subscriberId) !== null))
                            {
                                // HOOK: add custom tokens
                                if (isset($GLOBALS['TL_HOOKS']['beforeNotifyOnSubscriptionActivation']) && \is_array($GLOBALS['TL_HOOKS']['beforeNotifyOnSubscriptionActivation']))
                                {
                                    foreach ($GLOBALS['TL_HOOKS']['beforeNotifyOnSubscriptionActivation'] as $callback)
                                    {
                                        if ($blnSend)
                                        {
                                            $objHook = Controller::importStatic($callback[0]);
                                            // Pass $arrTokens by reference!
                                            $blnSend = $objHook->{$callback[1]}($arrTokens, $objSubscriber, $objChannel, $objNotification);
                                        }
                                    }
                                }
                                if ($blnSend)
                                {
                                    $objNotification->send($arrTokens, $objPage->language);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
