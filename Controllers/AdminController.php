<?php
require_once('Models/admin.php');

session_start();
$maxByPage = 10;
$entree = count(listData($pdo));
$linkPage = "http://localhost/yestransfert/index.php?page=admin&";
$debut = 0;
$operation ='';
$_SESSION['start'] = 0;
$data = listData($pdo);

//affiche une page de réponses
class Page
{
    private $nbResponse;
    public function __construct($nbResponse)
    {

        $this->nbResponse = $nbResponse;
    }
    public function page()
    {
        foreach ($this->nbResponse as $key) : ?>
            <tr scope="row">
                <?php foreach ($key as $value) : ?>
                    <td scope="row" class="alert alert-info exist-result"><?= $value; ?></td>
                <?php endforeach; ?>
                <td class="alert alert-info exist-result">
                    <?php $id = $key['id']; ?>
                    <form class="delete" action="" method="GET">
                        <a class="alert-danger" href="index.php?page=admin&id=<?= $id; ?>" onclick="return confirm('Voulez-vous supprimer cet élément !?')">Supprimer</a>
                    </form>
                </td>
            <tr>
    <?php endforeach;
    }
}
////Calcul le nombre de page en fonction des entrée
function calculPageTotal($entree, $maxByPage)
{
    $comptEntree = 0;
    $maxPage = 0;
    while ($comptEntree < $entree) {

        if ($comptEntree == $maxByPage && $comptEntree <= $entree) {
            $maxPage += 1;
            $maxByPage += 10;
        } else {
            $comptEntree++;
        }
        if ($comptEntree <= $maxByPage && $comptEntree == $entree) {
            $maxPage += 1;
        }
    }
    return $maxPage;
}

//remplis un tableau de maxByPage reponse (10 par défaut)
function numberTab($data, $debut, $maxByPage)
{
    $tabX = [];
    $j = 0;
    for ($i = $debut; $i < count($data)  && $i < $debut + $maxByPage; $i++) {
        if ($i < $debut + $maxByPage) {
            $tabX[$j] = $data[$i];
            $j++;
        }
    }
    return $tabX;
}
//fonction qui supprime le fichier du serveur
function deleteFile($adressZip, $operation )
{

    //on récupère l'adresse et nom du fichier
    $adressServer = './' . $adressZip;
    //On le supprime
    unlink($adressServer);
    // Si une erreur est survenu et que le fichier existe toujours
    if (file_exists($adressServer)) {
        $operation = '<div class="alert alert-danger result container">Le fichier n\'a pas pu être supprimé du serveur</div>';
    } else {
        //sinon on affiche qu'il a bien été supprimé
        $operation = '<div class="alert alert-success result container">Le fichier a été supprimé du serveur</div>';
    }
    //on retourne le message de réponse
    return $operation ;
}
//si aucune page n'est choisis on déclare et initialise les variables
if (!isset($_GET['var'])) {
    $var = 0;
    $_SESSION['pages'] = $var;
    $_SESSION['displayPages'] = $var;
}
//si l'on clique sur une page on récupère la valeur de la variable action
if (isset($_GET['action'])) {
    //si l'on incrémente
    if ($_GET['action'] == 'incr') {
        //que la page en cours est inférieur au total de page on incrémente la page
        if ($_SESSION['displayPages'] < calculPageTotal($entree, $maxByPage) - 1) {
            $_SESSION['displayPages']++;
            //on affiche le résultat 
            $_SESSION['start'] = $_SESSION['displayPages'] * 10;
            $_SESSION['pages'] = $_SESSION['displayPages'];
        } else {
            //si nous sommes sur la dernière page on affiche 
            $_SESSION['start'] = $_SESSION['displayPages'] * 10;
        }
    }
    //si l'on décrémente
    if ($_GET['action'] == 'decr') {
        //que nous sommes pas sur la première page on décrémente la page
        if ($_SESSION['displayPages'] > 0) {
            $_SESSION['displayPages']--;
            //on affiche le résultat 
            $_SESSION['start'] = $_SESSION['displayPages'] * 10;
            $_SESSION['pages'] = $_SESSION['displayPages'];
        } else {
            //si nous sommes sur la première page on affiche
            $_SESSION['start'] = $_SESSION['displayPages'] * 10;
        }
    }
}
require_once('Views/adminView.php');
