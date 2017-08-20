<?php
include __DIR__ . '/header.php';
include __DIR__ . '/navibar.php';
if (!isset($_SESSION['adminId'])) {
    header('Location: index.php');
}
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
                        </button> 
                        <?php
                        if (isset($_GET['target'])) {
                            if ($_GET['target'] == 'orders') {
                                echo '<ul>
                                    <li><a href="?target=orders&action=showOrdersAll">Show all orders</a></li>
                                    <li><a href="?target=orders&action=findOrderById">Find order by ID</a></li>
                                    <li><a href="?target=orders&action=findOrderByUser">Find order by user</a></li>
                                    <li><a href="?target=orders&action=findOrderByStatus">Find order by status</a></li>
                                    </ul>';
                            }
                        }
                        ?>
                        </div>
                        <div><button type="button" class="btn btn-default" onclick="location.href='?target=users';">
				Users
                        </button> 
                        <?php
                        if (isset($_GET['target'])) {
                            if ($_GET['target'] == 'users') {
                                    echo '<ul>
                                        <li><a href="?target=users&action=showUsersAll">Show all users</a></li>
                                        <li><a href="?target=users&action=findUserById">Find user by ID</a></li>
                                        <li><a href="?target=users&action=findUserByEmail">Find user by email</a></li>
                                        </ul>';
                                }
                        }
                        ?>
                        </div>
                        <div><button type="button" class="btn btn-default" onclick="location.href='?target=categories';">
				Categories
                        </button> 
                        <?php
                        if ($_GET['target'] == 'categories') {
                            echo '<ul>
                                <li><a href="?target=categories&action=showCategoriesAll">Show all categories</a></li>
                                <li><a href="?target=categories&action=findCategoryById">Find category by ID</a></li>
                                <li><a href="?target=categories&action=addCategory">Add category</a></li>
                                </ul>';
                        }                       
                        ?>
                        </div>
                        <div><button type="button" class="btn btn-default" onclick="location.href='?target=products';">
				Products
                        </button>
                        <?php
                        if (isset($_GET['target'])) {
                            if ($_GET['target'] == 'products') {
                                echo '<ul>
                                    <li><a href="?target=products&action=showProductsAll">Show all products</a></li>
                                    <li><a href="?target=products&action=showProductsByCategory">Show products by category</a></li>
                                    <li><a href="?target=products&action=findProductById">Find products by ID</a></li>
                                    <li><a href="?target=products&action=addProduct">Add products</a></li>
                                </ul>';
                            }
                        }                        
                        ?>
                        </div>
		</div>
		<div class="col-md-8">
                    <div class="row"><h3>
				Workspace
                        </h3></div>
                    <div>
                    <?php
                        if (isset($_GET['action'])) {
                            if ($_GET['action'] == 'addProduct') {
                                include __DIR__ . '/admin/addProduct.php';
                            }
                            if ($_GET['action'] == 'showProductsAll') {
                                include __DIR__ . '/admin/showProductsAll.php';
                            }
                            if ($_GET['action'] == 'showCategoriesAll') {
                                include __DIR__ . '/admin/showCategoriesAll.php';
                            }
                            if ($_GET['action'] == 'showUsersAll') {
                                include __DIR__ . '/admin/showUsersAll.php';
                            }
                            if ($_GET['action'] == 'showOrdersAll') {
                                include __DIR__ . '/admin/showOrdersAll.php';
                            }
                        }
//                        if ($_SERVER['REQUEST_METHOD'] == "GET") {
//                            if (isset($_GET['target'])) {
//                                if ($_GET['target'] == 'orders') {
//                                    echo '<ul>
//                                        <li>Show all orders</li>
//                                        <li>Find order by ID</li>
//                                        <li>Find order by user</li>
//                                        <li>Find order by status</li>
//                                        </ul>';
//                                }
//                                elseif ($_GET['target'] == 'users') {
//                                    echo '<ul>
//                                        <li>Show all users</li>
//                                        <li>Find user by ID</li>
//                                        <li>Find user by email</li>
//                                        </ul>';
//                                }
//                                elseif ($_GET['target'] == 'categories') {
//                                    echo '<ul>
//                                        <li>Show all categories</li>
//                                        <li>Find category by ID</li>
//                                        <li>Add category</li>
//                                        </ul>';
//                                }
//                                elseif ($_GET['target'] == 'products') {
//                                    echo '<ul>
//                                        <li>Show all products</li>
//                                        <li>Show products by category</li>
//                                        <li>Find products by ID</li>
//                                        <li><a href="./admin/addProduct.php">Add products</li>
//                                    </ul>';
//                                }
//                            }
//                            else {
//                                echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed gravida quam. Fusce fermentum, augue eu viverra tincidunt, 
//                                    mi lectus ornare mauris, in semper nisi mauris ac enim. Morbi ac felis ornare nisl tempus tempus. Nam commodo enim quis elementum 
//                                    posuere. Ut ante quam, mollis at lacinia ac, facilisis eget justo. ';
//                            }
//                        }
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
