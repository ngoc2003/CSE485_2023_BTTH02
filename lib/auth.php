<?php
    include_once 'config/Database.php';
    include_once 'admin/class/User.php';

    $database = new Database();
    $cnn = $database->getConnection();

    $user = new User($cnn);
    $isLogged = $user->loggedIn();
    $isAdmin = $user->isAdmin()
?>