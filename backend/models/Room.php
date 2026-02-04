<?php
// Room.php

class Room implements JsonSerializable {
    private $id;
    private $name;
    private $capacity;
    private $type;
    private $active;
   
    // C'est un constructeur, il permet d'injecter les données dès la naissance de l'objet.
    
    public function __construct($id = null, $name = null, $capacity = null, $type = null, $active = null) {
    $this->id = $id;
    $this->name = $name;
    $this->capacity = $capacity;
    $this->type = $type;
    $this->active = $active;
    }

    // Comme tous est en private on ne peut rien sortir, il faut faire des getters pour chaque propriétés

     public function getId(){
        return $this -> id;
    }
    public function getName(){
        return $this -> name;
    }
    public function getCapacity(){
        return $this -> capacity;
    }
    public function getType(){
        return $this -> type;
    }
    public function getActive(){
        return $this -> active;
    }   
    
   public function jsonSerialize(): mixed {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'capacity' => $this->capacity,
            'type'     => $this->type,
            'active'   => $this->active
        ];
    }

}