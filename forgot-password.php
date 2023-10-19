<?php

include 'config.php';
session_start();


if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $id_user = mysqli_real_escape_string($conn, $_POST['id_user']);
   
 
    $select = " SELECT * FROM user_form WHERE email = '$email' && id_user = '$id_user' && availability = 'active'";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);
        
        $_SESSION['user_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['mobile'] = $row['mobile'];
        $_SESSION['id_user'] = $row['id_user'];
 
     header('Location:new-password.php');
 
    }else{
     $error[] = 'incorrect email or mobile!';
    }
    
 
 };
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Forgot Password | Chappy</title>
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
         margin-top: 9em;
         box-shadow: box-shadow: 0 0 15px rgb(112, 112, 112);
         padding: 30px;
         border-radius: 20px;
         }
      .wrapper .form{
         width: 99%;
         align-items: center;
         }
     
         
   </style>
</head>
<body class="body1">

      <div class="wrapper">
         <div class="title">
         Find your account
         </div>
         <div class="form">
            <form action="forgot-password.php" method="post">
               <!-- for logs  -->
               <!-- <input type="hidden" value="<?php echo $_SESSION['admin_name']; ?>">
               <input type="hidden" value="<?php echo $_SESSION['email']; ?>" name="admin_name">
               <input type="hidden" value="Add new admin" name="action"> -->
               <!-- end for logs  -->
                        <?php
                           if(isset($error)){
                              foreach($error as $error){
                                 echo '<span class="error-msg">'.$error.'</span>';
                              };
                           };
                        ?>
                        <div class="successmsg">    
                                 <h2><?php 
                                          include('message.php');
                                          if (isset($_SESSION['message'])) {
                                             echo $_SESSION['message'];
                                             unset($_SESSION['message']);
                                         }
                                 ?> </h2> 
                           </div>
                  <div class="inputfield">
                     <label>Email</label>
                     <input type="email" name="email" required placeholder="Enter your email" class="input">
                  </div>         
                  <div class="inputfield">
                     <label>Account ID</label>
                     <input type="text" name="id_user" required placeholder="Enter your account id" class="input">
                  </div>  
                  
                  <div class="inputfield">
                  <input type="submit" name="submit" value="Search" class="button-login">
                  </div>
                     <div class="inputfield">
                        
                        <p>Already have an account with us? <a href="login_form.php">Sign in</a></p>

                     </div>
            </form>
         </div>
      </div>	

</body>
</html>