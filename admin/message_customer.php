<?php

@include 'config.php';
require_once 'functions.php';

if(!isset($_SESSION['admin_name'])){
header('location:login_form.php');
}

// ORDER _ ID
if(isset($_GET['id']))
{
$customer_id = mysqli_real_escape_string($conn, $_GET['id']);
$label_or_id = mysqli_real_escape_string($conn, $_GET['order_id']);
$query = "SELECT * FROM order_form WHERE customer_id ='$customer_id' && ID = '$label_or_id' ";
$query_run = mysqli_query($conn, $query);

if(mysqli_num_rows($query_run) > 0)
{
    $order = mysqli_fetch_array($query_run);
    $order_back_id = $order['ID'];

// Material Price Update //
if(isset($_POST['sent']))
{
    $customer_id_message = mysqli_real_escape_string($conn, $_POST['customer_id']);
    $admin_message_to_customer = mysqli_real_escape_string($conn, $_POST['message_to_customer']);
    $from_admin = mysqli_real_escape_string($conn, $_POST['from']);
    $order_id = mysqli_real_escape_string($conn, $_POST['or_id']);

    
// insert into  logs
        $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
        $action = mysqli_real_escape_string($conn, $_POST['action']);


        $insert = "INSERT INTO logs (admin_name, action) VALUES('$admin_name', '$action $admin_message_to_customer')";
        $inserted = mysqli_query($conn, $insert);
//  end logs
    $query = "INSERT INTO message_list (from_admin, customer_id, message) VALUES('$from_admin', '$customer_id_message', '$admin_message_to_customer' )";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Your message has sent!";
        echo "<script>alert('Message has sent'); window.location.href='view-approved-orders.php?id=" .$order_back_id."';</script>";
        exit(0);
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


<?php

?>


    <!-- CUSTOMER_ID -->
    <?php

        if(isset($_GET['id']))
        {
        $customer_id = mysqli_real_escape_string($conn, $_GET['id']);
        $query = "SELECT * FROM order_form WHERE customer_id ='$customer_id' ";
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
            $customer = mysqli_fetch_array($query_run);
            $customer_ID = $customer['customer_id'];
        ?>
    
<!-- Header -->
    <header class="header">    
            <nav class="nav container flex">
                    
                        
                        <div class="contact-content flex">
                            <!--<i class='bx bx-phone phone-icon' ></i>-->
                                <a class="button-logout" href="view-approved-orders.php?id=<?php echo $order_back_id ?>">Back</a>
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
                                                
                                            </div>
                                           
                                            <div class="title">
                                            <?php 
                                                    include('message.php')
                                                ?> 
                                            </div>
                                    <div class="form">
                                            <form  method="POST">
                                                <!-- for logs  -->
                                                <input type="hidden" value="<?php echo $_SESSION['admin_name']; ?>">
                                                <input type="hidden" value="<?php echo $_SESSION['email']; ?>" name="admin_name">
                                                <input type="hidden" value="Has messaged <?=  $customer['email'] ?>" name="action">
                                                <!-- end for logs  -->
                                            

                                                <!-- MESSAGE CUSTOMER -->
                                                    <input type="hidden" name="from" value="<?php echo $_SESSION['admin_name']?>">
                                                    <input type="hidden" name="customer_id" value="<?php echo $customer_ID?>">
                                                    <input type="hidden" name="or_id" value="<?php echo $customer['order_id'] ?>">

                                                <!-- MESSAGE CUSTOMER -->

                                                    <div class="inputfield">
                                                            <label>To:</label>                                               
                                                                <input type="text" value="<?php echo $customer['payer_name'] ?>" required class="input">                
                                                    </div>
                                                    <div class="inputfield">
                                                            <label>Order number</label>
                                                                <input type="text" value="<?php echo $customer['order_id'] ?>" required class="input">                          
                                                    </div>
                                                    <div class="inputfield">
                                                            <label>Message</label>
                                                                <input type="text" name="message_to_customer" required class="input">                          
                                                    </div>

                                                    
                                                    <div class="inputfield">
                                                            <input type="submit" name="sent" value="Send" class="button-login">
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