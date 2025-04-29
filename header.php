<?php include __DIR__ . '/Pages/config.php'; 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="navbar-nav">
                    <a class="btn btn-outline-primary" href="<?php echo BASE_URL; ?>/index.php">Accueil</a>
                    <a class="btn btn-outline-primary" href="<?php echo BASE_URL; ?>/Pages/personnages.php">Personnages</a>
                    <a class="btn btn-outline-primary" href="<?php echo BASE_URL; ?>/Pages/categorie.php">Catégories</a>
                </div>
                <div class="ms-auto">
                    <?php if(isset($_SESSION['authenticated']) && $_SESSION['authenticated']): ?>
                        <span class="navbar-text me-2">
                            Connecté en tant que: <?php echo htmlspecialchars($_SESSION['User']); ?>
                        </span>
                        <a class="btn btn-outline-primary" href="<?php echo BASE_URL; ?>/Pages/deconnexion.php">Déconnexion</a>
                    <?php else: ?>
                        <a class="btn btn-outline-primary" href="<?php echo BASE_URL; ?>/Pages/FormAdmin.php">Connexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <script src="<?php echo BASE_URL; ?>/bootstrap/js/popper.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>