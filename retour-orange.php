<?php

session_start();
require "include/function.php";
require "database/connexion.php";
require "OrangeMoneyService.php";

if (!empty($_GET['order_id']) && !empty($_GET['id_router']) && !empty($_GET['duree']) && !empty($_GET['prix'])) {

    // verifier si la transaction est un succes ou pas
    $pay_token = $_SESSION['orange_pay_token'];
    $id_router = $_GET['id_router'];
    $duree = $_GET['duree'];
    $prix = $_GET['prix'];
    $order_id = $_GET['order_id'];

    $payment = new OrangeMoneyService();


    $result = $payment->checkTransactionStatus($order_id, $prix, $pay_token);

    if ($result['status'] === 'FAILED') {

        if (isset($_POST['envoyer_numero'])) {

            $erreurs = [];
            $_SESSION['erreurs'] = []; 

            if (!empty($_POST['numero']) || !trim($_POST['numero']) != "") {

                $numero = $_POST['numero'];

                if (mb_strlen($numero) < 8 || mb_strlen($numero) > 14) {

                    $erreurs[] = "Minimum (8) caracteres Maximun (14 caracteres)";
                }

                if(!preg_match("/[0-9]/", $numero)) {
                    $erreurs[] = "Entrez un numero valide !"; 
                }

                if (count($erreurs) === 0) {

                    // decode les informations de url
                    // $id_router = base64_decode($id_router);
                    // $duree = base64_decode($duree);
                    // $prix = base64_decode($prix);

                    $sql = "SELECT *
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

                    $code_not_used = $request->fetchAll();
                    $element_aleatoire = $code_not_used[array_rand($code_not_used)];



                    
                    // modifier la option en o pour specifier que vient etre activer
                    $sql = "UPDATE code_ticke SET op = 'o' WHERE id_code = $element_aleatoire->id_code"; 
                    $conn->query($sql);

                    // enregister les codes utilises dans la table achat pour specifier vient utiliser
                    $sql = "INSERT INTO achat_code(id_rt, duree, prix, code_username, code_password, numero) 
                            VALUES (:id_rt, :duree, :prix, :code_username, :code_password, :numero)
                        "; 

                    $data = [
                        'id_rt' => $id_router, 
                        'duree' => $duree, 
                        'prix' => $prix, 
                        'code_username' => $element_aleatoire->username,
                        'code_password' => $element_aleatoire->password,
                        'numero' => $numero,
                    ]; 

                    $request = $conn->prepare($sql); 
                    $request->execute($data); 

                    redirect("achat-code.php?username=".$element_aleatoire->username .

                        "&password=". $element_aleatoire->password . 
                        "&prix=".$prix . 
                        "&duree=".$duree . 
                        "&numero=".$numero
                    ); 
                
                    
                }
            } else {
                $erreurs[] = "Veuillez entrer un numero !";
            }

            $_SESSION['erreurs'] = $erreurs;
        }

        require "views/demander.views.php"; 
    } else if($result['status'] === 'SUCCESS') {

        addFlashMessage("danger", "Votre paiement Orange Money a echoué. Veuillez encore ressayer !");
        redirect("index.php"); 

    } else {

        redirect("index.php"); 
    }


    // } else if ($result['status'] === 'SUCCESS') {

    //     addFlashMessage("danger", "Votre paiement Orange Money a echoué. Veuillez encore ressayer !");
    //     redirect('index.php');

    // } else {
    //     redirect('index.php');
    // }
}
