<?php

    //  新增點名 
    function roll_call_create($conn , $account, $year, $state){  
    
        $sql = "INSERT INTO roll_call_state_record (account, year, state) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii' ,  $account, $year, $state);
        return $stmt->execute(); 
    }

    //  根據帳號和年份查詢點名
    function roll_call_read_account_year($conn , $account, $year){   
    
        $sql = "SELECT * FROM roll_call_state_record 
                JOIN border ON roll_call_state_record.account = border.account 
                    AND roll_call_state_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE roll_call_state_record.account = ? AND border.year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,$account , $year);
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
                WHERE roll_call_state_record.state = ? AND border.year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' ,$state , $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據年份查詢暫時出入證
    function roll_call_read_year($conn , $year){  
        
        $sql = "SELECT * FROM roll_call_state_record 
                JOIN border ON roll_call_state_record.account = border.account 
                    AND roll_call_state_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE border.year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  查詢全部暫時出入證
    function roll_call_read_all($conn){  
        
        $sql = "SELECT * FROM roll_call_state_record
                JOIN border ON roll_call_state_record.account = border.account 
                    AND roll_call_state_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account ";

        $result = $conn->query($sql);
        return $result;
    }

    // 根據id更新state
    function roll_call_update($conn , $access_card_id , $state){  

        $sql = "UPDATE roll_call_state_record SET state = ? WHERE roll_call_state_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' , $state , $access_card_id);
        return $stmt->execute();
    }

    //  根據id刪除暫時出入證
    function roll_call_delete($conn , $access_card_id){     

        $sql = "DELETE FROM roll_call_state_record WHERE roll_call_state_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $access_card_id);
        return $stmt->execute();
    }
    
    
?>