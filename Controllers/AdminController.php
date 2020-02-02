<?php
require_once('Models/admin.php');

session_start();
$maxByPage = 10;
$entree = count(listData($pdo));
$linkPage = "http://localhost/yestransfert/index.php?page=admin&";
$debut = 0;
$_SESSION['pages'] = 0;
$_SESSION['start'] = 0;


if (!isset($_GET['var'])) { 

    if($entree != 0){
        $_SESSION['pages'] = 1;
    } 
} else {
    if($_GET['var'] === 0){
        $_SESSION['start'] = 10;
    } else {
        $_SESSION['pages'] = $_GET['var'];
        $_SESSION['start'] = $_SESSION['pages'] * 10;
    }
    
}
if (isset($_GET['action'])) {
    
    if ($_GET['action'] == 'incr') {
        if (calculPageTotal($entree, $maxByPage) != $_SESSION['pages']) {
            $_SESSION['pages']++; 
        }

    } else if ($_GET['action'] == 'decr') {
        if($_SESSION['pages'] != 1) {
            $_SESSION['pages']--;
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




/*
if (!isset($_GET['var'])) {
    var_dump("test1");
    if ($entree != 0) {
        $pages = 1;
        $var = $pages + 1;
    }
} else {
    var_dump("test2");
    $var = $_GET['var'];
    $pages = $_GET['var'];  
}

if (isset($_GET['action'])) {
    
    
    if ($_GET['action'] == 'incr') {
        var_dump("test3");
        if (calculPageTotal($entree, $maxByPage) != $pages) {
            $var++;
            $pages++;
            
        }


    } else if ($_GET['action'] == 'decr') {
        var_dump("test4");
        if ($pages != 1) {
            $var--;
            $pages--;
            $_SESSION['debut'] - 10;
        }
    } 
}*/
require_once('Views/adminView.php');
