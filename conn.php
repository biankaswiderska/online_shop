<?php
include __DIR__ . ('/config.php');
$baseName = $config['db']['dbName'];
$host = $config['db']['host'];
$username = $config['db']['user'];
$password = $config['db']['password'];

try {
        $conn = new PDO("mysql:charset=utf8;host=$host;dbname=$baseName", 
                $username, 
                $password/*, 
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING ]*/);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            echo "Blad 1062";
        } 
        else {
                echo 'Wystąpił błąd przy połączeniu do bazy danych: ' . $e->getMessage();
        }
}