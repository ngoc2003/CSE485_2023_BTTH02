<?php

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
                                </span> Posts founded</h3>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>