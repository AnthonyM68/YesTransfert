<?php
require_once('Models/Upload.php');
include('Email/Email.php');
//Déclaration des constantes
$emailNoSend      = false;
$emptyDest        = "Email Destinataire";
$emptyExp         = "Email Expéditeur";
$displayDivError  = '';
$divResponseError = '<div class="alert-danger response-error form-control">';
$divResponseValid = '<div class="alert-success response-valid form-control">';
$closeDiv         = '</div>';
$sujetGen         = "L'expéditeur n'a pas laissé de message.";
$messageGen       = "Ce fichier a été généré par Yes Transfert.";
///////////////////////////////////////////////////////////
//Desactive les warning de php nottament pour la fonction $zip->close() en cas d'erreur d'écriture sur le serveur
error_reporting(E_ERROR | /*E_WARNING | */ E_PARSE);
//////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////
//Fonction checkError au chargement du fichier sélectionné
function checkError($displayDivError, $divResponseError, $closeDiv)
{
    switch ($_FILES['zip']['error']) {

        case 1:
            $displayDivError  = $divResponseError . 'La taille du fichier exède la capacité du serveur' . $closeDiv; //upload_max_filesize de php.ini
            break;
        case 2:
            $displayDivError  = $divResponseError . 'La taille du fichier téléchargé excède la valeur autorisé' . $closeDiv; //MAX_FILE_SIZE défini dans le HTML
            break;
        case 3:
            $displayDivError  = $divResponseError . 'Le fichier n\'a été que partiellement téléchargé' . $closeDiv;
            break;
        case 4:
            $displayDivError  = $divResponseError . 'Aucun fichier n\'a été sélectionné' . $closeDiv;
            break;
    }
    return $displayDivError;
}
////////////////////////////////////////////////////////////////////////////
//On test que le formualaire a bien été soumis et qu'il ne soit pas vide
if (isset($_POST['uploadform']) && !empty($_POST)) {
    
    //check email expéditeur
    if (!empty($_POST['mail_exp'])) {
        if (filter_var($_POST['mail_exp'], FILTER_VALIDATE_EMAIL)) {
            $tabValue['mail_exp'] = $_POST['mail_exp'];
            $mail_exp = $_POST['mail_exp'];
        } else {
            $emptyExp = 'Email Expéditeur non valide';
        }
    } else {
        $displayDivError .= $divResponseError . 'L\'adresse email Expéditeur est vide' . $closeDiv;
    }

    //check email destinataire
    if (!empty($_POST['mail_dest'])) {
        if (filter_var($_POST['mail_dest'], FILTER_VALIDATE_EMAIL)) {
            $tabValue['mail_dest'] = $_POST['mail_dest'];
            $mail_dest = $_POST['mail_dest'];
        } else {
            $emptyDest = 'Email Destinataire non valide';
        }
    } else {
        $displayDivError .= $divResponseError . 'L\'adresse email Destinataire est vide.' . $closeDiv;
    }

    // Testons si le fichier a bien été chargé et s'il n'y a pas d'erreur au chargement du fichier
    if (isset($_FILES['zip']) && $_FILES['zip']['error'] == 0) {
        //On vérifie que la taille du fichier est correct
        if ($_FILES['zip']['size'] <= 2000000) {
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['zip']['name']);;
            //On récupère l'extention du fichier chargé par l'utilisateur
            $extension_upload = $infosfichier['extension'];
            // On convertis l'extension en petit caractère...
            $extension_upload = strtolower($extension_upload);
            //On déclare un Tableau des extensions autorisés
            $extensions_autorisees = array('bmp', 'jpg', 'jpeg', 'png', 'gif', 'tiff', 'mp3', 'wav', 'avi', 'mkv', 'ogg', 'mov', 'mp4', 'txt', 'doc', 'docx', 'odt', 'xlsx', 'ods', 'pdf', 'exe', 'sql');
            //On compare l'extention du fichier a ceux autorisés si valide on poursuis les instruction
            if (in_array($extension_upload, $extensions_autorisees)) {
                //Si le format est autorisé on Delete l'extention temporaire du fichier créer dans le dossier temporaire de php
                $deleteExtension = str_replace('.tmp', '', $_FILES['zip']['tmp_name']);
                //on récupère alors le nom du fichier temporaire sans extension 
                $nameTmp = basename($deleteExtension);
                
                //on instancie un nouveau zip
                $zip = new ZipArchive;
                //on lui indique le chemin de sortis Uploads/son_nom_temporaire.zip
                $res = $zip->open("Uploads/" . $nameTmp . ".zip", ZipArchive::CREATE);
                //Si l'archive zip est bien créer on insert le fichier chargé par l'utilisateur depuis le dossier temporaire de php
                if ($res === TRUE) {
                    $zip->addFromString($_FILES['zip']['name'], '');
                    //on ferme l'archive
                    //le @ masque le message d'erreur de php
                    $testClose = $zip->close();
                    //Si le dossier upload est manquant ou l'accès du dossier en écriture est refuser
                    if ($testClose === false) {
                        $displayDivError .= $divResponseError . 'Erreur d\'écriture du fichier sur le serveur' . $disClose;
                        $mailNosend = true;
                    } else {
                        $displayDivError .= $divResponseValid . 'Fichier zip bien créé' . $closeDiv;
                    }
                } else {
                    $displayDivError .= $divResponseError . 'Echec de génération fichier zip' . $closeDiv;
                }
                //on récupère le chemin du fichier que l'on insert dans le tableau tabValue pour la BDD
                $zip =  "Uploads/" . $nameTmp . ".zip";
                $tabValue['zip'] = $zip;
            } else {
                $displayDivError .= $divResponseError . 'Extension de format non valide' . $closeDiv;
            }
        } else {
            //si erreur autre que 0 on appel la fonction qui vérifie les codes d'erreur et l'on affiche le résultat
            $displayDivError .= checkError($displayDivError, $divResponseError, $closeDiv);
        }
    } else {
        //si erreur autre que 0 on appel la fonction qui vérifie les codes d'erreur et l'on affiche le résultat
        $displayDivError .= checkError($displayDivError, $divResponseError, $closeDiv);
    }
    //si le sujet est vide on indique le sujet générique
    if (empty($_POST['sujet'])) {
        $tabValue['sujet'] = $sujetGen;
    } 
    else 
    {//sinon on indique la saisie de l'utilisateur
        $tabValue['sujet'] = $_POST['sujet'];
        $subject = $_POST['sujet'];
    }
    // si le message est vide on indique le message générique
    if (empty($_POST['message'])) {
        $tabValue['message'] = $messageGen;
    }
    else 
    {//sinon on indique la saisie de l'utilisateur
        $tabValue['message'] = $_POST['message'];
        $message = $_POST['message'];
    }
    //on envois la requête SQL pour insérer les infos de l'upload dans la BDD
    $result = insertUpload($tabValue, $pdo);
    ///////////////////////////////////////////////////////////////////
    //En fonction de si on est sur serveur local ou serveur distant on prépare l'adresse de téléchargement
                //pour l'envoyer a la fonction mailCreate()
    //si serveur distant
    if ($_SERVER['SERVER_NAME'] === "anthonym.promo-36.codeur.online")
    {
        $upload = 'https://anthonym.promo-36.codeur.online/YesTransfert/index.php?page=download&link=' . $nameTmp . '.zip';
    }  
    //si serveur local
    else if ($_SERVER['SERVER_NAME'] === "localhost")
    {
        $upload = 'http://localhost/yestransfert/index.php?page=download&link=' . $nameTmp . '.zip';
    }
    //on récupère le mail en lui passant en argument l'adresse de l'upload, le sujet et le message pour optimiser l'affichage du mail
    $mailbody = mailCreate($upload, $mail_exp, $tabValue['sujet'], $tabValue['message']);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///Adresse de votre serveur ci-dessous a modifier
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Si le serveur est distant on utilise la fonction mail de php
    if ($_SERVER['SERVER_NAME'] === "anthonym.promo-36.codeur.online" && ($result === true && $emailNoSend === false)) {
        //on défini le header pour l'envois
        $headers = "From: Yes Transfert < $mail_dest >" . "\r\n" .
            "Reply-To: $mail_exp" . "\r\n" .
            "MIME-Version: 1.0\r\n" .
            "Content-Type: text/html; charset=utf-8\r\n";
        //on utilise la function mail de php
        if (mail($mail_dest, $sujetGen, $mailbody, $headers)) {
            $displayDivError .= $divResponseValid . 'Email correctement envoyer' . $closeDiv;;
        } else {
            $displayDivError .= $divResponseError . 'Erreur survenu a l\'envois du mail' . $closeDiv;;
        }
        //si le serveur est en local on utilise Swiftmailer
    } else if ($_SERVER['SERVER_NAME'] === "localhost" && ($result === true && $emailNoSend === false)) {
        //on charge Swiftmailer
        require_once('vendor/autoload.php');
        //on instancie une nouvelle méthode d'envois du mail
        $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 465)) //Port 25 ou 465 selon votre configuration
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//identifiant et mote de passe pour votre swiftmailer
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ->setUsername('10d8c72cde03e7')
            ->setPassword('bb66424e01e210');
        //on instancie un nouveau mail
        $mailer = new Swift_Mailer($transport);
        $date = date('j, F Y h:i A');
        //on instancie un nouveau corps de document mail
        $message = (new Swift_Message($sujetGen))
            ->setFrom([$mail_dest => 'Yes Transfert'])
            ->setTo([$mail_exp])
            ->setBody($mailbody);
        //on récupère et modifie le header du mail pour l'envois en HTML
        $type = $message->getHeaders()->get('Content-Type');
        $type->setValue('text/html');
        $type->setParameter('charset', 'utf-8');
        //On envois le mail en local
        $resultMail = $mailer->send($message);
        if ($resultMail === 1) {
            $displayDivError .= $divResponseValid . 'Votre Email a bien été envoyé' . $closeDiv;
        } else {
            $displayDivError .= $divResponseError . 'Erreur pendant l\'envoie de l\'Email' . $closeDiv;
        }
    } else {
        $displayDivError .= $divResponseError . 'Votre Email n\'a pas pu être envoyé' . $closeDiv;
    }
}

require_once('Views/homeView.php');
