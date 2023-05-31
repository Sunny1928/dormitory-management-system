<?php

    //  新增設備 
    function equipment_create($conn , $dormitory_id , $room_number , $name , $expired_year){  
    
        $sql = "INSERT INTO equipment (dormitory_id , room_number , name , expired_year) VALUES (? ,? ,? ,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issi' , $dormitory_id , $room_number , $name , $expired_year);
        return $stmt->execute(); 
    }

    //  根據宿舍和房號查詢設備
    function equipment_read_dormid_roomnum($conn , $dormitory_id , $room_number){   
               
        $sql = "SELECT * FROM equipment WHERE dormitory_id = ? AND room_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('is' ,$dormitory_id , $room_number);
        return $stmt->execute();
    }

    //  查詢全部設備
    function equipment_read_all($conn){  
        
        $sql = "SELECT * FROM equipment";
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    // 根據equipment_id更新設備apply_fix_state
    function equipment_update($conn , $equipment_id , $apply_fix_state){  

        $sql = "UPDATE equipment SET apply_fix_state = ? WHERE equipment_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' ,$apply_fix_state , $equipment_id);
        return $stmt->execute();
    }



    //  根據設備id刪除設備
    function equipment_delete($conn , $equipment_id){     

        $sql = "DELETE FROM equipment WHERE equipment_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $equipment_id);
        return $stmt->execute();
    }
    
    
?>