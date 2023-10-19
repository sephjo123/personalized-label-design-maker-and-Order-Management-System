<?php

@include 'config.php';
require_once 'functions.php';

if(!isset($_SESSION['admin_name'])){
header('location:login_form.php');
}

// Material Price Update //
if(isset($_POST['update_price']))
{
    $material_id = mysqli_real_escape_string($conn, $_POST['material_id']);
    $material = mysqli_real_escape_string($conn, $_POST['material_name']);
    $material_price = mysqli_real_escape_string($conn, $_POST['price']);
    $material_stock = mysqli_real_escape_string($conn, $_POST['stocks']);
    $availability =mysqli_real_escape_string($conn, $_POST['availability']);
    
    if (!is_numeric($material_price)) {
        echo "<script>alert('Invalid Price'); window.location.href='material-price.php';</script>";
        exit;
    }
// insert into  logs
        $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
        $action = mysqli_real_escape_string($conn, $_POST['action']);
        $action2 = mysqli_real_escape_string($conn, $_POST['action2']);
        $action3 = mysqli_real_escape_string($conn, $_POST['action3']);
        $action4 = mysqli_real_escape_string($conn, $_POST['action4']);

        $insert = "INSERT INTO logs (admin_name, action) VALUES('$admin_name', '$action $material $action2 $material_price $action3 $material_stock $action4 $availability')";
        $inserted = mysqli_query($conn, $insert);
//  end logs
    $query = "UPDATE item_materials SET  material='$material', price='$material_price', stock='$material_stock', availability='$availability'
    WHERE ID='$material_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo "<script>alert('Material has been updated!'); window.location.href='material-price.php';</script>";
        
    }else
    {
        $_SESSION['message'] = "Not Updated";
        header("Location:material-price-update.php");
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
        $material_id = mysqli_real_escape_string($conn, $_GET['id']);
        $query = "SELECT * FROM item_materials WHERE id='$material_id' ";
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
            $material = mysqli_fetch_array($query_run);
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
                                                Update Stocks
                                            </div>
                                    <div class="form">
                                            <form action="material-price-update.php" method="POST">
                                                <!-- for logs  -->
                                                <input type="hidden" value="<?php echo $_SESSION['admin_name']; ?>">
                                                <input type="hidden" value="<?php echo $_SESSION['email']; ?>" name="admin_name">
                                                <input type="hidden" value="Update the material of <?=  $material['material'] ?> into" name="action">
                                                <input type="hidden" value="with the price of" name="action2">
                                                <input type="hidden" value="with the stocks of" name="action3">
                                                <input type="hidden" value="and the availability into" name="action4">
                                                <!-- end for logs  -->
                                                <input type="hidden" name="material_id" value= "<?= $material['ID']; ?>">
                                                    <div class="inputfield">
                                                            <label>Material Name</label>                                               
                                                                <input type="text" name="material_name" value="<?=$material['material']; ?>" required class="input">                
                                                    </div>
                                                    <div class="inputfield">
                                                            <label>Price</label>
                                                                <input type="text" name="price" value="<?=$material['price']; ?>" required class="input">                          
                                                    </div>
                                                    <div class="inputfield">
                                                            <label>Stocks</label>
                                                                <input type="number" name="stocks" value="<?=$material['stock']; ?>" required class="input">                          
                                                    </div>
                                                    <div class="inputfield">
                                                        <label>Availability</label>
                                                        <div class="custom_select">
                                                        <select name="availability" scrollheight="120px" required>
                                                                <option value="available">Available</option>
                                                                <option value="not available">Not Available</option>
                                                                
                                                        </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="inputfield">
                                                            <input type="submit" name="update_price" value="Update Price" class="button-login">
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