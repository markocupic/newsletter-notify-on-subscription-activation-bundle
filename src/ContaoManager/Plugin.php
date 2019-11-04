<?php

/**
 * Module for Contao CMS
 * Copyright (c) 2008-2019 Marko Cupic
 * @package newsletter-notify-on-subscription-activation-bundle
 * @author Marko Cupic m.cupic@gmx.ch, 2019
 * @link https://github.com/markocupic/newsletter-notify-on-subscription-activation-bundle
 */

namespace Markocupic\NewsletterNotifyOnSubscriptionActivationBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

/**
 * Class Plugin
 * @package Markocupic\NewsletterNotifyOnSubscriptionActivationBundle\ContaoManager
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create('Markocupic\NewsletterNotifyOnSubscriptionActivationBundle\MarkocupicNewsletterNotifyOnSubscriptionActivationBundle')
                ->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle'])
        ];
    }
}
