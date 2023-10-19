<?php

@include 'config.php';
require_once 'functions.php';


if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Details</title>
   <link rel="stylesheet" href="css/style.css">
   <link rel="icon" href="images/bg/Chappy-Logo.png" type="image/x-icon">
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
        .successmsg{
            margin-bottom: 10px;
            margin-left: 4em;
         }
       
   </style>
</head>
<header class="header">    
            <nav class="nav container flex">
                    <a href="#" class="logo-content flex">
                    <i class='phone-icon'><img src="images/bg/Chappy-Logo.png" alt="" ></i>                      
                        <span class="logo-text">Chappy</span>
                    </a>           
                        <div class="contact-content flex">
                    
                                <a class="button-logout" href="index.php">Back</a>
                        </div>

                        <i class='bx bx-menu navOpen-btn'></i>
                </nav>
        
    </header>
<body class="body1">

   
      <div class="wrapper">
               <div class="successmsg">    
                        <h2>
                           <?php 
                                 include('message.php')
                              ?> 
                        </h2> 
               </div>
         
            
                                <div class="title">
                                Order Form
                                </div>
                                <div class="form">
                                        <form  method="POST" action="checkout.php" enctype="multipart/form-data">
                                                <div class="inputfield">
                                                        <label>Shape</label>
                                                        <div class="custom_select">
                                                        <select class="select-box" name="shape_id" required>
                                                                <option value="1">Rectangle</option>
                                                                <option value="2">Circle</option>
                                                                <option value="3">Square</option>
                                                        </select>
                                                        </div>
                                                </div>
                                                <div class="inputfield">
                                                        <label>Size</label>
                                                        <div class="custom_select">
                                                        <select name="size_id" required>
                                                                <option value="1">1x1 inches</option>
                                                                <option value="2">2x2 inches</option>
                                                                <option value="3">3x3 inches</option>
                                                        </select>
                                                        </div>
                                                </div>
                                                <div class="inputfield">
                                                        <label>Material</label>
                                                        <div class="custom_select">
                                                        <select name="material_id" required>
                                                        <?php
                                                                                
                                                                $query = "SELECT * FROM item_materials WHERE availability = 'available'";
           
                                                                $result = mysqli_query($conn, $query);
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option value='" . $row['ID'] ."'> ".$row['material']."</option>";
                                                                }

                                                        
                                                                ?>
                                                                
                                                        </select>
                                                        </div>
                                                </div>
                                                <div class="inputfield">
                                                        <label>Process</label>
                                                        <div class="custom_select">
                                                        <select name="processing" id="processing" required>
                                                                <option  value="4 Business Days">4 Business Days</option>
                                                                <option  value="2 Business Days">2 Business Days add Php200</option>
                                                        </select>
                                                        </div>
                                                </div>
                                                <div class="inputfield">
                                                        <label>Quantity</label>
                                                        <div class="custom_select">
                                                        <select name="qty" scrollheight="120px" required>
                                                                <option value="50">50 Labels</option>
                                                                <option value="75">75 Labels</option>
                                                                <option value="100">100 Labels</option>
                                                                <option value="150">150 Labels</option>
                                                                <option value="250">250 Labels</option>
                                                                <option value="500">500 Labels</option>
                                                                <option value="750">750 Labels</option>
                                                                <option value="1000">1000 Labels</option>
                                                        </select>
                                                        </div>
                                                </div>
                                                <div class="inputfield">
                                                        <input type="submit" name="test" value="Checkout" class="button-login">
                                                </div>
                                        </form>      
                                </div> 
                               
                              
      </div>	

</body>
</html>