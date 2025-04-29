<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    include "connexion.php";
    $id=$_GET["id"];
    $req = $bdd->prepare("select * from persos where idPerso=?");
    $req->execute([$id]);
    $tabs = $req->fetch();
    ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/form.css">
    <title>Modifier description</title>
</head>
<body>
    <div class="container-fluid">
        <h1 class="text-center"> Ajouter une sous-catégorie </h1>
        <?php include '../header.php'; ?>
        <br>
        <div class="row">
            <div class="col-9">
                <form action="modif_desc.php?id=<?php echo $tabs["IdPerso"]; ?>" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Nom </td>
                            <td><input type="text" name="NomPerso" value="<?php echo $tabs["NomPerso"]?>" readonly></td>
                        </tr>
                        <tr>
                            <td>Prenom</td>
                            <td><input type="text" name="PrenomPerso" value="<?php echo $tabs["PrenomPerso"]?>" readonly></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><input type="text" name="DescPerso" value="<?php echo $tabs["DescPerso"]?>"required></td>
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
