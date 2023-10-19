<?php

@include 'config.php';
@include 'paypal-function.php';

session_start();
if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}


global $conn;

// -- order ID -- //
function random_num()
{
    $prefix = 'ORD'; // set a prefix for your order ID
    $unique_id = uniqid();
    $random_num = rand(1000, 9999); // generate a random 4-digit number
    $order_id = $prefix . '-' . substr($unique_id, 0, 8) . '-' . $random_num;
    return $order_id;
}

//--- QUERY SIZE PRICE -- //

$size_id = $_POST['size_id'];
$size_sql = "SELECT * FROM item_size WHERE ID = '$size_id'"; 
$size_query = mysqli_query($conn, $size_sql);
$size_query_result = mysqli_fetch_array($size_query);
$size_price = $size_query_result['price'];
$size = $size_query_result['size'];


//--- QUERY SHAPE -- //
$shape_id = $_POST['shape_id'];
$shape_sql = "SELECT * FROM item_shape WHERE ID = '$shape_id'"; 
$shape_sql_query = mysqli_query($conn, $shape_sql);
$shape_query_result = mysqli_fetch_array($shape_sql_query);
$shape_price = $shape_query_result['price'];
$shape = $shape_query_result['shape']; 

if(mysqli_num_rows($shape_sql_query) == 0)
{
    header('location:index.php'); 
}

//--- QUERY MATERIAL -- //

$material_id = $_POST['material_id'];
$material_sql = "SELECT * FROM item_materials WHERE ID = '$material_id'"; 
$material_sql_query = mysqli_query($conn, $material_sql);
$material_query_result = mysqli_fetch_array($material_sql_query);
$material_price = $material_query_result['price'];
$material_stock = $material_query_result['stock'];
$material = $material_query_result['material'];



// QUANTITY  //
$qty = $_POST['qty'];
if($material_stock < $qty){
    echo "<script>alert('Sorry! the material you selected is not available or out of stock at this time!'); window.location.href='order-label.php';</script>";
    
}
  /*  $minus = $material_stock - $qty;
    $update = "UPDATE item_materials SET stock ='$minus' WHERE id = '$material_id'";
    $query_run = mysqli_query($conn, $update); */
//--- PROCESSING DAYS ---//
$qty = $_POST['qty'];
$process_days = $_POST['processing'];

//--- PRICE COMPUTATION ---//

$extra = '200';
switch ($process_days) {
  case "4 Business Days":
    $total = $qty * ($size_price + $material_price);
  break;

  case "2 Business Days":
    $totalamount = $qty * ($size_price + $material_price);
    $total = $totalamount + $extra; 
  break;
}


$user_id = $_SESSION['ID'];

$result = mysqli_query($conn, "SELECT * FROM user_form where ID = $user_id");
while($row = mysqli_fetch_array($result)){
$fname = $row['first_name'];
$lname = $row['last_name'];
$email = $row['email'];
$mobile = $row['mobile'];
$address = $row['address'];


}

