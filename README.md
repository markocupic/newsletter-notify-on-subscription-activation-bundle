# Benachrichtigung bei Newsletter Aktivierung 

## Frontend Modul für Contao >=4.4

Versenden Sie via terminal42/notification_center Benachrichtigungen, wenn sich Besucher auf Ihrer Seite für einen Newsletter anmelden. 
Die Benachrichtigungen werden versendet, sobald der Besucher seine Newsletter-Anmeldung per E-Mail-Link bestätigt.


## Installation

```php
composer require markocupic/newsletter-notify-on-subscription-activation-bundle
```

## Benachrichtigung einrichten
Erstellen Sie im Backend-Modul "Benachrichtigungen" eine Benachrichtigung des Typs "Newsletter-Benachrichtigungen -> Newsletter Anmeldung Aktivierung"
Als token stehen Ihnen ##recipient_*## und ##newsletter_*## zur Verfügung. 
Möchten Sie die E-Mail-Adresse des neuen Abonnenten ausgeben, so benutzen Sie ##recipient_*##, etc.
Mächten Sie den Titel des Newsletter-Channels ausgeben, benutzen Sie bitte ##newsletter_title##, etc. 

Im Modul Newsletter müssen Sie nun lediglich noch die Benachrichtigung aktivieren.

Viel Spass!
