<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    include "connexion.php";
    $id=$_GET["id"];
    $req = $bdd->prepare("SELECT * FROM persos WHERE idPerso=?");
    $req->execute([$id]);
    $tabs = $req->fetch();
    ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/form.css">
    <title>Modifier Personnage</title>
</head>
<body>
    <div class="container-fluid">
        <h1 class="text-center"> Modifier le personnage </h1>
        <?php include '../header.php'; ?>
        <br>
        <div class="row">
            <div class="col-9">
                <form action="modif_Perso.php" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>ID</td>
                            <td><input type="number" name="id" value="<?php echo $tabs["IdPerso"]?>"readonly></td>
                        </tr>
                        <tr>
                            <td>Nom </td>
                            <td><input type="text" name="nom" value="<?php echo $tabs["NomPerso"]?>" required></td>
                        </tr>
                        <tr>
                            <td>Prenom</td>
                            <td><input type="text" name="prenom" value="<?php echo $tabs["PrenomPerso"]?>"required></td>
                        </tr>
                        <tr>
                            <td>Image actuele</td>
                            <td>
                                <?php if(!empty($tabs['ImgPerso'])) { ?>
                                <img src="../Images/<?php echo $tabs['ImgPerso']; ?>" height="100">
                                <input type="hidden" name="image_actuelle" value="<?php echo $tabs['ImgPerso']; ?>">
                                <?php }else{ ?>
                                <p>Aucune image</p>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nouvelle image</td>
                            <td>
                            <input type="file" name="ImgPerso" accept="image/*">
                            <small>Laisser vide pour conserver l'image actuelle</small>
                            </td>
                        </tr>
                        <tr>
                            <td>Sous categ</td>
                            <td><input type="text" name="sscateg" value="<?php echo $tabs["IdsousCateg"]?>"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Modifier"></td>
                            <td><input type="reset" value="Annuler"></td>
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
