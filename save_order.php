<?php
    global $conn;
    require_once ('functions.php');
    require_once('config.php');

    if(isset($_POST['test1']))
    {
    $payer_name = $_SESSION['user_name'];
    $user_id = $_SESSION['ID'];
    $shape = mysqli_real_escape_string($conn, $_POST['shape']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $material = mysqli_real_escape_string($conn,$_POST['material']);
    $processing_days = mysqli_real_escape_string($conn,$_POST['processing']);
    $qty = mysqli_real_escape_string($conn,$_POST['qty']);
    $total = mysqli_real_escape_string($conn,$_POST['totalamount']);

    $target_dir = "test_upload/";
    $target_file = $target_dir . basename($_FILES["custom_image_name"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   // echo $target_file;

    $uplaoadfiles = move_uploaded_file($_FILES["custom_image_name"]["tmp_name"], $target_file);
   // $file = addslashes(file_get_contents($_FILES["custom_image_name"]["tmp_name"]));

    $save_order = "INSERT INTO order_form (customer_id, payer_name, shape, size, material, processing, qty, payment_total_amount, custom_image) VALUES 
    ('$user_id', '$payer_name','$shape', '$size', '$material', '$processing_days', '$qty', ' $total', '$target_file')";

    $save_order_query = mysqli_query($conn, $save_order);

    if($save_order_query) {
        $_SESSION['message'] = "Ordered Successfully";
            header("Location:new-order.php");
            exit(0);
    }

    else {
        mysqli_error($conn);
    }
}  
?>