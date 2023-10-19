<?php

@include 'config.php';
@include 'paypal-function.php';

session_start();
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

    </style>

</head>
<body>
<!-- Header -->
    <header class="header">    
            <nav class="nav container flex">
                    <a href="#" class="logo-content flex">
                    <i class='phone-icon'><img src="images/bg/Chappy-Logo.png" alt="" ></i>                      
                        <span class="logo-text">Chappy</span>
                    </a>

                   
                        
                        <div class="contact-content flex">
                            <!--<i class='bx bx-phone phone-icon' ></i>-->
                                <a class="button-logout" href="checkout.php">Back</a>
                        </div>

                        
                </nav>
        
    </header>

<!-- Home Section -->
    <main>

        <!-- Order Section -->
        <section class="section order" id="order">
                        <div class="review-text">
                                
                                <h2 class="section-title">Scan Here</h2>
                                
                        </div>
                <div class="review-container container">
               
                        <div class="wrapper">
                                
                                <div class="form">
                                        <img src="images/qr/gcashqr.jpg" alt="">  
                                </div> 
                               
                                 </div>
                        </div>	

                </div>
        </section>

</main>
 


<!-- Swiper JS -->
<script src="js/swiper-bundle.min.js"></script>

<!-- Scroll Reveal -->
<script src="js/scrollreveal.js"></script>

<!-- JavaScript -->
    <script src="js/script.js"></script>
</body>


</html>

