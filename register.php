<?php
include_once 'config/Database.php';
include_once 'admin/class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (
    isset($_POST["email"]) &&
    isset($_POST["first_name"]) &&
    isset($_POST["last_name"]) &&
    isset($_POST["password"])
) {
    $user->first_name = $_POST["first_name"] ;
    $user->last_name = $_POST["last_name"];
    $user->email = $_POST["email"];
    $user->password = $_POST["password"];

    $lastInsertId = $user->register();

    if ($lastInsertId) {
        echo "<script>alert('Đăng ký thành công')</script>";
    } else {
        echo "<script>alert('Đăng ký thất bại')</script>";
    }
}
?>

<?php include "lib/lib.php" ?>
<?php include 'layout/header.php' ?>

<div class="d-flex align-items-center justify-content-center" style="height: 100vh">
    <form style="width:100%; max-width: 500px" method="POST">
        <h1 class="mb-2">Đăng ký CMS
            <span class="fw-lighter fs-4">- 63KTPM2</span>
        </h1>
        <div class="mb-3">
            <label for="first_name" class="form-label">Họ</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="last_name" name="last_name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="mb-2 text-right">
            <a href="login.php">Hoặc đăng nhập tại đây</a>
        </div>
        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
</div>