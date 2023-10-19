<?php

@include 'config.php';

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
        .successmsg{
            margin-left: 6em;
        }
        .close {
            background-color:var(--section-bg);
            padding: 2px 3px 2px;
        }

                .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4); /* Black background with opacity */
        }

        .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 300px; /* Adjust width as needed */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
        }

        .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        }

        .close:hover,
        .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
        }


        .popup {
                position: fixed;
                z-index: 9999;
                top: 20%;
                left: 25%;
                transform: translate(-50%, -50%);
                background-color: rgb(145, 16, 16);
                width: 300px;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
                font-family: Arial, sans-serif;
            }
            .popup-content {
                text-align: center;
            }
            .popup-close {
                margin-top: 10px;
                cursor: pointer;
                color: red;
       
            }
.icon {
	cursor: pointer;
	margin-right: 50px;
	line-height: 60px;
}
.icon span {
	background: #f00;
	padding: 7px;
	border-radius: 50%;
	color: #fff;
	vertical-align: top;
	margin-left: -25px;
}
.icon img {
	display: inline-block;
	width: 40px;
	margin-top: 10px;
        margin-left: 1010px;

}
.icon:hover {
	opacity: .7;
}

.logo {
	flex: 1;
	margin-left: 50px;
	color: #eee;
	font-size: 20px;
	font-family: monospace;
}

