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
    <title>Ajouter Sous-Catégorie</title>
</head>
<body>
  <div class="container-fluid">
    <h1 class="text-center">Ajouter une sous-catégorie</h1>
    <?php include '../header.php'; ?>
    
    <?php if ($error) { ?>
        <div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div>
    <?php } ?>
    
    <?php if ($success) { ?>
        <div class="alert alert-success">✅ Sous-Catégorie ajoutée avec succès !</div>
    <?php } ?>
    
    <div class="row">
      <div class="col-9">
        <form method='post' action='AjoutSousCateg.php' enctype="multipart/form-data">
          <table>
            <tr>
              <td>Nom</td>
              <th><input type="text" name="nom" required></th>
            </tr>
            <tr>
              <td>Description</td>
              <th><input type="text" name="description"></th>
            </tr>
            <tr>
              <td>Image</td>
              <td>
                <input type="file" name="Imgsscateg" required>
                <small>Formats acceptés : JPG, PNG (max 500Ko)</small>
              </td>
            </tr>
            <tr>
              <td>Id Catégorie</td>
              <th><input type="text" name="idcateg"></th>
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