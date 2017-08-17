
<?php
include __DIR__ . '/header.php';
include __DIR__ . '/navibar.php';

if(isset($_SESSION['userId'])) {
	unset($_SESSION['userId']);
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
}
header("Location: index.php");

