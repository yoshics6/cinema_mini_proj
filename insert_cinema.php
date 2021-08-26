<?php
    require_once('connect_db.php');
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $c_title_add                            = $_POST['c_title_add'];
        $c_description_add                      = $_POST['c_description_add'];
        $c_contact_information_add              = $_POST['c_contact_information_add'];
        $c_created_timestamp_add                = $_POST['c_created_timestamp_add'];
        $c_latest_ticket_update_timestamp_add   = $_POST['c_latest_ticket_update_timestamp_add'];
        $c_status_add                           = $_POST['c_status_add'];
        
        $query = "INSERT INTO cinema_info (c_id,c_title,c_description,c_contact_information,c_created_timestamp,
        c_latest_ticket_update_timestamp,c_status) 
        VALUES 
        ('', '".$c_title_add."' , '".$c_description_add."' , '".$c_contact_information_add."' , 
        '".$c_created_timestamp_add."' , '".$c_latest_ticket_update_timestamp_add."' , '".$c_status_add."')";
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
    else{
        http_response_code(405);
    }
?>