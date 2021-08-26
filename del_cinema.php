<?php
    require_once('connect_db.php');
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $c_id = $_POST['c_id'];
        
        $query = "DELETE FROM cinema_info WHERE c_id = '".$c_id."' ";
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