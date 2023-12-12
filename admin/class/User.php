<?php
class User {
    private $userTable = 'cms_user';
    private $conn;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $type = 0; 
    public $id;
    public $deleted;

	public function __construct($db){
        $this->conn = $db;
    }

    public function register() {
        if($this->email && $this->password) {
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
    
            $sqlString ="
                INSERT INTO ".$this->userTable."(`first_name`, `last_name`, `email`, `password`, `type`)
                VALUES('".$this->first_name."','".$this->last_name."','".$this->email."','".$hashedPassword."','".$this->type."')";

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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
		if(!empty($_SESSION["userid"])) {
			return 1;
		} else {
			return 0;
		}
	}

    public function isAdmin() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION["user_type"]) && $_SESSION["user_type"]  == 1) return 1;
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

    public function getUsersListing(){		
		
        $sqlQuery = "
        SELECT id, CONCAT(first_name, ' ', last_name) AS name, 
        case when type = 1 then 'admin' 
        else 'user' 
        end as type, 
        email, COALESCE(deleted, 'Not Deleted') AS status
        FROM ".$this->userTable."  
         ";

    $result = $this->conn->query($sqlQuery);	
    return $result;
	}
	
	public function getUser(){		
		if($this->id) {
			$sqlQuery = "
			SELECT id, first_name, last_name, email, type
			FROM ".$this->userTable." 			
			WHERE id = ? ";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$user = $result->fetch_assoc();
			return $user;
		}		
	}
	
	public function update(){
		
		if($this->id) {			
			$stmt = $this->conn->prepare("
				UPDATE ".$this->userTable." 
				SET first_name= ?, last_name = ?, email = ?, type = ?
				WHERE id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->first_name = htmlspecialchars(strip_tags($this->first_name));
			$this->last_name = htmlspecialchars(strip_tags($this->last_name));
			$this->email = htmlspecialchars(strip_tags($this->email));
			$this->type = htmlspecialchars(strip_tags($this->type));
			
			$stmt->bind_param("ssssi", $this->first_name, $this->last_name, $this->email, $this->type, $this->id);
			
			if($stmt->execute()){
				return true;
			}			
		}
		
	}
	
	public function delete(){
		
		if($this->id) {	
		
			$stmt = $this->conn->prepare("
				DELETE FROM ".$this->userTable." 				
				WHERE id = ?");

			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bind_param("i", $this->id);

			if($stmt->execute()){
				return true;
			}
		}
	}
}
?>