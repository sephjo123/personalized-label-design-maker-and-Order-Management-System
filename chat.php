<?php

@include 'config.php';
require_once 'functions.php';


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
         *{
	padding: 0;
	margin: 0;
	box-sizing: border-box;
	font-family: sans-serif;
}
.container1 {
	width: 500px;
	margin: auto;
}
.chat {
	display: flex;
	flex-direction: column;
	height: 100vh;
	background: #f1f0e8;
}
.chat-header {
	display: flex;
	cursor: pointer;
}
.profile {
	width: 100%;
	background: gray;
	display: flex;
	align-items: center;
	height: 60px;
	padding: 0px 10px;
	position: relative;
}
.profile .pp {
	width: 50px;
    height: 50px;
	display: inline-block;
	border-radius: 50%;
	margin-left: 32px;
    border: solid 2px;
}
.profile .arrow {
	display: inline-block;
	width: 30px;
	position: absolute;
	top: 19px;
	cursor: pointer;
}
.profile h2 {
	display: inline-block;
	line-height: 60px;
	vertical-align: bottom;
	color: #fff;
	font-size: 20px;
}
.profile span {
	color: #ccc;
	position: absolute;
	top: 42px;
	left: 100px;
	font-size: 14px;
}
.right .icon {
	display: inline-block;
	width: 25px;
	margin-left: 10px;
}
.profile .left {
	flex: 1;
}

.chat-box {
	background: url('../img/bg.jpeg');
	background-attachment: fixed;
	padding-left: 20px;
	overflow-y: scroll;
	flex: 1;
}
.chat-box .img_chat {
	width: 280px;
}

.chat-r {
	display: flex;
}
.chat-r .sp {
	flex: 1;
}

.chat-l {
	
}
.chat-l .sp {
	flex: 1;
}

.chat-box .mess {
	max-width: 450px;
    height: 100px;
	background: black;
	padding: 10px;
	border-radius: 10px;
	margin: 20px 5px;
	cursor: pointer;
}
.chat-box .mess p {
	word-break: break-all;
	font-size: 18px;
}
.chat-box .mess-r {
    background: gray;
}
.chat-box .emoji {
	width: 20px;
}
.chat-box .check {
	float: right;
}
.chat-box .check img {
	width: 20px;
}
.chat-box .check span {
	color: white;
	font-size: 12px;
	font-weight: 700px;
}

*::-webkit-scrollbar {
	width: 5px;
}
*::-webkit-scrollbar-track {
	background: #f1f1f1;
}
*::-webkit-scrollbar-thumb {
	background: #aaa;
}
*::-webkit-scrollbar-thumb:hover {
	background: #555;
}

.chat-footer {
	display: flex;
	justify-content: center;
	align-items: center;
	border-radius: 60px;
	position: relative;
	cursor: pointer;
}
.chat-footer textarea {
	display: block;
	flex: 1;
	width: 100%;
	height: 50px;
	border-radius: 60px;
	margin: 5px;
	padding: 10px;
	outline: none;
	font-size: 19px;
	padding-left: 40px;
	padding-right: 90px;
	border: 2px solid #ccc;
	color: #555;
	resize: none;
}
.chat-footer .mic {
	display: block;
	width: 55px;
	height: 55px;
	margin-right: 20px;
}

