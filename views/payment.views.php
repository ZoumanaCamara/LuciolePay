<?php $title = "Luciole | Paiement - Orange"; ?>

<?php require "partials/header.php"; ?>
<style>
    .confirm {
        background-color: #f63;
        color: white;
        font-weight: bold;
        width: 100%;
    }

    .confirm:hover {
        background-color: #f83;
        color: #eee;
    }

    .montant {
        text-align: center;
        font-weight: bold;
    }
</style>

<div class="container">
    <h6>Commencez processus de Paiement ✅ </h6>
    <img src="assets/img/download.png" alt="Orange Money Logo">
    <div class="row">
            <div class="mb-3">
                <label for="pay" class="form-label fw-bold"><em>Le Tarif que vous avez selectionne</em></label>
                <input type="text" class="form-control text-center fw-bold" readonly id="pay" name="pay" value="<?= $prix . 'F-'. $duree . ($duree > 1 ? "JOURS" : "JOUR") ?>" style="background-color: #eef;">
            </div>

            <a class="btn w-75 text-white fw-bold text-center mx-auto mb-2" style="background-color: #f83;"
                href="payment_orange.php?amount=<?= base64_encode($id_router) ?>-<?=base64_encode($duree) ?>-<?=base64_encode($prix) ?>">
                Confirmer Votre Paiement
            </a>
    </div>
    <div class="row rounded-1 m-1 py-2 px-3 text-center" style="background-color: rgba(200, 100, 100, 0.3);">
        Après le paiement veuillez cliquer sur lien <span class="fw-bolder text-danger">Retourner au site du marchand</span>
    </div>
</div>

<?php require "partials/footer.php"; ?>