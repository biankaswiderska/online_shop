<?php
include __DIR__ . '/header.php';
include __DIR__ . '/navibar.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $admin = Admin::login($conn, $login, $password);
    if ($admin) {
        $_SESSION['adminId'] = $admin->getId();
        $_SESSION['admin'] = serialize($admin);
        header('Location: adminPanel.php');
    }
    else {
        $_SESSION['LoginMsg'] = 'Login fail';
    }

}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
	</div>
		<div class="col-md-4">
                    <?php
                        if (isset($_SESSION['LoginMsg'])) {
                            echo '<div class="alert alert-danger alert-dismissable">'.$_SESSION['LoginMsg'].'</div>';
                            unset($_SESSION['LoginMsg']);
                        }
                    ?>
                    <h2>Admin login</h2>
                        <form role="form" method="POST" action="./loginAdmin.php">
				<div class="form-group">

					<label for="login">
						Login
					</label>
					<input type="text" class="form-control" name="login" />
				</div>
				<div class="form-group">

					<label for="password">
						Password
					</label>
					<input type="password" class="form-control" name="password" />
				</div>
                                <button type="submit" class="btn btn-default">
					Log in!
				</button>

			</form>
		</div>
                    <div class="col-md-4">
		</div>
	</div>
</div>


<?php
include __DIR__ . '/footer.php';
