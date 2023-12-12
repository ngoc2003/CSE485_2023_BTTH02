<?php

include_once '../config/Database.php';
include_once './class/Category.php';
include_once './class/User.php';
$database = new Database();

$db = $database->getConnection();

$user = new User($db);

if(!$user->loggedIn() || !$user->isAdmin()) {
	header("location: index.php");
}

if(isset($_GET["id"])) {
	$user->id = $_GET["id"];	
    $curentUser = $user->getUser();
} 


if (
    isset($_POST["email"]) &&
    isset($_POST["first_name"]) &&
    isset($_POST["last_name"]) &&
    isset($_POST["type"])
) {
    $user->first_name = $_POST["first_name"] ;
    $user->last_name = $_POST["last_name"];
    $user->email = $_POST["email"];
    $user->type = $_POST["type"];

    $lastInsertId = $user->update();
	header('location: users.php');
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
                            <?= $curentUser['first_name']." ".$curentUser['last_name'] ?></h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" id="postForm">
                            <div class="form-group">
                                <label for="title" class="control-label my-2">First Name</label>
                                <input value="<?= $curentUser['first_name'] ?>" required type="text"
                                    class="form-control" id="first_name" name="first_name" placeholder="First name..">
                            </div>
                            <div class="form-group">
                                <label for="title" class="control-label my-2">Last Name</label>
                                <input value="<?= $curentUser['last_name'] ?>" required type="text" class="form-control"
                                    id="last_name" name="last_name" placeholder="Last name..">
                            </div>
                            <div class="form-group">
                                <label for="title" class="control-label my-2">Email</label>
                                <input value="<?= $curentUser['email'] ?>" required type="text" class="form-control"
                                    id="first_name" name="email" placeholder="email">
                            </div>

                            <div class="form-group">
                                <label for="title" class="control-label my-2">Type</label>
                                <select required class="form-select" name="type" id="">
                                    <option <?= $curentUser['type'] == 0 ? 'selected' : '' ?> value="0">Normal User
                                    </option>
                                    <option <?= $curentUser['type'] == 1 ? 'selected' : '' ?> value="1">Admin
                                    </option>
                                </select>

                            </div>

                            <button type="submit" id="userSave" class="btn btn-info my-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>