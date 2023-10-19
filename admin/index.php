<?php

@include 'config.php';
require_once 'functions.php';

if(!isset($_SESSION['admin_name'])){
header('location:login_form.php');
}
$search_user_details = display_user();

$popup = $conn->query("SELECT * FROM `order_form` where  status = 'Yet to be approved' ")->num_rows;
if($popup > 0) {
        $message = "You have pending orders!";
        echo "<style>
            .popup {
                display: none;
                position: fixed;
                z-index: 9999;
                top: 18%;
                left: 73%;
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
                color: #999;
                text-decoration: underline;
            }
          </style>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
                var popup = document.createElement('div');
                popup.classList.add('popup');

                var content = document.createElement('div');
                content.classList.add('popup-content');
                content.innerHTML = '$message';

                var close = document.createElement('span');
                close.classList.add('popup-close');
                close.textContent = 'Close';

                close.addEventListener('click', function() {
                    popup.style.display = 'none';
                });

                popup.appendChild(content);
                popup.appendChild(close);
                document.body.appendChild(popup);

                popup.style.display = 'block';
            });
          </script>";

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
    <link rel="icon" href="../images/bg/Chappy-Logo.png" type="image/x-icon">
        
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
                body{
                        overflow-x: hidden;
                        background-image: url(../images/bg/Background1.jpg);
                        background-size: cover;
                }

                .popup-cancel {

                position: fixed;
                z-index: 9999;
                top: 23%;
                left: 8%;
                transform: translate(-50%, -50%);
                background-color: rgb(145, 16, 16);
                width: 160px;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
                font-family: Arial, sans-serif;
            }
            .popup-content-cancel {
                text-align: center;
            }
            .popup-close-cancel {
                margin-top: 10px;
                cursor: pointer;
                color: #999;
                
            }
            .order-img{
                height: 100px;
                width: 100px;
                border: solid white 3px;
                border-radius: 50%;
            }
            .profile-icon{
                border-radius: 50%;
                border: solid white 2px;
                
        }
            
                
        </style>

</head>
<body>
        <?php
       $admin_id = $_SESSION['ID'];
       $admin = $_SESSION['user_type'];
       
       $result = mysqli_query($conn, "SELECT * FROM user_form where ID = '$admin_id' && user_type = 'admin' || user_type = 'super-admin'");
       while($row = mysqli_fetch_array($result)){
       $fname = $row['first_name'];
       $lname = $row['last_name'];
       $email = $row['email'];
       $mobile = $row['mobile'];
       $address = $row['address'];
       $id = $row['ID'];
       $profile = $row['profile_pic'];
       
       
       }
        ?>
        <!-- Logs -->
        <form action="" method="post">
                <!-- for logs  -->
               <input type="hidden" value="<?php echo $_SESSION['admin_name']; ?>">
               <input type="hidden" value="<?php echo $_SESSION['email']; ?>" name="admin_name">
               <input type="hidden" value="Has logged into the system" name="action">
               <!-- end for logs  -->
        </form>
