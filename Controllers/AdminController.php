<?php
require_once('Models/admin.php');

session_start();
$maxByPage = 10;
$entree = count(listData($pdo));
$linkPage = "http://localhost/yestransfert/index.php?page=admin&";
$debut = 0;
$pages = 0;

if (!isset($_GET['var'])) {
    $var = 0;
    $pages = 0;
} else {

    $var = $_GET['var'];
    $pages = $_GET['var'];
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'incr') { 
        if(calculPageTotal($entree, $maxByPage) != $pages) {
           $var++;
        $pages++; 
        }
        
    } else if ($_GET['action'] == 'decr') {
        if ($pages != 0) {
            $var--;
            $pages--;
        } 
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

//remplis un tableau de maxByPage reponse
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

//affiche un tableau 
class Page
{
    private $debut;
    private $fin;
    private $nbResponse;
    public function __construct($nbResponse, $debut, $fin)
    {
        $this->debut = $debut;
        $this->fin = $fin;
        $this->nbResponse = $nbResponse;
    }

    public function page()
    {

        foreach ($this->nbResponse as $key) : ?>

            <tr scope="row">
                <?php foreach ($key as $value) : ?>

                    <td scope="row" class="exist-result"><?= $value; ?></td>
                <?php endforeach; ?>

                <td class="exist-result">
                    <?php $id = $key['id']; ?>
                    <form class="delete" action="" method="GET">
                        <a href="index.php?page=admin&id=<?= $id; ?>" onclick="return confirm('Voulez-vous supprimer cet élément !?')">Supprimer</a>
                    </form>
                </td>
            <tr>
    <?php endforeach;
    }
}

//fonction qui supprime le fichier du serveur
function deleteFile($adressZip)
{
    //on récupère l'adresse et nom du fichier
    $adressServer = './' . $adressZip;
    //On le supprime
    unlink($adressServer);
    // Si une erreur est survenu et que le fichier existe toujours
    if (file_exists($adressServer)) {
        $result .= "Le fichier n'a pas pu être supprimé du serveur";
    } else {
        //sinon on affiche qu'il a bien été supprimé
        $result .= "Le fichier a été supprimé du serveur";
    }
    //on retourne le message de réponse
    return $result;
}
require_once('Views/adminView.php');
