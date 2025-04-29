<?php

try{
    $bdd = new PDO(
        "mysql:host=localhost;dbname=bddechecs;charset=utf8",
        "Admin_echecs",
        "Passer@2025"
    );
}catch(exeception $e){
    die("Erreur : ".$e->getMessage5());
}

?>