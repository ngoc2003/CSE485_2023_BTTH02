<?php
    include_once 'layout/header.php';
    include_once 'lib/auth.php';
    if (!$isLogged || !$isAdmin) {
        header('Location: index.php');
    }
?>
<h1>
    This is dashboard
</h1>