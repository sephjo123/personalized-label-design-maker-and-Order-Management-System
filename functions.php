<?php

    session_start();

    require_once 'config.php';

    // Display material price //
    function display_material_price(){
        global $conn;
        $query = "select * from item_materials";
        $result = mysqli_query($conn,$query);
        return $result;
    }

    // -- Display Pending Orders -- //
    function display_order(){
        global $conn;
        $user_id = $_SESSION['ID'];
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $query = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile) LIKE '%$search_user%' && customer_id = '$user_id' && status = 'Yet to be approved' ORDER BY date_order DESC";
    
        $result = $conn->query($query);

        return $result;
    }

    // -- Display Approved Orders -- //
    function display_approved_order(){
        global $conn;
        $user_id = $_SESSION['ID'];
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $query = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile) LIKE '%$search_user%' && customer_id = '$user_id' && status = 'Approved' ORDER BY date_order DESC";
        
        $result = $conn->query($query);

        return $result;
    }
    // -- Display to claim Orders -- //
    function display_toClaim_order(){
        global $conn;
        $user_id = $_SESSION['ID'];
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $query = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile) LIKE '%$search_user%' && customer_id = '$user_id' && status = 'To Claim' ORDER BY date_order DESC";
        
        $result = $conn->query($query);

        return $result;
    }

      // -- Display claimed Orders -- //
      function display_orderClaimed(){
        global $conn;
        $user_id = $_SESSION['ID'];
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $query = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile) LIKE '%$search_user%' && customer_id = '$user_id' && status = 'Claimed' ORDER BY date_order DESC";

        $result = mysqli_query($conn,$query);
        return $result;
    }

     // -- Display cancelled Orders customer panel-- //
     function display_cancelled_order(){
        global $conn;
        $user_id = $_SESSION['ID'];
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $query = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile) LIKE '%$search_user%' && customer_id = '$user_id' && status = 'Cancelled by customer' ORDER BY date_order DESC";

        $result = mysqli_query($conn,$query);
        return $result;
    }
      // -- Display cancelled by admin -- customer panel-- //
     function display_cancelled_by_admin(){
        global $conn;
        $user_id = $_SESSION['ID'];
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $query = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile) LIKE '%$search_user%' && customer_id = '$user_id' && status = 'Cancelled by Admin' ORDER BY date_order DESC";

        $result = mysqli_query($conn,$query);
        return $result;
    }

          // -- Display Message list -- customer panel-- //
          function display_message_list(){
            global $conn;
            $user_id = $_SESSION['ID'];
            $search_user = isset($_GET['search']) ? $_GET['search'] : '';
            $query = "SELECT * FROM message_list WHERE CONCAT(from_admin, message, date_messaged) LIKE '%$search_user%' && customer_id = '$user_id' && un_read = '0' ORDER BY date_messaged DESC";
    
            $result_message_list = mysqli_query($conn,$query);
            return $result_message_list;
        }

                  // -- Display Message list -- customer panel-- //
                  function display_marked_readMessage_list(){
                    global $conn;
                    $user_id = $_SESSION['ID'];
                    $search_user = isset($_GET['search']) ? $_GET['search'] : '';
                    $query = "SELECT * FROM message_list WHERE CONCAT(from_admin, message, date_messaged) LIKE '%$search_user%' && customer_id = '$user_id' ORDER BY date_messaged DESC";
            
                    $result_message_list = mysqli_query($conn,$query);
                    return $result_message_list;
                }

                function display_user(){
                    global $conn;
                    $search_user = isset($_GET['search']) ? $_GET['search'] : '';
                    $sql = "SELECT * FROM user_form WHERE CONCAT(first_name, last_name, email, mobile, address, user_type, date_added) LIKE '%$search_user%' && availability='active' ORDER BY date_added DESC;";    
            
                    $search_user_details = $conn->query($sql);
              
            
                    return $search_user_details;
                }


?>