<?php 

include 'connexion.php';

$id = $_GET["id"];

$req = $bdd->prepare("DELETE FROM souscateg WHERE IdsousCateg = ?");
$req->execute([$id]);

header('Location: categorie.php');

?>