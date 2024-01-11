<?php $title = "Luciole | Demande de numero"; ?>

<?php require "partials/header.php"; ?>
<div class="container p-3">
    <div class="bg-white p-8 rounded w-100 max-w-md">
        <h5 class="fw-bold mb-4 fs-6 text-left">Veuillez entrer votre numéro de téléphone <br> pour recevoir le code</h5>
        <form method="POST">
            <div class="mb-3">
                <label for="numero" class="form-label">Numero de telephone.</label>
                <input type="text" class="form-control text-center" id="numero" name="numero" style="background-color: #eef;" placeholder="60958690">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-block w-100" name="envoyer_numero">Envoyer</button>
            </div>
        </form>
    </div>

</div>

<?php require "partials/footer.php" ?>