<?php
require_once('headerAdmin.php');
require_once('Models/admin.php');

echo "<h3> Bonjour " . $_SESSION['login'] . " ! </h3>";

$data = listData($pdo);
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

         <tr>

      <?php endforeach; ?>

   <?php endif; ?>
   </tbody>
</table>
