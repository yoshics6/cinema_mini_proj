<?php
    require_once('connect_db.php');
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $c_id                               = $_POST['c_id'];
        $c_title                            = $_POST['c_title'];
        $c_description                      = $_POST['c_description'];
        $c_contact_information              = $_POST['c_contact_information'];
        $c_created_timestamp                = $_POST['c_created_timestamp'];
        $c_latest_ticket_update_timestamp   = date("d/m/Y , H:i:s A", strtotime(date("Y/m/d , h:i:s")));
        $c_status                           = $_POST['c_status'];
        
        $query = "UPDATE cinema_info SET 
        c_title = '".$c_title."' , c_description = '".$c_description."' , 
        c_contact_information = '".$c_contact_information."' , c_status = '".$c_status."' , c_created_timestamp = '".$c_created_timestamp."' , c_latest_ticket_update_timestamp = '".$c_latest_ticket_update_timestamp."' 
        WHERE c_id = '".$c_id."' ";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $items_arr = array();
        $items_arr['result'] = array();
        
        $items = array(
        "msg" => "success",
        "code" => 200
        );
        array_push($items_arr['result'], $items);
        echo json_encode($items_arr);
        
        http_response_code(200);
    }
    else {
        http_response_code(405);
    }
?>