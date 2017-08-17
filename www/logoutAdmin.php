
<?php
include __DIR__ . '/header.php';
include __DIR__ . '/navibar.php';

if(isset($_SESSION['adminId'])) {
	unset($_SESSION['adminId']);
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
}
header("Location: index.php");
