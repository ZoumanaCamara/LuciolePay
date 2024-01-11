<?php 

session_start(); 
require "include/function.php"; 


if(!empty($_GET['payment_url']) && !empty($_GET['pay_token'])) {

    $payment_url = $_GET['payment_url'];
    $pay_token = $_GET['pay_token'];

    $_SESSION['orange_pay_token'] = $pay_token; 

    redirect($payment_url);

}