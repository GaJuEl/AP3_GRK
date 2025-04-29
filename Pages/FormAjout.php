<?php
include "connexion.php";

$error = $_GET['error'] ?? null;
$success = $_GET['success'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/form.css">
    <title>Ajouter Personnage</title>
</head>
<body>
  <div class="container-fluid">
    <h1 class="text-center">Ajouter un personnage</h1>
    <?php include '../header.php'; ?>
    
    <?php if ($error) { ?>
        <div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
    <?php } ?>
    
    <?php if ($success) { ?>
        <div class="alert alert-success">✅ Personnage ajouté avec succès !</div>
    <?php } ?>
    
    <div class="row">
      <div class="col-9">
        <form method='post' action='Ajout.php' enctype="multipart/form-data">
          <table>
            <tr>
              <td>Nom</td>
              <th><input type="text" name="nom" required></th>
            </tr>
            <tr>
              <td>Prénom</td>
              <th><input type="text" name="prenom" required></th>
            </tr>
            <tr>
              <td>Description</td>
              <th><input type="text" name="description"></th>
            </tr>
            <tr>
              <td>Image</td>
              <td>
                <input type="file" name="ImgPerso" required>
                <small>Formats acceptés : JPG, PNG (max 500Ko)</small>
              </td>
            </tr>
            <tr>
              <td>Id Sous-Catégorie</td>
              <th><input type="text" name="idsscateg"></th>
            </tr>
            <tr>
              <th><input type='submit' value='Ajouter'></th>
              <th><input type='reset' value='Annuler'></th>
            </tr>
          </table>
        </form>
      </div>
      <div class="col-3">
        <?php include 'SideBar.php'; ?>
      </div>
    </div>
  </div>
  <?php include '../footer.php'; ?>
</body>
</html>