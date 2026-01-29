<?php
class Room {
    public $id;
    public $name;
    public $capacity;
    public $type;
    public $active;
   

    public function __construct($id, $name, $capacity, $type, $active) {
    $this->id = $id;
    $this->name = $name;
    $this->capacity = $capacity;
    $this->type = $type;
    $this->active = $active;
    
}
}