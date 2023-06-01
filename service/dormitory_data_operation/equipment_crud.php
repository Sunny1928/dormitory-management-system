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
               
        $sql = "SELECT dormitory.dormitory_id  , dormitory.name as dormitory_name , room.* ,  equipment.* FROM equipment
                JOIN room ON equipment.dormitory_id = room.dormitory_id 
                    AND equipment.room_number = room.room_number
                JOIN dormitory ON equipment.dormitory_id = dormitory.dormitory_id
                WHERE room.dormitory_id = ? AND room.room_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('is' ,$dormitory_id , $room_number);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  查詢全部設備
    function equipment_read_all($conn){  
        
        $sql = "SELECT dormitory.dormitory_id  , dormitory.name as dormitory_name , room.* ,  equipment.* FROM equipment
                JOIN room ON equipment.dormitory_id = room.dormitory_id 
                    AND equipment.room_number = room.room_number
                JOIN dormitory ON equipment.dormitory_id = dormitory.dormitory_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據equipment_id更新設備apply_fix_state
    function equipment_update($conn , $equipment_id ,$expired_year,$name, $apply_fix_state,$room_number,$dormitory_id){  

        $sql = "UPDATE equipment SET expired_year = ? , name =? , apply_fix_state = ? , room_number=? , dormitory_id =? WHERE equipment_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isisii' ,$expired_year , $name , $apply_fix_state,$room_number,$dormitory_id , $equipment_id);
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