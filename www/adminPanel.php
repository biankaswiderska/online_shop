<?php
include __DIR__ . '/header.php';
include __DIR__ . '/navibar.php';
?>

    <!-- Page Content -->
    <div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
			<h3>
				Admin menu
			</h3> 
                        <div><button type="button" class="btn btn-default" onclick="location.href='?target=orders';">
                                Orders
                        </button> </div>
                        <div><button type="button" class="btn btn-default" onclick="location.href='?target=users';">
				Users
                        </button> </div>
                        <div><button type="button" class="btn btn-default" onclick="location.href='?target=categories';">
				Categories
                        </button> </div>
                        <div><button type="button" class="btn btn-default" onclick="location.href='?target=products';">
				Products
                        </button></div>
		</div>
		<div class="col-md-10">
                    <div class="row"><h3>
				Workspace
                        </h3></div>
                    <div>
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == "GET") {
                            if (isset($_GET['target'])) {
                                if ($_GET['target'] == 'orders') {
                                    echo '<ul>
                                        <li>Show all orders</li>
                                        <li>Find order by ID</li>
                                        <li>Find order by user</li>
                                        <li>Find order by status</li>
                                        </ul>';
                                }
                                elseif ($_GET['target'] == 'users') {
                                    echo '<ul>
                                        <li>Show all users</li>
                                        <li>Find user by ID</li>
                                        <li>Find user by email</li>
                                        </ul>';
                                }
                                elseif ($_GET['target'] == 'categories') {
                                    echo '<ul>
                                        <li>Show all categories</li>
                                        <li>Find category by ID</li>
                                        </ul>';
                                }
                                elseif ($_GET['target'] == 'products') {
                                    echo '<ul>
                                        <li>Show all products</li>
                                        <li>Show products by category</li>
                                        <li>Find products by ID</li>
                                    </ul>';
                                }
                            }
                            else {
                                echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed gravida quam. Fusce fermentum, augue eu viverra tincidunt, 
                                    mi lectus ornare mauris, in semper nisi mauris ac enim. Morbi ac felis ornare nisl tempus tempus. Nam commodo enim quis elementum 
                                    posuere. Ut ante quam, mollis at lacinia ac, facilisis eget justo. ';
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

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
