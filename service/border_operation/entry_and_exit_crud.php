<?php


    //  新增進出宿舍紀錄 
    function entry_and_exit_create($conn , $account, $state, $year){  
    
        $sql = "INSERT INTO entry_and_exit_dormitory_record (account, state, year) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii' ,$account , $state , $year);
        return $stmt->execute(); 
    }

    //  根據帳號和年份查詢進出宿舍紀錄
    function entry_and_exit_read_account_year($conn , $account, $year){   
               
        $sql = "SELECT * FROM entry_and_exit_dormitory_record 
                JOIN border ON entry_and_exit_dormitory_record.account = border.account 
                    AND entry_and_exit_dormitory_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE entry_and_exit_dormitory_record.account = ? AND border.year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,$account, $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據年份查詢進出宿舍紀錄
    function entry_and_exit_read_year($conn , $year){   
               
        $sql = "SELECT * FROM entry_and_exit_dormitory_record 
                JOIN border ON entry_and_exit_dormitory_record.account = border.account 
                    AND entry_and_exit_dormitory_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE border.year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  查詢全部進出宿舍紀錄
    function entry_and_exit_read_all($conn){  
        
        $sql = "SELECT * FROM entry_and_exit_dormitory_record
                JOIN border ON entry_and_exit_dormitory_record.account = border.account 
                    AND entry_and_exit_dormitory_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account";
                
        $result = $conn->query($sql);
        return $result;
    }

    //  根據id刪除進出宿舍紀錄
    function entry_and_exit_delete($conn , $entry_and_exit_id){     

        $sql = "DELETE FROM entry_and_exit_dormitory_record WHERE entry_and_exit_dormitory_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$entry_and_exit_id);
        return $stmt->execute();
    }
    
?>