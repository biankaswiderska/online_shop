<?php
require_once './../src/User.php';
require_once './../src/Product.php';
require_once './../src/Cart.php';
require_once './../src/Order.php';

require_once './../conn.php';
//
//$product2 = new Product(5, 'Movie 1', 'Description movie 1', 4, 1);
//var_dump($product2);
//$basket = new Basket(1);
//echo 'dodaje 2';
//$basket->addProduct($product2, 2);
//var_dump($basket);
//echo 'dodaje 2';
//$basket->addProduct($product2, 2);
//var_dump($basket);
//echo 'odejmuje 1';
//$basket->removeProduct($product2, 1);
//var_dump($basket);
//echo 'robie zlecenie';
//$order = $basket->createOrder();
//var_dump($order->saveToDB($conn));
//var_dump($order);

$user = User::loadUserByEmail($conn, 'test5@abc.pl');
$password = 'a1';
var_dump($user);
var_dump($user->getHashPass());
var_dump(password_verify($password, $user->getHashPass()));
        if($user) {
            if(password_verify('a1', $user->getHashPass())) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }