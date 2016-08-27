<?php

namespace SDK;

require_once 'SDK/sms.class.php';

use SDK\smsSDK;

if(isset($_GET['to']) && isset($_GET['body']) && isset($_GET['apiKey'])){

    $to = "+" . $_GET['to'];
    $body = $_GET['body'];

    $apiKey = $_GET['apiKey'];

    $sms = new smsSDK\smsSDK();

    return $sms->setAPIKey($apiKey)
                ->setBody($body)
                ->setTo($to)
                // Send SMS
                ->sendSMS();
}
