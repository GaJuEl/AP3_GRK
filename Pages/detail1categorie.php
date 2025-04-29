<?php
include "connexion.php";
include 'VerifAdmin.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/detail_categ.css">
    <?php 
    $id = $_GET["id"];
    $req = $bdd->prepare("SELECT * FROM categorie WHERE Idcateg=?");
    $req->execute([$id]);
    $tabsCateg = $req->fetch();

    $req2 = $bdd->prepare("SELECT * FROM souscateg WHERE Idcateg=?");
    $req2->execute([$id]);
    $tabsSCateg = $req2->fetchAll();
    ?>
    <title>Détail <?php echo $tabsCateg["Nomcateg"]; ?></title>
</head>
<body>
    <h1 class="text-center">Les Différents <?php echo $tabsCateg["Nomcateg"]; ?> </h1>
    <?php include "../header.php"; ?>
    
    <div class="container-fluid">
        <div class="row">
            <img src="../Images/<?php echo $tabsCateg["ImgCateg"]; ?>" class="main-img">
        </div>
        
        <div class="row mt-4">
            <div class="col-lg-3 order-lg-2 order-1 sidebar-content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">À propos</h4>
                        <p class="card-text">Ce site est en l'honneur du monde des échecs.</p>
                    </div>
                </div>
                
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title">Sites favoris</h4>
                        <ul class="list-unstyled">
                            <li><a href="https://fr.wikipedia.org/wiki/%C3%89checs" target="_blank">Page Wikipédia</a></li>
                            <li><a href="https://www.chess.com" target="_blank">Jeu d'échecs</a></li>
                            <li><a href="https://lichess.org" target="_blank">Autre jeu d'échecs</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9 order-lg-1 order-2">
                
                <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) { ?>
                    <div class="ajt mb-4">
                        <a href="FormAjoutSousCateg.php" class="btn btn-primary">Ajouter une sous-catégorie</a>
                    </div>
                <?php } ?>
                
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Description</h4>
                        <p class="card-text"><?php echo $tabsCateg["DescCateg"]; ?></p>
                    </div>
                </div>
                
                <?php foreach($tabsSCateg as $tab) { ?>
                    <div class="card mb-4">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="../Images/<?php echo $tab["Imgsscateg"]; ?>" class="img-fluid rounded-start h-100" style="object-fit: cover;" alt="<?php echo $tab["Nomsscateg"]; ?>">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo $tab["Nomsscateg"]; ?></h3>
                                    <p class="card-text"><?php echo $tab["Descsscateg"]; ?></p>
                                    
                                    <div class="mt-3">
                                        <a href="PersoParCateg.php?id=<?php echo $tab["IdsousCateg"];?>" class="btn btn-primary">
                                            Voir les personnages de <?php echo $tab["Nomsscateg"]; ?>
                                        </a>
                                    </div>
                                    
                                    <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) { ?>
                                        <div class="mt-3">
                                            <a href="SuppSousCateg.php?id=<?php echo $tab["IdsousCateg"]; ?>" class="btn btn-danger">Supprimer</a>
                                            <a href="FormModifSousCateg.php?id=<?php echo $tab["IdsousCateg"]; ?>" class="btn btn-secondary">Modifier</a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <?php include "../footer.php"; ?>
    
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>