<?php
// ScreeningService.php


// filtre des horaires, respect de la limite de 5 séances par jour et organisation de tout dans un tableau structuré par date.
class ScreeningService{
    public function organizeScreenings($allScreenings){
        $organized = [];
        foreach($allScreenings as $screening){
            $dateObj = new DateTime($screening->getScreeningDate());
            $day = $dateObj->format('Y-m-d');
            $hour = $dateObj->format('H:i');

            if (!isset($organized[$day])){
                $organized[$day] = [];
            } if ($hour >= '11:00' && count($organized[$day]) < 5) {
                
                $organized[$day][] = $screening;
            }
        }
        return $organized;
    }
}

