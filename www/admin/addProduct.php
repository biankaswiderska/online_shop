<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['category'])) {
        $newProduct = new Product($_POST['price'], $_POST['name'], $_POST['description'], $_POST['date']);
        if ($newProduct->saveToDB($conn)) {
            $_SESSION['addProductMsg'] = 'Success!';
        }
        else {
            $_SESSION['addProductMsg'] = 'Fail!';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SESSION['addProductMsg'])) {
        if ($_SESSION['addProductMsg'] == 'Success!') {
            echo '<div class="alert alert-success alert-dismissable">'.$_SESSION['addProductMsg'].'</div>';
        }
        elseif ($_SESSION['addProductMsg'] == 'Fail!') {
            echo '<div class="alert alert-danger alert-dismissable">'.$_SESSION['addProductMsg'].'</div>';
        }
        unset($_SESSION['addProductMsg']);
    }
    $cats = Category::loadAllCategories($conn);
    echo '
<div class="col-md-4">
    <form role="form" method="POST" action="">
        <div class="form-group">
            <label for="Title">
                    Title
            </label>
            <input type="text" class="form-control" name="name" maxlength="100"/>
        </div>
        <div class="form-group">
            <label for="Description">
                    Description
            </label>
            <input type="text" class="form-control" name="description" maxlength="255"/>
        </div>
        <div class="form-group">
            <label for="Price">
                    Price
            </label>
            <input type="number" class="form-control" name="price" min="0" max="1000" step=".01"/>
        </div>
        <div class="form-group">
            <label for="Release date">
                    Release date
            </label>
            <input type="month" class="form-control" name="date" />
        </div>
        <div class="form-group">
            <label for="Category">
                   Category
            </label>
            <select name="category">';
            foreach ($cats as $category) {
                echo '<option value= "'.$category->getId().'">'.$category->getName().'</option>';
            }
            echo '
            </select>
        </div>
        <div class="form-group">
            <label for="Photos">
                    Photos
            </label>
            <input type="file" name="photos" />
            <p class="help-block">
                    Tips and tricks
            </p>
        </div>
        <div class="checkbox">
            <label>
                    <input type="checkbox" name="startAmount"/> Set amount to 0
            </label>
        </div> 
        <button type="submit" class="btn btn-default">
            Add product
        </button>
    </form>
</div>    

';
    
}

?>

<!--

<div class="col-md-4">
    <form role="form">
        <div class="form-group">
            <label for="Title">
                    Title
            </label>
            <input type="text" class="form-control" name="name" maxlength="100"/>
        </div>
        <div class="form-group">
            <label for="Description">
                    Description
            </label>
            <input type="text" class="form-control" name="description" maxlength="255"/>
        </div>
        <div class="form-group">
            <label for="Price">
                    Price
            </label>
            <input type="number" class="form-control" name="price" min="0" max="1000" step=".01"/>
        </div>
        <div class="form-group">
            <label for="Category">
                   Category
            </label>
            <select name="category">
                <option value=""></option>
            </select>
        </div>
        <div class="form-group">
            <label for="Photos">
                    Photos
            </label>
            <input type="file" name="photos" />
            <p class="help-block">
                    Tips and tricks
            </p>
        </div>
        <div class="checkbox">
            <label>
                    <input type="checkbox" name="startAmount"/> Set amount to 0
            </label>
        </div> 
        <button type="submit" class="btn btn-default">
            Add product
        </button>
    </form>
</div>