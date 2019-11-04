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

// Hooks
$GLOBALS['TL_HOOKS']['activateRecipient'][] = array('Markocupic\ActivateRecipient', 'activateRecipient');

// notification center
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['newsletter-notify'] = array
(

    // Type
    'on-subscription-activation' => array
    (
        // Field in tl_nc_language
        'email_sender_name'    => array(),
        'email_sender_address' => array(),
        'recipients'           => array('recipient_email', 'recipient_email'),
        'email_replyTo'        => array('recipient_email', 'recipient_email'),
        'email_recipient_cc'   => array('recipient_email', 'recipient_email'),
        'email_subject'        => array('recipient_email', 'recipient_*', 'newsletter_*'),
        'email_text'           => array('recipient_email', 'recipient_*', 'newsletter_*'),
        'email_html'           => array('recipient_email', 'recipient_*', 'newsletter_*'),
    )
);
