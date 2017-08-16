<?php
session_start();
include __DIR__ . "./../conn.php";
spl_autoload_register(function ($class_name) {
    include __DIR__ . './../src/' . $class_name . '.php';
});
var_dump($_POST);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordCheck'])) {
        if ($_POST['password'] != $_POST['passwordCheck']) {
            $_SESSION['registrationMsg'] = "Password discrepancy";
            header("Location: ./../www/newUser.php");
            die();
        }
        $newUser = new User();
        $newUser->setName($_POST['name']);
        $newUser->setSurname($_POST['surname']);
        $newUser->setEmail($_POST['email']);
        $newUser->setHashPass(password_hash($_POST['password'], PASSWORD_BCRYPT));
        $newUser->saveToDB($conn);
        if ($newUser) {
            header("Location: ./../www/userPanel.php");
            die();
        }
        else {
            $_SESSION['registrationMsg'] = "Fail";
            header("Location: ./../www/newUser.php");
            die();
        }
    }
    
    
}