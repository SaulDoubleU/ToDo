<?php

    abstract class Db{
        private static $conn;
        
        public static function getConnection(){
            if( self::$conn != null ){
                return self::$conn;
            }else{
                $config = parse_ini_file($_SERVER['DOCUMENT_ROOT']. "/todoapp/config/config.ini");
                self::$conn = new PDO("mysql:host=" . $config['host'] . ";dbname=" . $config['db_name'], $config['db_user'], $config['db_password']);
                return self::$conn;
            }
        }
    }