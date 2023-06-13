<?php


    // 新增申請住宿
    function apply_dorm_create($conn , $account , $year , $first_priority_dorm,$second_priority_dorm){  
    
        $sql = "INSERT INTO apply_dorm (account,year,first_priority_dorm,second_priority_dorm) VALUES (? , ? , ? , ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('siii' ,$account,$year, $first_priority_dorm,$second_priority_dorm);
        $stmt->execute(); 
        return $stmt->get_result();
    }

    # 根據year找出申請學生(Account)
    function apply_dorm_read_year_number($conn ,$year){
        $sql = "SELECT apply_dorm.account FROM apply_dorm
                WHERE apply_dorm.year = ?
                ORDER BY apply_dorm.datetime DESC";
        
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
    // 根據 account ,year更改apply_dorm state
    function apply_dorm_update_state($conn,$account,$year,$state){
        
        # 得到目前apply的 state
        $sql = "UPDATE apply_dorm SET state = ?  
                WHERE apply_dorm.account = ? AND apply_dorm.year = ?
                ORDER BY apply_dorm.datetime DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isi' ,$state,$account,$year);
        return $stmt->execute();
        
    }
    # 根據year、優先順序、宿舍找出申請學生(Account)
    # first priority : 1 , second priority : 2 
    # OA :0, OB :1 , OE :2 ,OF :3
    function apply_dorm_read_priority_dorm_by_year($conn ,$year, $priority , $dorm){
        
        #  判斷優先順序
        $prior = "first";
        if($priority == 2){
            $prior = "second";
        }
        $sql = "SELECT apply_dorm.account FROM apply_dorm
                WHERE apply_dorm.year = ?  AND apply_dorm.state = 0 AND apply_dorm.".$prior."_priority_dorm = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' ,$year ,$dorm);
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
                WHERE apply_dorm.account = ? AND apply_dorm.year = ?
                ORDER BY apply_dorm.datetime DESC";
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
                WHERE user.account = ?
                ORDER BY apply_dorm.datetime DESC";
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
                WHERE apply_dorm.state = ?
                ORDER BY apply_dorm.datetime DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$state);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 查詢全部申請住宿
    function apply_dorm_read_all($conn){  
        
        $sql = "SELECT * FROM apply_dorm
                JOIN student ON apply_dorm.account = student.account
                JOIN user ON user.account = student.account
                ORDER BY apply_dorm.datetime DESC";
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

    // 將不是當年的資料 更新state
    function apply_dorm_set_state($conn , $state ,$year){  

        $sql = "UPDATE apply_dorm SET state = ? WHERE year != ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' ,$state ,$year);
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