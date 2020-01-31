<?php
require_once('Models/admin.php');

session_start();
$pages = 1;
$totalPages = 3;
$entree = count(listData($pdo));

$compt = 0;
$a = 10;
while ($compt < count(listData($pdo))) {
    if ($compt == $a) {
        $pages += 1;
        
        $a += 10;

    } else {
        $compt++;
    }
}

//fonction qui supprime le fichier du serveur
function deleteFile($adressZip){
    //on récupère l'adresse et nom du fichier
    $adressServer ='./' . $adressZip;
    //On le supprime
    unlink($adressServer);
    // Si une erreur est survenu et que le fichier existe toujours
    if(file_exists($adressServer)){
        $result .= "Le fichier n'a pas pu être supprimé du serveur";
    } else {
        //sinon on affiche qu'il a bien été supprimé
        $result .= "Le fichier a été supprimé du serveur";
    }
    //on retourne le message de réponse
    return $result;
}
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
                        <a  href="index.php?page=admin&id=<?= $id; ?>" onclick="return confirm('Voulez-vous supprimer cet élément !?')" >Supprimer</a>
                    </form>
                </td>
            <tr>
        <?php endforeach;
    }
}
function numberTab($data){
    $tabX = [];

    for ($i=0; $i < 10;$i++)
    {
        $tabX[$i] = $data[$i];
    }
    return $tabX;

}
require_once('Views/adminView.php');
