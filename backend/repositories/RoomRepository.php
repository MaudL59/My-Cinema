<?php
// RoomRepository.php

// Le Repository, c'est le "bibliothécaire". Son rôle est d'aller chercher les données dans la base (SQL) et de les transformer en objets Movie (PHP) pour pouvoir utiliser les getters.

class RoomRepository{
    private $pdo;

    // le constructeur qui va recevoir la connexion à la base de données pour la stocker dans cette propriété
    public function __construct($connection){
        $this -> pdo = $connection;

    }

    // la fonction qui va demander à la base de données tous les films
    public function findAll(){
        
        $sql = "SELECT * FROM Room";
        // appel de la table Room
        $statement = $this ->pdo->query($sql); 
        // renvoie la demande et stocke le résultat dans une variable $statement
        
        return $statement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Room');
        // Le mode de transport : PDO::FETCH_CLASS veut dire : "Prépare-toi à créer des objets"
        // Le plan de construction : On lui donne le nom de la classe sous forme de texte : 'Room'
        //   renvoie un tableau d'objets Room
        
    }

}