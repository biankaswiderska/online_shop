<?php
//namespace OShop;
require_once __DIR__ . '/../conn.php';

class User {
    protected $id;
    private $name;
    private $surname;
    private $email;
    private $hashPass;
    private $accessLevel;
        
    public function __construct() {
        $this->id = -1;
        $this->name = '';
        $this->surname = '';
        $this->email = '';
        $this->hashPass = '';
        $this->accessLevel = 1;
    }
    
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getHashPass() {
        return $this->hashPass;
    }
    public function getAccessLevel() {
        return $this->accessLevel;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setHashPass($hashPass) {
        $this->hashPass = $hashPass;
    }
    public function setAccessLevel($accessLevel) {
        $this->accessLevel = $accessLevel;
    }
    public function setPassword($password) {
        $this->hashPass = password_hash($password, PASSWORD_BCRYPT);
        
    }
    function getSurname() {
        return $this->surname;
    }
    function setSurname($surname) {
        $this->surname = $surname;
    }

        
    public function saveToDB(PDO $conn) {
        if($this->id == -1) {
            $stmt = $conn->prepare('INSERT INTO Users (name, surname, email, hashPass, accessLevel) '
                    . 'VALUES (:name, :surname, :email, :pass, :accessLevel)');
            
            $result = $stmt->execute([ 
                'name' => $this->name, 
                'surname' => $this->surname, 
                'email'=> $this->email, 
                'pass' => $this->hashPass,
                'accessLevel' => $this->accessLevel]);
            
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
            
        } else {
            $stmt = $conn->prepare('UPDATE Users '
                    . 'SET name=:name, '
                    . 'surname=:surname, '
                    . 'email=:email, '
                    . 'hash_pass=:hash_pass, '
                    . 'accessLevel=:accessLevel'
                    . 'WHERE id=:id');
            
            $result = $stmt->execute([ 
                'name' => $this->name, 
                'surname' => $this->surname, 
                'email' => $this->email,
                'hash_pass' => $this->hashPass,
                'accessLevel' => $this->accessLevel,
                'id' => $this->id]);
            return $result;
        }
        return false;
    }
    
    static public function loadUserById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM Users WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);
        if ($result === true && $stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->setName($row['name']);
            $loadedUser->setSurname($row['surname']);
            $loadedUser->setHashPass($row['hashPass']);
            $loadedUser->setEmail($row['email']);
            $loadedUser->setAccessLevel($row['accessLevel']);
            return $loadedUser;
        }
    }
    
    static public function loadAllUsers(PDO $conn) {
        $sql = "SELECT * FROM Users";
        $ret = [];
        
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->setName($row['name']);
                $loadedUser->setSurname($row['surname']);
                $loadedUser->setHashPass($row['hashPass']);
                $loadedUser->setEmail($row['email']);
                $loadedUser->setAccessLevel($row['accessLevel']);
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }
    
    public function delete(PDO $conn) {
        if($this->id != -1) {
            $stmt = $conn->prepare('DELETE FROM Users WHERE id=:id');
            $result = $stmt->execute(['id' => $this->id]);
            if($result === true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }
    
    static public function loadUserByEmail(PDO $conn, $email) {
        $stmt = $conn->prepare('SELECT * FROM Users WHERE email=:email');
        $result = $stmt->execute(['email' => $email]);
        
        if ($result === true && $stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->setName($row['name']);
            $loadedUser->setSurname($row['surname']);
            $loadedUser->setHashPass(trim($row['hashPass']));
            $loadedUser->setEmail($row['email']);
            $loadedUser->setAccessLevel($row['accessLevel']);

            return $loadedUser;
        }
    }
    
    static public function login(PDO $conn, $email, $password) {
        $user = self::loadUserByEmail($conn, $email);
        if($user) {
            if(password_verify($password, $user->getHashPass())) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}