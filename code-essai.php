<?php

require "database/connexion.php"; 
require "include/function.php"; 

$sql = 'SELECT mode_test FROM routeur WHERE id_rt = 1';
$request = $conn->query($sql); 

$check_if_router_is_mode_test = $request->fetch(); 

if ($check_if_router_is_mode_test->mode_test === 1) {



    $sql = "SELECT *
                        FROM code_ticke
                        JOIN profil ON code_ticke.code_profil = profil.code_profil 
                        WHERE profil.id_rt = 1
                        AND profil.duree = 1
                        AND profil.prix = 200
                        AND code_ticke.op = 'n'
                ";

    $request = $conn->query($sql); 
    $code_not_used = $request->fetchAll(); 

    // reccuperer les codes non utiliser dans la base de donnee de facon aleatoire
    $element_aleatoire = $code_not_used[array_rand($code_not_used)];
    $element_aleatoire->test = false; 


    require "views/code.views.php"; 
} else {

    addFlashMessage('info', 'Nous ne sommes pas en promo actuellement. Veuillez effectuer un achat pour obtenir un code !');
    redirect("index.php"); 
}
