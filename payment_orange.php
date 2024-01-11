<?php 


require "database/connexion.php";
require "include/function.php";
require "OrangeMoneyService.php"; 


if (!empty($_GET['amount'])) {

    $payment = new OrangeMoneyService(); 


    // Reccuperation de url et decodage et les convertir en integerer
    $tableau = explode('-', $_GET['amount']);
    $id_router = convertStringToInteger(base64_decode($tableau[0]));
    $duree = convertStringToInteger(base64_decode($tableau[1]));
    $prix = convertStringToInteger(base64_decode($tableau[2]));

    $order_id = "orangeapi" . rand(100000, 900000) . "_00" . rand(10000, 90000);

    $data = [
        // "merchant_key" => $this->getParameter('merchant_key'),
        "merchant_key" => 'ec821b46',
        "currency" => "XOF",
        "order_id" =>  $order_id,
        "amount" => $prix,
        "return_url" => "http://192.168.1.105/Luciole/retour-orange.php?order_id={$order_id}&id_router={$id_router}&duree={$duree}&prix=$prix",
        "cancel_url" => "http://192.168.1.105/",
        "notif_url" => 'http://192.168.1.105/',
        "lang" => "fr",
        "reference" => "Luciole"
    ];

    $result = $payment->webPayment($data);

    $payment_url = $result['payment_url'];
    $pay_token = $result['pay_token'];

    redirect("transition.php?payment_url=" . $payment_url. "&pay_token=" . $pay_token); 


}