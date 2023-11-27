<?php
namespace COMP3385;

class CreateUserModel extends AbstractORM {

    
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


    public function getRoleId($role){
        $stmt = $this->connection->prepare("SELECT id FROM roles WHERE role = (?)");
        $stmt->execute([$role]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    
    public function getUserId($email){
        $stmt = $this->connection->prepare("SELECT id FROM users WHERE email = (?)");
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

  }
?>
