<?php


    // 新增退宿申請
    function quit_dorm_create($conn , $account, $year){  

        $sql = "INSERT INTO apply_quit_dorm (account, year) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,$account, $year);
        return $stmt->execute(); 
    }

    // 根據account和year查詢退宿申請
    function quit_dorm_read_account_year($conn , $account, $year){   
               
        $sql = "SELECT * FROM apply_quit_dorm 
                JOIN border ON apply_quit_dorm.account = border.account 
                    AND apply_quit_dorm.year = border.year
                JOIN student ON apply_quit_dorm.account = student.account
                JOIN user ON user.account = student.account
                WHERE apply_quit_dorm.account = ? AND border.year = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,$account ,$year);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據account查詢退宿申請
    function quit_dorm_read_account($conn , $account){   
            
        $sql = "SELECT * FROM apply_quit_dorm 
                JOIN border ON apply_quit_dorm.account = border.account 
                    AND apply_quit_dorm.year = border.year
                JOIN student ON apply_quit_dorm.account = student.account
                JOIN user ON user.account = student.account
                WHERE apply_quit_dorm.account =";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據state和year查詢退宿申請
    function quit_dorm_read_state_year($conn , $state , $year){   
            
        $sql = "SELECT * FROM apply_quit_dorm 
                JOIN border ON apply_quit_dorm.account = border.account 
                    AND apply_quit_dorm.year = border.year
                JOIN student ON apply_quit_dorm.account = student.account
                JOIN user ON user.account = student.account
                WHERE apply_quit_dorm.state = ? AND apply_quit_dorm.year = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' ,$state ,$year);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據state查詢退宿申請
    function quit_dorm_read_state($conn , $state){   
               
        $sql = "SELECT * FROM apply_quit_dorm 
                JOIN border ON apply_quit_dorm.account = border.account 
                    AND apply_quit_dorm.year = border.year
                JOIN student ON apply_quit_dorm.account = student.account
                JOIN user ON user.account = student.account
                WHERE apply_quit_dorm.state = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$state);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 查詢全部退宿申請
    function quit_dorm_read_all($conn){  
        
        $sql = "SELECT * FROM apply_quit_dorm 
                JOIN border ON apply_quit_dorm.account = border.account 
                    AND apply_quit_dorm.year = border.year
                JOIN student ON apply_quit_dorm.account = student.account
                JOIN user ON user.account = student.account";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據id更新退宿資料
    function quit_dorm_update($conn , $apply_quit_dorm_id , $state){  

        $sql = "UPDATE apply_quit_dorm SET state = ? WHERE apply_quit_dorm_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' , $state , $apply_quit_dorm_id);
        return $stmt->execute();
    }

    // 根據id刪除退宿申請
    function quit_dorm_delete($conn , $apply_quit_dorm_id){     

        $sql = "DELETE FROM apply_quit_dorm WHERE apply_quit_dorm_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$apply_quit_dorm_id);
        return $stmt->execute();
    }
    
    
?>