<?php

namespace App\Model\MainModel;

use PDO;
use PDOException;
use PDOStatement;
use App\Config\DataBaseConfig;

class MainModel {

    /**
     * This method is responsible for 
     * connecting to the database
     * @return PDO|null
     */
    public static function connection(): ?PDO
    {
        $config = DataBaseConfig::DBConfig();
        return new PDO("mysql:host=" . $config['host'] . ":" . $config['port'] . ";dbname=" . $config['database'], $config['user'], $config['password']);
    }

    /**
     * This method is responsible for 
     * checking the database connection, 
     * 
     * returns true if successful 
     * 
     * returns false on failure and an error message
     * 
     * @return array
     */
    public static function checkDataBaseConnect(): array
    {
        try {
            $config = DataBaseConfig::DBConfig();
            $conn = new PDO("mysql:host=" . $config['host'] . ":" . $config['port'] . "", $config['user'], $config['password']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return ['status' => true];
        }
        catch (PDOException $e) {
            switch($e->getCode()) {
                case "2002":
                    $message = "Wrong host or wrong port specified in database configuration.";
                    break;
                case "1045":
                    $message = "Wrong user or wrong password specified in database configuration.";
                    break;
            }
            return ['status' => false, 'message' => $message];
        }
    }
}
