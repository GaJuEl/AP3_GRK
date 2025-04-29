<?php
include "connexion.php";

$id = $_POST['id'];
$nom = $_POST['nom'];
$description = $_POST['description'];
$image = $_POST['image_actuelle'] ?? null;

if(isset($_FILES['ImgCateg']) && $_FILES['ImgCateg']['error'] === UPLOAD_ERR_OK) {
    $fichier = $_FILES['ImgCateg'];
    
    // Validation
    $taille_max = 500 * 1024; // 500Ko
    $types_autorises = ['image/jpeg', 'image/jpg', 'image/png'];
    $extension = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));
    
    // Vérifications
    if($fichier['size'] > $taille_max) {
        header("Location: categorie.php?id=$id&error=La taille de l'image dépasse 500Ko");
        exit();
    }
    
    $type_mime = mime_content_type($fichier['tmp_name']);
    if(!in_array($type_mime, $types_autorises) || !in_array($extension, ['jpg', 'jpeg', 'png'])) {
        header("Location: categorie.php?id=$id&error=Formats autorisés: JPG, PNG, JPEG");
        exit();
    }
    
    // Nouveau nom de fichier
    $nom_categorie = $nom;
    $nouveau_nom = 'image_' . $nom_categorie . '.' . $extension;
    
    // Suppression de l'ancienne image si elle existe
    if($image && file_exists("../Images/$image")) {
        unlink("../Images/$image");
    }
    
    // Upload
    if(move_uploaded_file($fichier['tmp_name'], "../Images/$nouveau_nom")) {
        $image = $nouveau_nom;
    } else {
        header("Location: categorie.php?id=$id&error=Erreur lors de l'upload");
        exit();
    }
}

// Mise à jour BDD
$req = $bdd->prepare("UPDATE categorie SET Nomcateg=?, DescCateg=?, ImgCateg=? WHERE Idcateg=?");
$req->execute([$nom, $description, $image, $id]);

header("Location: categorie.php?id=$id&success=1");
exit();
?>