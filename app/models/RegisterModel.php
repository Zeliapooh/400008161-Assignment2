<?php
namespace COMP3385;

class RegisterModel extends AbstractORM {

    
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

    public function check_user_exists($username)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function check_email_exists($email)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insert_user($username,$email, $password) {

        
        // $rolesId= $this->getRoleId()['id'] ;
        // $stmt = $this->connection->prepare("INSERT INTO users (username, password, email, role, role_id) VALUES (?, ?, ?, ?,?)");
        // $stmt->execute([$username, $hashPassword, $email, 'Research Group Manager', $rolesId]);

        // $usersId= $this->getUserId($email)['id'] ;
        // $stmt = $this->connection->prepare("INSERT INTO user_access_levels (id, email, AccessLevel) VALUES (?, ?, ?)");
        // $stmt->execute([ $usersId,$email, 'Research Group Manager']);
    }

    public function getRoleId(){
        $stmt = $this->connection->prepare("SELECT id FROM roles WHERE role = (?)");
        $stmt->execute(['Research Group Manager']);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    
    public function getUserId($email){
        $stmt = $this->connection->prepare("SELECT id FROM users WHERE email = (?)");
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    // public function check_user_exists($username)
    // {
    //     $newUser = [
    //         'user' => 'John Doe',
    //         'email' => 'john@example.com',
    //     ];
    //    // $this->save('user,email');
    //     $stmt = $this->db->query("SELECT COUNT(*) as `amt` FROM `users` WHERE username = '$username'");
    //     $stmt->execute();
    //     $count = $stmt->fetch(\PDO::FETCH_ASSOC);
    //     return $count;
    // }
    // public function check_email_exists($email)
    // {
    //     $stmt = $this->db->query("SELECT COUNT(*) as `amt` FROM `users` WHERE email = '$email'");
    //     $stmt->execute();
    //     $count = $stmt->fetch(\PDO::FETCH_ASSOC);
    //     return $count;
    // }
    // public function insert_user($username, $password, $email)
    // {
    //     //global $db;
    //     $stmt = $this->db->prepare("INSERT INTO users (username, password,email, role) values (?,?,?,?)");
    //     $stmt->execute([$username,$password,$email, 'Research Group Manager']);
    //     $stmt = $this->db->prepare("INSERT INTO user_access_levels (email, AccessLevel) values (?,?)");
    //     $stmt->execute([$email, 'Research Group Manager']);

    //     //$this->db->insert('register', $data);
    //     //$sql =  "INSERT INTO users (username, password,email) values ('$username','$password','$email') ";;
    // }

  }
?>
