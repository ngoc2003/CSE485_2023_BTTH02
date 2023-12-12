<?php
include_once '../config/Database.php';
include_once './class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(!$user->loggedIn() || !$user->isAdmin()) {
	header("location: index.php");
}

$user = new User($db);

$userResults = $user->getUsersListing();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id']) ) {
    $user->id = $_REQUEST['delete_id'];
    $user->delete();
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
                                    <!-- <?= $total ?> -->
                                </span> Users founded</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3 class="panel-title"></h3>
                                    </div>
                                    <div class="col-md-2" align="right">
                                        <a href="add_users.php" class="btn btn-primary m-2 btn-xs">Add New</a>
                                    </div>
                                </div>
                            </div>
                            <table id="userList" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($userResults as $user) {
                                        ?>
                                    <tr>
                                        <th><?= $user['name'] ?></th>
                                        <th><?= $user['email'] ?></th>
                                        <th><?= $user['type'] ?></th>
                                        <th>
                                            <a href="edit_users.php?id=<?= $user['id'] ?>"
                                                class="btn btn-warning btn-sm">
                                                Edit
                                            </a>
                                        </th>
                                        <th>
                                            <form method="POST">
                                                <input type="hidden" name="delete_id" value="<?= $user['id'] ?>">
                                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                            </form>
                                        </th>
                                    </tr>
                                    <?php
                                    }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>