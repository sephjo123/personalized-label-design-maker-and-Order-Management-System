<?php

@include 'config.php';
require_once 'functions.php';

if(!isset($_SESSION['admin_name'])){
header('location:../login_form.php');
}

if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') {
    echo "<script>alert('You're not able to disable this account'); window.location.href='index.php';</script>";
}



// Material Price Update //
if(isset($_POST['update_user']))
{
    
    $disadbled = mysqli_real_escape_string($conn, $_POST['availability']);
    $disadbled_user_id = mysqli_real_escape_string($conn, $_POST['user_disabled_id']);

// insert into  logs
        $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
        $action = mysqli_real_escape_string($conn, $_POST['action']);


        $insert = "INSERT INTO logs (admin_name, action) VALUES('$admin_name', '$action')";
        $inserted = mysqli_query($conn, $insert);
//  end logs
    $query = "UPDATE user_form SET  availability='$disadbled' WHERE ID='$disadbled_user_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo "<script>alert('Disabled Account!'); window.location.href='index.php';</script>";
        exit(0);
    
    }else{
    echo "<script>alert('Your're not able to disble this account'); window.location.href='index.php';</script>";
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
        .profile_pic{
            height: 200px;
            width: 200px;
            border: solid white 5px;
            border-radius: 50%;
            
         }
         .image-container{
            justify-content: center;
            align-items: center;
            display: flex;
         }
    </style>


</head>
<body>
    <!-- Get user Id -->
    <?php

        if(isset($_GET['id']))
        {
        $user_id = mysqli_real_escape_string($conn, $_GET['id']);
        $query = "SELECT * FROM user_form WHERE ID ='$user_id' ";
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
            $user = mysqli_fetch_array($query_run);
        ?>
    
<!-- Header -->
    <header class="header">    
            <nav class="nav container flex">
                    
                        
                        <div class="contact-content flex">
                            <!--<i class='bx bx-phone phone-icon' ></i>-->
                                <a class="button-logout" href="index.php">Back</a>
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
                                                User Details
                                            </div>
                                            <div class="image-container">
                                                <a onclick="showCalendar()"><img src="<?= $user['profile_pic']; ?>" alt="" class="profile_pic"></a> 
                                            </div>
                                    <div class="form">
                                            <form action="disable-account.php" method="POST">
                                                <!-- for logs  -->
                                                <input type="hidden" value="<?php echo $_SESSION['admin_name']; ?>">
                                                <input type="hidden" value="<?php echo $_SESSION['email']; ?>" name="admin_name">
                                                <input type="hidden" value="Update <?=  $user['email'] ?> into disabled" name="action">

                                                <!-- end for logs  -->
                                                <input type="hidden" name="material_id" value= "<?= $material['ID']; ?>">
                                                    <div class="inputfield">
                                                            <label>Name</label>   
                                                                <input type="hidden" name="user_disabled_id" value="<?=$user['ID']; ?>">                                            
                                                                <input type="text" value="<?=$user['first_name']; ?> <?=$user['last_name']; ?>" required class="input">                
                                                    </div>
                                                    <div class="inputfield">
                                                            <label>Email</label>
                                                                <input type="text" value="<?=$user['email']; ?>" required class="input">                          
                                                    </div>
                                                    <div class="inputfield">
                                                            <label>Address</label>
                                                                <input type="text" value="<?=$user['address']; ?>" required class="input">                          
                                                    </div>
                                                    <div class="inputfield">
                                                            <label>Mobile</label>
                                                                <input type="text" value="<?=$user['mobile']; ?>" required class="input">                          
                                                    </div>
                                                    <div class="inputfield">
                                                            <label>User type</label>
                                                                <input type="text" value="<?=$user['user_type']; ?>" required class="input">                          
                                                    </div>
                                                    
                                                    <input type="hidden" value="disabled" name="availability"  >
                                                    <div class="inputfield">
                                                        <?php
                                                                
                                                                if($_SESSION['user_type'] == 'super-admin'){
                                                                echo"
                                                                <input type='submit' name='update_user' value='Disable user' class='button-login'>
                                                                
                                                                ";
                                                                    }
                                                        ?>
                                                            
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