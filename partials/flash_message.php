<?php 

if (isset($_SESSION['flashbag'])) {
    foreach ($_SESSION['flashbag'] as $type => $messages) {
        foreach ($messages as $message) {
            echo '<div class="alert alert-' . $type . '" role="alert">' . $message . '</div>';
        }
    }
    // Effacer les messages flash après les avoir affichés
    // unset($_SESSION['flashbag']);
}