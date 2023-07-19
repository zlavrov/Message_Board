<?php

namespace App\Config;

class AppConfig {

    public function getController() {
        return [
            "controllerDir" => "app/Controller",
            "partClassName" => "App\\Controller\\"
        ];
    }
}
