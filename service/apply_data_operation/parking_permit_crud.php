<?php


    //  新增停車證 state預設0
    function parking_permit_create($conn , $account){  
    
        $sql = "INSERT INTO parking_permit_record (account) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        return $stmt->execute(); 
    }

    //  根據account查詢停車證
    function parking_permit_read($conn , $account){   
               
        $sql = "SELECT * FROM parking_permit_record 
                JOIN parent ON parent.parent_account = parking_permit_record.account
                JOIN user ON parent.parent_account = user.account
                WHERE parent.parent_account = ?
                ORDER BY parking_permit_record.datetime DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據id查詢停車證
    function parking_permit_read_id($conn , $parking_permit_id){   
               
        $sql = "SELECT * FROM parking_permit_record 
                JOIN parent ON parent.parent_account = parking_permit_record.account
                JOIN user ON parent.parent_account = user.account
                WHERE parking_permit_record.parking_permit_record_id = ?
                ORDER BY parking_permit_record.datetime DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$parking_permit_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據state查詢停車證
    function parking_permit_read_state($conn , $state){   
               
        $sql = "SELECT * FROM parking_permit_record 
                JOIN parent ON parent.parent_account = parking_permit_record.account
                JOIN user ON parent.parent_account = user.account
                WHERE parking_permit_record.state = ?
                ORDER BY parking_permit_record.datetime DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$state);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  查詢全部停車證
    function parking_permit_read_all($conn){  
        
        $sql = "SELECT * FROM parking_permit_record
                JOIN parent ON parent.parent_account = parking_permit_record.account
                JOIN user ON parent.parent_account = user.account
                ORDER BY parking_permit_record.datetime DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據id更新停車證state
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
    

    // 生成qrcode data
    function parking_permit_gen_qrcode_data($conn , $parking_permit_id){
        $rel = parking_permit_read_id($conn , $parking_permit_id);
        if($rel->num_rows == 0)
            return -1;
        $rel = $rel->fetch_assoc();

        $message = $rel['parent_account'] . "|" . $rel['student_account'] . "|" .  $rel['parking_permit_record_id'];
        $qrcode_data = encrypt_qrcode_data($GLOBALS['url'] , $message , "parking_permit");
        return $qrcode_data;
    }
    
    // 驗證qrcode data
    function parking_permit_check_qrcode_data($conn , $cipgher){
        $msg = decrypt_qrcode_data($cipgher);
        $msg = explode("|" , $msg);

        if( count($msg) < 3)
            return -1;

        $rel = parking_permit_read_id($conn , $msg[2]);
        if($rel->num_rows == 0)
            return -1;

        $rel = $rel->fetch_assoc();
        if($rel['parent_account'] == $msg[0] && $rel['state'] == 1){
            return $rel['parking_permit_record_id'];
        }
        else
            return -1;
        
    }
    
?>