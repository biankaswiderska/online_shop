<?php

class Admin {
    private $id;
    private $login;
    private $password;
    private $email;
    
    
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
    
    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

        
    static public function loadAdminByLogin(PDO $conn, $login) {
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
        $user = self::loadAdminByLogin($conn, $login);
        
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
    
        public function saveToDB(PDO $conn) {
        if($this->id == -1) {
            $stmt = $conn->prepare('INSERT INTO Admins(login, email, password) '
                    . 'VALUES (:login, :email, :pass)');
            
            $result = $stmt->execute([ 
                'login' => $this->login, 
                'email'=> $this->email, 
                'pass' => $this->password]);
            
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
            
        } else {
            $stmt = $conn->prepare('UPDATE Admins '
                    . 'SET login=:login, '
                    . 'email=:email, '
                    . 'password=:password '
                    . 'WHERE id=:id');
            
            $result = $stmt->execute([ 
                'login' => $this->login, 
                'email' => $this->email,
                'password' => $this->password, 
                'id' => $this->id]);
            
            return $result;
        }
        
        return false;
    }
    
    static public function loadAdminById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM Admins WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);
        
        if ($result === true && $stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->setLogin($row['login']);
            $loadedUser->setPassword($row['password']);
            $loadedUser->setEmail($row['email']);
            
            return $loadedUser;
        }
    }
    
    static public function loadAllAdmins(PDO $conn) {
        $sql = "SELECT * FROM Admins";
        $ret = [];
        
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->setLogin($row['login']);
                $loadedUser->setPassword($row['password']);
                $loadedUser->setEmail($row['email']);
                
                $ret[] = $loadedUser;
            }
        }
        
        return $ret;
    }
    
    public function delete(PDO $conn) {
        if($this->id != -1) {
            
            $stmt = $conn->prepare('DELETE FROM Admins WHERE id=:id');
            $result = $stmt->execute(['id' => $this->id]);
            
            if($result === true) {
                $this->id = -1;
                return true;
            }
            
            return false;
        }
        
        return true;
    }
    
    static public function loadsAdminByEmail(PDO $conn, $email) {
        $stmt = $conn->prepare('SELECT * FROM Admins WHERE email=:email');
        $result = $stmt->execute(['email' => $email]);
        
        if ($result === true && $stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $loadedAdmin = new Admin();
            $loadedAdmin->id = $row['id'];
            $loadedAdmin->setAdminname($row['username']);
            $loadedAdmin->setPassword($row['password']);
            $loadedAdmin->setEmail($row['email']);
            
            return $loadedAdmin;
        }
    }
}
