<?php

$host = 'localhost';
$db   = 'my-cinema'; 
$user = 'root';
$pass = ''; 

try {
    // C'est ici qu'on dit à PHP d'ouvrir la base 'my_cinema'
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
