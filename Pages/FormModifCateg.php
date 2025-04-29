<?php
include "connexion.php";

// Récupération des messages d'erreur/succès s'ils existent
$error = $_GET['error'] ?? null;
$success = $_GET['success'] ?? null;

$id = $_GET["id"];

$req = "SELECT * FROM categorie WHERE Idcateg=?";
$modif = $bdd->prepare($req);
$modif->execute([$id]);
$categorie = $modif->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/form.css">
    <title>Modifier Catégorie</title>
</head>
<body>
  <div class="container-fluid">
    <h1 class="text-center">Modifier une catégorie</h1>
    <?php include '../header.php'; ?>
    
    <!-- Affichage des messages -->
    <?php if ($error): ?>
        <div class="alert alert-error">
            ⚠️ <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success">
            ✅ Catégorie mise à jour avec succès !
        </div>
    <?php endif; ?>
    
    <br>
    <div class="row">
      <div class="col-9">
        <form method='post' action='modif_categ.php' enctype="multipart/form-data">
          <table>
            <tr>
              <td>Id</td>
              <th><input type="text" name="id" value="<?php echo $categorie['Idcateg']; ?>" readonly></th>
            </tr>
            <tr>
              <td>Nom</td>
              <th><input type="text" name="nom" value="<?php echo $categorie['Nomcateg']; ?>" required></th>
            </tr>
            <tr>
              <td>Description</td>
              <th><input type="text" name="description" value="<?php echo $categorie['DescCateg']; ?>"></th>
            </tr>
            <tr>
              <td>Image actuelle</td>
              <td>
                <?php if(!empty($categorie['ImgCateg'])) { ?>
                  <img src="../Images/<?php echo $categorie['ImgCateg']; ?>" height="100">
                  <input type="hidden" name="image_actuelle" value="<?php echo $categorie['ImgCateg']; ?>">
                <?php }else { ?>
                  <p>Aucune image</p>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td>Nouvelle image</td>
              <td>
                <input type="file" name="ImgCateg" accept="image/png, image/jpeg, image/jpg">
                <small>Formats acceptés : PNG, JPG, JPEG (max 500Ko)</small>
              </td>
            </tr>
            <tr>
              <th><input type='submit' value='Envoyer'></th>
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