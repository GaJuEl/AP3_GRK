<?php 

include 'connexion.php';

$req = $bdd->prepare('UPDATE persos SET DescPerso=? WHERE IdPerso = ?');
$req->execute([ $_POST["DescPerso"], $_GET["id"] ]);

header('Location: personnages.php');
?>