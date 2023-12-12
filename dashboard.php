<?php
include_once 'layout/header.php';
include_once 'lib/auth.php';

if (!$isLogged || !$isAdmin) {
    header('Location: index.php');
}

include_once 'config/Database.php';
$conn = $database->getConnection();

if ($conn) {
    $sql_count_user = "SELECT COUNT(*) FROM cms_user";
    $sql_count_posts = "SELECT COUNT(*) FROM cms_posts";
    $sql_count_category = "SELECT COUNT(*) FROM cms_category";

    $result_count_user = $conn->query($sql_count_user)->fetch_assoc()['COUNT(*)'];
    $result_count_posts = $conn->query($sql_count_posts)->fetch_assoc()['COUNT(*)'];
    $result_count_category = $conn->query($sql_count_category)->fetch_assoc()['COUNT(*)'];
}
?>

<main class="container mt-5 mb-5">
    <div class="card mb-2" style="width: 100%;">
        <div class="card-body">
            <h5 class="card-title text-center">
                <a href="admin/users.php">
                    User</a>
            </h5>

            <h5 class="h1 text-center">
                <?= $result_count_user ?>
            </h5>
        </div>
    </div>

    <div class="card mb-2" style="width: 100%;">
        <div class="card-body">
            <h5 class="card-title text-center">
                <a href="admin/posts.php">
                    Post</a>
            </h5>

            <h5 class="h1 text-center">
                <?= $result_count_posts ?>
            </h5>
        </div>
    </div>

    <div class="card mb-2" style="width: 100%;">
        <div class="card-body">
            <h5 class="card-title text-center">
                <a href="admin/categories.php">
                    Category
                </a>
            </h5>

            <h5 class="h1 text-center">
                <?= $result_count_category ?>
            </h5>
        </div>
    </div>
</main>