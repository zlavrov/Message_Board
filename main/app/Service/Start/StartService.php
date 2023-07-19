<?php

namespace App\Service\Start;

use App\Model\MainModel\MainModel;
use App\Service\Router\RouterService;

class StartService {

    public function startApp() {

        $response = (new MainModel())->checkDataBaseConnect();
        if($response['status']) {
            (new RouterService())->routeMethod();
        } else {
            header('Content-type: application/json');
            echo json_encode($response);
        }
    }
}