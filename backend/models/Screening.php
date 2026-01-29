<?php
class Screening {
    public $id;
    public $movie_id;
    public $room_id;
    public $star_time;  

    public function __construct($id, $movie_id, $room_id, $star_time) {
    $this->id = $id;
    $this->movie_id = $movie_id;
    $this->room_id = $room_id;
    $this->star_time = $star_time;
    
}
}