p<?php

require "APIService.php"; 


class OrangeMoneyService
{
    private $api;

    private  $token;

    public function __construct()
    {
       $this->api = new APIService(); 
    }

    public function getAccesToken()
    {
        // $rep = $this->api->getToken();
        // $data= json_decode($rep->getBody(), true);
        // $this->token=$data["access_token"];

        // return $data;

        try {
            $rep = $this->api->getToken();
    
            if ($rep->getStatusCode() === 200) {
                $data = json_decode($rep->getBody(), true);
    
                if (isset($data["access_token"])) {
                    $this->token = $data["access_token"];
                    return $data;
                } else {
                    // Gérez l'absence de la clé "access_token" dans les données JSON.
                    echo ("la cle du token n'a pas pu etre reccuperer"); 
                    die; 
                }
            } else {
                // Gérez l'erreur de statut de la réponse.
            }
        } catch (\Exception $e) {
            // Gérez les exceptions potentielles (par exemple, échec de la connexion à l'API).
            echo(['error' => $e->getMessage()]);
        }
    }


    public function webPayment($data)
    {
        $dt= $this->getAccesToken();
        $rep = $this->api->Payment($this->token,$data);
        
        if (is_object($rep)) {
            $data = json_decode($rep->getBody(), true);
            return $data;
        } elseif (is_string($rep)) {
            return $rep;
        } else {
            return $rep;
        }
    }

    public function checkTransactionStatus($orderId, $amount, $pay_token)
    {

        $data = [
            "order_id"  => $orderId,
            "amount"    => $amount,
            "pay_token" => $pay_token
        ];

        $dt = $this->getAccesToken();
        $rep = $this->api->checkTransactionStatus($this->token, $data);

        if (is_object($rep)) {
            $data = json_decode((string)$rep->getBody(), true);
            return $data;
        } elseif (is_string($rep)) {
            return $rep;
        } else {
            return $rep;
        }
    }

    
}

