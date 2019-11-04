<?php
/**
 * Created by PhpStorm.
 * User: Marko
 * Date: 08.09.2019
 * Time: 19:05
 */

namespace Markocupic;

class ActivateRecipient
{
    public function activateRecipient($strEmail, $arrAdd, $arrCids)
    {
        mail('m.cupic@gmx.ch', $strEmail,'s'); // Newsletter REcipient E-Mail
        mail('m.cupic@gmx.ch', 'Newsletter Recipient Id',print_r($arrAdd,true));
        mail('m.cupic@gmx.ch', 'Newsletter ID', print_r($arrCids,true));
    }
}
