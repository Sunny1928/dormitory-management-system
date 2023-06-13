<?php


    // 新增換宿申請
    function change_dorm_create($conn , $account, $year, $another_border, $student_state = 0){  
    
        $rel = border_read_student_year($conn , $another_border , $year);
        $rel = $rel->fetch_assoc();
        $change_room_number = $rel['room_number'];
        $change_dorm_id = $rel['dormitory_id'];

        $sql = "INSERT INTO apply_change_dorm (account, year, change_dorm_id, change_room_number, another_border, student_state) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('siissi' ,$account, $year, $change_dorm_id, $change_room_number, $another_border, $student_state);
        return $stmt->execute(); 
    }

    // 新增換宿流程
    function change_dorm_create_process($conn , $account, $year, $another_border){

        change_dorm_create($conn , $account, $year, $another_border , 1);
        change_dorm_create($conn , $another_border, $year, $account);
    }

    // 根據account和year查詢換宿申請(包含another_border)
    function change_dorm_read_account_year($conn , $account, $year){   
               
        $sql = "SELECT * FROM apply_change_dorm 
                JOIN student ON apply_change_dorm.account = student.account
                JOIN user ON user.account = student.account
                JOIN border ON apply_change_dorm.another_border = border.account AND border.year = apply_change_dorm.year
                WHERE apply_change_dorm.account = ? OR apply_change_dorm.another_border = ? AND border.year = ?
                ORDER BY apply_change_dorm.datetime	DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi' ,$account ,$account ,$year);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據account和year查詢換宿申請
    function change_dorm_read_self_account_year($conn , $account, $year){   
            
        $sql = "SELECT * FROM apply_change_dorm 
                JOIN student ON apply_change_dorm.account = student.account
                JOIN user ON user.account = student.account
                JOIN border ON apply_change_dorm.another_border = border.account AND border.year = apply_change_dorm.year
                WHERE apply_change_dorm.account = ? AND border.year = ?
                ORDER BY apply_change_dorm.datetime	DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,$account ,$year);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據account查詢換宿申請
    function change_dorm_read_account($conn , $account){   
            
        $sql = "SELECT * FROM apply_change_dorm 
                JOIN student ON apply_change_dorm.account = student.account
                JOIN user ON user.account = student.account
                JOIN border ON apply_change_dorm.another_border = border.account AND border.year = apply_change_dorm.year
                WHERE apply_change_dorm.account = ? OR apply_change_dorm.another_border = ?
                ORDER BY apply_change_dorm.datetime	DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss' ,$account ,$account);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 查詢全部換宿申請
    function change_dorm_read_all($conn){  
        
        $sql = "SELECT * FROM apply_change_dorm 
                JOIN border ON apply_change_dorm.another_border = border.account 
                    AND border.year = apply_change_dorm.year
                JOIN student ON apply_change_dorm.account = student.account
                JOIN user ON user.account = student.account
                ORDER BY apply_change_dorm.datetime	DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 修改換宿申請-舍監同意
    function change_dorm_manager_agree_update($conn , $apply_change_dorm_id, $account, $another_border, $year, $change_dorm_id, $change_room_number){

        change_dorm_update_process($conn , $apply_change_dorm_id , 1, 2, $another_border, $year);

        $rel = border_read_student_year($conn , $account , $year);
        $rel = $rel->fetch_assoc();
        $change_dorm_id2 = $rel['dormitory_id'];
        $change_room_number2 = $rel['room_number'];

        border_update_dorm_room($conn , $account , $change_dorm_id , $change_room_number , $year);
        border_update_dorm_room($conn , $another_border , $change_dorm_id2 , $change_room_number2 , $year);
    }

    // 更新換宿申請流程
    function change_dorm_update_process($conn , $apply_change_dorm_id ,$student_state, $final_state, $new_another_border, $year){  

        $rel = border_read_student_year($conn , $new_another_border , $year);
        $rel = $rel->fetch_assoc();
        $change_room_number = $rel['room_number'];
        $change_dorm_id = $rel['dormitory_id'];

        $sql = "UPDATE apply_change_dorm 
                SET student_state = ? , final_state = ? , account = ? , year = ?
                WHERE account = (SELECT another_border FROM apply_change_dorm WHERE apply_change_dorm_id = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iisii' ,$student_state ,$final_state ,$new_another_border ,$year , $apply_change_dorm_id);
        $stmt->execute();
        
        $sql = "UPDATE apply_change_dorm 
                SET student_state = ? , final_state = ? , another_border = ? , change_dorm_id = ? , change_room_number = ?
                WHERE apply_change_dorm_id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iisisi' ,$student_state ,$final_state ,$new_another_border 
                    , $change_dorm_id , $change_room_number ,$apply_change_dorm_id);
        $stmt->execute();
    }

    // 根據account year刪除換宿申請
    function change_dorm_delete_account_year($conn , $account , $another_border , $year){     

        $sql = "DELETE FROM apply_change_dorm WHERE account = ? AND another_border = ? AND year = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi' ,$account , $another_border , $year);
        return $stmt->execute();
    }

    // 刪除換宿流程
    function change_dorm_delete_process($conn , $account , $year , $another_border){     

        change_dorm_delete_account_year($conn , $account , $another_border , $year);
        change_dorm_delete_account_year($conn , $another_border , $account , $year);
    }
?>