<?php
@include 'config.php';
if(isset($_POST['as_done'])) {
    $message_id = $_POST['message_id'];
    $mark_as_read = $_POST['mark_as_read'];

    $query = "UPDATE message_list SET un_read = '$mark_as_read' WHERE id = '$message_id'";
    $query_run =mysqli_query($conn, $query);

    if($query_run){
        header('Location: index.php');
    }
}