<?php

    //  新增申請暫時出入證 
    function access_card_create($conn , $account, $year){  
    
        $sql = "INSERT INTO temporary_access_card_record (account, year) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,  $account, $year);
        return $stmt->execute(); 
    }

    //  根據帳號和年份查詢暫時出入證
    function access_card_read_account_year($conn , $account, $year){   
    
        $sql = "SELECT * FROM temporary_access_card_record 
                JOIN border ON temporary_access_card_record.account = border.account 
                    AND temporary_access_card_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE temporary_access_card_record.account = ? AND border.year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,$account , $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據年份查詢暫時出入證
    function access_card_read_year($conn , $year){  
        
        $sql = "SELECT * FROM temporary_access_card_record 
                JOIN border ON temporary_access_card_record.account = border.account 
                    AND temporary_access_card_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE border.year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  查詢全部暫時出入證
    function access_card_read_all($conn){  
        
        $sql = "SELECT * FROM temporary_access_card_record 
                JOIN border ON temporary_access_card_record.account = border.account 
                    AND temporary_access_card_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account ";

        $result = $conn->query($sql);
        return $result;
    }

    // 根據id更新state
    function access_card_update($conn , $access_card_id , $state){  

        $sql = "UPDATE temporary_access_card_record SET state = ? WHERE temporary_access_card_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' , $state , $access_card_id);
        return $stmt->execute();
    }

    //  根據id刪除暫時出入證
    function access_card_delete($conn , $access_card_id){     

        $sql = "DELETE FROM temporary_access_card_record WHERE temporary_access_card_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $access_card_id);
        return $stmt->execute();
    }
    
    
?>