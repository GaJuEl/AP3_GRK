<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/PersoCateg.css">
    <title>Personnages par catégorie</title>
    <?php
    include "connexion.php";
    $id = $_GET["id"];
    $req = $bdd->prepare("SELECT persos.*, souscateg.Nomsscateg 
                         FROM persos 
                         JOIN souscateg ON persos.Idsouscateg = souscateg.Idsouscateg 
                         WHERE souscateg.IdsousCateg = ?");
    $req->execute([$id]);
    $characters = $req->fetchAll();
    
    // Récupérer le nom de la catégorie pour le titre
    $catReq = $bdd->prepare("SELECT Nomsscateg FROM souscateg WHERE IdsousCateg = ?");
    $catReq->execute([$id]);
    $category = $catReq->fetch();
    ?>
</head>
<body>
    <h1 class="mb-4">Personnages : <?php echo $category['Nomsscateg']; ?></h1>
    <?php include '../header.php'; ?>
    
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-9">
                
                <div class="row">
                    <?php foreach($characters as $character): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card character-card">
                            <img src="../Images/<?php echo $character['ImgPerso']; ?>" 
                                 class="card-img-top character-img" 
                                 alt="<?php echo $character['PrenomPerso'].' '.$character['NomPerso']; ?>">
                            <div class="card-body">
                                <h3 class="card-title character-name">
                                    <?php echo $character['PrenomPerso'].' '.$character['NomPerso']; ?>
                                </h3>
                                <p class="card-text character-desc">
                                    <?php echo $character['DescPerso']; ?>
                                </p>
                                <a href="detail1personnage.php?id=<?php echo $character["IdPerso"]; ?>" class="btn btn-primary">Voir détails</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="col-lg-3">
                <?php include 'SideBar.php'; ?>
            </div>
        </div>
    </div>
    
    <?php include "../footer.php"; ?>
    
    <script src="../bootstrap/js/jquery-3.5.1.slim.min.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>