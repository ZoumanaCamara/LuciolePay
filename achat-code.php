<?php

if (!empty($_GET['username']) && !empty($_GET['password']) && !empty($_GET['prix']) && !empty($_GET['duree']) && !empty($_GET['numero'])) {

    $element_aleatoire = []; 
    $element_aleatoire = (object) $element_aleatoire; 
    
    $element_aleatoire->username = $_GET['username'];
    $element_aleatoire->password = $_GET['password'];
    $element_aleatoire->prix = $_GET['prix'];
    $element_aleatoire->duree = $_GET['duree'];
    $element_aleatoire->numero = $_GET['numero'];
    $element_aleatoire->test = true; 

    require "views/code.views.php"; 
    
}
    
