
<?php
include __DIR__ . '/header.php';
include __DIR__ . '/navibar.php';

if(isset($_SESSION['userId'])) {
	unset($_SESSION['userId']);
}
header("Location: login.php");

include __DIR__ . '/footer.php';
