<?php

require "vendor/autoload.php"; 

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class APIService {

        /**
     * Orange Money  API Base url
     */
    const BASE_URL = "https://api.orange.com/";
    /**
     * The Query to run against the FileSystem
     * @var Client;
     */
    private $client ;
    /**
     * @var string or null
     */
    private $auth_header = 'czVOQkcxZmJNU1kzNDNUY2w4Y3JudFVBWlBjU1VOZlY6UWdwZGd5WENSdm1LOXI2WA==';

    /**
     * @var string or null
     */
    private $merchant_key = 'ec821b46';


    public function __construct()
    {
        // Credentials: <Base64 value of UTF-8 encoded “username:password”>
        $this->client = new Client([
            'base_uri' => self::BASE_URL
        ]);
        // $this->auth_header  =  $auth_header; 
        // $this->merchant_key =  $merchant_key; 
        // // $this->return_url   =  $return_url; 
        // // $this->cancel_url   =  $cancel_url; 
        // // $this->notif_url    =  $notif_url; 

    }

    /**
     * Create API query and execute a GET/POST request
     * @param string $httpMethod GET/POST
     * @param string $endpoint
     * @param string $options
     */
    private function apiCall($httpMethod, $endpoint, $options)
    {
        // POST method or GET method
        try{
            if(strtolower($httpMethod) === "post") {

                /** @var Response $response */
                $response = $this->client->request('post',$endpoint,$options);

            } else {
                $response = $this->client->get($endpoint);

            }
            /** @var $response Response */
//            $response = $request->send();

            /** @var $body EntityBody */
//            $body = $response->getBody();

            return  $response;
        }catch (Exception $exception){
            return  $exception->getMessage();
        };

    }
    /**
     * Call GET request
     * @param string $endpoint
     * @param string $options
     */
    private function get($endpoint, $options = null) {
        return $this->apiCall("get", $endpoint, $options);
    }
    /**
     * Call POST request
     * @param string $endpoint
     * @param string $options
     */
    private function post($endpoint, $options = null)
    {
        return $this->apiCall("post", $endpoint, $options);
    }
    /**
     * Get Token
     */
    public function getToken()
    {

        $options = [
            'headers'=> [
                'Authorization' => 'Basic '.$this->auth_header,
                'Accept'        =>'application/json'
            ],
            'form_params' => [
                 'grant_type'=>'client_credentials',
            ]
        ];

        return $this->post('oauth/v3/token',$options);
    }


    public function Payment($token,$body)
    {

        $id = "OM_0".rand(100000,900000)."_00".rand(10000,90000);
        $b = [
            "merchant_key"  => $this->merchant_key,
            "currency"      => "XOF",
            "order_id"      => $id,
            "amount"        => 0,
            // "return_url"    => $this->return_url,
            // "cancel_url"    => $this->cancel_url,
            // "notif_url"     => $this->notif_url,
            "lang"          => "fr"
        ];
        $b = array_merge($b,$body);
        $b = json_encode($b);

        $options = [
            'headers'=> [
                'Authorization' => 'Bearer '.$token,
                'Accept'        =>'application/json',
                'Content-Type'  =>'application/json'
            ],
            'body' => $b
        ];

        return $this->post('orange-money-webpay/ml/v1/webpayment',$options);
    }

    public function checkTransactionStatus($token, $data)
    {

        $b = [
            "order_id"  => $data["order_id"],
            "amount"    => $data["amount"],
            "pay_token" => $data["pay_token"]
        ];

        $b = json_encode($b);

        /* var_dump($b);
         die();*/
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json'
            ],
            'body' => $b
        ];

        return $this->post('orange-money-webpay/ml/v1/transactionstatus', $options);
    }
}
