<?php
namespace COMP3385;

class LoginModel extends AbstractORM{
    public function __construct() {
        $config = parse_ini_file(CONFIG_DIR.'\config.ini', true);
        $this->connectDatabase($config['database']);
        
    }
    public function connectDatabase($database){
        $host = $database["host"];
        $dbname = $database["dbname"];
        $username = $database["username"];
        $password = $database["password"];
        $this->connection = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }


}