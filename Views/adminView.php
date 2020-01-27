<?php require_once "headerAdmin.php";
require_once "Models/admin.php";

echo '<div class="d-flex justify-content-center"> <h3> Bonjour ' . $_SESSION['login'] . ' ! </h3></div>';

$data = listData($pdo);
$delete = delete($pdo);

?>

<table>
   <thead>
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
   <?php if(empty($data)): ?>

      <tr>
         <td colspan="6">Aucun résultat trouvé</td>
      </tr>

   <?php else: ?>

      <?php foreach($data as $key): ?>

         <tr scope="row">

         <?php foreach ($key as $value) : ?>

            <td scope="row"><?= $value; ?></td>

         <?php endforeach; ?>

            <td>
               <?php $id = $key['id']; ?>

               <form action="" method="GET">
                  <a href="index.php?page=admin&id=<?= $id; ?>" onclick="return confirm('Voulez-vous supprimer cet élément !?')">Delete</a>
               </form>
            </td>

         <tr>

      <?php endforeach; ?>

      <?php
         if (isset($_GET['id']) && !empty($_GET['id'])) {

            if ($_GET['id']){
               $id = $_GET['id'];
               header('Location: Admin');
               echo "l'élément avec l'id :$id à bien été supprimé !";
            }
            else{
               echo "ça marche pas";
            }
         }
      ?>


   <?php endif; ?>
   </tbody>
</table>
