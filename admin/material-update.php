<?php

@include 'config.php';
require_once 'functions.php';

if(!isset($_SESSION['admin_name'])){
header('location:login_form.php');
}

// Update Stocks //
if(isset($_POST['update_stock']))
    {
        $material_id = mysqli_real_escape_string($conn, $_POST['material_id']);
        $brand_name = mysqli_real_escape_string($conn, $_POST['brand_name']);
        $qty = mysqli_real_escape_string($conn, $_POST['qty']);
        $date_added = mysqli_real_escape_string($conn, $_POST['date_added']);
        

        $query = "UPDATE materials SET  brand_name='$brand_name', qty='$qty', date_added= '$date_added' 
        WHERE id='$material_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            $_SESSION['message'] = "Updated Successfully";
            header("Location:add-stocks.php");
            exit(0);
        }else
        {
            $_SESSION['message'] = "Not Updated";
            header("Location:add-stocks.php");
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

    <style>
        .order-img {
            height: 100px;
            width: 100px;
        }

    </style>


</head>
<body>
    <!-- Get Material Id -->
        <?php

        if(isset($_GET['id']))
        {
        $material_id = mysqli_real_escape_string($conn, $_GET['id']);
        $query = "SELECT * FROM materials WHERE id='$material_id' ";
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
                                <a class="button-logout" href="add-stocks.php">Back</a>
                        </div>

                        <i class='bx bx-menu navOpen-btn'></i>
                </nav>
        
    </header>

<!-- Home Section -->
    <main>
    <section class="section edit" id="edit">
        
            <div class="review-container container">
                     <div class="menu-content">
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
                                    <?php
                                    function getCurrentPHDateAddedStock() {
                                                $ph_timezone = new DateTimeZone('Asia/Manila'); 
                                                $current_date = new DateTime('now', $ph_timezone); 
                                                return $current_date->format('Y-m-d H:i:s'); 
                                            }
                                            $current_date = getCurrentPHDateAddedStock();
                                     ?>
                                            <form action="material-update.php" method="POST">
                                            <input type="hidden" value="<?php echo $current_date; ?>" name="date_added">
                                                <input type="hidden" name="material_id" value= "<?= $material['id']; ?>">
                                                    <div class="inputfield">
                                                            <label>Brand Name</label>                                               
                                                                <input type="text" name="brand_name" value="<?=$material['brand_name']; ?>" required class="input">                
                                                    </div>
                                                    <div class="inputfield">
                                                            <label>Quantity</label>
                                                                <input type="number" name="qty" value="<?=$material['qty']; ?>" required class="input">                          
                                                    </div>
                                                    
                                                    <div class="inputfield">
                                                            <input type="submit" name="update_stock" value="Update Stocks" class="button-login">
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