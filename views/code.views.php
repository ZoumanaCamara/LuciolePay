<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Luciole - Envoie Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/default-theme.css">
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
</head>

<bod>
    <div class="container">
        <div class="bg-white p-8 rounded" id="contentToExport">
            <p class="h2 fw-bold mb-4 text-center">Luciole : Code d'accès</p>

            <h5 class="text-center border-bottom border-secondary mb-2 pb-2">
                <?= date("d/m/Y H:i:s") ?>
            </h5>

            <div class="d-flex w-100 justify-content-around align-items-center gap-2">
                <div class="mb-4">
                    <p class="mb-2">Username:</p>
                    <div class="border border-dark p-2 rounded">
                        <span id="username" class="select-all"><?= $element_aleatoire->username ?></span>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="mb-2">Password:</p>
                    <div class="border border-dark p-2 rounded">
                        <span id="password" class="select-all"><?= $element_aleatoire->password ?></span>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold text-center border border-dark">
                Ticket de : <?= $element_aleatoire->prix ?>F - <?= $element_aleatoire->duree ?>JOUR
            </h6>
            <a class="fw-bold text-center text-primary text-decoration-underline my-2" href="http://luciole.net">Lien : http://luciole.net</a>

            <div class="d-flex justify-content-center align-items-center border-top border-light py-2">
                <button id="copyBtn" class="ms-2 btn btn-primary btn-sm fw-bold">
                    Copier
                </button>
                <button id="exportBtn" class="ms-2 btn btn-info btn-sm text-white fw-bold">
                    Télécharger
                </button>
                <?php if ($element_aleatoire->test): ?>
                    <a href="whatsapp.php?numero=<?= $element_aleatoire->numero ?>&prix=<?= $element_aleatoire->prix ?>&duree=<?= $element_aleatoire->duree ?>&username=<?= $element_aleatoire->username ?>&password=<?= $element_aleatoire->password ?>" class="ms-2 btn btn-success btn-sm">
                        WhatsApp
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html2pdf.js"></script>
    <script>
        document.getElementById("copyBtn").addEventListener("click", function() {
            var username = document.getElementById("username").innerText;
            var password = document.getElementById("password").innerText;

            var textToCopy = "Username: " + username + "\n" + "Password" + password;
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = textToCopy;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);

            alert("Le code a ete copie sur le presse-papie!");
        });

        document
            .getElementById("exportBtn")
            .addEventListener("click", function() {
                const contentToExport = document.getElementById("contentToExport");

                // Options pour la conversion en PDF
                const pdfOptions = {
                    margin: 5,
                    filename: "exported-document.pdf",
                    image: {
                        type: "jpeg",
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 1.4
                    },
                    jsPDF: {
                        unit: "mm",
                        format: "a5",
                        orientation: "portrait"
                    },
                };

                // Utiliser html2pdf pour exporter en PDF
                if (html2pdf(contentToExport, pdfOptions)) {
                    alert(
                        "Apres avoir telechager le code. Veuiller vous rendre sur le lien http://luciole.net pour renseigner votre code d'access !"
                    );
                }
            });
    </script>
</bod>

</html>