<?php
//namespace OShop;
require_once __DIR__ . '/../conn.php';
require_once __DIR__ . '/Order.php';
require_once __DIR__ . '/ProductInBasket.php';

class Basket {
    private $id;
    private $ownerId;
    private $products;
    private $totalValue;
    
    public function __construct($ownerId) {
        $this->id = strval($ownerId) . '_' . strval(time());
        $this->id = strval($ownerId). '_' .strval(date('Y-m-d_H:i', time()));
        $this->setOwnerId($ownerId);
        $this->products = [];
        $this->totalValue = 0;
    }
    
    public function addProduct(Product $product, $amount) {
        $valueOfProductX = $product->getPrice() * $amount;
        if (array_key_exists($product->getId(), $this->getProducts())) {
            $this->products[$product->getId()]->changeAmount($amount);
            $this->products[$product->getId()]->changeValue($valueOfProductX);
            $this->totalValue+=$valueOfProductX;
        }
        else {
            $this->products[$product->getId()] = new ProductInBasket($valueOfProductX, $product->getPrice(), $amount, clone $product);
            $this->totalValue+=$valueOfProductX;
        }
        $this->saveToSession();
        return $this;
    }
    
    public function removeProduct(Product $product, $amountToRemove = -1) {
        if (array_key_exists($product->getId(), $this->getProducts())) {
            if ($amountToRemove == -1) {
                $this->totalValue-=$this->products[$product->getId()]['value'];
                unset($this->products[$product->getId()]);            
            }
            elseif ($this->products[$product->getId()]->getAmount() <= $amountToRemove) {
                $this->totalValue-=$this->products[$product->getId()]->getValue();
                unset($this->products[$product->getId()]);
            }
            else {
                $valueToSubtract = $product->getPrice() * $amountToRemove;
                $this->totalValue-= $valueToSubtract;
                $this->products[$product->getId()]->changeAmount($amountToRemove);
                $this->products[$product->getId()]->changeValue($valueToSubtract);
            }

        }
        $this->saveToSession();
        return $this;
    }
    
//  WERSJA BEZ OBIEKTÓW W KOSZYKU 
//    public function addProduct(Product $product, $amount) {
//        $valueOfProductX = $product->getPrice() * $amount;
//        if (array_key_exists($product->getId(), $this->getProducts())) {
//            echo 't';
//            
//            $this->products[$product->getId()]['amount']+= $amount;
//            $this->products[$product->getId()]['value']+= $valueOfProductX;
//        }
//        else {
//            $this->products[$product->getId()] = ['amount' => $amount, 'value' => $valueOfProductX];
//            $this->totalValue+=$valueOfProductX;
//            $this->products[$product->getId()]['product'] = $product;
//        }
//        $this->saveToSession();
//        return $this;
//    }
//    
//    public function removeProduct(Product $product, $amountToRemove = -1) {
//        if (array_key_exists($product->getId(), $this->getProducts())) {
//            if ($amountToRemove == -1) {
//                $this->totalValue-=$this->products[$product->getId()]['value'];
//                unset($this->products[$product->getId()]);            
//            }
//            elseif ($this->products[$product->getId()]['amount'] <= $amountToRemove) {
//                $this->totalValue-=$this->products[$product->getId()]['value'];
//                unset($this->products[$product->getId()]);
//            }
//            else {
//                $valueToSubtract = $product->getPrice() * $amountToRemove;
//                $this->totalValue-= $valueToSubtract;
//                $this->products[$product->getId()]['amount']-=$amountToRemove;
//                $this->products[$product->getId()]['value']-= $valueToSubtract;
//            }
//
//        }
//        $this->saveToSession();
//        return $this;
//    }
    
    private function saveToSession() {
        $_SESSION['basket'] = $this;
    }
    
    public function createOrder() {
        $productsForOrder = [];
        foreach ($this->products as $k => $product) {
            $productsForOrder[$k] = clone $product;
        }
               
        $order = new Order($this->getOwnerId(), date('Y-m-d H:i:s', time()), 0, $productsForOrder, $this->getTotalValue());
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
