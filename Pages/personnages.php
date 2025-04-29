<?php
session_start();

include 'connexion.php'; 
include 'VerifAdmin.php';

$req = $bdd->prepare("SELECT * FROM persos");
$req->execute();
$tabs = $req->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Personnages</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/perso.css">
    <h1>Les joueurs phares des échecs</h1>
</head>
<body>
    <?php include '../header.php'; ?>
    <div class="container-fluid">
        <img src="../Images/image_perso.jpg" width="100%">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) { ?>
                        <div class="ajt">
                            <a href="FormAjout.php" class="btn btn-primary">Ajouter un perso</a>
                        </div>
                    <?php } ?>
                </div>

                <div class="row">
                    <?php 
                    foreach ($tabs as $tab) { ?>
                        <div class="col-4">
                            <div class="card" style="width: 18rem;">
                                <img src="../Images/<?php echo $tab["ImgPerso"]; ?>" class="card-img-top">
                                <div class="card-body">
                                    <a href="detail1personnage.php?id=<?php echo $tab["IdPerso"]; ?>" class="btn btn-primary">
                                        <?php echo $tab["PrenomPerso"]; ?> <?php echo $tab["NomPerso"]; ?>
                                    </a>
                                </div>
                            </div>

                            <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) { ?>
                            <div class="ajt">
                                <a href="SuppPerso.php?id=<?php echo $tab["IdPerso"]; ?>" class="btn btn-primary">SUPPR!!</a>
                                <a href="FormModifPerso.php?id=<?php echo $tab["IdPerso"]; ?>" class="btn btn-primary">Modif</a>
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

    <?php include '../footer.php'; ?>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>