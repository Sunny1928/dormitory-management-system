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
                WHERE apply_quit_dorm.account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
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

        $sql = "UPDATE apply_quit_dorm 
                SET state = ? WHERE apply_quit_dorm_id = ?";
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
    

    // 根據id查詢退宿學生的帳號和學年
    function quit_dorm_read_account_year_by_id($conn ,$apply_quit_dorm_id){   
    
        $sql = "SELECT account,year FROM apply_quit_dorm 
                WHERE apply_quit_dorm.apply_quit_dorm_id = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$apply_quit_dorm_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據student為分宿生 與 刪除 該家長帳號
    function quit_dorm_delete_data($conn ,$apply_quit_dorm_id  , $state){
        quit_dorm_update($conn,$apply_quit_dorm_id , $state);
        $rowData =quit_dorm_read_account_year_by_id($conn,$apply_quit_dorm_id)->fetch_array(MYSQLI_NUM);
        $account = $rowData[0];
        $year = $rowData[1];
        border_update_quit($conn,$account,$year);
        $parent_account = parents_read_student($conn,$account)->fetch_array(MYSQLI_NUM)[4];
        user_delete($conn,$parent_account);
    }

    // 根據account與 year找退宿申請的state，判斷是否刪除
    function quit_dorm_state_check_process($conn, $apply_quit_dorm_id , $state){
        
        # 如果state = 1 ，通過才刪除資料
        if($state){
            quit_dorm_delete_data($conn,$apply_quit_dorm_id, $state);
        }
        # state = 2 ， 不通過
        else if($state == 2){
            quit_dorm_update($conn,$apply_quit_dorm_id , $state);
        }
    }
    
?>