<?php 

include 'connexion.php';

$id = $_GET["id"];

$req = $bdd->prepare('DELETE FROM persos WHERE IdPerso = ?');
$req->execute([$id]);

header('Location: personnages.php');

?>