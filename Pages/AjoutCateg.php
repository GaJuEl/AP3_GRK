<?php
include "connexion.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$nom = $_POST['nom'];
$description = $_POST['description'];

if(isset($_FILES['ImgCateg']) && $_FILES['ImgCateg']['error'] === UPLOAD_ERR_OK) {
    $fichier = $_FILES['ImgCateg'];
    
    $taille_max = 500 * 1024;
    $extensions_autorisees = ['jpg', 'jpeg', 'png'];
    $types_mime_autorises = [
        'image/jpeg',
        'image/png',
        'image/jpg' 
    ];
    
    if($fichier['size'] > $taille_max) {
        header("Location: FormAjoutCateg.php?error=La+taille+de+l'image+depasse+500Ko");
        exit();
    }

    $extension = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));
    if(!in_array($extension, $extensions_autorisees)) {
        header("Location: FormAjoutCateg.php?error=Extension+de+fichier+non+autorisée");
        exit();
    }
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $type_mime = finfo_file($finfo, $fichier['tmp_name']);
    finfo_close($finfo);
    
    if(!in_array($type_mime, $types_mime_autorises)) {
        header("Location: FormAjoutCateg.php?error=Type+MIME+non+valide:+".$type_mime);
        exit();
    }
    
    $nom_clean = preg_replace('/[^a-z0-9]/i', '_', strtolower($nom));
    $nom_image = 'image_'.$nom_clean.'_'.time().'.'.$extension;
    $chemin_image = "../Images/".$nom_image;
    
    if(!move_uploaded_file($fichier['tmp_name'], $chemin_image)) {
        header("Location: FormAjoutCateg.php?error=Erreur+de+transfert+du+fichier");
        exit();
    }
} else {
    $error_msg = "Aucun fichier reçu";
    if(isset($_FILES['ImgCateg']['error'])) {
        $error_msg = "Erreur upload: ".$_FILES['ImgCateg']['error'];
    }
    header("Location: FormAjoutCateg.php?error=".urlencode($error_msg));
    exit();
}

try {
    $req = $bdd->prepare("INSERT INTO categorie (Nomcateg, DescCateg, ImgCateg) VALUES (?, ?, ?)");
    $req->execute([$nom, $description, $nom_image]);
    
    header("Location: FormAjoutCateg.php?success=1");
} catch(PDOException $e) {
    if(isset($chemin_image) && file_exists($chemin_image)) {
        unlink($chemin_image);
    }
    header("Location: FormAjoutCateg.php?error=Erreur+SQL:+".urlencode($e->getMessage()));
}
exit();
?>