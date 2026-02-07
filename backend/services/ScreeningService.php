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

    public function hasConflict($existingScreenings, $newStartTimeString, $newDuration, $currentId = null) {

    $newStart = new DateTime($newStartTimeString);

    $duration = (int)$newDuration > 0 ? (int)$newDuration : 1;

    $newEnd = (clone $newStart)->modify("+" . (int)$newDuration . " minutes");

    foreach ($existingScreenings as $s) {
        
        if ($currentId !== null && $s->getId() == $currentId) {
            continue;
        }

        $exStart = new DateTime($s->getScreeningDate());
        $exDuration = $s->getDuration()> 0 ? (int)$s->getDuration() : 1;
        
        // Calcule de l'heure de fin de la séance existante 
        $exEnd = (clone $exStart)->modify("+" . (int)$exDuration . " minutes");
        // vérification du chevauchement
        // Si c'est vrai, return true;
        if ($newStart < $exEnd && $newEnd > $exStart) {
            return true; // Alerte ! Il y a un conflit.
        }
    }

    return false; // Pas de conflit trouvé
}
}

