<?php
include 'config.php';

session_start();
if(isset($_SESSION['admin_name'])){
    $admin_name = $_SESSION['email'];
    $action = "Has logged out of the system";

    $insert = "INSERT INTO logs (admin_name, action) VALUES('$admin_name', '$action')";
    $inserted = mysqli_query($conn, $insert);
}

session_unset();
session_destroy();

header('location:../login_form.php');
?>