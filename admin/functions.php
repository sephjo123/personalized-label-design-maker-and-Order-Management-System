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

    function display_user(){
        global $conn;
        $search_user = isset($_GET['search1']) ? $_GET['search1'] : '';
        $sql = "SELECT * FROM user_form WHERE CONCAT(first_name, last_name, email, mobile, address, user_type, date_added) LIKE '%$search_user%' && availability='active' ORDER BY date_added DESC;";    

        $search_user_details = $conn->query($sql);
  

        return $search_user_details;
    }

    // DISPLAY YET TO APPROVED ORDER TO ADMIN SIDE //
    function display_orders(){
        global $conn;
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile, date_order) LIKE '%$search_user%' && status = 'Yet to be approved';";
  
        $search_order_details = $conn->query($sql);


        return $search_order_details;
    }

        // -- Display  Approved Orders---admin panel -- //
    function display_all_approved_order(){
        global $conn;
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile, date_order) LIKE '%$search_user%' && status = 'Approved' && processing = '4 Business Days' ;";

        $search_approved_order_details = $conn->query($sql);

        return $search_approved_order_details;
    }

            // -- Display  Approved Orders---admin panel -- //
            function display_all_Rushapproved_order(){
                global $conn;
                $search_user = isset($_GET['search']) ? $_GET['search'] : '';
                $sql = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile, date_order) LIKE '%$search_user%' && status = 'Approved' && processing = '2 Business Days' ;";
        
                $search_Rushapproved_order_details = $conn->query($sql);
        
                return $search_Rushapproved_order_details;
            }

     // -- Display to claim -- admin panel --//
     function display_to_claim_admin(){
        global $conn;
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile, date_order) LIKE '%$search_user%' && status = 'To Claim' ;";

        $result = $conn->query($sql);

        return $result;
    }

     // -- Display claimed orders-- admin panel --//
    function display_claimed_admin(){
        global $conn;
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile, date_order) LIKE '%$search_user%' && status = 'Claimed' ORDER BY date_order DESC ;";

        $result = $conn->query($sql);

        return $result;
    }
    // -- Display cancelled by customer orders -- admin panel --//
    function display_cancelled_by_customer(){
        global $conn;
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile, date_order) LIKE '%$search_user%' && status = 'Cancelled by customer' ORDER BY date_order DESC ;";

        $result = $conn->query($sql);

        return $result;
    }

    // -- Display cancelled by admin -- admin panel --//
    function display_cancelled_admin(){
        global $conn;
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM order_form WHERE CONCAT(order_id, ref_num, payer_name, email, mobile, date_order) LIKE '%$search_user%' && status = 'Cancelled by Admin' ORDER BY date_order DESC ;";

        $result = $conn->query($sql);

        return $result;
    }

    // -- display logs -- //
    function display_logs(){
        global $conn;
        $search_user = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM logs WHERE CONCAT(admin_name, action, date) LIKE '%$search_user%' ORDER BY date DESC;";
  
        $search_logs_details = $conn->query($sql);


        return $search_logs_details;
    }


         // -- Display to claim -- admin panel --//
         function display_month(){
            global $conn;
            // $search_user = isset($_GET['search']) ? $_GET['search'] : '';
            $sql = "SELECT COUNT(*) FROM order_form WHERE MONTH(date_order)= 4";
    
            $result1 = $conn->query($sql);
            $fetch = mysqli_num_rows($result1);
    
            return $fetch;
        }

?>