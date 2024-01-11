<?php

session_start(); 
require "vendor/autoload.php"; 
require "include/function.php"; 


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request; 

if (!empty($_GET['username']) && !empty($_GET['password']) && !empty($_GET['prix']) && !empty($_GET['duree']) && !empty($_GET['numero'])) {

    $numero = $_GET['numero'];
        $code = $_GET['username']; 
        $password = $_GET['password'];
        $prix = $_GET['prix']; 
        $duree = $_GET['duree']; 

        $params = array(
            "token" => "q5x4y950nlr2o4mm",
            "to" => "$numero",
            "body" => "Bienvenue sur notre reséau Luciole. Merci pour votre achat de $prix F - $duree H .
            Code : $code 
            Mot de pass : $password"
        );

        $client = new Client();
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $options = ['form_params' => $params];
        $request = new Request('POST', 'https://api.ultramsg.com/instance10652/messages/chat', $headers);
        $res = $client->sendAsync($request, $options)->wait();
        echo $res->getBody();

        addFlashMessage("success", "Votre code a été envoyer sur whatsapp. Veuillez cliquer sur ce lien <strong><a href='http://luciole.net'>luciole.net</a></strong> pour renseigner vos informations de connexion"); 
        redirect("index.php"); 

    
}
    