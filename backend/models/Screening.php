<?php
// Screening.php

class Screening {
    private $id;
    private $movie_id;
    private $room_id;
    private $screening_date;  

    // C'est un constructeur, il permet d'injecter les données dès la naissance de l'objet.
   
    public function __construct($id = null, $movie_id = null, $room_id = null, $screening_date = null) {
    $this->id = $id;
    $this->movie_id = $movie_id;
    $this->room_id = $room_id;
    $this->screening_date = $screening_date;
    
}
    // Comme tous est en private on ne peut rien sortir, il faut faire des getters pour chaque propriétés

     public function getId(){
        return $this -> id;
    }
    public function getMovieId(){
        return $this -> movie_id;
    }
    public function getRoomId(){
        return $this -> room_id;
    }
    public function getStarTime(){
        return $this -> screening_date;
    } 

}