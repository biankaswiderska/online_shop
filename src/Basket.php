<?php
namespace OShop;
require_once __DIR__ . '/../conn.php';
require_once __DIR__ . '/Order.php';

class Basket {
    private $id;
    private $ownerId;
    private $products;
    private $totalValue;
    
    public function __construct($ownerId) {
        $this->id = $id + '_' + strtotime($time());
        $this->ownerId = $this->setOwnerId($ownerId);
        $this->products = [];
        $this->totalValue = 0;
    }
    
    public function addProduct(OShop\Product $product, $amount) {
        $valueOfProductX = $product->getPrice * $amount;
        if (array_key_exists($product->getId(), $this->getProducts())) {
            $array = $this->products[$product->getId()];
            $array[0]=+ $amount;
            $array[1]=+ $valueOfProductX;
        }
        else {
        $this->products[$product->getId()] = [$amount, $valueOfProductX];
        }
        return $this;
    }
    
    public function removeProduct(OShop\Product $product) {
        if (array_key_exists($product->getId(), $this->getProducts())) {
            unset($this->products[$product->getId()]);
        }
        return $this;
    }
    
    public function __clone() {
        $this->ownerId = clone($this->ownerId);
        $this->products = clone($this->products);
        $this->totalValue = clone($this->totalValue);
    }
    
    public function createOrder() {
        $order = new Order($this->getOwnerId(), $creationDate, $status, $this->getProducts(), $this->getTotalValue());
        return $order;
    }
    
    function getId() {
        return $this->id;
    }

    function getOwnerId() {
        return $this->ownerId;
    }

    function getProducts() {
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

    function setProducts($products) {
        $this->products = $products;
    }

    function setTotalValue($totalValue) {
        $this->totalValue = $totalValue;
    }


}
