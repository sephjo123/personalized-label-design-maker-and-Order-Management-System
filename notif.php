<?php

@include 'config.php';
require_once 'functions.php';

if(!isset($_SESSION['user_name'])){
    header('location:login_form.php');
 }
 $result_message_list = display_message_list();
 
 if(isset($_POST['read'])) {
    $message_id = $_POST['message_id'];
    $mark_as_read = $_POST['mark_as_read'];

    $query = "UPDATE message_list SET un_read = '$mark_as_read' WHERE id = '$message_id'";
    $query_run =mysqli_query($conn, $query);

    if($query_run){
        echo "<script>alert('Message has marked as read!'); window.location.href='notif.php';</script>";
    };
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
              .button-update{
        border: none;
        outline: none;
        color: var(--font-color);
        padding: 5px 5px;
        border-radius: 3rem;
        background-color: gray;
        transition: var(--tran-0-3);
        cursor: pointer;
        }
        .button-update:hover{
        background-color: royalblue;
        }

        table{
            margin-left: 100px;
        }
        .outer-wrapper{
            height: 350px;
            width: 700px;
           
        }
    </style>


</head>
<body class="body2">
<!-- Header -->
    <header class="header">    
            <nav class="nav container flex">
                    <a href="#" class="logo-content flex">
                    <i class='phone-icon'><img src="images/bg/Chappy-Logo.png" alt="" ></i>                       
                        <span class="logo-text">Chappy.</span>
                    </a>
                    <div class="menu-content">
                            <ul class="menu-list flex">

                                    <li><a href="notif.php" class="nav-link active-navlink">New message</a></li>
                                    <li><a href="previews-notif.php" class="nav-link"> message list</a></li>
                                  
                                    
                                    
                            </ul>

                            <div class="media-icons flex">
                                    <a href="https://www.facebook.com/profile.php?id=100009150553521"><i class='bx bxl-facebook'></i></a>
                            </div>

                            <i class='bx bx-x navClose-btn'></i>
                        </div>
                    <div class="menu-content">
                            

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
    <section class="section " id="edit">
    <form method="GET" class="searchitem" >
                <input class="searchinput" type="text" required name="search" placeholder="Search Data" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>">
                <button type="submit" class="button-search">Search</button>
        </form>
        
        <div class="meu-text">
                
                <h2 class="section-title">Message list</h2>

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
                            <th>FROM</th>
                            <th>MESSAGE</th>
                            <th>DATE</th>
                            <th>ACTION</th>
                            
                          
                            
                        </thead>
                        <tbody>
                            
                        <?php
                                        $user_id = $_SESSION['ID'];
                                        while($row = mysqli_fetch_assoc($result_message_list))
                                                {
                                            ?>
                                                
                                                <td> <?php echo $row['from_admin'] ?> </td>
                                                <td> <?php echo $row['message'] ?> </td>
                                                <td><?php echo date("M d, Y", strtotime($row['date_messaged'])) ?> </td>
                                                <form action="" method="post">
                                                    <input type="hidden" value="1" name="mark_as_read">
                                                    <input type="hidden" name="message_id" value="<?php echo $row['id']?>">
                                                <td><button type="submit" name = "read" class="btn btn-success button-update">Mark as read</button></td>
                                                </form>
                                                
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
<script src="js/swiper-bundle.min.js"></script>

<!-- Scroll Reveal -->
<script src="js/scrollreveal.js"></script>

<!-- JavaScript -->
    <script src="js/script.js"></script>
</body>
</html>