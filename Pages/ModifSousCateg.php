<?php
include "connexion.php";

$id = $_POST['id'];
$nom = $_POST['nom'];
$description = $_POST['description'];
$idcateg = $_POST['idcateg'];
$image = $_POST['image_actuelle'] ?? null;

if(isset($_FILES['Imgsscateg']) && $_FILES['Imgsscateg']['error'] === UPLOAD_ERR_OK) {
    $fichier = $_FILES['Imgsscateg'];
    
    $taille_max = 500 * 1024;
    $types_autorises = ['image/jpeg', 'image/jpg', 'image/png'];
    $extension = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));
    
    if($fichier['size'] > $taille_max) {
        header("Location: categorie.php?id=$id&error=La taille de l'image dépasse 500Ko");
        exit();
    }
    
    $type_mime = mime_content_type($fichier['tmp_name']);
    if(!in_array($type_mime, $types_autorises) || !in_array($extension, ['jpg', 'jpeg', 'png'])) {
        header("Location: categorie.php?id=$id&error=Formats autorisés: JPG, PNG, JPEG");
        exit();
    }
    
    $nom_image = $nom;
    $nouveau_nom = 'image_' . $nom_image . '.' . $extension;
    
    if($image && file_exists("../Images/$image")) {
        unlink("../Images/$image");
    }
    
    if(move_uploaded_file($fichier['tmp_name'], "../Images/$nouveau_nom")) {
        $image = $nouveau_nom;
    } else {
        header("Location: categorie.php?id=$id&error=Erreur lors de l'upload");
        exit();
    }
}

$req = $bdd->prepare("UPDATE souscateg SET Nomsscateg=?, Descsscateg=?, Imgsscateg=?, Idcateg=? WHERE IdsousCateg=?");
$req->execute([$nom,$description, $image, $idcateg, $id]);

header("Location: categorie.php?id=$id&success=1");
exit();
?>