<?php

require_once __DIR__ . '/../conn.php';

class Category {
    private $id;
    private $name;
    private $description;
    
    public function __construct($name = '', $description = '', $id = -1) {
        if ($id == -1) {
            $this->id = -1;
        }
        else {
            $this->id = $id;
        }
        $this->name = $name;
        $this->description = $description;
        return $this;
    }
    
    public function saveToDB(PDO $conn) {
        if($this->id == -1) {
            $stmt = $conn->prepare('INSERT INTO Categories(name, description) '
                    . 'VALUES (:name, :description)');
            
            $result = $stmt->execute([ 
                'name' => $this->name, 
                'description' => $this->description]);
            
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
            
        } else {
            $stmt = $conn->prepare('UPDATE Categories '
                    . 'SET name=:name, '
                    . 'description=:description, '
                    . 'WHERE id=:id');
            
            $result = $stmt->execute([ 
                'name' => $this->name, 
                'description' => $this->description,
                'id' => $this->id]);
            return $result;
        }
        return false;
    }
    
    static public function loadAllCategories(PDO $conn) {
        $sql = "SELECT * FROM Categories";
        $array = [];
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
//            $row = $result->fetch(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $loadedCategory = new Category($row['name'], $row['description'], $row['id']);
                $array[] = $loadedCategory;
            }
        }
        return $array;
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }


}