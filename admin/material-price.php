<?php

@include 'config.php';
require_once 'functions.php';

if(!isset($_SESSION['admin_name'])){
header('location:login_form.php');
}

$result = display_material_price();

// Save Material Price // 
if(isset($_POST['save_material']))
    {
        
        $material_name = mysqli_real_escape_string($conn, $_POST['material_name']);
        $material_price = mysqli_real_escape_string($conn, $_POST['price']);
        
        if (!is_numeric($material_price)) {
            echo "<script>alert('Invalid Price'); window.location.href='material-price.php';</script>";
            exit;
        }
        // logs
        $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
        $action = mysqli_real_escape_string($conn, $_POST['action']);
        $action2 = mysqli_real_escape_string($conn, $_POST['action2']);

        $insert = "INSERT INTO logs (admin_name, action) VALUES('$admin_name', '$action $material_name $action2 $material_price')";
        $inserted = mysqli_query($conn, $insert);
        // end logs
        $query = "INSERT INTO item_materials (material, price) VALUES 
        ('$material_name', '$material_price')";

        $query_run = mysqli_query($conn, $query);
        if($query_run)
        {
            $_SESSION['message'] = "Successfully";
            header("Location:material-price.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Created";
            header("Location:material-price.php");
            exit(0);
        }
    }

// Delete Stocks //
if(isset($_POST['delete_btn_set']))
{
    $del_id = $_POST['delete_id'];

    $query = "DELETE FROM item_materials WHERE id= '$del_id'";
    $query_run = mysqli_query($conn, $query);
}

    if(isset($_POST['delete_stock']))
    {
        $material_id = mysqli_real_escape_string($conn, $_POST['delete_stock']);

        $query = "DELETE FROM item_materials WHERE id= '$material_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            $_SESSION['message'] = "Deleted Successfully";
            header("Location:add-stocks.php");
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Deleted";
            header("Location:add-stocks.php");
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

        .button-delete{
        border: none;
        outline: none;
        color: var(--font-color);
        padding: 1.1rem 1rem;
        border-radius: 3rem;
        background-color: transparent;
        transition: var(--tran-0-3);
        cursor: pointer;
        }
        .button-delete:hover{
        background-color: var(--button-color);
        }

        .button-update{
        border: none;
        outline: none;
        color: var(--font-color);
        padding: 1.1rem 1rem;
        border-radius: 3rem;
        background-color: transparent;
        transition: var(--tran-0-3);
        cursor: pointer;
        }
        .button-update:hover{
        background-color: gray;
        }
        .successmsg{
            margin-left: 4.5em;
        }
        .close {
            background-color:var(--section-bg);
            padding: 2px 3px 2px;
        }
    </style>

</head>
<body>
    
<!-- Header -->
    <header class="header">    
            <nav class="nav container flex">
                    <a href="#" class="logo-content flex">
                    <i class='phone-icon'><img src="../images/bg/Chappy-Logo.png" alt="" ></i>                       
                        <span class="logo-text">Chappy.</span>
                    </a>

                    <div class="menu-content">
                            <ul class="menu-list flex">
                            <li><a href="index.php" class="nav-link active-navlink">Users</a></li>
                                    <li><a href="admin.php" class="nav-link">Profile</a></li>
                                    <li><a href="all-orders.php" class="nav-link">Orders</a></li>
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

<!-- Home Section -->
    <main>
        <?php
        // WARNING ECHO //
        $select_stock = "SELECT * FROM item_materials WHERE stock < '200' ";
        $query_stock_run = mysqli_query($conn, $select_stock);

        if(mysqli_num_rows($query_stock_run) > 0){
          
            $low_stock[] = "You're running out of stocks!";        
        }
?>
        
    <section class="section stocks" id="menu">
       
            <div class="menu-container container">
                    <div class="menu-text">
                            
                            <h2 class="section-title">Material Price</h2>
                            <?php
                           if(isset($low_stock)){
                              foreach($low_stock as $low_stock){
                                 echo '<span class="section-title">'.$low_stock.'</span>';
                              };
                           };
                        ?>
                          
                    </div>

                    <div class="menu-content">
                            <div class="menu-items">
                            <div class="stocks-outer-wrapper">
                                    <div class="stocks-table-wrapper">
                                            <table class="content-table">
                                                <thead>
                                                <th> Materials </th>
                                                <th> Price </th>
                                                <th> Stocks </th>
                                                <th> Availability </th>
                                                <th> Action</th>
                                                    
                                                </thead>
                                                                
                                                <tbody>                       
                                        <tr>   
                                        <?php
                                            while($row = mysqli_fetch_assoc($result))
                                                    {
                                                        ?>
                                                        <td><?php echo $row['material']; ?></td>
                                                        <td><?php echo $row['price']; ?></td>
                                                        <td><?php echo $row['stock']; ?></td>
                                                        <td> <?php echo $row['availability']; ?> </td>
                                                    
                                                    <td>
                                                    
                                                    <a href="material-price-update.php?id=<?= $row['ID']; ?>" class="btn btn-success button-update">Update</a>
                                        
                                                        <form action="material-price.php" method="POST" class="d-inline">
                                                            <br>
                                                            
                                                            
                                                        <input type="hidden" class="delete_id_value" value="<?= $row['ID'];?>">
                                                        <?php
                                                            if($_SESSION['user_type'] == 'super-admin'){
                                                                    echo"      
                                                                <a href='javascripit:void(0)' class='delete_btn_ajax btn button-delete'>Delete</a>
                                                            ";
                                                            }
                                                            ?>
                                                        
                                                    </form>
                                                    
                                                    </td>
                                            </tr>
                                                    <?php
                                                    }
                                        
                                                    ?>   
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <?php
                                        if($_SESSION['user_type'] == 'super-admin'){
                                                echo"      
                                                <div class='time-table'>
                                                <div class='wrapper'>
                                                            <div class='successmsg'>    
                                                                <?php 
                                                                    include('message.php')
                                                                ?>  
                                                            </div>
                                                            <div class='title'>
                                                                Add Material
                                                            </div>
                                                    <div class='form'>
                                                            <form action='material-price.php' method='POST'>
                                                                <!-- for logs  -->
                                                                <input type='hidden' value='". $_SESSION['admin_name']."'>
                                                                <input type='hidden' value='". $_SESSION['email'] ."' name='admin_name'>
                                                                <input type='hidden' value='Add new material' name='action'>
                                                                <input type='hidden' value='with the prize of' name='action2'>
                                                                <!-- end for logs  -->
                                                                    <div class='inputfield'>
                                                                            <label>Material Name</label>                                               
                                                                                <input type='text' name='material_name' required class='input'>                
                                                                    </div>
                                                                    <div class='inputfield'>
                                                                            <label>Price</label>
                                                                                <input type='text' name='price' id='qty' required class='input'>                          
                                                                    </div>
                                                                    <div class='inputfield'>
                                                                            <input type='submit' name='save_material' value='Save Material Price' class='button-login'>
                                                                    </div>
                                                            </form>      
                                                    </div>
                                                 </div> 
                                                </div>
                                        ";
                                        }
                                         ?>
                            

              <!-- Size Price -->
            <div class="menu-items">              
                <div class="size-outer-wrapper">
                <div class="size-table-wrapper">               
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Action</th>
                            
                        </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $query = " SELECT * FROM item_size ";
                                    $query_run = mysqli_query($conn, $query);
                                        while($row = mysqli_fetch_assoc($query_run))
                                                {
                                                    ?>
                                                    <td><?php echo $row['size']; ?></td>
                                                    <td><?php echo $row['price']; ?></td>
                                                    
                                                
                                                <td>
                                                
                                                    <a href="size-price-update.php?id=<?= $row['ID']; ?>" class="btn btn-success button-update">Update</a>
                                                    
                                                                    
                                                </td>
                                        </tr>
                                                    <?php
                                                        }
                                            
                                                    ?>   
                                    </tbody>
                                </table>
                        </div>
                    </div>
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
<!-- Jquery -->    
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<!-- popper -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Sweet Alert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
       $(document).ready(function (){

        $('.delete_btn_ajax') .click(function (e){
            e.preventDefault();
         

          var deleteid = $(this).closest("tr").find('.delete_id_value').val();
          console.log(deleteid);

         swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                
                $.ajax({
                    type: "POST",
                    url: "material-price.php",
                    data: {
                        "delete_btn_set": 1,
                        "delete_id": deleteid,
                    },
                   
                    success: function (response) {
                        swal("Data Deleted Successfully.!", {
                            icon: "success",
                        }).then((result) => {
                            location.reload();
                        });
                            

                    }
                });

            } 
            });

        });

       });
    </script>
</body>
</html>