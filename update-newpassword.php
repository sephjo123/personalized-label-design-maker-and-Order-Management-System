<?php

@include 'config.php';

session_start();
// $email = $_POST['email'];
// $mobile = $_POST['mobile'];

// $query = "SELECT * FROM user_form WHERE email = '$email' && mobile = '$mobile' && availability = 'active'";
// $query_run = mysqli_query($conn, $query);
// $email_query_result = mysqli_fetch_array($query_run);
// $email_account = $email_query_result['email'];




		
// update user details -- //
if(isset($_POST['submit'])){

   $user_id = mysqli_real_escape_string($conn, $_SESSION['ID']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   if($pass != $cpass){
    $error1[] = 'Password not matched!';
 }else{
   $query = "UPDATE user_form SET password= '$pass' WHERE id= '$user_id' ";
   $query_run = mysqli_query($conn, $query);

   $_SESSION['message'] = "Your password has been updated!";
   header('location: profile.php');
   exit(0);
   }
   {
      mysqli_error($conn);
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update form</title>
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
                    
                                <a class="button-logout" href="profile.php">Back</a>
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
         
            <form action="update-newpassword.php"  method="post">
                  <div class="title">
                     Input your new password 
                  </div>
                  <div class="err-msg">
                              <?php
                                    if(isset($error1)){
                                       foreach($error1 as $error1){
                                          echo '<span class="error-msg">'.$error1.'</span>';
                                       };
                                    };
                                 ?>
                        </div>
                      
                  <div class="form">
                  <div class="inputfield">
                        <label>Password:</label>
                        <input type="password" name="password" required placeholder="enter your password" class="input">
                     </div>
                     <div class="inputfield">
                        <label>Confirm Password:</label>
                        <input type="password" name="cpassword" required placeholder="confirm your password" class="input">
                     </div>  
         
                     <div class="inputfield">
                     <input type="submit" name="submit" value="Submit" class="button-login">
                     </div>
                    
                   
                  </div>
            </form>   
      </div>	

</body>
</html>
