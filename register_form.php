<?php

@include 'config.php';

function user_num()
{
    $prefix = 'ID'; 
    $unique_id = uniqid();
    $random_num = rand(1000, 9999); 
    $u_id = $prefix . '-' . substr($unique_id, 0, 8) . '-' . $random_num;
    return $u_id;
}

if(isset($_POST['submit'])){

   $u_id = user_num();

   $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
   $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $mobile = $_POST['mobile'];
   $address = $_POST['address'];
   $user_type = $_POST['user_type'];
   $default_dp = $_POST['nprofile'];

   $select = " SELECT * FROM user_form WHERE email = '$email' ";
   
  

   $result = mysqli_query($conn, $select);
   
   if(mysqli_num_rows($result) > 0 ){

      $error1[] = 'Email already exist!';

   }else{

      if($pass != $cpass){
         $error1[] = 'Password not matched!';
      }else{
         $insert = "INSERT INTO user_form (first_name, profile_pic, last_name, email, password, mobile, address, user_type, id_user) VALUES('$first_name', '$default_dp','$last_name','$email','$pass','$mobile','$address','$user_type', '$u_id')";
         $registered = mysqli_query($conn, $insert);

         if($registered){
         
         echo "<script>alert('Registered Successfully!'); window.location.href='login_form.php';</script>";
        
         }
         else{
            header('location:register_form.php');
         }
      }
   }
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>
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
       
   </style>
</head>
<body class="body1">
   
      <div class="wrapper">
         
            <form action=""  method="post" enctype="multipart/form-data">
                  <div class="title">
                     Registration Form
                  </div>
                      <div class="err-msg">
                              <?php
                                    if(isset($error1)){
                                       foreach($error1 as $error1){
                                          echo '<span class="error-msg">'.$error1.'</span>';
                                       };
                                    };
                                 ?>
                                 <div class="successmsg">    
                                       <h2><?php 
                                                include('message.php')
                                       ?> </h2> 
                                 </div>
                        </div>
                  <div class="form">
                     <div class="inputfield">
                        <label>First Name:</label>
                        <input type="hidden" value="user" name="user_type">
                        <input type="text" name="first_name" id = "fmyInput" oninput="validateInput()" required placeholder="enter your first name"class="input">
                     </div>  
                     <div class="inputfield">
                        <label>Last Name:</label>
                        <input type="text" name="last_name" id = "lmyInput" oninput="validateInput()" required placeholder="enter your last name" class="input">
                     </div>
                     <div class="inputfield">
                        <label>Email:</label>
                        <input type="email" name="email" required placeholder="enter your email" class="input">
                     </div>   
                     <div class="inputfield">
                        <label>Password:</label>
                        <input type="password" name="password" required placeholder="enter your password" class="input">
                     </div>
                     <div class="inputfield">
                        <label>Confirm Password:</label>
                        <input type="password" name="cpassword" required placeholder="confirm your password" class="input">
                     </div>    
                     <div class="inputfield">
                        <label>Phone Number:</label>
                        <input type="number" name="mobile" required placeholder="mobile number" class="input">
                     </div> 
                     <input type="hidden" value="profile_pics/blankprofile.png" name="nprofile">
                     <div class="inputfield">
                        <label>Address</label>
                        <textarea type="text" name="address"  required placeholder="Address" class="textarea"></textarea>
                     </div> 
                     <div class="inputfield">
                     <input type="submit" name="submit" value="Sign up" class="button-login">
                     </div>
                     <div class="inputfield">
                        
                        <p>Already have an account with us? <a href="login_form.php">Sign in</a></p>
                     </div>
                  </div>
            </form>   
      </div>	

</body>
</html>
<script>
function validateInput() {
  var input = document.getElementById('fmyInput').value;
  var regex = /^[A-Za-z]+$/; 

  if (!regex.test(input)) {
    
    document.getElementById('fmyInput').value = '';
  }
}
function validateInput() {
  var input = document.getElementById('lmyInput').value;
  var regex = /^[A-Za-z]+$/; 

  if (!regex.test(input)) {
    
    document.getElementById('lmyInput').value = '';
  }
}
</script>