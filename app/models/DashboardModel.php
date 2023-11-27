<?php
namespace COMP3385;

class DashboardModel extends AbstractORM{
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

    // public function check_email_exists($email)
    // {
    //     $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = ?");
    //     $stmt->execute([$email]);
    //     return $stmt->fetch(\PDO::FETCH_ASSOC);
    // }
}