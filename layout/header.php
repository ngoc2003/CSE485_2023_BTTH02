<?php
    include_once 'lib/auth.php';
    include_once 'lib/lib.php';
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div style="width: 100%">
            <a class="navbar-brand" href="index.php">MY DEMO CMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item btn btn-primary btn-sm">
                    <?php if (!$isLogged) { ?> <a class="nav-link text-white" href="login.php">Login</a>
                    <?php } else { ?> <a class="nav-link text-white" href="logout.php">Logout</a>
                    <?php }  ?>
                </li>
            </ul>
        </div>
    </div>
</nav>