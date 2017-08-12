<?php

class ProductInCart {
    private $value;
    private $price;
    private $amount;
    private $product;
    
    function __construct($value, $price, $amount, Product $product) {
        $this->value = $value;
        $this->price = $price;
        $this->amount = $amount;
        $this->product = $product;
    }
    
    
    public function changeAmount($a) {
        $this->amount+=$a;
    } 
    
    public function changeValue($v) {
        $this->value+=$v;
    }
    
    function getValue() {
        return $this->value;
    }

    function getAmount() {
        return $this->amount;
    }

    function getProduct() {
        return $this->product;
    }

    function setValue($value) {
        $this->value = $value;
    }

    function setAmount($amount) {
        $this->amount = $amount;
    }

    function setProduct($product) {
        $this->product = $product;
    }
    function getPrice() {
        return $this->price;
    }

    function setPrice($price) {
        $this->price = $price;
    }

}
