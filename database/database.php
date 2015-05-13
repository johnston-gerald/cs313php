<?php
class Database {
    
    public $dbname;
    private static $dsn, $username, $db;
    private static $password = 'pa55word';
    
    private function __construct() { }

        public static function getDB ($dbname) {
            //local settings
            if ($_SERVER['SERVER_NAME'] == 'localhost'){
                self::$dsn = "mysql:host=localhost;dbname=$dbname";
            //remote settings
            } else{
                self::$dsn = "mysql:host=127.2.123.2;port=3306;dbname=$dbname";
            }

            self::$username = 'gerrygj';
            self::$password = 'pa55word';
            
            if (!isset(self::$db)) {
                try {
                    self::$db = new PDO(self::$dsn,
                                        self::$username,
                                        self::$password);
                    //make query errors throw exceptions (they don't by default)
                    self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    $error_message = $e->getMessage();
                    include('database_error.php');
                    exit();
                }
            }
            //echo self::$username;   //for testing
            return self::$db;
    }
}