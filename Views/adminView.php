<?php require_once "headerAdmin.php";
require_once "Models/admin.php";

echo '<div class="d-flex justify-content-center"> <h3> Bonjour Administrateur ' . $_SESSION['login'] . ' ! </h3></div>';?>


<table class="container">
    <thead class="header-tab">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Mail expéditeur</th>
            <th scope="col">Mail destinataire</th>
            <th scope="col">Zip</th>
            <th scope="col">Sujet</th>
            <th scope="col">Message</th>
            <th scope="col">Date</th>
            <th scope="col">Supprimer</th>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($data)) : ?>

            <tr>
                <td colspan="12" class="container no-result">Aucun résultat trouvé</td>
            </tr>

        <?php else :

            if (isset($_GET['id']) && !empty($_GET['id'])) {
                //on vérifie que l'id existe dans la BDD
                $result = siExist($pdo, $_GET['id']);
                //s'il existe on le delete de la BDD
                if (!empty($result) && $result['0']['zip'] != null) {
                    delete($pdo);
                    //On supprime le fichier du serveur
                    $operation = deleteFile($result['0']['zip'], $operation);
                    //on reverifie qu'il n'existe plus dans la BDD
                    $result = siExist($pdo, $_GET['id']);
                    //si la suppression a échoué on affiche un message
                    if (!empty($result)) {
                        $operation .= '><div class="alert alert-danger result container">Une erreur est survenue pendant la suppression des données de la BDD</div>';
                    } else {
                        //On affiche le resultat de la suppression du fichier;
                        $operation .= '<div class="alert alert-success result container">l\'élément avec l\'id :' . $_GET['id'] . ' à bien été supprimé de la BDD!</div>';

                    }
                    //Si la suppression a échoué on affiche un message
                } else {
                    $operation .= '<div class="alert alert-danger result container">Veuillez vérifier votre ID car il n\'existe pas dans la base de données</div>';
                }
                //Affiche la BDD après suppression
                $listEntree = numberTab(listData($pdo), $_SESSION['start'], $maxByPage);
                $newPage = new Page($listEntree);
                echo $newPage->page();

                $maxPage = calculPageTotal($entree, $maxByPage);
            } else {

                //Affiche la BDD actuel
                $listEntree = numberTab(listData($pdo), $_SESSION['start'], $maxByPage);
                $newPage = new Page($listEntree);
                echo $newPage->page();
                $maxPage = calculPageTotal($entree, $maxByPage);
            }
        ?>
        <?php endif; ?>
    </tbody>
</table>
<div class="justify-content-center"><?=$operation?></div>
<?php require_once "footerAdminView.php"; ?>