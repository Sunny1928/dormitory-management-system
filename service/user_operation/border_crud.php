<?php
    /*
    type    
        -0 住宿生 
        -1 無效 
    */

    // 新增住宿生
    function border_create($conn , $account , $year){

        $sql = "INSERT INTO border (account , year) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' , $account , $year);
        return $stmt->execute();
    }

    // 分配住宿生的宿舍大樓及房間
    function border_update_dorm_room($conn , $account , $dorm_id , $room_number , $year){

        $sql = "UPDATE border 
                SET dormitory_id = ? , room_number = ? 
                WHERE account = ? AND year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issi' , $dorm_id , $room_number , $account , $year);
        return $stmt->execute();
    }


    // 將住宿生設為退宿狀態
    function border_update_quit($conn , $account , $year){

        $sql = "UPDATE border 
                SET type = 1 , room_number = NULL , dormitory_id = NULL 
                WHERE account = ? AND year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' , $account , $year);
        return $stmt->execute();
    }

    // 查詢該學生的所有住宿資料
    function border_read_student($conn , $account){

        $sql = "SELECT user.* , border.* , dormitory.dormitory_id  , dormitory.name as dormitory_name FROM student 
                JOIN border ON student.account = border.account 
                JOIN user ON user.account = student.account 
                LEFT JOIN dormitory ON dormitory.dormitory_id = border.dormitory_id
                WHERE student.account = ?";        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        $stmt->execute();

        return $stmt->get_result();
    }

    // 查詢該年度的所有住宿資料
    function border_read_year($conn , $year){

        $sql = "SELECT user.* , border.* , dormitory.dormitory_id  , dormitory.name as dormitory_name FROM student 
                JOIN border ON student.account = border.account 
                JOIN user ON user.account = student.account 
                LEFT JOIN dormitory ON dormitory.dormitory_id = border.dormitory_id
                WHERE border.year = ?";        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $year);
        $stmt->execute();

        return $stmt->get_result();
    }

    // 查詢所有住宿生
    function border_read_all($conn){

        $sql = "SELECT user.* , border.* , dormitory.dormitory_id  , dormitory.name as dormitory_name FROM student 
                JOIN border ON student.account = border.account 
                JOIN user ON user.account = student.account
                LEFT JOIN dormitory ON dormitory.dormitory_id = border.dormitory_id";        
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->get_result();
    }

    // 查詢住宿生的室友
    function border_read_roommate($conn , $account , $year){

        $sql = "SELECT * FROM border
                JOIN student ON border.account = student.account
                JOIN user ON user.account = student.account
                JOIN dormitory ON dormitory.dormitory_id = border.dormitory_id
                WHERE EXISTS  (
                    SELECT dormitory_id , room_number FROM border
                    WHERE account = ? AND year = ?
                ) AND year = ?" ;        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii' ,$account, $year , $year);
        $stmt->execute();

        return $stmt->get_result();
    }


    function border_update($conn , $account , $year , $type, $apply_story_manager_state, $room_number ,$dormitory_id){

        $sql = "UPDATE border 
                SET type = ? ,apply_story_manager_state =? , room_number = ? , dormitory_id = ? 
                WHERE account = ? AND year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iisisi' ,$type, $apply_story_manager_state, $room_number ,$dormitory_id, $account , $year);
        return $stmt->execute();
    }

    function border_delete($conn , $account , $year){

        $sql = "DELETE FROM border 
                WHERE account = ? AND year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,$account , $year);
        return $stmt->execute();
    }
?>