.notifi-box {
	width: 300px;
	height: 0px;
	opacity: 0;
	position: absolute;
	top: 63px;
	right: 35px;
	transition: 1s opacity, 250ms height;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.notifi-box h2 {
	font-size: 14px;
	padding: 10px;
	border-bottom: 1px solid #eee;
	color: #999;
}
.notifi-box h2 span {
	color: #f00;
}
.notifi-item {
	display: flex;
	border-bottom: 1px solid #eee;
	padding: 15px 5px;
	margin-bottom: 15px;
	cursor: pointer;
}
.notifi-item:hover {
	background-color: #eee;
}
.notifi-item img {
	display: block;
	width: 50px;
	margin-right: 10px;
	border-radius: 50%;
}
.notifi-item .text h4 {
	color: #777;
	font-size: 16px;
	margin-top: 10px;
}
.notifi-item .text p {
	color: #aaa;
	font-size: 12px;
}
.profile-icon{
        border-radius: 50%;
        border: solid white 2px;
}
.prof_image_message-list{
        height: 50px;
            width: 50px;
            border: solid white 5px;
            border-radius: 50%;
}

        </style>

</head>
<body>
        <!-- POPUP MESSAGE NOTIFY THE CUSTOMER -->
                <?php
                       
                
                        $user_id = $_SESSION['ID'];
                        $popup = $conn->query("SELECT * FROM `order_form` where customer_id = '$user_id' && status = 'To Claim' && un_read = '1' ")->num_rows;

                        if($popup > 0) {
                                $message = "Your order is ready to claim, Please Screen Shot your order details before you claim your order";
                                echo "
                                <form method='POST' action='to-claim-orders.php'>
                                <div class='popup'>
                                        <input type='hidden' name='mark_as_read' value='0'>
                                        <input type='hidden' name='user_id' value='$user_id'>

                                        <div = class'popup-content'>
                                                $message
                                        </div>

                                        <button type='submit' class='popup-close' name='read'>Okay </button>
                                </div>
                                </form>";
                        };
                // Popup show the orders that approved by admin 
                        

                        $user_id = $_SESSION['ID'];
                        $popup = $conn->query("SELECT * FROM `order_form` where customer_id = '$user_id' && status = 'Approved' && un_read = '1' ")->num_rows;

                        if($popup > 0) {
                                $message = "Your order has been approved! Press Ok to check your order";
                                echo "
                                <form method='POST' action='approved-order.php'>
                                <div class='popup'>
                                        <input type='hidden' name='mark_as_read_approve' value='0'>
                                        <input type='hidden' name='user_id' value='$user_id'>

                                        <div = class'popup-content'>
                                                $message
                                        </div>

                                        <button type='submit' class='popup-close' name='ok'>Okay </button>
                                </div>
                                </form>";
                        };

                        if(isset($_POST['clear'])){
                                $user_id = $_POST['user_id'];
                                $mark_as_read = $_POST['mark_as_read_approve'];

                                $select = "UPDATE order_form SET un_read = '$mark_as_read'  WHERE customer_id = '$user_id' && status = 'Cancelled by Admin'";
                                $query_run = mysqli_query($conn, $select);

                                if($query_run){
                                        header('location:cancelled-by-admin.php');
                                }
                        }

                        $user_id = $_SESSION['ID'];
                        $popup = $conn->query("SELECT * FROM `order_form` where customer_id = '$user_id' && status = 'Cancelled by Admin' && un_read = '1' ")->num_rows;

                        if($popup > 0) {
                                $message = "Your Order has been cancelled by admin! Sorry for the inconvineince. We will refund your payment.";
                                echo "
                                <form method='POST'>
                                <div class='popup'>
                                        <input type='hidden' name='mark_as_read_approve' value='0'>
                                        <input type='hidden' name='user_id' value='$user_id'>

                                        <div = class'popup-content'>
                                                $message
                                        </div>

                                        <button type='submit' class='popup-close' name='clear'>Okay </button>
                                </div>
                                </form>";
                        };
                        ?> 
<?php
        $user_id = $_SESSION['ID'];
        $result = mysqli_query($conn, "SELECT * FROM user_form where ID = $user_id");
                while($row = mysqli_fetch_array($result)){
                        $fname = $row['first_name'];
                        $lname = $row['last_name'];
                        $email = $row['email'];
                        $mobile = $row['mobile'];
                        $address = $row['address'];
                        $id = $row['ID'];
                        $user_identifier = $row['id_user'];
                        $profile = $row['profile_pic'];
        }
?>
<!-- Header -->
    <header class="header">    
            <nav class="nav container flex">
                <a href="profile.php" class="logo-content flex">
                    <i class='phone-icon'><img src="admin/<?php echo $profile ?>" class="profile-icon" alt="" ></i>                      
                        <span class="logo-text"><?php echo $fname ?></span>
                    </a>
                    <?php
                $popup = $conn->query("SELECT * FROM `message_list` WHERE customer_id = '$user_id' && un_read = '0' ORDER BY date_messaged DESC ")->num_rows;
                ?>
                    <div class="menu-content">
                            <ul class="menu-list flex">
                                    <li><a href="profile.php" class="nav-link">Profile</a></li>
                                    <li>
                                    <span class="num_notif"><?= number_format($popup) ?></span><a class="nav-link" onclick="toggleNotifi()">Notif</a></li>
                                    <li><a href="#labelprice" class="nav-link">Price</a></li>
                                    <li><a href="order-label.php" class="nav-link">Label</a></li>
                                    <li><a href="pending-order.php" class="nav-link ">Orders</a></li>
                                    <li><a href="#menu" class="nav-link">Designs</a></li>                                   
                                    <li><a href="label-design-maker.php" class="nav-link">Edit Design</a></li>
                                    <li><a href="#about" class="nav-link">about</a></li>
                                    
                            </ul>

                            <div class="media-icons flex">
                                    <a href="https://www.facebook.com/profile.php?id=100009150553521"><i class='bx bxl-facebook'></i></a>
                            </div>

                            <i class='bx bx-x navClose-btn'></i>
                        </div>
                        
                        <div class="contact-content flex">
                            <!--<i class='bx bx-phone phone-icon' ></i>-->
                                <a class="button-logout" href="logout.php">Log out</a>
                        </div>
                        

                        <i class='bx bx-menu navOpen-btn'></i>
                </nav>
              
                        <div class="notifi-box" id="box">
			<h2>Notifications <span><?= number_format($popup) ?></span></h2>
			
                <?php

                        

                        $user_id = $_SESSION['ID'];                                     
                        $query = "SELECT * FROM message_list WHERE customer_id = '$user_id' && un_read = '0' ORDER BY date_messaged DESC";

                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        echo "
                        <div class='notifi-item'>
                        <img src='images/bg/Chappy-Logo.png' alt='img'>
				<div class='text'>";
				  echo" <h4 '" . $row['id'] ."'>".$row['from_admin']."</h4>";
				 echo"  <p '" . $row['id'] ."'>".$row['message']." ".$row['admin_reply']."</p>
                                   <p '" . $row['id'] ."'>".date("M d, Y H:i:s", strtotime($row['date_messaged']))."</p>
			    </div>
                            
		        </div>
                        
                ";
                echo"
                <form method='post' action='clear.php'>
                <input type='hidden' value='" . $row['id'] ."' name='message_id'>
                <input type='hidden' value='1' name='mark_as_read'>

                                <button type='submit' name='as_done' class='button-logout'>Clear</button>
                            </from> ";
                        }
                ?>
                </div>
    
    </header>

