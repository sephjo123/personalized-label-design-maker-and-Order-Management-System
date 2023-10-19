<?php

@include 'config.php';
require_once 'functions.php';

if(!isset($_SESSION['admin_name'])){
header('location:login_form.php');
}

// Size Price Update //
if(isset($_POST['size-update_price']))
{
    $size_id = mysqli_real_escape_string($conn, $_POST['size_id']);
    $size = mysqli_real_escape_string($conn, $_POST['size_name']);
    $size_price = mysqli_real_escape_string($conn, $_POST['price']);
    
    
    if (!is_numeric($size_price)) {
        echo "<script>alert('Invalid Price'); window.location.href='material-price.php';</script>";
        exit;
    }
    // insert into  logs
    $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
    $action = mysqli_real_escape_string($conn, $_POST['action']);
    $action2 = mysqli_real_escape_string($conn, $_POST['action2']);

    $insert = "INSERT INTO logs (admin_name, action) VALUES('$admin_name', '$action $size $action2 $size_price')";
    $inserted = mysqli_query($conn, $insert);
//  end logs
    $query = "UPDATE item_size SET  size='$size', price='$size_price'
    WHERE ID='$size_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Updated Successfully";
        header("Location:material-price.php");
        exit(0);
    }else
    {
        $_SESSION['message'] = "Not Updated";
        header("Location:size-price-update.php");
        exit(0);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chappy Website</title>

    <!-- Swiper JS CSS-->
    <link rel="stylesheet" href="../css/swiper-bundle.min.css">

    <!-- Scroll Reveal -->
    <link rel="stylesheet" href="../css/scrollreveal.min.js">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="../images/bg/Chappy-Logo.png" type="image/x-icon">
        
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <!-- Get Material Id -->
    <?php
    if(isset($_GET['id']))
        {
           $size_id = mysqli_real_escape_string($conn, $_GET['id']);
           $query = "SELECT * FROM item_size WHERE id='$size_id' ";
           $query_run = mysqli_query($conn, $query);

           if(mysqli_num_rows($query_run) > 0)
           {
            $size = mysqli_fetch_array($query_run);

            
           ?>
    
<!-- Header -->
    <header class="header">    
            <nav class="nav container flex">
                    
                        
                        <div class="contact-content flex">
                            <!--<i class='bx bx-phone phone-icon' ></i>-->
                                <a class="button-logout" href="material-price.php">Back</a>
                        </div>

                        <i class='bx bx-menu navOpen-btn'></i>
                </nav>
        
    </header>

<!-- Home Section -->
    <main>
    <section class="section edit" id="edit">
        
            <div class="review-container container">
                     <div class="menu-content">
                                             <br>
                                            <br>
                                            <br>
                        <div class="wrapper">
                                            <div class="successmsg">    
                                                <?php 
                                                    include('message.php')
                                                ?>  
                                            </div>
                                           
                                            <div class="title">
                                                Update Size Price
                                            </div>
                                    <div class="form">
                                            <form action="size-price-update.php" method="POST">
                                                <!-- for logs  -->
                                                <input type="hidden" value="<?php echo $_SESSION['admin_name']; ?>">
                                                <input type="hidden" value="<?php echo $_SESSION['email']; ?>" name="admin_name">
                                                <input type="hidden" value="Update the size <?=  $size['size'] ?> into" name="action">
                                                <input type="hidden" value="and update the price into" name="action2">
                                                <!-- end for logs  -->
                                                <input type="hidden" name="size_id" value= "<?= $size['ID']; ?>">
                                                    <div class="inputfield">
                                                            <label>Size</label>                                             
                                                                <input type="text" name="size_name" value="<?=$size['size']; ?>" required class="input">                
                                                    </div>
                                                    <div class="inputfield">
                                                            <label>Price</label>
                                                                <input type="text" name="price" value="<?= $size['price']; ?>" required class="input">                          
                                                    </div>
                                                    
                                                    <div class="inputfield">
                                                            <input type="submit" name="size-update_price" value="Update Price" class="button-login">
                                                    </div>
                                            </form>  
                                            <?php
                                                    }
                                                    else
                                                    {
                                                        echo "<h4>No Such Id Found</h4>";
                                                    }
                                                    }
                                                ?>    
                                    </div>
                                </div> 
                    </div>
                </div>
        </section>
         
    




</main>

<!-- Swiper JS -->
<script src="../js/swiper-bundle.min.js"></script>

<!-- Scroll Reveal -->
<script src="../js/scrollreveal.js"></script>

<!-- JavaScript -->
    <script src="../js/script.js"></script>
</body>
</html>