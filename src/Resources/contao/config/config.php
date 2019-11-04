<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 08.09.2019
 * Time: 19:03
 */

// Hooks
$GLOBALS['TL_HOOKS']['activateRecipient'][] = array('Markocupic\ActivateRecipient','activateRecipient');



// notification center
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['newsletter-notify-on-subscription-activation'] = array
(

    // Type
    'notify-on-subscription-activation' => array
    (
        // Field in tl_nc_language
        'email_sender_name' => array(),
        'email_sender_address' => array(),
        'recipients'    => array('recipient_email'),
        'email_replyTo' => array(),
        'email_recipient_cc' => array(),
        'email_subject' => array('newsletter_*'),
        'email_text'    => array('newsletter_*'),
        'email_html'    => array('newsletter_*'),
    ),
);
