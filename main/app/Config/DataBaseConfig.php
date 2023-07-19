<?php

namespace App\Config;

class DataBaseConfig {

    /**
     * This method is responsible for 
     * the given database configuration
     * 
     * @return array
     */
    public static function DBConfig(): array
    {
        return [
            "host"       =>      "mysql", 
            "port"       =>       "3306", 
            "user"       =>    "my_user", 
            "password"   =>"my_password", 
            "database"   =>"my_database"
        ];
    }
}
