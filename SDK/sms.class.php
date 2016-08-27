<?php

namespace SDK\smsSDK;

require_once 'Twilio/autoload.php';

use Twilio\Rest\Client;

class smsSDK{

    static $config;

    private $to;

    private $from;

    private $body;

    private $apiKEY;


    public function __construct()
    {
        self::$config = json_decode(file_get_contents('SDK/config.json'));

        $this->from = self::$config->default->from;

    }


    public function setTo($to){
        $this->to = $to;
        return $this;
    }

    public function setFrom($from){
        $this->from = $from;
        return $this;
    }

    public function setBody($body){
        $this->body = $body;
        return $this;
    }

    public function setAPIKey($apiKey){
        $this->apiKEY = $apiKey;
        return $this;
    }


    public function sendSMS(){

        if(!in_array($this->apiKEY, self::$config->authorized_keys)){

            $json = json_encode([
                "status" => "error_api_key"
            ]);
            exit($json);

        }

        $client = new Client(self::$config->sid, self::$config->token);

        $sms = $client->messages->create(
            $this->to,
            array(
                'from' => $this->from,
                'body' => $this->body
            )
        );

        if($sms){
            $json = json_encode([
                "status" => "success"
            ]);
            exit($json);
        } else{
            $json = json_encode([
                "status" => "error"
            ]);
            exit($json);
        }

    }


}