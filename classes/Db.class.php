<?php

    class Db {
        private static $conn;

        /*
            @return PDO connection
            -> if exists -> return existing
            -> if !exists -> return new PDO 
        */
        public static function getInstance() {
            
            include_once("../settings/db.php");


            if( self::$conn == null ){
                self::$conn = new PDO('mysql:host='.$db['host'].';dbname=todoapp', $db['username'], $db['password']);
                // echo "no";
                return self::$conn;
                
            }
            else {
                // echo "yes";
                return self::$conn;
            }
        }

    }