<?php
class Database {
    
    public $dbname;
    private $dsn, $username, $db, $password, $host, $port;
    
    //function __construct() { }

        public function getDB ($dbname) {
            if ($_SERVER['SERVER_NAME'] == 'localhost'){
                $host = 'localhost';
                $port = '';
            //remote settings
            } else{
                //get host and port settings from phpMyAdmin
                $host = '127.2.123.2';
                $port = '3306';
            }
            $username = 'gerrygj';
            $password = 'pa55word';
            
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
            
            if (!isset($db)) {
                try {
                    $db = new PDO($dsn,
                                  $username,
                                  $password);
                    //make query errors throw exceptions (they don't by default)
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    $error_message = $e->getMessage();
                    include('database_error.php');
                    exit();
                }
            }
            return $db;
        }
}