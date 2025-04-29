<?php
include "connexion.php";
include "VerifAdmin.php";
            
$req = $bdd->prepare("select * from categorie ");
$req->execute([]);
$tabs = $req->fetchAll();
?>

<html>
    <head>
        <meta charset="utf-8">
        <title> Catégories </title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../CSS/index.css">
        <h1> Les différentes catégories </h1>
    </head>

    <body>
        <div class="container-fluid">
            <?php 
            include '../header.php';             
            ?>
            <div class="row">
                <img src="../Images/image_categories.webp" class="rounded mx-auto d-block" width="100%" height="60%">
            </div>
            <div class="row">
                <div class="col-9">
                    <div class="row">
                        <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) { ?>
                            <div class="ajt">
                                <a href="FormAjoutCateg.php" class="btn btn-primary">Ajouter une catégorie</a>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="row">
                        <?php
                        foreach ($tabs as $tab){ ?>
                            <div class="col-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="../Images/<?php echo $tab["ImgCateg"]; ?>" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title"> <?php echo $tab["Nomcateg"]; ?></h5>
                                        <a href="./detail1categorie.php?id=<?php echo $tab["Idcateg"];?>" class="btn btn-primary">Bouton du <?php echo $tab["Nomcateg"]; ?></a>
                                    </div>
                                </div>

                                <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) { ?>
                                    <div class="ajt">
                                        <a href="SuppCateg.php?id=<?php echo $tab["Idcateg"]; ?>" class="btn btn-primary">SUPPR!!</a>
                                        <a href="FormModifCateg.php?id=<?php echo $tab["Idcateg"]; ?>" class="btn btn-primary">Modif</a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-3">
                    <?php include 'SideBar.php'; ?>
                </div>
            </div>
        </div>
        <?php
        include "../footer.php";
        ?>
    </body>
</html>