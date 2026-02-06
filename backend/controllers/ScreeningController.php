<?php
// ScreeningController.php

class ScreeningController{
    public function index($pdo){
        $repo = new ScreeningRepository($pdo);
        $allData = $repo->findAll();
        $service = new ScreeningService();
        $planning = $service-> organizeScreenings($allData);

        echo json_encode($planning);
    }
    
}