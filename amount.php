<?php

require "database/connexion.php";
require "include/function.php";


if (!empty($_GET['amount'])) {


    // Reccuperation de url et decodage et les convertir en integerer
    $tableau = explode('-', $_GET['amount']);
    $id_router = convertStringToInteger(base64_decode($tableau[0]));
    $duree = convertStringToInteger(base64_decode($tableau[1]));
    $prix = convertStringToInteger(base64_decode($tableau[2]));




    // Verifier si la categorie de ticket que utilisateur va acheter est superieur a 10 dans la base de donne
    $sql = "SELECT id_code
        FROM code_ticke
        JOIN profil ON code_ticke.code_profil = profil.code_profil 
        WHERE profil.id_rt = :id_rt
        AND profil.duree = :duree
        AND profil.prix = :prix
        AND code_ticke.op = 'n'
    ";


    $request = $conn->prepare($sql);
    $request->execute([
        'id_rt' => $id_router,
        'prix' => $prix,
        'duree' => $duree
    ]);

    $verified_if_code_price_and_duree_no_active_exist = $request->fetchAll();


    if (count($verified_if_code_price_and_duree_no_active_exist) < 5) {

        addFlashMessage("danger", "Veuillez achéter un autre ticket le ticket de $prix F n'est pas disponible pour le moment !");
        redirect('index.php');
    }



    // Securite url au cas ou l'utilisateur aurait tente de les modifier on le redirigera vers la page accueil 
    $sql = 'SELECT DISTINCT prix, duree FROM profil WHERE id_rt = 1';
    $authorizated = $conn->query($sql)->fetchAll();


    $authorizated_prix = array_column($authorizated, 'prix');
    $authorizated_duree = array_column($authorizated, 'duree');


    if (!in_array($prix, $authorizated_prix) || !in_array($duree, $authorizated_duree)) {
        redirect('index.php');
    }

    require "views/payment.views.php"; 


}
