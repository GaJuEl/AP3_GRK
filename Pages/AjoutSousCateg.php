<?php
include "connexion.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$nom = $_POST['nom'];
$description = $_POST['description'];
$idcateg = $_POST["idcateg"];

if(isset($_FILES['Imgsscateg']) && $_FILES['Imgsscateg']['error'] === UPLOAD_ERR_OK) {
    $fichier = $_FILES['Imgsscateg'];
    
    $taille_max = 500 * 1024;
    $extensions_autorisees = ['jpg', 'jpeg', 'png'];
    $types_mime_autorises = [
        'image/jpeg',
        'image/png',
        'image/jpg' 
    ];
    
    if($fichier['size'] > $taille_max) {
        header("Location: FormAjoutSousCateg.php?error=La+taille+de+l'image+depasse+500Ko");
        exit();
    }

    $extension = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));
    if(!in_array($extension, $extensions_autorisees)) {
        header("Location: FormAjoutSousCateg.php?error=Extension+de+fichier+non+autorisée");
        exit();
    }
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $type_mime = finfo_file($finfo, $fichier['tmp_name']);
    finfo_close($finfo);
    
    if(!in_array($type_mime, $types_mime_autorises)) {
        header("Location: FormAjoutSousCateg.php?error=Type+MIME+non+valide:+".$type_mime);
        exit();
    }
    
    $nom_clean = preg_replace('/[^a-z0-9]/i', '_', strtolower($nom));
    $nom_image = 'image_'.$nom_clean.'_'.time().'.'.$extension;
    $chemin_image = "../Images/".$nom_image;
    
    if(!move_uploaded_file($fichier['tmp_name'], $chemin_image)) {
        header("Location: FormAjoutSousCateg.php?error=Erreur+de+transfert+du+fichier");
        exit();
    }
} else {
    $error_msg = "Aucun fichier reçu";
    if(isset($_FILES['Imgsscateg']['error'])) {
        $error_msg = "Erreur upload: ".$_FILES['Imgsscateg']['error'];
    }
    header("Location: FormAjoutSousCateg.php?error=".urlencode($error_msg));
    exit();
}

try {
    $req = $bdd->prepare("INSERT INTO souscateg (Nomsscateg, Descsscateg, Imgsscateg, IdCateg) VALUES (?, ?, ?, ?)");
    $req->execute([$nom, $description, $nom_image, $idcateg]);
    
    header("Location: FormAjoutSousCateg.php?success=1");
} catch(PDOException $e) {
    if(isset($chemin_image) && file_exists($chemin_image)) {
        unlink($chemin_image);
    }
    header("Location: FormAjoutSousCateg.php?error=Erreur+SQL:+".urlencode($e->getMessage()));
}
exit();
?>