.chat-footer .emo{
	display: block;
	width: 35px;
	height: 35px;
	position: absolute;
	left: 10px;
	top: 12px;
}
.chat-footer .icons {
	position: absolute;
	right: 100px;
	top: 10px;
}
.chat-footer .icons img{
    display: inline-block;
    width: 35px;
    height: 35px;
    margin-left: 5px;
}
.button-login{
    border-radius: 40%;
    padding: 10px;
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
                    
                                <a class="button-logout" href="all-user-chatlist.php">Back</a>
                        </div>

                        <i class='bx bx-menu navOpen-btn'></i>
                </nav>
        
    </header>
 <!-- Get user Id -->
 <?php

if(isset($_GET['id']))
{
$user_id = mysqli_real_escape_string($conn, $_GET['id']);
// $your_id = mysqli_real_escape_string($conn, $_GET['you_id']);
$query = "SELECT * FROM user_form WHERE ID ='$user_id' ";
$query_run = mysqli_query($conn, $query);

if(mysqli_num_rows($query_run) > 0)
{
    $user = mysqli_fetch_array($query_run);
    $receiver_email = $user['email'];
    $receiver_id = $user['ID'];
?>
<body class="body1">

   
        <div class="container1">
                <div class="chat">
                    <div class="chat-header">
                        <div class="profile">
                            <div class="left">
                               
                                <img src="admin/<?php echo $user['profile_pic'] ?>" class="pp">
                                <h2><?php echo $user['first_name']?> <?php echo $user['last_name'] ?></h2>
                                <span><?php echo $user['availability'] ?></span>
                            </div>
                            <div class="right">
                               
                            </div>
                        </div>
                    </div>
                    <div class="chat-box">
                        
                        
                    <?php
                    
                    $message_sent = "SELECT * FROM message_list WHERE sender_id = '$id' || sender_id = '$receiver_id' && customer_id = '$receiver_id' || customer_id = '$id' ORDER BY date_messaged ASC ;";
                    $query_run = mysqli_query($conn, $message_sent);
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        echo "
                        <div class='chat-l'>
                            <div class='mess'>
                            <h2>
                            ".$row['from_admin']."
                            </h2>
                            <br>
                                <p>
                                ".$row['message']."
                                </p>
                                <div class='check'>
                                    <span>".date("M d, Y H:i:s", strtotime($row['date_messaged']))."</span>
                                </div>
                            </div>
                            <div class='sp'></div>
                        </div>
                        ";}

                        // $message_sent1 = "SELECT * FROM message_list WHERE sender_id = '$receiver_id' && customer_id = '$id' ORDER BY date_messaged ASC ;";
                        // $query_run1 = mysqli_query($conn, $message_sent1);
                        // while ($row1 = mysqli_fetch_assoc($query_run1)) {
                        // echo "
                        // <div class='chat-l'>
                        //     <div class='mess'>
                        //     <h2>
                        //     ".$row1['from_admin']."
                        //     </h2>
                        //     <br>
                        //         <p>
                        //         ".$row1['message']."
                        //         </p>
                        //         <div class='check'>
                        //             <span>".date("M d, Y H:i:s", strtotime($row1['date_messaged']))."</span>
                        //         </div>
                        //     </div>
                        //     <div class='sp'></div>
                        // </div>
                        // ";}
                    
                            ?>
                       
                    </div>
    
    <?php
    if(isset($_POST['send']))
    {
        $admin_id_message = mysqli_real_escape_string($conn, $_POST['admin_id']);
        $message_to_admin = mysqli_real_escape_string($conn, $_POST['message_to_admin']);
        $from_customer = mysqli_real_escape_string($conn, $_POST['from']);
        $sender_id = mysqli_real_escape_string($conn, $_POST['sender_id']);
    
        if(($message_to_admin) == false) {
            echo "<script>alert('Type a message'); window.location.href='chat.php?id=" .$receiver_id."';</script>";
        }else{
        $query = "INSERT INTO message_list (from_admin, customer_id, sender_id, message) VALUES('$from_customer ', '$admin_id_message', '$sender_id', '$message_to_admin' )";
        $query_run = mysqli_query($conn, $query);
    
        if($query_run)
        {
            $_SESSION['message'] = "Your message has sent!";
            echo "<script>alert('Message has sent'); window.location.href='chat.php?id=" .$receiver_id."';</script>";
            exit(0);
        }else
        {
            $_SESSION['message'] = "Not Updated";
            header("Location:material-price-update.php");
            exit(0);
        }
    }
}
    
    ?>
                    <form action="" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="from" value="<?php echo $_SESSION['email']?>">
                        <input type="hidden" name="admin_id" value="<?php echo $receiver_id ?>">
                        <input type="hidden" name="sender_id" value="<?php echo $id?>">

                            <div class="chat-footer">                  
                                <textarea name= "message_to_admin" placeholder="Type a message" require></textarea>
                                <div class="icons">
                                    <img src="images/camera.png">
                                </div>
                                <button type="submit" name ="send" class="button-login">Send</button>
                            </div>
                        </form>
                </div>
            </div>
            <?php
            }
            else
            {
                echo "<h4>No Such Id Found</h4>";
            }
            }
        ?> 

</body>
</html>