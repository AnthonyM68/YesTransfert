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
}
require_once('Views/downloadView.php');
