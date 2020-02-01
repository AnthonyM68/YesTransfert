<?php
require_once('Models/admin.php');

session_start();
$pages = 10;

$entree = count(listData($pdo));
$maxByPage = 10;
$linkPage = "http://localhost/yestransfert/index.php?page=admin&linkPage=";

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
//Détect un changement de page
if(isset($_GET['linkPage']) && !empty($_GET['linkPage'])){
    if ($_GET['linkPage'] == "down"){
        var_dump($_GET['linkPage']);
    } else if ($_GET['linkPage'] == "next"){
        var_dump($_GET['linkPage']);
    }
    
}
//remplis un tableau de maxByPage reponse
function numberTab($data, $maxByPage)
{
    $tabX = [];
    for ($i = 0; $i < $maxByPage; $i++) {
        $tabX[$i] = $data[$i];
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






require_once('Views/adminView.php');
