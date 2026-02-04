<?php
// ScreeningRepository.php

// Le Repository, c'est le "bibliothécaire". Son rôle est d'aller chercher les données dans la base (SQL) et de les transformer en objets Movie (PHP) pour pouvoir utiliser les getters.

class ScreeningRepository{
    private $pdo;

    // le constructeur qui va recevoir la connexion à la base de données pour la stocker dans cette propriété
    public function __construct($connection){
        $this -> pdo = $connection;

    }

    // la fonction qui va demander à la base de données tous les films
    public function findAll(){
        
        $sql = "SELECT 
            Screening.id, 
            Screening.movie_id, 
            Screening.room_id, 
            Screening.screening_date, 
            Movie.title AS title, 
            Movie.duration AS duration,
            Room.name AS room_name
        FROM Screening 
        JOIN Movie ON Screening.movie_id = Movie.id
        JOIN Room ON Screening.room_id = Room.id";
        // appel de la table Screening
        $statement = $this ->pdo->query($sql); 
        // renvoie la demande et stocke le résultat dans une variable $statement
        
        return $statement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Screening');
        // Le mode de transport : PDO::FETCH_CLASS veut dire : "Prépare-toi à créer des objets"
        // Le plan de construction : On lui donne le nom de la classe sous forme de texte : 'Screening'
        //   renvoie un tableau d'objets Screening
        
    }

}