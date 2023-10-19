<?php

@include 'config.php';
require_once 'functions.php';

if(!isset($_SESSION['admin_name'])){
header('location:login_form.php');
}
$search_user_details = display_user();
$fetch = display_month();

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

                
        </style>

</head>
<body>
        <!-- <?php
       /* if(isset($_SESSION['admin_name'])){
        $admin_name = $_SESSION['email'];
        $action = "Has logged into the system";
        
                
        $insert = "INSERT INTO logs (admin_name, action) VALUES('$admin_name', '$action')";
        $inserted = mysqli_query($conn, $insert); 
        } */
        ?> -->
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
                    <a href="#" class="logo-content flex">
                    <i class='phone-icon'><img src="../images/bg/Chappy-Logo.png" alt="" ></i>                       
                        <span class="logo-text">Chappy.</span>
                    </a>
                    <?php
					$query = $conn->query("SELECT * FROM `user_form` WHERE `ID` = '$_SESSION[ID]'") or die(mysqli_error());
					$fetch = $query->fetch_array();
                                        $popup = $conn->query("SELECT * FROM `order_form` where  status = 'Yet to be approved' ")->num_rows;
				?>
                    <div class="menu-content">
                            <ul class="menu-list flex">
                            <li><a href="index.php" class="nav-link active-navlink">Users</a></li>
                            <li><a href="admin.php" class="nav-link">Profile</a></li>
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
                                    <li><a href="chart-report.php" class="nav-link">Chart</a></li>
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

                        $query = "SELECT * FROM order_form WHERE monthname(date_order) = 'May'";
                        $query_run = mysqli_query($conn, $query);

                        $may = mysqli_fetch_assoc($query_run);

                        ?>

<!-- Home Section -->
    <main>
    <section class="section" id="edit">

<?php
////////////////////////////////////////////////// VIEW ORDERSSSS /////////////////////////////////////
        //January
        $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 1 && status = 'Claimed'";
            
        $result1 = $conn->query($sql);
        $fetch = mysqli_num_rows($result1);

        //February
        $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 2 && status = 'Claimed'";
            
        $result2 = $conn->query($sql);
        $fetch2 = mysqli_num_rows($result2);

         //Mar
         $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 3 && status = 'Claimed'";
            
         $result3 = $conn->query($sql);
         $fetch3 = mysqli_num_rows($result3);

          //Apr
          $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 4 && status = 'Claimed'";
            
          $result4 = $conn->query($sql);
          $fetch4 = mysqli_num_rows($result4);
////////////////////// compute
          $sql = "SELECT SUM(payment_total_amount) AS value_sum FROM order_form WHERE MONTH(date_order)= 4";
          $sales = $conn->query($sql);

          $fetch_sales = mysqli_fetch_assoc($sales);
//////////////////////
          //May
          $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 5 && status = 'Claimed'";
            
          $result5 = $conn->query($sql);
          $fetch5 = mysqli_num_rows($result5);

           //jun
           $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 6 && status = 'Claimed'";
            
           $result6 = $conn->query($sql);
           $fetch6 = mysqli_num_rows($result6);

            //Jul
          $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 7 && status = 'Claimed'";
            
          $result7 = $conn->query($sql);
          $fetch7 = mysqli_num_rows($result7);

           //Aug
           $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 8 && status = 'Claimed'";
            
           $result8 = $conn->query($sql);
           $fetch8 = mysqli_num_rows($result8);

            //Sep
          $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 9 && status = 'Claimed'";
            
          $result9 = $conn->query($sql);
          $fetch9 = mysqli_num_rows($result9);

           //Oct
           $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 10 && status = 'Claimed'";
            
           $result10 = $conn->query($sql);
           $fetch10 = mysqli_num_rows($result10);

            //Nov
          $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 11 && status = 'Claimed'";
            
          $result11 = $conn->query($sql);
          $fetch11 = mysqli_num_rows($result11);

           //Dec
           $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 12 && status = 'Claimed'";
            
           $result12 = $conn->query($sql);
           $fetch12 = mysqli_num_rows($result12);

?>