// -- save order -- //
if(isset($_POST['test1']))
    {

    $user_id = $_SESSION['ID'];
    $payer_name = $_POST['payer_fname'];
    $payer_last_name = $_POST['payer_lname'];
    $mobile_num = $_POST['mobile'];
    $email = $_POST['email'];
    $shape = mysqli_real_escape_string($conn, $_POST['shape']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $material = mysqli_real_escape_string($conn,$_POST['material']);
    $processing_days = mysqli_real_escape_string($conn,$_POST['processing']);
    $qty = mysqli_real_escape_string($conn,$_POST['qty']);
    $total = mysqli_real_escape_string($conn,$_POST['totalamount']);
    $ref_num = mysqli_real_escape_string($conn,$_POST['ref_num']);

    $target_dir = "test_upload/";
    $target_file = $target_dir  . basename($_FILES["custom_image_name"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   // echo $target_file;

    $uplaoadfiles = move_uploaded_file($_FILES["custom_image_name"]["tmp_name"], $target_file);
   // $file = addslashes(file_get_contents($_FILES["custom_image_name"]["tmp_name"]));

    //-- Order ID -- //
    $order_id = random_num();

    $ref_num_query = "SELECT * FROM order_form WHERE ref_num = '$ref_num'"; 
    $ref_sql_query = mysqli_query($conn, $ref_num_query);
    $ref_query_result = mysqli_fetch_array($ref_sql_query);
    $ref_number = $ref_query_result['ref_num'];
    
    if ($ref_number == $ref_num) { // Use == for comparison, not =
    
        $_SESSION['message'] = "Warning! Invalid Reference number!";
        header("Location:error.php");
        exit(0);
    }

    //-- UPDATE - stocks -- //
    $material_id = $_POST['mid'];
    $quantity = $_POST['nqty'];
    $nstock = $_POST['nstock'];
    $minus = $nstock - $quantity;
    $update = "UPDATE item_materials SET stock ='$minus' WHERE id = '$material_id'";
    $update_stock_query = mysqli_query($conn,$update);

    //if($update_stock_query){

    
    $save_order = "INSERT INTO order_form (customer_id, ref_num, order_id, payer_name, email, mobile, shape, size, material, processing, qty, payment_total_amount, custom_image) VALUES 
    ('$user_id', '$ref_num', '$order_id', '$payer_name $payer_last_name', '$email', '$mobile_num', '$shape', '$size', '$material', '$processing_days', '$qty', ' $total', '$target_file')";

    $save_order_query = mysqli_query($conn,$save_order);

    if($save_order_query) {
        $_SESSION['message'] = "Ordered Successfully! <br> Please wait to Approve your order";
            header("Location:pending-order.php");
            exit(0);
    }

    else {
        header('location:checkout.php');
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
    <link rel="stylesheet" href="css/swiper-bundle.min.css">

    <!-- Scroll Reveal -->
    <link rel="stylesheet" href="css/scrollreveal.min.js">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="images/bg/Chappy-Logo.png" type="image/x-icon">
        
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        .form input[type="file"]{
            background-color: black;
            color: white;
            font-weight: 500;
            font-size: 18px;
            height: 55px;
            width: 100%;
            padding: 0 30px;
            border: 3px solid black;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 30px;
            }

        .form input[type="file"]:hover{
            background-color: var(--section-bg);
            }

        .computation{
            margin-top: 30px;
            margin-left: 50px;
           
            padding: 10px 30px 10px;
            background-color: black;
        }


     .wrapper2{
        max-width: 400px;
        width: 100%;
        margin-top: 2em;
        margin-left: 18em;

        }

       
     .wrapper2 .form{
        align-items: center;
        }
        .successmsg{
            margin-bottom: 10px;
            margin-left: 4em;
         }
                     /* Popup Calendar Styles */
        .calendar-popup {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .calendar-container {
            background-color: #2B2B2B;
            padding: 20px;
            border-radius: 4px;
        }

        .calendar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .calendar-header h2 {
            margin: 0;
        }

        .calendar-header .close {
            cursor: pointer;
        } 
        .img-qr{
            height: 300px;
            width: 300px;
            border-radius: 10%;
        }
        .designs{
            justify-content: center;
            align-items: center;
            display: flex;
        }
        .dp{
            height: 100px;
            width: 100px;
            border: solid white 5px;
            border-radius: 50%;
        }
        .qr-container{
            justify-content: center;
            align-items: center;
            display: flex;
        }
       
    </style>

</head>
<body>
      <!-- popup profile  -->
  <div id="calendarPopup" class="calendar-popup">
    <div class="calendar-container">
        <div class="calendar-header">
            
            <span class="close" onclick="hideCalendar()">&times;</span>
        </div>
        <div class="qr-container">
            <img src="images/Gcash/QR_Code1.png" alt="" class="img-qr">
        </div>
        <br>
        <div class="calendar-body">
            <form action="checkout.php" method="post" enctype="multipart/form-data">

                        <input type="hidden" value="<?php echo $material_id ?>" name="mid">
                        <input type="hidden" value="<?php echo $material_stock ?>" name="nstock">
                        <input type="hidden" value="<?php echo $qty ?>" name="nqty">
                        <input type="hidden" name="shape" id="shape" value="<?php echo $_SESSION['ID']  ?>">
                        <input type="hidden" name="payer_fname" value="<?= $fname ?>">
                        <input type="hidden" name="payer_lname" value="<?= $lname ?>">
                        <input type="hidden" name="mobile" value="<?= $mobile ?>">
                        <input type="hidden" name="email" value="<?= $email ?>">
                        <input type="hidden" name="shape" id="shape" value="<?php echo $shape ?>">
                        <input type="hidden" id="size" name="size" value="<?php echo $size ?>">
                        <input type="hidden" id="material" name="material" value="<?php echo $material ?>"> 
                        <input type="hidden" id="processing" name="processing" value="<?php echo $process_days ?>" >
                        <input type="hidden" id="qty" name="qty" value="<?php echo $qty ?>">
                        <input type="hidden" name="totalamount" id="totalamount" value="<?php echo $total ?>"/>

                <label>Amount to Pay: </label>                                              
                    <p>Php <?php echo " ".number_format($total,2)."" ?></p>
                <label>Reference Number</label>                                              
                    <input type="text"  name="ref_num" class="input" required/><br>
                <label>Upload Design</label> 
                
                    <input type="file" name="custom_image_name" id="custom_image_id"  class="input"  accept="image/*" required>
                    <button type="submit" name="test1" class="button-login">Submit</button>
            </form>
        </div>
    </div>
</div>
<!-- Header -->
    <header class="header">    
            <nav class="nav container flex">
                    <a href="#" class="logo-content flex">
                    
                    </a>

                   
                        
                        <div class="contact-content flex">
                            <!--<i class='bx bx-phone phone-icon' ></i>-->
                                <a class="button-logout" href="order-label.php">Cancel</a>
                        </div>

                        
                </nav>
        
    </header>

<!-- Home Section -->
    <main>

        <!-- Order Section -->
        <section class="section order" id="order">
                        <div class="review-text">
                                
                                <h2 class="section-title">Checkout</h2>
                                
                        </div>
                <div class="review-container container">
                <?php
                                    if(isset($error)){
                                       foreach($error as $error){
                                          echo '<span class="error-msg">'.$error.'</span>';
                                       };
                                    };
                                 ?>
               
                        <div class="wrapper">
                                
                                <div class="form">
                                        
                                        <input type="hidden" value="<?php echo $material_id ?>" name="mid">
                                        <input type="hidden" value="<?php echo $material_stock ?>" name="nstock">
                                        <input type="hidden" value="<?php echo $qty ?>" name="nqty">

                                        <input type="hidden" name="shape" id="shape" value="<?php echo $_SESSION['ID']  ?>">
                                                <div class="inputfield">
                                                        <label>Shape</label>
                                                        <input type="hidden" name="payer_fname" value="<?= $fname ?>">
                                                        <input type="hidden" name="payer_lname" value="<?= $lname ?>">
                                                        <input type="hidden" name="mobile" value="<?= $mobile ?>">
                                                        <input type="hidden" name="email" value="<?= $email ?>">
                                                       
                                                            <input type="hidden" name="shape" id="shape" value="<?php echo $shape ?>">
                                                            <input type="text" id="shape" value="<?php echo $shape ?>" class="input" />
                             
                                                        
                                                </div>
                                                <div class="inputfield">
                                                        <label>Size</label>
                                                            <input type="hidden" id="size" name="size" value="<?php echo $size ?>">
                                                            <input type="text" id="size_id" value="<?php echo $size ?>"  class="input"/>
                                                </div>
                                                <div class="inputfield">
                                                        <label>Material</label>
                                                            <input type="hidden" id="material" name="material" value="<?php echo $material ?>"> 
                                                            <input type="text" id="material_id" value="<?php echo $material ?>"  class="input"/>
                                                </div>
                                                <div class="inputfield">
                                                        <label>Process</label>
                                                            <input type="text" id="processing_id" value="<?php echo $process_days ?>"  class="input"/> 
                                                            <input type="hidden" id="processing" name="processing" value="<?php echo $process_days ?>" >
                                                </div>
                                                <div class="inputfield">
                                                        <label>Quantity</label>
                                                            <input type="text" id="qty_id" value="<?php echo $qty ?>" class="input"/> 
                                                            <input type="hidden" id="qty" name="qty" value="<?php echo $qty ?>">
                                                </div>
                                                <div class="inputfield">
                                                        <label>Total Price</label>
                                                            <input type="hidden" name="totalamount" id="totalamount" value="<?php echo $total ?>"/>
                                                            <input type="text" id="totalamount_id" value="Php <?php echo " ".number_format($total,2)."" ?>" class="input" />
                                                </div>
                                                <!-- <div class="inputfield">
                                                        <label>Reference Number</label>
                                                            
                                                            <input type="text"  name="ref_num" class="input" required/>
                                                </div>
                                                <div class="inputfield">
                                                        <label>Upload Your Design</label>
                                                        <input type="file" name="custom_image_name" id="custom_image_id"  class="input"  accept="image/*" required>
                                                            
                                                </div> -->
                                                <div class="inputfield">
                                                        <input type="submit" onclick="showCalendar()" class="button-login" value="Pay Here">
                                                        
                                                </div>     
                                             
                                </div> 
                               
                                 </div>
                        </div>	

                </div>
        </section>

</main>

<script>
    function showCalendar(requestId) {
        var calendarPopup = document.getElementById('calendarPopup');
        calendarPopup.style.display = 'flex';
        document.getElementById('requestId').value = requestId;
    }

    function hideCalendar() {
        var calendarPopup = document.getElementById('calendarPopup');
        calendarPopup.style.display = 'none';
    }

</script>
 


<!-- Swiper JS -->
<script src="js/swiper-bundle.min.js"></script>

<!-- Scroll Reveal -->
<script src="js/scrollreveal.js"></script>

<!-- JavaScript -->
    <script src="js/script.js"></script>
</body>


</html>