<!-- Home Section -->
    <main>
        <section class="home" id="home">
                <div class="home-content">
                        <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                                <img src="images/bg/A.jpg" alt="" class="home-img">

                                                <div class="home-details">
                                                        <div class="home-text">
                                                                <div class="successmsg"> 
                                                                
                                                                        <h2><?php 
                                                                                include('message.php')
                                                                        ?> </h2> 
                                                                </div>
                                                                
                                                                <h4 class="homeSubtitle">We really like what we do.</h4>
                                                                <h2 class="homeTitle">Get your customized <br> labels made fast and easy</h2>
                                                        </div>

                                                        
                                                </div>
                                        </div>

                                        <div class="swiper-slide" id="">
                                                <img src="images/bg/C.jpg" alt="" class="home-img">

                                                <div class="home-details">
                                                        <div class="home-text">
                                                                
                                                                <h4 class="homeSubtitle">We really like what we do.</h4>
                                                                <h2 class="homeTitle">Print custom labels that last. <br> Minimum of 50 Labels</h2>
                                                        </div>

                                                        
                                                </div>
                                        </div>

                                        <div class="swiper-slide">
                                                <img src="images/bg/D.jpg" alt="" class="home-img">

                                                <div class="home-details">
                                                        <div class="home-text">
                                                                <h4 class="homeSubtitle">We really like what we do.</h4>
                                                                <h2 class="homeTitle">Print on waterproof,<br> weatherproof white vinyl sticker paper</h2>
                                                        </div>

                                                        
                                                </div>
                                        </div>
                                </div>

                                <div class="swiper-button-next swiper-navBtn"></div>
                                <div class="swiper-button-prev swiper-navBtn"></div>
                                <div class="swiper-pagination"></div>
                        </div>
                </div>
        </section>
         <!-- Order Price Section -->
         <section class="section menu" id="labelprice">
            <div class="menu-container container">
                    <div class="menu-text">
                            
                            <h2 class="section-title">Configured Label Price</h2>
                         
                    </div>

                    <div class="menu-content">
                            <div class="menu-items">
                            <div class="time-table">
                                    <span class="time-topic">Material & Size Price</span>

                                    <ul class="time-lists">

                                
                                        <?php
                                                                
                                                $query = "SELECT * FROM item_materials";

                                                $result = mysqli_query($conn, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                echo "
                                                <li class='time-list flex'>
                                                <span class='open-day' '" . $row['ID'] ."'> ".$row['material']."</span>";
                                                echo "<span class='open-time' '" . $row['ID'] ."'>Php ".number_format($row['price'],2)." each</span>
                                                </li>";
                                                }
                                
                                                ?>           
                                        
                                    </ul>
                            </div>
                            </div>
                            <div class="time-table">
                                    <span class="time-topic">Material & Size Price</span>

                                    <ul class="time-lists">
                                    <?php
                                                                                
                                        $query = "SELECT * FROM item_size";

                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        echo "
                                        <li class='time-list flex'>
                                        <span class='open-day' '" . $row['ID'] ."'> ".$row['size']."</span>";
                                        echo "<span class='open-time' '" . $row['ID'] ."'>Php ".number_format($row['price'],2)." each</span>
                                        </li>";
                                        }

                        
                                        ?>
                                    </ul>
                            </div>
                    </div>
            </div>
        </section>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
        <!-- Menu Section -->
        <section class="section menu" id="menu">
       
            <div class="menu-container container">
                    <div class="menu-text">
                            <h2 class="section-title">Our Sample Design</h2>
                    </div>

                    <div class="menu-content">
                            <div class="menu-items">
                                    <div class="menu-item flex">
                                            <img src="images/Labels/label1.png" alt="" class="menu-img">

                                            <div class="menuItem-details">
                                                    <h4 class="menuItem-topic">Sweet Bake</h4>
                                                    <p class="menuItem-des">A circle-shaped item with a size of 1x1 inch, made
                                                        from satin sticker material.
                                                    </p>
                                            </div>
                                            
                                    </div>
                                    <div class="menu-item flex">
                                            <img src="images/Labels/label2.png" alt="" class="menu-img">

                                            <div class="menuItem-details">
                                                    <h4 class="menuItem-topic">Coffee Lover</h4>
                                                    <p class="menuItem-des">A circle-shaped item with a size of 2x2 inches, made from non-laminated
                                                        clear vinyl sticker material.
                                                    </p>
                                            </div>

                                            
                                    </div>
                                    <div class="menu-item flex">
                                            <img src="images/Labels/label3.png" alt="" class="menu-img">

                                            <div class="menuItem-details">
                                                    <h4 class="menuItem-topic">Ice Cream</h4>
                                                    <p class="menuItem-des">A circle-shaped item with a size of 2x2 inches, made from
                                                        non-laminated white vinyl sticker material.
                                                    </p>
                                            </div>

                                           
                                    </div>
                                    <div class="menu-item flex">
                                            <img src="images/Labels/label4.png" alt="" class="menu-img">

                                            <div class="menuItem-details">
                                                    <h4 class="menuItem-topic">Beautiful</h4>
                                                    <p class="menuItem-des">A circle-shaped item with a size of 3x3 inches, made from
                                                        white vinyl sticker material without lamination.
                                                    </p>
                                            </div>

                                    </div>
                            </div>








                            <div class="time-table">
                                    <span class="time-topic">Time Categories</span>

                                    <ul class="time-lists">
                                            <li class="time-list flex">
                                                    <span class="open-day"> Sunday</span>
                                                    <span class="open-time">Closed</span>
                                            </li>
                                            <li class="time-list flex">
                                                    <span class="open-day"> Monday</span>
                                                    <span class="open-time">8.00am - 5.00pm</span>
                                            </li>
                                            <li class="time-list flex">
                                                    <span class="open-day"> Tuesday</span>
                                                    <span class="open-time">8.00am - 5.00pm</span>
                                            </li>
                                            <li class="time-list flex">
                                                    <span class="open-day"> Wednesday</span>
                                                    <span class="open-time">8.00am - 5.00pm</span>
                                            </li>
                                            <li class="time-list flex">
                                                    <span class="open-day"> Thursday</span>
                                                    <span class="open-time">8.00am - 5.00pm</span>
                                            </li>
                                            <li class="time-list flex">
                                                    <span class="open-day"> Friday</span>
                                                    <span class="open-time">8.00am - 5.00pm</span>
                                            </li>
                                            <li class="time-list flex">
                                                    <span class="open-day"> Saturday</span>
                                                    <span class="open-time">8.00am - 5.00pm</span>
                                            </li>
                                    </ul>
                            </div>
                    </div>
            </div>
       
        </section>

       
    


    
