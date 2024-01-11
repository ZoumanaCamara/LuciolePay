<?php 


/**
 * @param Array $value
*/
function show($value) {

    echo '<pre>'; 
    print_r($value); 
    echo '</pre>'; 
}


/**
 * @param String $type
 * @param String $message
*/
function addFlashMessage($type, $message) {
    if (!isset($_SESSION['flashbag'])) {
        $_SESSION['flashbag'] = [];
    }

    $_SESSION['flashbag'][$type][] = $message;
}

/**
 * @param String $url
 */
function redirect($url) {

    header('Location: '. $url); 
    die; 
}




/**
 * @return Integer
 * @param String $inputString
 */
function convertStringToInteger($inputString)
{
    // Tente de convertir la chaîne en slug
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputString)));

    // Tente de convertir le slug en entier
    $integerValue = (int)$slug;

    // Vérifie si la conversion a réussi
    if ($integerValue != 0 || $slug === '0') {
        // La conversion a réussi, faites quelque chose avec $integerValue
        return $integerValue;
    } else {
        // La conversion a échoué, levez une exception
        throw new \InvalidArgumentException('La conversion de la chaîne en entier a échoué.');
    }
}
