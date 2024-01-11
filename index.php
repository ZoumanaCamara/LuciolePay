<?php

session_start(); 
require "database/connexion.php";


$request = $conn->query("SELECT mode_test FROM routeur WHERE id_rt = 1"); 

$result = $request->fetch(); 

if($result->mode_test === 0) {

    $sql = 'SELECT * FROM profil WHERE id_rt = 1';
    $routeur_tarif = $conn->query($sql)->fetchAll();

    require "views/index.views.php"; 


} else {
    
    require "views/index.essayer.views.php";
}