<!-- Header -->
    <header class="header">    
            <nav class="nav container flex">
                    <a href="admin.php" class="logo-content flex">
                    <i class='phone-icon'><img src="<?php echo $profile  ?>" alt=""  class="profile-icon"></i>                       
                        <span class="logo-text"><?php echo $fname ?></span>
                    </a>
                    <?php
					$query = $conn->query("SELECT * FROM `user_form` WHERE `ID` = '$_SESSION[ID]'") or die(mysqli_error());
					$fetch = $query->fetch_array();
                                        $popup = $conn->query("SELECT * FROM `order_form` where  status = 'Yet to be approved' ")->num_rows;
				?>
                    <div class="menu-content">
                            <ul class="menu-list flex">
                            <li><a href="index.php" class="nav-link active-navlink">Users</a></li>
                            
                                    <li>
                                    <span id="state1" countto="70"><?= number_format($popup) ?></span>
                                        <a href="all-orders.php" class="nav-link">Orders</a></li>
                                    <li><a href="material-price.php" class="nav-link">Material & Size Price</a></li>
                                    <?php
                                        if($_SESSION['user_type'] == 'super-admin'){
                                                echo"      
                                        <li><a href='create-admin.php' class='nav-link'>Add Admin</a></li>
                                        ";
                                        }
                                         ?>
                                         <?php
                                        if($_SESSION['user_type'] == 'super-admin'){
                                                echo"      
                                        <li><a href='chart-report.php' class='nav-link'>Chart</a></li>
                                        ";
                                        }
                                         ?>
                                    <li><a href="logs.php" class="nav-link">Logs</a></li>
                                    
                            </ul>

                            <div class="media-icons flex">
                                    <a href="https://www.facebook.com/profile.php?id=100009150553521"><i class='bx bxl-facebook'></i></a>
                                    <a href="https://twitter.com/i/flow/login"><i class='bx bxl-twitter' ></i></a>
                                    <a href="https://www.instagram.com/accounts/login"><i class='bx bxl-instagram-alt' ></i></a>
                                    <a href="https://github.com/login"><i class='bx bxl-github'></i></a>
                                    <a href="https://www.youtube.com/login"><i class='bx bxl-youtube'></i></a>
                            </div>

                            <i class='bx bx-x navClose-btn'></i>
                        </div>
                        
                        <div class="contact-content flex">
                            <!--<i class='bx bx-phone phone-icon' ></i>-->
                                <a class="button-logout" href="logout.php">Log out</a>
                        </div>

                        <i class='bx bx-menu navOpen-btn'></i>
                </nav>
        
    </header>
     <!-- POPUP MESSAGE NOTIFY THE ADMIN -->
     <?php
                        if(isset($_POST['gone'])){
                                $mark_as_read = $_POST['mark_as_read'];
                                
                                $select = "UPDATE order_form SET un_read = '$mark_as_read'  WHERE  status = 'Cancelled by customer'";
                                $query_run = mysqli_query($conn, $select);

                        }

                        $popup_cancelled = $conn->query("SELECT * FROM `order_form` where  status = 'Cancelled by customer' && un_read = '1' ")->num_rows; 

                        if($popup_cancelled > 0) {
                                $message = "Order has been cancelled by customer!";
                                echo "
                                <form method='POST'>
                                <div class='popup-cancel'>
                                        <input type='hidden' name='mark_as_read' value='0'>
                                        
                                        <div = class'popup-content-cancel'>
                                                $message
                                        </div>

                                        <button type='submit' class='popup-close-cancel' name='gone'><strong>Okay</strong></button>
                                </div>
                                </form>";
                        };
                        ?>

<!-- Home Section -->
    <main>
    <section class="section" id="edit">
        <form method="GET" class="searchitem" >
                <input class="searchinput" type="text" required name="search1" placeholder="Search Data" value="<?php if(isset($_GET['search1'])){echo $_GET['search1'];} ?>">
                <button type="submit" class="button-search">Search</button>
        </form>
        <div class="meu-text">
                
                <h2 class="section-title">All Users</h2>
                <h2 class="section-title"> <?php
                     include('message.php')
                     ?></h2>
               
                
        </div>
                <div class="review-container container">
                        
                <div class="outer-wrapper">
                <div class="table-wrapper">
                         <table class="content-table">
                                 <thead>
                                        <th>Profile</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address </th>
                                        <th>User Type</th>
                                        <th>Date Added</th>
                                        <th>User</th>
                                        <th>Action</th>

                                                                
                                </thead>
                     

                                <tbody>                 
                                        
                                        <tr>   
                                                <?php
                                                while($row = mysqli_fetch_assoc($search_user_details))
                                                {
                                                        ?>
                                                        <td class="order-flex"> <a href="disable-account.php?id=<?php echo $row['ID'] ?>"><img src="<?php echo $row['profile_pic'] ?>" class="order-img"> </a> </td>
                                                        <td><?php echo $row['first_name']; ?></td>
                                                        <td><?php echo $row['last_name']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><?php echo $row['mobile']; ?></td>
                                                        <td><?php echo $row['address']; ?></td>
                                                        <td><?php echo $row['user_type']; ?></td>
                                                        <td><?php echo date("M d, Y H:i:s", strtotime($row['date_added'])) ?></td>
                                                        <td><?php echo $row['availability'] ?></td>
                                                        <?php
                                                        if($_SESSION['user_type'] == 'super-admin'){
                                                          echo"      
                                                        <td><a class='button-logout' href ='disable-account.php?id=".$row['ID']."'>Disable</a></td>
                                                        ";
                                                        }
                                                        ?>
                                                        <?php
                                                        if($_SESSION['user_type'] == 'admin'){
                                                          echo"      
                                                        <td><a class='button-logout' href ='disable-account.php?id=".$row['ID']."'>View</a></td>
                                                        ";
                                                        }
                                                        ?>
                                        </tr>
                                                <?php
                                                        
                                                        }                   
                                                        ?>   
                                 </tbody>
                                 </table>
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