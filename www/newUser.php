<?php
include __DIR__ . '/header.php';
include __DIR__ . '/navibar.php';
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
                    <form role="form" method="post" action="./../api/newUserAction.php">
                        <div class="form-group">
                                <label for="name">
                                        Name
                                </label>
                                <input type="text" class="form-control" name="name"/>
                        </div>
                        <div class="form-group">
                                <label for="surname">
                                        Surname
                                </label>
                                <input type="text" class="form-control" name="surname" />
                        </div>
                        <div class="form-group">
                                <label for="email">
                                        E-mail
                                </label>
                                <input type="email" class="form-control" name="email" />
                        </div>
                        <div class="form-group">
                                <label for="password">
                                        Password
                                </label>
                                <input type="password" class="form-control" name="password" />
                        </div>
                        <div class="form-group">
                                <label for="passwordcheck">
                                        Password check
                                </label>
                                <input type="password" class="form-control" name="passwordCheck" />
                        </div>

                        <button type="submit" class="btn btn-default">
                                Submit
                        </button>
			</form>
		</div>
		<div class="col-md-4">
		</div>
	</div>
</div>





<?php
include __DIR__ . '/footer.php';
