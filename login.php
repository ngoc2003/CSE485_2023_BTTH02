<?php
include_once 'config/Database.php';
include_once 'admin/class/User.php';
include_once 'lib/auth.php';

$database = new Database();

$db = $database->getConnection();

$user = new User($db);

if ($isLogged) {
    if ($isAdmin) {
        header("Location: dashboard.php");
    } else {
        header("Location: index.php");
    }
}

if(isset($_POST["email"]) && isset($_POST["password"])) {	
	$user->email = $_POST["email"];
	$user->password = $_POST["password"];
	if (!$user->login()) {
        echo "<script>alert('Có lỗi xảy ra!')</script>";
    };
}
?>

<?php include "lib/lib.php" ?>
<?php include 'layout/header.php' ?>

<div class="d-flex align-items-center justify-content-center" style="height: 100vh">
    <form style="width:100%; max-width: 500px" method="POST">
        <h1 class="mb-2">Đăng nhập CMS
            <span class="fw-lighter fs-4">- 63KTPM2</span>
        </h1>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" required class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" required class="form-control" name="password" id="password">
        </div>
        <div class="mb-2 text-right">
            <a href="register.php">Hoặc đăng ký tại đây</a>
        </div>
        <button type="submit" class="btn btn-primary">Đăng nhập</button>
    </form>
</div>