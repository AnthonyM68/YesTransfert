<?php require_once "header.php"; ?>

<div class="area">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>
<div class="container">
    <div class="container-message ">
        <div class="d-flex justify-content-center">
            <div class="message-download">Votre Fichier est disponible , veuillez cliquer sur le lien ci-dessous
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button class="btn-download" onclick="location.href='<?=$link?>'">Cliquez ici</button>
        </div>
    </div>
</div>
<?php require_once "footer.php"; ?>