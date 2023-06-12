<?php

    //  新增點名 
    function roll_call_create($conn , $account, $year, $state){  
    
        $sql = "INSERT INTO roll_call_state_record (account, year, state) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii' ,  $account, $year, $state);
        return $stmt->execute(); 
    }

    //  根據樓長管理的宿舍、年份和狀態查詢點名
    function roll_call_read_dormitory_year_state($conn , $account, $year, $state){   
    
        $rel = story_manager_read_account_year($conn , $account , $year);
        $dormitory = $rel->fetch_assoc()["type"];
        $dormitory -= 2;

        $sql = "SELECT * FROM roll_call_state_record 
                JOIN border ON roll_call_state_record.account = border.account 
                    AND roll_call_state_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE border.dormitory_id = ? AND border.year = ? AND roll_call_state_record.state = ?
                ORDER BY roll_call_state_record.datetime DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii' ,$dormitory , $year , $state);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據帳號和年份查詢點名
    function roll_call_read_account_year($conn , $account, $year){   
    
        $sql = "SELECT * FROM roll_call_state_record 
                JOIN border ON roll_call_state_record.account = border.account 
                    AND roll_call_state_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE roll_call_state_record.account = ? AND border.year = ?
                ORDER BY roll_call_state_record.datetime DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,$account , $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據帳號查詢點名
    function roll_call_read_account($conn , $account){   
    
        $sql = "SELECT * FROM roll_call_state_record 
                JOIN border ON roll_call_state_record.account = border.account 
                    AND roll_call_state_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE roll_call_state_record.account = ?
                ORDER BY roll_call_state_record.datetime DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據狀態和年份查詢點名
    function roll_call_read_state_year($conn , $state, $year){   
    
        $sql = "SELECT * FROM roll_call_state_record 
                JOIN border ON roll_call_state_record.account = border.account 
                    AND roll_call_state_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE roll_call_state_record.state = ? AND border.year = ?
                ORDER BY roll_call_state_record.datetime DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' ,$state , $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據年份查詢點名
    function roll_call_read_year($conn , $year){  
        
        $sql = "SELECT * FROM roll_call_state_record 
                JOIN border ON roll_call_state_record.account = border.account 
                    AND roll_call_state_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE border.year = ?
                ORDER BY roll_call_state_record.datetime DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據id查詢點名
    function roll_call_read_id($conn , $roll_call_id){  
        
        $sql = "SELECT * FROM roll_call_state_record 
                JOIN border ON roll_call_state_record.account = border.account 
                    AND roll_call_state_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE roll_call_state_record.roll_call_state_record_id = ?
                ORDER BY roll_call_state_record.datetime DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $roll_call_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  查詢全部點名
    function roll_call_read_all($conn){  
        
        $sql = "SELECT * FROM roll_call_state_record
                JOIN border ON roll_call_state_record.account = border.account 
                    AND roll_call_state_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account
                ORDER BY roll_call_state_record.datetime DESC";

        $result = $conn->query($sql);
        return $result;
    }

    // 根據id更新點名
    function roll_call_update($conn , $access_card_id , $state){  

        $sql = "UPDATE roll_call_state_record SET state = ? WHERE roll_call_state_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' , $state , $access_card_id);
        return $stmt->execute();
    }

    //  根據id刪除點名
    function roll_call_delete($conn , $access_card_id){     

        $sql = "DELETE FROM roll_call_state_record WHERE roll_call_state_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $access_card_id);
        return $stmt->execute();
    }

    // 生成qrcode data
    function roll_call_gen_qrcode_data($conn , $roll_call_id){
        $rel = roll_call_read_id($conn , $roll_call_id);
        if($rel->num_rows == 0)
            return -1;
        $rel = $rel->fetch_assoc();

        $message = $rel['account'] . "|" . $rel['year'] . "|" .  $rel['roll_call_state_record_id'];
        $qrcode_data = encrypt_qrcode_data($GLOBALS['url'] , $message , "main.php");
        return $qrcode_data;
    }
    
    // 驗證qrcode data
    function roll_call_check_qrcode_data($conn , $cipgher){
        $msg = decrypt_qrcode_data($cipgher);
        $msg = explode("|" , $msg);

        if( count($msg) < 3)
            return -1;

        $rel = roll_call_read_id($conn ,$msg[2]);
        if($rel->num_rows == 0)
            return -1;

        $rel = $rel->fetch_assoc();
        if($rel['account'] == $msg[0] && $rel['year'] == $msg[1]){
            roll_call_update($conn , $rel['roll_call_state_record_id'] , 1);
            return $rel['roll_call_state_record_id'];
        }
        else
            return -1;
        
    }
    
    function roll_call_read_by_dormitory_id($conn,$dormitory_id){
        $sql = "SELECT * FROM roll_call_state_record 
                JOIN border ON roll_call_state_record.account = border.account 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE border.dormitory_id =  ? 
                ORDER BY roll_call_state_record.datetime DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $dormitory_id);
        $stmt->execute();
        return $stmt->get_result();
    }
?>