<?php
//namespace OShop;
require_once __DIR__ . '/../conn.php';

class Product {

    private $id;
    private $price;
    private $name;
    private $description;
    private $releaseDate;
    private $sizeClass;


    public function __construct($price, $name, $description, $releaseDate, $sizeClass, $id = -1) {
        if ($id = -1) {
            $this->id = -1;
        }
        else {
            $this->setId($id);
        }
        $this->setPrice($price);
        $this->setName($name);
        $this->setDescription($description);
        $this->setreleaseDate($releaseDate);
        $this->setSizeClass($sizeClass);
        return $this;
    }

    public function saveToDB(PDO $conn) {
        if($this->id == -1) {
            $stmt = $conn->prepare('INSERT INTO Products (price, name, description, releaseDate, sizeClass) '
                    . 'VALUES (:price, :name, :description, :releaseDate, :sizeClass)');

            $result = $stmt->execute([
                'price' => $this->price,
                'name'=> $this->name,
                'description' => $this->description,
                'releaseDate' => $this->releaseDate,
                'sizeClass' => $this->sizeClass]);

            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }

        } else {
            $stmt = $conn->prepare('UPDATE Products '
                    . 'SET price=:price, '
                    . 'name=:name, '
                    . 'description=:description, '
                    . 'releaseDate=:releaseDate, '
                    . 'sizeClass=:sizeClass'
                    . 'WHERE id=:id');

            $result = $stmt->execute([
                'price' => $this->price,
                'name' => $this->name,
                'description' => $this->description,
                'releaseDate' => $this->releaseDate,
                'sizeClass' => $this->sizeClass,
                'id' => $this->id]);

            return $result;
        }

        return false;
    }

     static public function loadProductById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM Products WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);

        if ($result === true && $stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $loadedProduct = new Product();
            $loadedProduct->id = $row['id'];
            $loadedProduct->setPrice($row['price']);
            $loadedProduct->setName($row['name']);
            $loadedProduct->setDescription($row['description']);
            $loadedProduct->setReleaseDate($row['releaseDate']);
            $loadedProduct->setSizeClass($row['sizeClass']);
            return $loadedProduct;
        }
    }

    static public function loadAllProducts(PDO $conn) {
        $sql = "SELECT * FROM Products";
        $ret = [];

        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedProduct = new Product();
                $loadedProduct->id = $row['id'];
                $loadedProduct->setPrice($row['price']);
                $loadedProduct->setName($row['name']);
                $loadedProduct->setDescription($row['description']);
                $loadedProduct->setreleaseDate($row['releaseDate']);
                $loadedProduct->setSizeClass($row['sizeClass']);
                $ret[] = $loadedProduct;
            }
        }

        return $ret;
    }

    public function delete(PDO $conn) {
        if($this->id != -1) {
            $stmt = $conn->prepare('DELETE FROM Products WHERE id=:id');
            $result = $stmt->execute(['id' => $this->id]);

            if($result === true) {
                $this->id = -1;
                return true;
            }

            return false;
        }
        return true;
    }


    function getId() {
        return $this->id;
    }

    function getPrice() {
        return $this->price;
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

    function setPrice($price) {
        $this->price = $price;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }
    function getReleaseDate() {
        return $this->releaseDate;
    }

    function getSizeClass() {
        return $this->sizeClass;
    }

    function setReleaseDate($releaseDate) {
        $this->releaseDate = $releaseDate;
    }

    function setSizeClass($sizeClass) {
        $this->sizeClass = $sizeClass;
    }


}
