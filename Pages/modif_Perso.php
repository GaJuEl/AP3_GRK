<?php
include "connexion.php";

$id = $_POST['id'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$image = $_POST['image_actuelle'] ?? null;
$sscateg = $_POST['sscateg'];

if(isset($_FILES['ImgPerso']) && $_FILES['ImgPerso']['error'] === UPLOAD_ERR_OK) {
    $fichier = $_FILES['ImgPerso'];
    
    // Validation
    $taille_max = 500 * 1024; // 500Ko
    $types_autorises = ['image/jpeg', 'image/jpg', 'image/png'];
    $extension = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));
    
    // Vérifications
    if($fichier['size'] > $taille_max) {
        header("Location: personnages.php?id=$id&error=La taille de l'image dépasse 500Ko");
        exit();
    }
    
    $type_mime = mime_content_type($fichier['tmp_name']);
    if(!in_array($type_mime, $types_autorises) || !in_array($extension, ['jpg', 'jpeg', 'png'])) {
        header("Location: personnages.php?id=$id&error=Formats autorisés: JPG, PNG, JPEG");
        exit();
    }
    
    // Nouveau nom de fichier
    $nom_image = $nom;
    $nouveau_nom = 'image_' . $nom_image . '.' . $extension;
    
    // Suppression de l'ancienne image si elle existe
    if($image && file_exists("../Images/$image")) {
        unlink("../Images/$image");
    }
    
    // Upload
    if(move_uploaded_file($fichier['tmp_name'], "../Images/$nouveau_nom")) {
        $image = $nouveau_nom;
    } else {
        header("Location: personnages.php?id=$id&error=Erreur lors de l'upload");
        exit();
    }
}

// Mise à jour BDD
$req = $bdd->prepare("UPDATE persos SET NomPerso=?, PrenomPerso=?, ImgPerso=?, IdsousCateg=? WHERE IdPerso=?");
$req->execute([$nom,$prenom, $image, $sscateg, $id]);

header("Location: personnages.php?id=$id&success=1");
exit();
?>