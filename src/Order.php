<?php
//namespace OShop;
require_once __DIR__ . '/../conn.php';

class Order {
    private $id;
    private $ownerId;
    private $creationDate;
    private $status;
    private $products;
    private $totalValue;
    
    public function __construct($ownerId, $creationDate, $status = 0, $products = [], $totalValue = '', $id = -1) {
        if ($id == -1) {
           $this->id = -1; 
        }
        else {
            $this->setId($id);
        }
        $this->setProducs($products);
        $this->setOwnerId($ownerId);
        $this->setCreationDate($creationDate);
        $this->setStatus($status);
        $this->setTotalValue($totalValue);
    }
    
    public function saveToDB(PDO $conn) {
        if($this->id == -1) {
            $stmt = $conn->prepare('INSERT INTO Orders(ownerId, creationDate, status, products, totalValue) '
                    . 'VALUES (:ownerId, :creationDate, :status, :products, :totalValue)');
            
            $result = $stmt->execute([ 
                'ownerId' => $this->ownerId, 
                'creationDate'=> $this->creationDate, 
                'status' => $this->status,
                'products' => serialize($this->products),
                'totalValue' => $this->totalValue]);
            
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
            
        } else {
            $stmt = $conn->prepare('UPDATE Orders '
                    . 'SET ownerId=:ownerId, '
                    . 'creationDate=:creationDate, '
                    . 'status=:status, '
                    . 'products=:products, '
                    . 'totalValue=:totalValue'
                    . 'WHERE id=:id');
            
            $result = $stmt->execute([ 
                'ownerId' => $this->ownerId, 
                'creationDate' => $this->creationDate,
                'status' => $this->status,
                'products' => serialize($this->products),
                'totalValue' => $this->totalValue,
                'id' => $this->id]);
            
            return $result;
        }
        
        return false;
    }
    
    
    function getId() {
        return $this->id;
    }

    function getOwnerId() {
        return $this->ownerId;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function getStatus() {
        return $this->status;
    }

    function getProducs() {
        return $this->products;
    }

    function getTotalValue() {
        return $this->totalValue;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setOwnerId($ownerId) {
        $this->ownerId = $ownerId;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setProducs($products) {
        $this->products = $products;
    }

    function setTotalValue($totalValue) {
        $this->totalValue = $totalValue;
    }


}