<?php
class User {
    private $userTable = 'cms_user';
    private $conn;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $type; 

	public function __construct($db){
        $this->conn = $db;
    }

    public function register() {
        if($this->email && $this->password) {
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
    
            $sqlString ="
                INSERT INTO ".$this->userTable."(`first_name`, `last_name`, `email`, `password`)
                VALUES('".$this->first_name."','".$this->last_name."','".$this->email."','".$hashedPassword."')";

                try {
                    $stmt = $this->conn->prepare($sqlString);
                    return $stmt->execute();
                } catch (Exception $e) {
                    return false;
                }
        } else {
            return false;
        }
    }

    public function loggedIn (){
        session_start();
		if(!empty($_SESSION["userid"])) {
			return 1;
		} else {
			return 0;
		}
	}

    public function isAdmin() {
        session_start();
        if($_SESSION["user_type"] == 1) return 1;
        return 0;
    }
    
	public function login() {
        if($this->email && $this->password) {
            try {
                $sqlQuery = "SELECT * FROM ".$this->userTable." WHERE email = '".$this->email."'";
                $result = $this->conn->query($sqlQuery);

                if($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    if (password_verify($this->password, $user['password'])) {
                        session_start();
                        $_SESSION["userid"] = $user['id'];
                        $_SESSION["user_type"] = $user['type'];
                        $_SESSION["name"] = $user['first_name']." ".$user['last_name'];

                        if($user['type'] == 1) {
                            header("Location: dashboard.php");
                            exit;
                        } else {
                            header("Location: index.php");
                            exit;
                        }
                        return 1;
                    }
                }
            } catch (Exception $e) {

                return false;
            }
        }
        return 0;
    }
}
?>