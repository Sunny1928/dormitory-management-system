<?php


    // 新增申請住宿
    function apply_dorm_create($conn , $account){  
    
        $sql = "INSERT INTO apply_dorm (account) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        return $stmt->execute(); 
    }

    // 根據account查詢申請住宿
    function apply_dorm_read($conn , $account){   
               
        $sql = "SELECT * FROM apply_dorm WHERE account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        return $stmt->execute();
    }

    // 查詢全部申請住宿
    function apply_dorm_read_all($conn){  
        
        $sql = "SELECT * FROM apply_dorm";
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    // 根據id更新申請住宿state
    function apply_dorm_update($conn , $apply_dorm_id , $state){  

        $sql = "UPDATE apply_dorm SET state = ? WHERE apply_dorm_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' ,$state ,$apply_dorm_id);
        return $stmt->execute();
    }

    // 根據id刪除申請住宿
    function apply_dorm_delete($conn , $apply_dorm_id){     

        $sql = "DELETE FROM apply_dorm WHERE apply_dorm_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$apply_dorm_id);
        return $stmt->execute();
    }
    
    
?>