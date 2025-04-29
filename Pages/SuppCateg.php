<?php 

include 'connexion.php';

$id = $_GET["id"];

$req = $bdd->prepare("SELECT * FROM souscateg WHERE Idcateg = ?");
$req->execute([$id]);
$souscateg = $req->fetchall();

if(count($souscateg) != 0){
    $req = $bdd->prepare("DELETE FROM souscateg WHERE Idcateg = ?");
    $req->execute([$id]);
}

$req = $bdd->prepare('DELETE FROM categorie WHERE Idcateg = ?');
$req->execute([$id]);

header('Location: categorie.php');

?>