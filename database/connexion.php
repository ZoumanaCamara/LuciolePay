<?php 

require 'config-db.php'; 

try
{

    $option = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]; 

    $string = DB_TYPE . ":host=". DB_HOST . ";dbname=" . DB_NAME; 

    $conn = new PDO($string, DB_USER, DB_PASSWORD, $option); 

} catch (PDOException $e) {

    echo "ERREUR : ".$e->getMessage(); 
}