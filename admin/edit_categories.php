<?php

include_once '../config/Database.php';
include_once './class/Category.php';
include_once './class/User.php';
$database = new Database();

$db = $database->getConnection();

$user = new User($db);

$category = new Category($db);

if(!$user->loggedIn() || !$user->isAdmin()) {
	header("location: index.php");
}

$category = new Category($db);

if(isset($_GET["id"])) {
	$category->id = $_GET["id"];	
    $curentCategory = $category->getCategory();
} 

if(isset($_POST["categoryName"])) {
	$category->name = $_POST["categoryName"];	
	$lastInserId = $category->update();
    header("Location: categories.php");
} 
include_once '../layout/admin/topbar.php';

?>
<section id="main">
    <div class="container">
        <div class="row">
            <?php include "../layout/admin/left_menus.php"; ?>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Category
                            <?= $curentCategory['name'] ?></h3>
                    </div>
                    <div class="panel-body">

                        <form method="post" id="postForm">
                            <div class="form-group">
                                <label for="title" class="control-label my-2">Category Name</label>
                                <input required type="text" class="form-control" id="categoryName" name="categoryName"
                                    value="<?= $curentCategory['name'] ?>" placeholder="Category name..">
                            </div>

                            <button type="submit" id="categorySave" class="btn btn-info my-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>