<?php
////////////////////////////////////////////////// VIEW CANCELLED ORDERS /////////////////////////////////////
        //January
        $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 1 && status = 'Cancelled by customer' && status = 'Cancelled by Admin'";
            
        $result_cancel = $conn->query($sql);
        $fetch_cancelled_order = mysqli_num_rows($result_cancel);

        //February
        $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 2 && status = 'Cancelled by customer' && status = 'Cancelled by Admin'";
            
        $result_cancel2 = $conn->query($sql);
        $fetch_cancelled_order2 = mysqli_num_rows($result_cancel2);

         //Mar
         $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 3 && status = 'Cancelled by customer' && status = 'Cancelled by Admin'";
            
         $result_cancel3 = $conn->query($sql);
         $fetch_cancelled_order3 = mysqli_num_rows($result_cancel3);

          //Apr
          $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 4 && status = 'Cancelled by customer'";
            
          $result_cancel4 = $conn->query($sql);
          $fetch_cancelled_order4 = mysqli_num_rows($result_cancel4);
////////////////////// compute
        //   $sql = "SELECT SUM(payment_total_amount) AS value_sum FROM order_form WHERE MONTH(date_order)= 4";
        //   $sales = $conn->query($sql);

        //   $fetch_sales = mysqli_fetch_assoc($sales);
//////////////////////
          //May
          $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 5 && status = 'Cancelled by customer' ";
            
          $result_cancel5 = $conn->query($sql);
          $fetch_cancelled_order5 = mysqli_num_rows($result_cancel5);

           //jun
           $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 6 && status = 'Cancelled by customer' && status = 'Cancelled by Admin'";
            
           $result_cancel6 = $conn->query($sql);
           $fetch_cancelled_order6 = mysqli_num_rows($result_cancel6);

            //Jul
          $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 7 && status = 'Cancelled by customer' && status = 'Cancelled by Admin'";
            
          $result_cancel7 = $conn->query($sql);
          $fetch_cancelled_order7 = mysqli_num_rows($result_cancel7);

           //Aug
           $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 8 && status = 'Cancelled by customer' && status = 'Cancelled by Admin'";
            
           $result_cancel8 = $conn->query($sql);
           $fetch_cancelled_order8 = mysqli_num_rows($result_cancel8);

            //Sep
          $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 9 && status = 'Cancelled by customer' && status = 'Cancelled by Admin'";
            
          $result_cancel9 = $conn->query($sql);
          $fetch_cancelled_order9 = mysqli_num_rows($result_cancel9);

           //Oct
           $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 10 && status = 'Cancelled by customer' && status = 'Cancelled by Admin'";
            
           $result_cancel10 = $conn->query($sql);
           $fetch_cancelled_order10 = mysqli_num_rows($result_cancel10);

            //Nov
          $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 11 && status = 'Cancelled by customer' && status = 'Cancelled by Admin'";
            
          $result_cancel11 = $conn->query($sql);
          $fetch_cancelled_order11 = mysqli_num_rows($result_cancel11);

           //Dec
           $sql = "SELECT * FROM order_form WHERE MONTH(date_order)= 12 && status = 'Cancelled by customer' && status = 'Cancelled by Admin'";
            
           $result_cancel12 = $conn->query($sql);
           $fetch_cancelled_order12 = mysqli_num_rows($result_cancel12);

?>

        <div class="meu-text">
                
                <h2 class="section-title">All Orders</h2>

 <!-- <h1><?php echo $fetch_sales['value_sum']; ?></h1> -->
                
        </div>
                <div class="review-container container">
                        
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Orders', 'Cancelled Orders'],
          ['Jan',  <?php echo $fetch?>, <?php echo $fetch_cancelled_order ?>],
          ['Feb',  <?php echo $fetch2?>, <?php echo $fetch_cancelled_order2 ?>],
          ['Mar',  <?php echo $fetch3?>, <?php echo $fetch_cancelled_order3 ?>],
          ['Apr',  <?php echo $fetch4?>, <?php echo $fetch_cancelled_order4 ?>],
          ['May',  <?php echo $fetch5?>, <?php echo $fetch_cancelled_order5 ?>],
          ['Jun',  <?php echo $fetch6?>, <?php echo $fetch_cancelled_order6 ?>],
          ['Jul',  <?php echo $fetch7?>, <?php echo $fetch_cancelled_order7 ?>],
          ['Aug',  <?php echo $fetch8?>, <?php echo $fetch_cancelled_order8 ?>],
          ['Sept',  <?php echo $fetch9?>, <?php echo $fetch_cancelled_order9 ?>],
          ['Oct',  <?php echo $fetch10?>, <?php echo $fetch_cancelled_order10 ?>],
          ['Nov',  <?php echo $fetch11?>, <?php echo $fetch_cancelled_order11 ?>],
          ['Dec',  <?php echo $fetch12?>, <?php echo $fetch_cancelled_order12 ?>]
     
        ]);

        var options = {
          title: 'Chappy Printing',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
                
                <div id="curve_chart" style="width: 900px; height: 500px; margin-left: 15px;"></div>
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