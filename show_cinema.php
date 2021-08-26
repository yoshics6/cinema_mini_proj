<?php
    require_once('connect_db.php');
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $select_stmt = $db->prepare("SELECT * FROM cinema_info ORDER BY C_ID");
        $select_stmt->execute();
        
        $data_arr = array();
        $data_arr['result'] = array();
        
        while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $data_items = array(
            "c_id"                              => $c_id,
            "c_title"                           => $c_title,
            "c_description"                     => $c_description,
            "c_contact_information"             => $c_contact_information,
            "c_created_timestamp"               => $c_created_timestamp,
            "c_latest_ticket_update_timestamp"  => $c_latest_ticket_update_timestamp,
            "c_status" => $c_status
            );
            array_push($data_arr['result'], $data_items);
        }
        echo json_encode($data_arr);
        http_response_code(200);
    }
    else{
        http_response_code(405);
    }
?>