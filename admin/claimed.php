<?php

@include 'config.php';
require_once 'functions.php';

if(!isset($_SESSION['admin_name'])){
header('location:login_form.php');
}
$result = display_claimed_admin();


if(isset($_POST['order_claimed'])){

    $status_claimed = $_POST['claim'];
    $id = $_POST['id'];

    $sql = "UPDATE order_form SET status='$status_claimed' WHERE ID=$id;";
    $query_run = mysqli_query($conn, $sql);

    if($query_run){
       
        $_SESSION['message'] = "Order has been updated";
        header('location:to-claim.php');
        exit(0);
        
    }

 };
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

                    <div class="menu-content">
                            <ul class="menu-list flex">
                                    <li><a href="all-orders.php" class="nav-link active-navlink">Orders</a></li>
                                    <li><a href="rush-orders.php" class="nav-link">Approved Orders</a></li>
                                    <li><a href="to-claim.php" class="nav-link active-navlink">To Claim</a></li>
                                    <li><a href="claimed.php" class="nav-link active-navlink">Claimed Orders</a></li>
                                    <li><a href="cancelled-by-customer.php" class="nav-link">Cancelled Orders</a></li>
                                    
                            </ul>

                            <div class="media-icons flex">
                                    <a href="https://www.facebook.com/profile.php?id=100009150553521"><i class='bx bxl-facebook'></i></a>
                                    
                            </div>

                            <i class='bx bx-x navClose-btn'></i>
                        </div>
                        
                        <div class="contact-content flex">
                            <!--<i class='bx bx-phone phone-icon' ></i>-->
                                <a class="button-logout" href="index.php">Back</a>
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
                
               
                        <div class="successmsg">    
                                <h2>
                                    <?php 
                                        include('message.php')
                                     ?> 
                                </h2> 
                        </div>
                
        </div>
        <div class="meu-text">
                
                <h2 class="section-title">Orders Complete</h2>
                        
                
        </div>
            <div class="review-container container">
                        
                <div class="outer-wrapper">
                    <div class="table-wrapper">
                    <table class="content-table">
                        <thead>
                            <th>Action</th>
                            <th>Custom Image</th>
                            <th>Reference Number</th>
                            <th>Order ID</th>
                            <th>Payer Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Shape</th>
                            <th>Size</th>
                            <th>Material </th>
                            <th>Processing Days</th>
                            <th>Quantity</th>
                            <th>Total Payment</th>
                            <th>Status</th>
                            <th>Date Ordered</th>
                            <th>Date Claimed</th>
                            
                        </thead>
                       
                        <tbody>
                            
                        <?php
                                        

                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            ?>
                                                <td><a href="view-claimed-orders.php?id=<?= $row['ID']; ?>" class="btn btn-success button-update">view</a></td>   
                                                <td class="order-flex"> <img src="../<?php echo $row['custom_image'] ?>" class="order-img">  </td>
                                                <td> <?php echo $row['ref_num'] ?> </td>
                                                <td> <?php echo $row['order_id'] ?> </td>
                                                <td> <?php echo $row['payer_name'] ?> </td>
                                                <td> <?php echo $row['email'] ?> </td>
                                                <td> <?php echo $row['mobile'] ?> </td>
                                                <td> <?php echo $row['shape'] ?> </td>
                                                <td> <?php echo $row['size'] ?> </td>
                                                <td> <?php echo $row['material'] ?> </td>
                                                <td> <?php echo $row['processing'] ?> </td>
                                                <td> <?php echo $row['qty'] ?> </td>
                                                <td>Php <?php echo number_format($row['payment_total_amount'],2) ?> </td>
                                                <td><?= $row['status']; ?>   </td>
                                                <td> <?php echo date("M d, Y", strtotime($row['date_order'])) ?> </td>
                                                <td> <?php echo date("M d, Y", strtotime($row['date_act'])) ?> </td>

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