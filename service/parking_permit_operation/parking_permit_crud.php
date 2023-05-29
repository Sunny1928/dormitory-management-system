<?php


    //  新增停車證 state預設0
    function parking_permit_create($conn , $account){  
    
        $sql = "INSERT INTO parking_permit_record (account, state) VALUES (?, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        return $stmt->execute(); 
    }

    //  根據account查詢停車證
    function parking_permit_read($conn , $account){   
               
        $sql = "SELECT * FROM parking_permit_record WHERE account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        return $stmt->execute();
    }

    //  查詢全部停車證
    function parking_permit_read_all($conn){  
        
        $sql = "SELECT * FROM parking_permit_record";
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    //  根據id更新停車證status
    function parking_permit_update($conn , $parking_permit_record_id, $state){  

        $sql = "UPDATE parking_permit_record SET state = ? WHERE parking_permit_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' ,$state ,$parking_permit_record_id);
        return $stmt->execute();
    }

    //  根據id刪除停車證
    function parking_permit_delete($conn , $parking_permit_record_id){     

        $sql = "DELETE FROM parking_permit_record WHERE parking_permit_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$parking_permit_record_id);
        return $stmt->execute();
    }
    
    
?>