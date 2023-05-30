<?php

    // 新增住宿生
    function border_create($conn , $account , $year){

        $sql = "INSERT INTO border (account , year) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' , $account , $year);
        return $stmt->execute();
    }

    // 分配住宿生的宿舍大樓及房間
    function border_update_dorm_room($conn , $account , $dorm_id , $room_number){

        $sql = "UPDATE border SET dormitory_id = ? , room_number = ? WHERE account = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iss' , $dorm_id , $room_number , $account);
        return $stmt->execute();
    }


    // 將住宿生設為退宿狀態
    function border_update_quit($conn , $account){

        $sql = "UPDATE border SET type = 1 , room_number = NULL , dormitory_id = NULL WHERE account = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' , $account);
        return $stmt->execute();
    }

    // 查詢該學生的所有住宿資料
    function border_read_student($conn , $account){

        $sql = "SELECT * FROM student JOIN border ON student.account = border.account WHERE student.account = ?";        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        $stmt->execute();

        return $stmt->get_result();
    }

    // 查詢該年度的所有住宿資料
    function border_read_year($conn , $year){

        $sql = "SELECT * FROM student JOIN border ON student.account = border.account WHERE border.year = ?";        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $year);
        $stmt->execute();

        return $stmt->get_result();
    }

?>