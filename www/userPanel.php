<?php
include __DIR__ . '/header.php';
include __DIR__ . '/navibar.php';
//if (!isset($_SESSION['userId'])) {
//    header("Location: ./../www/newUser.php");
//    die();
//}

?>

    <!-- Page Content -->
    <div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
			<h3>
				User menu
			</h3> 
                        <div><button type="button" class="btn btn-default" onclick="location.href='?target=details';">
                                Account details
                        </button> </div>
                        <div><button type="button" class="btn btn-default" onclick="location.href='?target=orders';">
				Orders
                        </button> </div>
                        <div><button type="button" class="btn btn-default" onclick="location.href='?target=';">
				Lorem button
                        </button> </div>
		</div>
		<div class="col-md-10">
                    <div class="row"><h3>
				Workspace
                        </h3></div>
                    <div>
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == "GET") {
                            if (isset($_GET['target'])) {
                                if ($_GET['target'] == 'details') {
                                    echo '<ul>
                                        <li>Some details</li>
                                        <li>Other details</li>
                                        <li>Update</li>
                                        </ul>';
                                }
                                elseif ($_GET['target'] == 'orders') {
                                    echo '<ul>
                                        <li>Show all orders</li>
                                        <li>Show last order</li>
                                        <li>Find order by status</li>
                                        </ul>';
                                }

                            }
                            else {
                                echo 'Welcome to the best online movie shop!';
                            }
                        }
                        ?>
                </div>
		</div>
	</div>
</div>
</div>
    </div>
    <!-- /.container -->

<?php
include __DIR__ . '/footer.php';