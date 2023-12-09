<?php
session_start();
if(isset($_SESSION['userid'])){
    unset($_SESSION['userid']); //Huy 1 bien phien cu the

    //session_destroy(); Huy tat ca cac phien dang co
    header("location: index.php");
}
?>