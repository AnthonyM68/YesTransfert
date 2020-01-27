<?php
require_once('Models/Download.php');
$link = null;

if (isset($_GET['link']) && !empty($_GET['link'])) {
    //si serveur distant
    if ($_SERVER['SERVER_NAME'] === "anthonym.promo-36.codeur.online") {
        $link = 'https://anthonym.promo-36.codeur.online/YesTransfert/Uploads/' . $_GET['link'];
    }
    //si serveur local
    else if ($_SERVER['SERVER_NAME'] === "localhost") {
        $link = 'http://localhost/yestransfert/Uploads/' . $_GET['link'];
    }
    $message = '<div class="d-flex justify-content-center">
    <div class="message-download">Votre Fichier est disponible , veuillez cliquer sur le lien ci-dessous
    </div>
    </div>
    <div class="d-flex justify-content-center">
    <form method="POST" class="hiddenForm" id="validLink">
    <input type="hidden" name="validLink" value="' . $link . '" />
    <button type="submit" onclick="window.open(\'' . $link . '\')" class="btn-download">Cliquez ici</button>
    </form>
    </div>';
}
if (isset($_POST['validLink']) && !empty($_POST['validLink'])) {
    $message = '<div class="d-flex justify-content-center thanksyou">Merci d\'avoir utilisé Yes Transfert</div>';
}
require_once('Views/downloadView.php');

//Alternative pour download un fichier
/*
        $file = $_POST['validLink'];
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");

        readfile($file);
*/
