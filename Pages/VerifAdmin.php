<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'connexion.php'; 


function authenticate($username, $password) {
    global $bdd; 
    
    $stmt = $bdd->prepare('SELECT * FROM user');
    $stmt->execute();
    $user = $stmt->fetch();
    
    if ($user['Username'] == $username && $user["Password"] == $password) {
        $_SESSION['authenticated'] = true;
        $_SESSION['User'] = $user['Username'];
    } else {
        $_SESSION['authenticated'] = false; 
    }
    
    header("Location: ../index.php"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['Usr'] ?? '';
    $password = $_POST['pass'] ?? '';
    
    authenticate($username, $password);
}
?>
