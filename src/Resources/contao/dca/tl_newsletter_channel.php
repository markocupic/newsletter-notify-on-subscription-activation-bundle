<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 04.11.2019
 * Time: 19:06
 */

// Manipulate palette default
Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('notify_on_subscription_activation_legend', 'title_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
    ->addField(array('notifyOnSubscriptionActivation'), 'notify_on_subscription_activation_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_newsletter_channel');

// Palettes
$GLOBALS['TL_DCA']['tl_newsletter_channel']['palettes']['__selector__'][] = 'notifyOnSubscriptionActivation';
$GLOBALS['TL_DCA']['tl_newsletter_channel']['subpalettes']['notifyOnSubscriptionActivation'] = 'onSubscriptionActivationNotification';

$GLOBALS['TL_DCA']['tl_newsletter_channel']['fields']['notifyOnSubscriptionActivation'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_newsletter_channel']['notifyOnSubscriptionActivation'],
    'exclude'   => true,
    'filter'    => true,
    'inputType' => 'checkbox',
    'eval'      => array('submitOnChange' => true),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_newsletter_channel']['fields']['onSubscriptionActivationNotification'] = array(
    'label'      => &$GLOBALS['TL_LANG']['tl_newsletter_channel']['onSubscriptionActivationNotification'],
    'exclude'    => true,
    'search'     => true,
    'inputType'  => 'select',
    'foreignKey' => 'tl_nc_notification.title',
    'eval'       => array('mandatory' => true, 'includeBlankOption' => false, 'chosen' => true, 'tl_class' => 'clr'),
    'sql'        => "int(10) unsigned NOT NULL default '0'",
    'relation'   => array('type' => 'hasOne', 'load' => 'lazy'),
);
