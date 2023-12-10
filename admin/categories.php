<?php
include_once '../config/Database.php';
include_once './class/Category.php';
include_once './class/User.php';
$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$category = new Category($db);

$categoryResult = $category->getCategoryListing();
$total = $category->totalCategory();

if(!$user->loggedIn() || !$user->isAdmin()) {
	header("location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id']) ) {
    $category->id = $_REQUEST['delete_id'];
    $category->delete();
    header("Location: ".$_SERVER['PHP_SELF']);
}

include_once '../layout/admin/topbar.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
    <link href="./css/style.css" rel="stylesheet" type="text/css">

    <script src="./js/categories.js"></script>

</head>

<body>
    <section id="main">
        <div class="container">
            <div class="row">
                <?php include "../layout/admin/left_menus.php"; ?>
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading p-2 text-white" style="background-color:  #095f59;">
                            <h3 class=" panel-title">--<span>
                                    <?= $total ?>
                                </span> Categories founded</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3 class="panel-title"></h3>
                                    </div>
                                    <div class="col-md-2" align="right">
                                        <a href="add_categories.php" class="btn btn-primary btn-xs m-2">Add New</a>
                                    </div>
                                </div>
                            </div>
                            <table id="categoryList" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category</th>
                                        <th style="width: 50px"></th>
                                        <th style="width: 50px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($categoryResult as $cate) {
                                        ?>
                                    <tr>
                                        <th><?= $cate['id'] ?></th>
                                        <th><?= $cate['name'] ?></th>
                                        <th>
                                            <a href="edit_categories.php?id=<?= $cate['id'] ?>"
                                                class="btn btn-warning btn-sm">
                                                Edit
                                            </a>
                                        </th>
                                        <th>
                                            <form method="POST">
                                                <input type="hidden" name="delete_id" value="<?= $cate['id'] ?>">
                                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                            </form>
                                        </th>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<!-- <script src="./js/categories.js" /> -->

</html>