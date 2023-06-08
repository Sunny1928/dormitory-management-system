<?php


    // 新增換宿申請
    function change_dorm_create($conn , $account, $year, $another_border){  
    
        $rel = border_read_student_year($conn , $another_border , $year);
        $rel = $rel->fetch_assoc();
        $change_room_number = $rel['room_number'];
        $change_dorm_id = $rel['dormitory_id'];

        $sql = "INSERT INTO apply_change_dorm (account, year, change_dorm_id, change_room_number, another_border) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('siiss' ,$account, $year, $change_dorm_id, $change_room_number, $another_border);
        return $stmt->execute(); 
    }

    // 根據account和year查詢換宿申請
    function change_dorm_read_account_year($conn , $account, $year){   
               
        $sql = "SELECT * FROM apply_change_dorm 
                JOIN student ON apply_change_dorm.account = student.account
                JOIN user ON user.account = student.account
                JOIN border ON apply_change_dorm.another_border = border.account AND border.year = apply_change_dorm.year
                WHERE apply_change_dorm.account = ? OR apply_change_dorm.another_border = ? AND border.year = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi' ,$account ,$account ,$year);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據account查詢換宿申請
    function change_dorm_read_account($conn , $account){   
            
        $sql = "SELECT * FROM apply_change_dorm 
                JOIN student ON apply_change_dorm.account = student.account
                JOIN user ON user.account = student.account
                JOIN border ON apply_change_dorm.another_border = border.account AND border.year = apply_change_dorm.year
                WHERE apply_change_dorm.account = ? OR apply_change_dorm.another_border = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss' ,$account ,$account);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據student_state和year查詢換宿申請
    function change_dorm_read_student_state_year($conn , $student_state , $year){   
            
        $sql = "SELECT * FROM apply_change_dorm 
                JOIN border ON apply_change_dorm.account = border.account 
                    AND apply_change_dorm.year = border.year 
                JOIN student ON apply_change_dorm.account = student.account
                JOIN user ON user.account = student.account
                WHERE apply_change_dorm.student_state = ? AND apply_change_dorm.year = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' ,$student_state ,$year);
        $stmt->execute();
        return $stmt->get_result();
    }


    // 根據student_state查詢換宿申請
    function change_dorm_read_student_state($conn , $student_state){   
               
        $sql = "SELECT * FROM apply_change_dorm 
                JOIN border ON apply_change_dorm.account = border.account 
                    AND apply_change_dorm.year = border.year 
                JOIN student ON apply_change_dorm.account = student.account
                JOIN user ON user.account = student.account
                WHERE apply_change_dorm.student_state = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$student_state);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據final_state查詢換宿申請
    function change_dorm_read_final_state_year($conn , $final_state , $year){   
        
        $sql = "SELECT * FROM apply_change_dorm 
                JOIN border ON apply_change_dorm.account = border.account 
                    AND apply_change_dorm.year = border.year 
                JOIN student ON apply_change_dorm.account = student.account
                JOIN user ON user.account = student.account
                WHERE apply_change_dorm.final_state = ? AND apply_change_dorm.year = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' ,$final_state ,$year);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據final_state查詢換宿申請
    function change_dorm_read_final_state($conn , $final_state){   
            
        $sql = "SELECT * FROM apply_change_dorm 
                JOIN border ON apply_change_dorm.account = border.account 
                    AND apply_change_dorm.year = border.year 
                JOIN student ON apply_change_dorm.account = student.account
                JOIN user ON user.account = student.account
                WHERE apply_change_dorm.final_state = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$final_state);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 查詢全部換宿申請
    function change_dorm_read_all($conn){  
        
        $sql = "SELECT * FROM apply_change_dorm 
                JOIN border ON apply_change_dorm.another_border = border.account 
                    AND border.year = apply_change_dorm.year
                JOIN student ON apply_change_dorm.account = student.account
                JOIN user ON user.account = student.account";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據id更新換宿資料
    function change_dorm_update($conn , $apply_change_dorm_id ,$student_state, $final_state, $another_border, $year){  

        $rel = border_read_student_year($conn , $another_border , $year);
        $rel = $rel->fetch_assoc();
        $change_room_number = $rel['room_number'];
        $change_dorm_id = $rel['dormitory_id'];

        $sql = "UPDATE apply_change_dorm 
                SET student_state = ? , final_state = ? , another_border = ? 
                    , year = ? , change_room_number = ? , change_dorm_id = ? 
                WHERE apply_change_dorm_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iisisii' ,$student_state ,$final_state ,$another_border, $year, $change_room_number, $change_dorm_id, $apply_change_dorm_id);
        return $stmt->execute();
    }

    // 根據id刪除換宿申請
    function change_dorm_delete($conn , $apply_change_dorm_id){     

        $sql = "DELETE FROM apply_change_dorm WHERE apply_change_dorm_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$apply_change_dorm_id);
        return $stmt->execute();
    }
    
    
?>