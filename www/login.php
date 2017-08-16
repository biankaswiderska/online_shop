<?php
include __DIR__ . '/header.php';
include __DIR__ . '/navibar.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (User::login($conn, $email, $password)) {
        header('Location: /index.php');
    }
    else {
        $_SESSION['LoginMsg'] = 'Logowanie nieudane';
    }        

}



?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
                    <button type="button" class="btn btn-default" onclick="location.href='./newUser.php';">I'm new here</button>
	</div>
		<div class="col-md-4">
                    <?php
                        if (isset($_SESSION['LoginMsg'])) {
                            echo '<div class="alert alert-danger alert-dismissable">'.$_SESSION['LoginMsg'].'</div>';
                            unset($_SESSION['LoginMsg']);
                        }
                    ?>
                        <form role="form" method="POST" action="./login.php">
				<div class="form-group">
					 
					<label for="email">
						Email address
					</label>
					<input type="email" class="form-control" name="email" />
				</div>
				<div class="form-group">
					 
					<label for="password">
						Password
					</label>
					<input type="password" class="form-control" name="password" />
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="cookieCheck"/> Remember me!
					</label>
				</div> 
                                <button type="submit" class="btn btn-default">
					Log in!
				</button>
                            
			</form>
		</div>
                    <div class="col-md-4">
                        <a href="./adminPanel.php">Administrator login</a>
		</div>
	</div>
</div>


<?php
include __DIR__ . '/footer.php';
