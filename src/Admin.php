<?php

class Admin {
    private $id;
    private $login;
    private $password;
    
    
    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $this->password = $password;
    }
    
    static public function loadUserByLogin(PDO $conn, $login) {
        $stmt = $conn->prepare('SELECT * FROM Admins WHERE login=:login');
        $result = $stmt->execute(['login' => $login]);
        
        if ($result === true && $stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $loadedUser = new Admin();
            $loadedUser->id = $row['id'];
            $loadedUser->setLogin($row['login']);
            return $loadedUser;
        }
    }    

    static public function login(PDO $conn, $login, $password) {
        $user = self::loadUserByLogin($conn, $login);
        
        if($user) {
            if(password_verify($password, $user->getLogin())) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
