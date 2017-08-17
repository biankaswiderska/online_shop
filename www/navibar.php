<div class="row">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>Services
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.php">Online shop</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Homepage</a>
                    </li>
                    <li>
                        <a href="./../www/userPanel.php">My profile</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <?php
                        if (isset($_SESSION['userId'])) {
                            echo '<li>
                                    <a href="./logout.php">Logout</a>
                                </li>';
                        }
                        elseif (isset($_SESSION['adminId'])){
                            echo '<li>
                                <a href="./adminPanel.php">Admin Panel</a>
                                </li><li>
                                    <a href="./logoutAdmin.php">You are logged as admin. Click to logout</a>
                                </li>';
                        }
                        else {
                            echo '<li>
                                    <a href="./login.php">Log in</a>
                                </li>';
                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    </div>