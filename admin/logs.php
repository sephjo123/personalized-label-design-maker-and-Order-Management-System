<?php

@include 'config.php';
require_once 'functions.php';

if(!isset($_SESSION['admin_name'])){
header('location:login_form.php');
}

$search_logs_details = display_logs();

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
       .order-img{
        height: 100px;
        width: 100px;
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
         .successmsg{
            margin-bottom: 10px;
            margin-left: 15em;
         }
         .button-update{
        border: none;
        outline: none;
        color: var(--font-color);
        padding: 1.1rem 1rem;
        border-radius: 3rem;
        background-color: gray;
        transition: var(--tran-0-3);
        cursor: pointer;
        }
        .button-update:hover{
        background-color: royalblue;
        }
    </style>


</head>
<body class="body2">
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

<!-- Home Section -->
    <main>
    <section class="section" id="edit">
        <form method="GET" class="searchitem" >
                <input class="searchinput" type="text" required name="search" placeholder="Search Data" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>">
                <button type="submit" class="button-search">Search</button>
        </form>
        <div class="meu-text">
                
                <h2 class="section-title">Logs</h2>
                        <div class="successmsg">    
                                <h2>
                                    <?php 
                                        include('message.php')
                                     ?> 
                                </h2> 
                        </div>
                
        </div>
            <div class="review-container container">
                        
                <div class="outer-wrapper">
                    <div class="table-wrapper">
                    <table class="content-table">
                        <thead>
                            <th>Admin</th>
                            <th>Action</th>
                            <th>Date</th>
                          
                            
                            
                        </thead>
                       
                        <tbody>
                            
                        <?php
     
                                        while ($row = mysqli_fetch_array( $search_logs_details))
                                        {
                                            ?>
                                                
                                                <td> <?php echo $row['admin_name'] ?> </td>
                                                <td> <?php echo $row['action'] ?> </td>
                                                <td> <?php echo date("M d, Y H:i:s", strtotime($row['date'])) ?> </td>

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