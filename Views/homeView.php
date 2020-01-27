<?php require_once "header.php"; ?>

<div class="container">
    <div class="wrapper">
        <form method="POST" id="contactform" class="form-signin" enctype="multipart/form-data">
            <h2 class="form-signin-heading">Sélectionnez votre fichier</h2>
            <input type="email" name="mail_exp" class="form-control" placeholder="<?= $emptyExp ?>" /> 
            <input type="text" name="mail_dest" class="form-control" placeholder="<?= $emptyDest ?>"  />
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
            <input type="file" name="zip" class="form-control" />
            <span class="max-file-size">2Mo Max</span>
            <input type="text" name="sujet" class="form-control" placeholder="Sujet" />
            <textarea class="form-control" name="message" rows="3"></textarea>
            <button class="btn btn-lg btn-primary btn-block form-control" type="submit" name="uploadform">Envoyer</button>
            <!--On affiche le résultat du traitement-->
            <?=$displayDivError?>
            <!--On affiche le résultat du traitement-->
        </form>
    </div>
</div>


<?php require_once "footer.php"; ?>