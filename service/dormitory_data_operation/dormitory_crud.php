<?php

    //  新增宿舍 
    function dormitory_create($conn , $dormitory_id , $name){  
    
        $sql = "INSERT INTO dormitory (dormitory_id , name) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('is' ,$dormitory_id ,$name);
        return $stmt->execute(); 
    }

    //  根據id查詢宿舍
    function dormitory_read($conn , $dormitory_id){   
               
        $sql = "SELECT * FROM dormitory WHERE dormitory_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$dormitory_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據id查詢宿舍的所有房間
    function dormitory_read_all_room($conn , $dormitory_id){   
               
        $sql = "SELECT * FROM dormitory 
                JOIN room ON dormitory.dormitory_id = room.dormitory_id
                WHERE dormitory.dormitory_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$dormitory_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  查詢全部宿舍
    function dormitory_read_all($conn){  
        
        $sql = "SELECT * FROM dormitory";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據id刪除宿舍
    function dormitory_delete($conn , $dormitory_id){     

        $sql = "DELETE FROM dormitory WHERE dormitory_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$dormitory_id);
        return $stmt->execute();
    }

    //  刪除全部宿舍
    function dormitory_delete_all($conn){     

        $sql = "DELETE FROM dormitory";
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    //  根據id更新宿舍的名稱
    function dormitory_update($conn , $dormitory_id , $name){  

        $sql = "UPDATE dormitory SET name = ?  WHERE dormitory_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' , $name , $dormitory_id);
        return $stmt->execute();
    }
    
    
?>