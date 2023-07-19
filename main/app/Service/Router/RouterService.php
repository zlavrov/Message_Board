<?php

namespace App\Service\Router;

use ReflectionClass;
use App\Config\AppConfig;

class RouterService {

    public function routeMethod() {

        $controller = (new AppConfig())->getController();
        $controllerFiles = scandir($controller['controllerDir']);
        $controllerList = array();
        foreach ($controllerFiles as $file) {
            if (substr($file, -4) === '.php' && $file !== '.' && $file !== '..') {
                $className = substr($file, 0, -4);
                $fullClassName = $controller['partClassName'] . $className;
                $controllerList[] = new $fullClassName();
            }
        }

        foreach($controllerList as $class) {
            $reflection = new ReflectionClass($class);
            foreach ($reflection->getMethods() as $method) {
                foreach ($method->getAttributes() as $attribute) {
                    foreach($attribute->getArguments() as $key => $value) {
                        $this->routeDiff([$value], $class, $method->getName());
                    }
                }
            }
        }
    }

    public function routeDiff($arrayRoute, $class, $method) {

        $regexRoutes = array_map(function($route) {
            return preg_replace('/\{\w+\}/', '(\w+)', $route);
        }, $arrayRoute);

        foreach ($regexRoutes as $i => $regexRoute) {
            if (preg_match('#^' . $regexRoute . '$#', $_SERVER['REQUEST_URI'], $matches)) {
                $params = array_slice($matches, 1);
                call_user_func_array(array($class, $method), $params);
                break;
            }
        }
    }
}
