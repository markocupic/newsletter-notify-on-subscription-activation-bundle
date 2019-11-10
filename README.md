# Benachrichtigung bei Newsletter Aktivierung (Opt-In E-Mail-Aktivierungslink)

## Frontend Modul für Contao >=4.4

Versenden Sie via terminal42/notification_center Benachrichtigungen, wenn sich Besucher auf Ihrer Seite für einen Newsletter anmelden. 
Die Benachrichtigungen werden versendet, sobald der Besucher seine Newsletter-Anmeldung per E-Mail-Link bestätigt.


## Installation

```php
composer require markocupic/newsletter-notify-on-subscription-activation-bundle
```

## Benachrichtigung einrichten (Notification Center)
Erstellen Sie im Backend-Modul "Benachrichtigungen" eine Benachrichtigung des Typs "Newsletter-Benachrichtigungen -> Newsletter Anmeldung Aktivierung"


Als token stehen ##recipient_*## und ##newsletter_*## zur Verfügung. 

Mit ##recipient_email## lässt sich im NC die E-Mail-Adresse des neuen Abonnenten ausgeben. Weitere Felder können über ##recipient_*## ausgegeben werden.

Mit ##newsletter_title## lässt sich im NC der Titel des Newsletter-Channels  ausgeben. Weitere Felder können über ##newsletter_*## ausgegeben werden.

Im Modul Newsletter müssen Sie nun lediglich noch die Benachrichtigung aktivieren.

## Optional per Hook die tokens anpassen
Eine Beispielklasse für die Benutzung des Hooks findet sich hier [hier](src/Resources/contao/hooks/BeforeNotifyOnSubscriptionActivation.php):
Damit lassen sich beispielsweise die Tokens weiter an eigene Bedürfnisse anpassen.

```php
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

```

Den Hook wie immer contaotypisch in der config.php des eigenen Moduls registrieren.

```php

// config.php
$GLOBALS['TL_HOOKS']['beforeNotifyOnSubscriptionActivation'][] = array('Markocupic\BeforeNotifyOnSubscriptionActivation','beforeNotifyOnSubscriptionActivation');


```

