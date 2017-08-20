<?php
require_once './../src/User.php';
require_once './../src/Admin.php';
require_once './../src/Product.php';
require_once './../src/Cart.php';
require_once './../src/Order.php';

require_once './../conn.php';

//$admin =  new Admin();
//$admin->setPassword('admin1');
//$admin->setEmail('admin1@abc.pl');
//$admin->setLogin('admin1');

$admin = Admin::loadAdminByLogin($conn, 'admin1');
var_dump($admin);