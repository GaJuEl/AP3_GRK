<?php 
session_start()
?>
<html>
    <head>
        <meta charset="utf-8">
        <title> Échecs </title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="CSS/index.css">
        <h1> Les Échecs par Gabkemi </h1>
    </head>

    <body>
        <div class="container-fluid"> 
            <?php include 'header.php'; ?>
            <div class="row">
                <img src="./Images/images_index.jpeg" class="rounded mx-auto d-block" width="300px" height="300px">
            </div>
            <div class="row">

                <div class="col-9">

                    <div class="row">

                        <div class="col-3">
                            <img src="./Images/images_index2.avif" class="rounded float-start" width="220px" height="200px">
                        </div>

                        <div class="col-6">
                            <h1> Bienvenue dans le monde des Échecs </h1>
                        </div>

                        <div class="col-3">
                            <img src="./Images/images_index3.jpg" class="rounded float-end" width="220px" height="200px">
                        </div>

                    </div>

                </div>

                <div class="col-3">
                    <?php include 'Pages/SideBar.php'; ?>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>