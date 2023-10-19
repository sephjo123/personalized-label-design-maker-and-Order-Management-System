<?php

include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
  

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'super-admin' || $row['user_type'] == 'admin' &&  $row['availability'] == 'active'){
      //   $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
         $action = "Has logged into the system";

         $insert = "INSERT INTO logs (admin_name, action) VALUES('$email', '$action')";
         $inserted = mysqli_query($conn, $insert);
         
         $_SESSION['admin_name'] = $row['first_name'];
         $_SESSION['last_name'] = $row['last_name'];
         $_SESSION['user_type'] = $row['user_type'];
         $_SESSION['email'] = $row['email'];
         $_SESSION['ID'] = $row['ID'];
         header('location:admin/index.php');

      }elseif($row['user_type'] == 'user' && $row['availability'] == 'active'){

         $_SESSION['user_name'] = $row['first_name'];
         $_SESSION['last_name'] = $row['last_name'];
         $_SESSION['address'] = $row['address'];
         $_SESSION['ID'] = $row['ID'];
         $_SESSION['email'] = $row['email'];
         $_SESSION['password'] = $row['password'];
         $_SESSION['mobile'] = $row['mobile'];
         $_SESSION['id_user'] = $row['id_user'];
         header('location:index.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }
   

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>
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
            Login Form
         </div>
         <div class="form">
            <form action="" method="post">
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
                     <label>Password</label>
                     <input type="password" name="password" required placeholder="Enter your password" class="input">
                  </div>  
                  
                  <div class="inputfield">
                  <input type="submit" name="submit" value="Sign in" class="button-login">
                  </div>
                     <div class="inputfield">
                        
                        <p>Don't have an account? <a href="register_form.php">Sign up</a></p>

                     </div>
                     <div class="inputfield">

                        <p><a href="forgot-password.php">Forgot password?</a></p>
                     </div>
            </form>
         </div>
      </div>	

</body>
</html>