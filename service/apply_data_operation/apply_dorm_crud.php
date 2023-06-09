<?php


    // 新增申請住宿
    function apply_dorm_create($conn , $account , $year){  
    
        $sql = "INSERT INTO apply_dorm (account,year) VALUES (? , ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,$account,$year);
        $stmt->execute(); 
        return $stmt->get_result();
    }

    # 根據year找出申請學生(Account)
    function apply_dorm_read_year_number($conn ,$year){
        $sql = "SELECT apply_dorm.account FROM apply_dorm
                JOIN user ON apply_dorm.account = user.account
                WHERE apply_dorm.year = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$year);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $account_array = array();
        while($rowData = $result -> fetch_array()){
            array_push($account_array, $rowData[0]);
        }
        return $account_array;
    }

    // 根據account、year查詢申請住宿
    function apply_dorm_read_account_year($conn , $account , $year){   
    
        $sql = "SELECT * FROM apply_dorm
                JOIN student ON apply_dorm.account = student.account
                JOIN user ON apply_dorm.account = user.account
                WHERE apply_dorm.account = ? AND apply_dorm.year = ?";
        $stmt = $conn->prepare($sql);
        $stmt-> bind_param('si' ,$account, $year);
        $stmt-> execute();
        return $stmt->get_result();

    }

    // 根據account查詢申請住宿
    function apply_dorm_read_account($conn , $account){   
    
        $sql = "SELECT * FROM apply_dorm 
                JOIN student ON apply_dorm.account = student.account
                JOIN user ON user.account = student.account
                WHERE user.account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        $stmt->execute();
        return $stmt->get_result();

    }

    // 根據state查詢申請住宿
    function apply_dorm_read_state($conn , $state){   
    
        $sql = "SELECT * FROM apply_dorm 
                JOIN student ON apply_dorm.account = student.account
                JOIN user ON user.account = student.account
                WHERE apply_dorm.state = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$state);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 查詢全部申請住宿
    function apply_dorm_read_all($conn){  
        
        $sql = "SELECT * FROM apply_dorm
                JOIN student ON apply_dorm.account = student.account
                JOIN user ON user.account = student.account";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
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