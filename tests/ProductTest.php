<?php
namespace OShop\Test;

use OShop\Product;

class ProductTest extends \PHPUnit_Framework_TestCase {
	
	public function testCreateInstance() {
		$id = 5;
		$price = 9.99;
		$name = 'nazwa produktu';
		$description = 'jakiś krótki opis';
		$quantity = 20;
		$product = new Product($id, $price, $name, $description, $quantity); 
	}
}