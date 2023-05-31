<?php

    //  新增房間 
    function room_create($conn , $dormitory_id , $room_number , $num_of_people , $fee){  
    
        $sql = "INSERT INTO room (dormitory_id , room_number , num_of_people , fee) VALUES (? ,? ,? ,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isii' , $dormitory_id , $room_number , $num_of_people , $fee);
        return $stmt->execute(); 
    }

    //  根據宿舍及房號查詢房間
    function room_read($conn , $dormitory_id , $room_number){   
               
        $sql = "SELECT * FROM room 
                JOIN dormitory ON dormitory.dormitory_id = room.dormitory_id
                WHERE room.dormitory_id = ? AND room.room_number =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('is' ,$dormitory_id , $room_number);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  查詢全部房間
    function room_read_all($conn){  
        
        $sql = "SELECT * FROM room";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據宿舍和房號更新申請住宿clean_state
    function room_update($conn , $room_number , $dormitory_id , $clean_state){  

        $sql = "UPDATE room SET clean_state = ? WHERE room_number = ? AND dormitory_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isi' ,$clean_state , $room_number , $dormitory_id);
        return $stmt->execute();
    }



    //  根據宿舍和房號刪除房間
    function room_delete($conn , $room_number , $dormitory_id){     

        $sql = "DELETE FROM room WHERE room_number = ? AND dormitory_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' , $room_number , $dormitory_id);
        return $stmt->execute();
    }
    
    
?>