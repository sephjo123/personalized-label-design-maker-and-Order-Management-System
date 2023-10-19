<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

// -- user id -- //
$user_id = $_SESSION['ID'];


$result = mysqli_query($conn, "SELECT * FROM user_form where ID = $user_id");
while($row = mysqli_fetch_array($result)){
$fname = $row['first_name'];
$lname = $row['last_name'];
$email = $row['email'];
$mobile = $row['mobile'];
$address = $row['address'];
$id = $row['ID'];
$user_identifier = $row['id_user'];
$profile = $row['profile_pic'];


}
if($_SESSION['ID'])
	{
		
// update user details -- //
if(isset($_POST['submit'])){

   $user_id = mysqli_real_escape_string($conn, $_SESSION['ID']);
   $nname = mysqli_real_escape_string($conn, $_POST['nfirst_name']);
   $lname = mysqli_real_escape_string($conn, $_POST['nlast_name']);
   $nemail = mysqli_real_escape_string($conn, $_POST['nemail']);
   $nmobile = mysqli_real_escape_string($conn, $_POST['nmobile']);
   $naddress = mysqli_real_escape_string($conn, $_POST['naddress']);
   
   $query = "UPDATE user_form SET first_name = '$nname', last_name = '$lname', email = '$nemail', 
   mobile = '$nmobile', address = '$naddress'WHERE id= $user_id ";

   
   $query_run = mysqli_query($conn, $query);
   if($query_run) {
   $_SESSION['message'] = "Your account has been updated successfully!";
   header('location: profile.php');
   exit(0);
   }
   else {
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
   <title>User Details</title>
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
         .profile_pic{
            height: 200px;
            width: 200px;
            border: solid white 5px;
            border-radius: 50%;
            
         }
         .profile_pic2{
            height: 400px;
            width: 400x;
            border: solid white 5px;
           =
         }
         .image-container{
            justify-content: center;
            align-items: center;
            display: flex;
         }
              /* Popup Calendar Styles */
        .calendar-popup {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .calendar-container {
            background-color: #2B2B2B;
            padding: 20px;
            border-radius: 4px;
        }

        .calendar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .calendar-header h2 {
            margin: 0;
        }

        .calendar-header .close {
            cursor: pointer;
        } 
        .img-share{
            height: 450px;
            width: 450px;
        }
        .designs{
            justify-content: center;
            align-items: center;
            display: flex;
        }
        .dp{
            height: 100px;
            width: 100px;
            border: solid white 5px;
            border-radius: 50%;
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
                    
                                <a class="button-logout" href="index.php">Back</a>
                        </div>

                        <i class='bx bx-menu navOpen-btn'></i>
                </nav>      
    </header>
<body class="body1">

<?php
if(isset($_POST['nprof'])){
    $target_dir = "admin/profile_pics/";
    $target_file = $target_dir  . basename($_FILES["upload_prof"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
   $uplaoadfiles = move_uploaded_file($_FILES["upload_prof"]["tmp_name"], $target_file);

   $target_dir1 = "profile_pics/";
    $target_file1 = $target_dir1  . basename($_FILES["upload_prof"]["name"]);
    $uploadOk1 = 1;
    $imageFileType1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
   
   $uplaoadfiles1 = move_uploaded_file($_FILES["upload_prof"]["tmp_name"], $target_file1);

   $query = "UPDATE user_form SET profile_pic = '$target_file1' WHERE id= $user_id ";
   $query_run = mysqli_query($conn, $query);

   if($query_run){
      echo "<script>alert('Updated Successfully!'); window.location.href='profile.php';</script>";
    }

    else {
        header('location:profile.php');
    }

   
}

?>

  <!-- popup profile  -->
  <div id="calendarPopup" class="calendar-popup">
    <div class="calendar-container">
        <div class="calendar-header">
        <a href ="<?php echo $profile ?>" target="_blank"><img src="admin/<?php echo $profile ?>" alt="" class="profile_pic2"></a>
            <span class="close" onclick="hideCalendar()">&times;</span>
        </div>
        <div class="calendar-body">
            <form action="profile.php" method="post" enctype="multipart/form-data">
            <label for="">Upload new profile picture</label>
                
                <br>
                <input type="file"  name="upload_prof" accept="image/*" required>
                <button type="submit" name="nprof" class="button-login">Submit</button>
            </form>
        </div>
    </div>
</div>
      <div class="wrapper">
               <div class="successmsg">    
                        <h2>
                           <?php 
                                 include('message.php')
                              ?> 
                        </h2> 
               </div>
         
            <form action="profile.php"  method="post" enctype="multipart/form-data">
                  <div class="title">
                     User Details 
                  </div>
                  <div class="image-container">
                     <a onclick="showCalendar()"><img src="admin/<?php echo $profile ?>" alt="" class="profile_pic"></a> 
                  </div>
                  <br>
                  <br>
                  <div class="form">
                     <div class="inputfield">
                        <label>First Name:</label>
                        <input type="text" name="nfirst_name" value="<?php echo $fname ?>" id = "pfmyInput" oninput="tvalidateInput()"  class="input" required>
                     </div>  
                     <div class="inputfield">
                        <label>Last Name:</label>
                        <input type="text" name="nlast_name" value="<?php echo $lname ?>" id = "lmyInput" oninput="uvalidateInput()" class="input" required>
                     </div>
                     <div class="inputfield">
                        <label>Email:</label>
                        <input type="email" name="nemail" value="<?php echo $email ?>" class="input" required>
                     </div>   
                      
                     <div class="inputfield">
                        <label>Phone Number:</label>
                        <input type="text" name="nmobile" value="<?php echo $mobile ?>" class="input" required>
                        
                     </div>
                     <div class="inputfield">
                        <label>Address</label>
                        <input type="text" name="naddress" value="<?php echo $address ?>"  class="input" required>
                     </div> 
                     <div class="inputfield">
                        <label>ID</label>
                        <p><?php echo $user_identifier ?></p>
                   </div> 
                     
                     <div class="inputfield">
                     <input type="submit" name="submit" value="Update" class="button-login">
                     </div>
                     <div class="inputfield">
                        
                        <p> <a href="update-newpassword.php">Update password</a></p>
                     </div>

                   
                  </div>
            </form>   
      </div>	

</body>
</html>
<?php
	}
	else
	{
		if($_SESSION['admin_name'])
		{
			header("location:admin-page.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>
<script>
    function showCalendar(requestId) {
        var calendarPopup = document.getElementById('calendarPopup');
        calendarPopup.style.display = 'flex';
        document.getElementById('requestId').value = requestId;
    }

    function hideCalendar() {
        var calendarPopup = document.getElementById('calendarPopup');
        calendarPopup.style.display = 'none';
    }

</script>

<script>
function tvalidateInput() {
  var input = document.getElementById('pfmyInput').value;
  var regex = /^[A-Za-z]+$/; 

  if (!regex.test(input)) {
    
    document.getElementById('pfmyInput').value = '';
  }
}
function uvalidateInput() {
  var input = document.getElementById('lmyInput').value;
  var regex = /^[A-Za-z]+$/; 

  if (!regex.test(input)) {
    
    document.getElementById('lmyInput').value = '';
  }
}
</script>