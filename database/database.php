<?php
class Database {
    
    public $dbname;
    private $dsn, $username, $db, $password, $host, $port;
    
    //function __construct() { }

        public function getDB ($dbname) {
            //local settings
            if ($_SERVER['SERVER_NAME'] == 'localhost'){
                $host = 'localhost';
                $port = '';
                $username = 'gerrygj';
                $password = 'pa55word';

            //remote settings
            } else{
                $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
                $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
                $username = getenv('OPENSHIFT_MYSQL_DB_USERNAME2');
                $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD2');
            }
            
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