<!-- Brand Section -->
        <section class="section brand">
            <div class="brand-container container">
                    <h4 class="section-subtitle"><i>Our Trusted Brand</i></h4>

                    <div class="brand-images">
                            <div class="brand-image">
                                    <img src="images/Brands/brandImg1.png" alt="" class="brand-img">
                            </div>
                            <div class="brand-image">
                                    <img src="images/Brands/brandImg2.png" alt="" class="brand-img">
                            </div>
                            <div class="brand-image">
                                    <img src="images/Brands/brandImg3.png" alt="" class="brand-img">
                            </div>
                            <div class="brand-image">
                                    <img src="images/Brands/brandImg4.png" alt="" class="brand-img">
                            </div>
                            <div class="brand-image">
                                    <img src="images/Brands/brandImg5.png" alt="" class="brand-img">
                            </div>
                    </div>
            </div>
        </section>

    
<!-- about Section -->
        <section class="section review" id="about">
        <div class="about-content container">
                        <div class="about-imageContent">
                                <img src="images/bg/1.jpg" alt="" class="about-img">

                                <div class="aboutImg-textBox">
                                        
                                        <p class="content-description">I really love the Design.</p>
                                </div>
                        </div>

                        <div class="about-details">
                                <div class="about-text">
                                        <h4 class="content-subtitle"><i>Our Printing Shop</i></h4>
                                        <h2 class="content-title">Hello, we're <br> Chappy Printing</h2>
                                        <p class="content-description">We are available to you. We are a dedicated group of motivated people who are prepared to meet your labeling needs. We have the technology to offer you industry-leading quality and service for everything from small quantities of blank or printed labels to big, commercial runs of labels for your products.</p>

                                        <ul class="about-lists flex">
                                                <li class="about-list">White Vinyl Sticker</li>
                                                <li class="about-list dot">.</li>
                                                <li class="about-list">Satin Sticker</li>
                                                <li class="about-list dot">.</li>
                                                <li class="about-list">Clear Vinyl Sticker</li>
                                                
                                        </ul>
                                </div>

                                
                        </div>

                </div>
                <br>
                <div class="about-content container">
                        <div class="about-imageContent">
                                <img src="images/bg/2.jpg" alt="" class="about-img" border-radius="20px">

                                
                        </div>

                        <div class="about-details">
                                <div class="about-text">
                                        <h4 class="content-subtitle"><i>Our team</i></h4>
                                        <h2 class="content-title">Hello, we're <br> Chappy Printing</h2>
                                        <p class="content-description">We are a team of diligent individuals. We come from many racial and cultural backgrounds. We are happy to provide you with the best level of service attainable because we are dedicated to quality and perfection at every turn.</p>

                                       
                                </div>

                               
                        </div>

                </div>
                <br>
                <br>
        <div class="review-container container">
                    <div class="review-text">
                            <h4 class="section-subtitle"><i>Our Team</i></h4>
                            
                            <p class="section-description">We are a team of diligent individuals. We come from many racial and cultural backgrounds. We are happy to provide you with the best level of service attainable because we are dedicated to quality and perfection at every turn.</p>
                    </div>

                    <div class="tesitmonial swiper mySwiper">
                            <div class="swiper-wrapper">
                                    <div class="testi-content swiper-slide flex">
                                            <img src="images/Developers/Dev. Joseph.jpg" alt="" class="review-img">
                                            
                                            <i class='bx bxs-quote-alt-left quote-icon'></i>

                                            <div class="testi-personDetails flex">
                                                    <span class="name">Mark Joseph Lebaquin</span>
                                                    <span class="job">Web Developer</span>
                                            </div>
                                    </div>
                                    <div class="testi-content swiper-slide flex">
                                            <img src="images/Developers/Dev. Jomarie.jpg" alt="" class="review-img">
                                            
                                            <i class='bx bxs-quote-alt-left quote-icon'></i>

                                            <div class="testi-personDetails flex">
                                                    <span class="name">Jomarie Atadero</span>
                                                    <span class="job">Web Developer</span>
                                            </div>
                                    </div>
                                    <div class="testi-content swiper-slide flex">
                                            <img src="images/Developers/Dev. Bill.jpg" alt="" class="review-img">
                                            
                                            <i class='bx bxs-quote-alt-left quote-icon'></i>

                                            <div class="testi-personDetails flex">
                                                    <span class="name">Jason Bill Mercado</span>
                                                    <span class="job">Web Developer</span>
                                            </div>
                                    </div>
                                    <div class="testi-content swiper-slide flex">
                                            <img src="images/Developers/Dev. Shane.jpg" alt="" class="review-img">
                                            
                                            <i class='bx bxs-quote-alt-left quote-icon'></i>

                                            <div class="testi-personDetails flex">
                                                    <span class="name">Shane Steven Trinidad</span>
                                                    <span class="job">Web Developer</span>
                                            </div>
                                    </div>
                                    <div class="testi-content swiper-slide flex">
                                            <img src="images/Developers/Dev. Jhayc.jpg" alt="" class="review-img">
                                            
                                            <i class='bx bxs-quote-alt-left quote-icon'></i>

                                            <div class="testi-personDetails flex">
                                                    <span class="name">John Marcel Satombo</span>
                                                    <span class="job">Web Developer</span>
                                            </div>
                                    </div>
                                    
                                </div>
                                <div class="swiper-button-next swiper-navBtn"></div>
                                <div class="swiper-button-prev swiper-navBtn"></div>
                                <div class="swiper-pagination"></div>
                    </div>
                 </div>
            </div>
        </section>

    
