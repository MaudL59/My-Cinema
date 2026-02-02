<?php
// ScreeningController.php


// database
require_once './config/database.php';

class ScreeningController{
    public function index($pdo){
        $repo = new ScreeningRepository($pdo);
        $allData = $repo->findAll();
        $service = new ScreeningService();
        $planning = $service-> organizeScreenings($allData);

        return $planning;
    }
    
}