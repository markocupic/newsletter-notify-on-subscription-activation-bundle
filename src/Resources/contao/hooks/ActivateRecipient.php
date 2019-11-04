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
                if (($objChannel = NewsletterChannelModel::findByPk($channelId)) !== null)
                {
                    if ($objChannel->notifyOnSubscriptionActivation)
                    {
                        if (($objNotification = Notification::findByPk($objChannel->onSubscriptionActivationNotification)) !== null)
                        {
                            // Fill newsletter channel token from tl_newsletter_channel
                            $arrTokens = array();
                            $arrRow = $objChannel->row();
                            foreach ($arrRow as $k => $v)
                            {
                                $arrTokens['newsletter_' . $k] = html_entity_decode($v);
                            }

                            // Fill recipient token from tl_newsletter_recipients
                            foreach ($arrAdd as $id)
                            {
                                if (($objRecipient = NewsletterRecipientsModel::findByPk($id)) !== null)
                                {
                                    if ($objRecipient->pid === $objChannel->id)
                                    {
                                        $arrRow = $objRecipient->row();
                                        foreach ($arrRow as $k => $v)
                                        {
                                            $arrTokens['recipient_' . $k] = html_entity_decode($v);
                                        }
                                        // Handle timestamps
                                        $arrTimestamps = array('tstamp', 'addedOn');
                                        foreach ($arrTimestamps as $k)
                                        {
                                            if ($arrTokens['recipient_' . $k] != '')
                                            {
                                                $arrTokens['recipient_' . $k] = Date::parse(Config::get('datimFormat'), $objRecipient->{$k});
                                            }
                                        }
                                    }
                                }
                            }

                            $objNotification->send($arrTokens, $objPage->language);
                        }
                    }
                }
            }
        }
    }
}