<!-- Newsletter Section -->
        <section class="section newsletter">
            <div class="newletter-container container">
                        <a href="#" class="logo-content flex">
                                <i class='phone-icon'><img src="images/bg/Chappy-Logo.png" alt="" ></i>
                                <span class="logo-text">Chappy</span>
                        </a>

                    <p class="section-description">Design labels from scratch on our website, or upload your own ready-made design.</p>


                    <div class="newsletter media-icons flex">
                        <a href="https://www.facebook.com/profile.php?id=100009150553521"><i class='bx bxl-facebook'></i></a>
                </div>
            </div>
        </section>
        
<!-- Footer Section -->
        <footer class="section footer">
            <div class="footer-container container">
                    <div class="footer-content">
                        <a href="#" class="logo-content flex">
                                <i class='phone-icon'><img src="images/bg/Chappy-Logo.png" alt="" ></i>
                                <span class="logo-text">Chappy</span>
                            </a>

                            <p class="content-description">The standard sizes that we offer are all listed on our website, if you have any questions about a specific size please give us a call or contact us.</p>

                            <div class="footer-location flex">
                                <i class='bx bx-map map-icon'></i>
                                
                                <div class="location-text">
                                28 L Wood Street Taytay, Rizal
                                </div>
                            </div>
                    </div>

                    <div class="footer-linkContent">
                            
                    </div>
            </div>
            <div class="footer-copyRight">Chappy Printing</div>
        </footer>

<!-- Scroll Up -->
        <a href="#home" class="scrollUp-btn flex">
                <i class='bx bx-up-arrow-alt scrollUp-icon'></i>
        </a>

</main>


<!-- Swiper JS -->
<script src="js/swiper-bundle.min.js"></script>

<!-- Scroll Reveal -->
<script src="js/scrollreveal.js"></script>

<!-- JavaScript -->
    <script src="js/script.js"></script>


<script>
   var box  = document.getElementById('box');
var down = false;


function toggleNotifi(){
	if (down) {
		box.style.height  = '0px';
		box.style.opacity = 0;
		down = false;
	}else {
		box.style.height  = '510px';
		box.style.opacity = 1;
		down = true;
	}
}
   </script>
</body>
</html>