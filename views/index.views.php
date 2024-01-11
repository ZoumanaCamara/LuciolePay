<?php $title = "Luciole | Tarif"; ?>

<?php require "partials/header.php"; ?>

<style>
    img {
        width: 30px;
        height: 30px;
    }
</style>

<div class="container">
        <h6>CONSULTER NOS TARIFS MOINS CHERS ✅</h6>
        
        <?php include("partials/flash_message.php") ?>

        <div class="table-responsive bg-white rounded-md shadow-md">
            <table class="table table-bordered text-center text-sm font-weight-light">
                <thead class="border-bottom bg-white font-weight-medium">
                    <tr>
                        <th scope="col" class="px-3 py-2">PRIX</th>
                        <th scope="col" class="px-3 py-2">DUREE</th>
                        <th scope="col" class="px-3 py-2">ACHETER</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($routeur_tarif as $tarif): ?>
                        <tr class="border-bottom bg-light dark:border-dark dark:bg-dark">
                            <td class="whitespace-nowrap px-3 py-2 text-secondary"><?= $tarif->prix . "F" ?></td>
                            <td class="whitespace-nowrap px-3 py-2 text-secondary"><?= $tarif->duree . "JOUR" ?></td>
                            <td class="whitespace-nowrap px-3 py-2">

                                <a href="amount.php?amount=<?= base64_encode($tarif->id_rt) ?>-<?= base64_encode($tarif->duree) ?>-<?= base64_encode($tarif->prix) ?>"
                                    class="text-warning fw-bolder text-decoration-none">
                                    Acheter <img src="assets/img/download.png" /> 
                                </a> 
                        
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


<?php require "partials/footer.php"; ?>