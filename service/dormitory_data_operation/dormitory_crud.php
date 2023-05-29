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
        return $stmt->execute();
    }

    //  查詢全部宿舍
    function dormitory_read_all($conn){  
        
        $sql = "SELECT * FROM dormitory";
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    //  根據id刪除宿舍
    function dormitory_delete($conn , $dormitory_id){     

        $sql = "DELETE FROM dormitory WHERE dormitory_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$dormitory_id);
        return $stmt->execute();
    }
    
    
?>