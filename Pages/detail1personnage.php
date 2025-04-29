<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/detail_perso.css">
        <?php
        include "./connexion.php";

        $projectFolder = "AP3_GRK";
        $base_url = "/" . $projectFolder . "/";

        $id = $_GET["id"];

        $req=$bdd->prepare("select * from persos where IdPerso = ?");
        $req->execute([$id]);
        $tabs = $req->fetch();
        ?>
        <title>Détail <?php echo $tabs["PrenomPerso"]; ?></title>
    </head>
    <body>
        <h1 class="text-center"> Détail du Personnage</h1>
        <?php include "../header.php"; ?>
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <img src="../Images/<?php echo $tabs["ImgPerso"]; ?>">
                </div>
                <div class="row">
                    <h3> <?php echo $tabs["PrenomPerso"]; echo " "; echo $tabs["NomPerso"]; ?> </h3>
                </div>
                <div class="row">
                    <h4> <?php echo $tabs["DescPerso"]; ?> </h4>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mod">
                            <a href="FormModifDesc.php?id=<?php echo $tabs["IdPerso"]; ?>" class="btn btn-primary">Modifier la description </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="sup">
                            <a href="SuppDesc.php?id=<?php echo $tabs["IdPerso"]; ?>" class="btn btn-primary">Supprimer une description </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <?php include 'SideBar.php'; ?>
            </div>
        </div>
        <?php include "../footer.php"; ?>
    </body>
</html>