<?php
// backend/config/database.php
$host = 'localhost';
$db   = 'my-cinema'; // On utilise bien le tiret confirmé par ton terminal
$user = 'root';
$pass = ''; 

try {
    // On force l'utilisation de la variable $db ici
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Ce message s'affichera si le nom est toujours mauvais
    die("Erreur de connexion : " . $e->getMessage());
}