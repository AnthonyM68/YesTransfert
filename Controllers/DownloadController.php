<?php
require_once('Models/Download.php');

$link = null;


$message = '<div class="d-flex justify-content-center">
<div class="message-download">Votre Fichier est disponible , veuillez cliquer sur le lien ci-dessous
</div>
</div>
<div class="d-flex justify-content-center">
<form method="POST" class="hiddenForm" id="validLink">
    <input type="hidden" name="validLink" value="<?= $link ?>" />
    <button type="submit" class="btn-download">Cliquez ici</a>
</form>
</div>';


if (isset($_GET['link']) && !empty($_GET['link'])) {
    //si serveur distant
    if ($_SERVER['SERVER_NAME'] === "anthonym.promo-36.codeur.online") {
        $link = 'https://anthonym.promo-36.codeur.online/YesTransfert/Uploads/' . $_GET['link'];
    }
    //si serveur local
    else if ($_SERVER['SERVER_NAME'] === "localhost") {
        $link = 'http://localhost/yestransfert/Uploads/' . $_GET['link'];
    }
}
if (isset($_POST['validLink']) && !empty($_POST['validLink'])) {
    $message = '<div class="d-flex justify-content-center thanksyou">Merci d\'avoir utilisé Yes Transfert</div>';
}


require_once('Views/downloadView.php');
