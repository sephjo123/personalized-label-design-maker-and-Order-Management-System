<?php

@include 'config.php';
require_once 'functions.php';
if(!isset($_SESSION['admin_name'])){
    header('location:login_form.php');
    }


//--approve Order Status -- //
if(isset($_POST['claimed']))
{
$date = $_POST['date_claimed'];
$status = $_POST['status_claimed'];
$id = $_POST['id'];

   $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
   $action = mysqli_real_escape_string($conn, $_POST['action']);

   $insert = "INSERT INTO logs (admin_name, action) VALUES('$admin_name', '$action')";
   $inserted = mysqli_query($conn, $insert);

    $sql = "UPDATE order_form SET status='$status', date_act='$date' WHERE ID=$id;";
    $query_run = mysqli_query($conn, $sql);

    if($query_run){

        $_SESSION['message'] = "Order has been Claimed";
        header('location:to-claim.php');
        exit(0);
       
    }
    else{
        

        $_SESSION['message'] = "Status has not updated";
        header('location:to-claim.php');
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
   <title>To Claim</title>
   <link rel="stylesheet" href="../css/style.css">
   <link rel="icon" href="../images/bg/Chappy-Logo.png" type="image/x-icon">
   <style>
      body{
        
        padding: 0 10px;
        }

     .wrapper{
        max-width: 500px;
        width: 100%;
        background: rgb(0, 0, 0);
        margin-top: 2em;
        box-shadow: 0 0 15px rgb(112, 112, 112);
        padding: 30px;
        border-radius: 20px;
        }
     .wrapper .form{
        width: 99%;
        align-items: center;
        }

        .order-img{
        height: 200px;
        width: 200px;
        margin-right: 1.5rem;
        }

        .order-flex {
        overflow: hidden;
        }
        .order-flex .order-img{
        transition: var(--tran-0-2);
        }
        .order-flex:hover .order-img {
        transform: scale(1.2);
        }
        
       
   </style>
</head>
<body class="body1">
     <!-- Get Material Id -->
     <?php

if(isset($_GET['id']))
{
$or_id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT * FROM order_form WHERE ID='$or_id' ";
$query_run = mysqli_query($conn, $query);

if(mysqli_num_rows($query_run) > 0)
{
    $view_order = mysqli_fetch_array($query_run);
?>
<header class="header">    
            <nav class="nav container flex">   
                        
                        <div class="contact-content flex">
                            <!--<i class='bx bx-phone phone-icon' ></i>-->
                                <a class="button-logout" href="to-claim.php">Back</a>
                        </div>

                     
                </nav>
        
    </header>
   
      <div class="wrapper">
         
            <form action=""  method="post">
               <!-- for logs  -->
               <input type="hidden" value="<?php echo $_SESSION['admin_name']; ?>">
               <input type="hidden" value="<?php echo $_SESSION['email']; ?>" name="admin_name">
               <input type="hidden" value="Update the order <?=  $view_order['order_id'] ?> into to claimed by customer" name="action">
               <!-- end for logs  -->
                  <div class="title">
                     To Claim
                  </div>
                  <a href="../<?php echo $view_order['custom_image'] ?>" target="_blank" class="button-login">Preview</a>
                  <div class="form">
                    <div class="inputfield">
                        <label><a href="../<?php echo $view_order['custom_image'] ?>" download class="button-login">Download Image</a></label>
                        <p class="order-flex"><img src="../<?php echo $view_order['custom_image'] ?>" class="order-img" ></p>
                     </div>  
                     <div class="inputfield">
                        <label>Reference Number:</label>
                        <input type="text" value="<?= $view_order['ref_num']; ?>"  class="input">
                     </div>  
                     <div class="inputfield">
                        <label>Order Number:</label>
                        <input type="text" value="<?= $view_order['order_id']; ?>"   class="input">
                     </div>
                     <div class="inputfield">
                        <label>Payer Name:</label>
                        <input type="text" value="<?= $view_order['payer_name']; ?>" class="input">
                     </div>
                     <div class="inputfield">
                        <label>Email:</label>
                        <input type="text" value="<?= $view_order['email']; ?>"  class="input">
                     </div> 
                     <div class="inputfield">
                        <label>Mobile:</label>
                        <input type="text" value="<?= $view_order['mobile']; ?>"  class="input">
                     </div>    
                     <div class="inputfield">
                        <label>Shape</label>
                        <input type="text" value="<?= $view_order['shape']; ?>"  class="input">
                     </div>
                     <div class="inputfield">
                        <label>Size</label>
                        <input type="text" value="<?= $view_order['size']; ?>"  class="input">
                     </div>    
                     <div class="inputfield">
                        <label>Material</label>
                        <input type="text" value="<?= $view_order['material']; ?>"  class="input">
                     </div>
                     <div class="inputfield">
                        <label>Processing Days</label>
                        <input type="text" value="<?= $view_order['processing']; ?>"  class="input">
                     </div>
                     <div class="inputfield">
                        <label>Quantity</label>
                        <input type="text" value="<?= $view_order['qty']; ?>" class="input">
                     </div>
                     <div class="inputfield">
                        <label>Total Payment</label>
                        <input type="text" value="Php <?= number_format($view_order['payment_total_amount'],2) ?>"  class="input">
                     </div>
                     <div class="inputfield">
                        <label>Status</label>
                        <input type="text" value="<?= $view_order['status']; ?>" class="input">
                     </div>
                     <div class="inputfield">
                        <label>Date Ordered</label>
                        <input type="text" value="<?= date("M d, Y", strtotime($view_order['date_order'])) ?>"  class="input">
                     </div>
                     <div class="inputfield">
                        <label>Date to Claim</label>
                        <input type="text" value="<?= date("M d, Y", strtotime($view_order['date_act'])) ?>"  class="input">
                     </div>
                     
                     <div class="inputfield">
                        <?php
                            function getCurrentPHDateOrderClaimed() {
                              $ph_timezone = new DateTimeZone('Asia/Manila'); 
                              $current_date = new DateTime('now', $ph_timezone); 
                              return $current_date->format('Y-m-d H:i:s'); 
                            }
                            $current_date = getCurrentPHDateOrderClaimed();
                           ?>
                            <form action="view-approved-orders.php" method="post">
                                <input type="hidden" value="<?php echo $current_date; ?>" name="date_claimed">
                                <input type="hidden" value="<?php echo $view_order['ID'] ?>" name="id">
                                <input type="hidden" name="status_claimed" value="Claimed">
                                <input href="" type="submit" name="claimed" value="UPDATE STATUS INTO CLAIMED" class="button-login"></input>
                            </form>
                          
                        </div>
                        
                     
                     
                        <?php
                                }
                                else
                                {
                                    echo "<h4>No Such Id Found</h4>";
                                }
                                }
                            ?>   
                  </div>
            </form>   
      </div>	

</body>
</html>