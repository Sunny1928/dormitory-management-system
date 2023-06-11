<?php

    // 新增學生 
    function student_create($conn , $name , $password , $email , $phone , $account , $gender , $type , $department){

        user_create($conn , $name , $password , $email , $phone , $account , $gender , $type);

        $sql = "INSERT INTO student (account , department) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss' , $account , $department);
        return $stmt->execute();
    }

    // 查詢學生資訊
    function student_read($conn , $account){
        
        $sql = "SELECT * FROM user 
                JOIN student ON user.account = student.account 
                WHERE user.account = ?";        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        $stmt->execute();
        
        return $stmt->get_result();
    }
    
    // 查詢所有學生資訊
    function student_read_all($conn){
        
        $sql = "SELECT * FROM user 
                JOIN student ON user.account = student.account";
        $result = $conn->query($sql);    
        
        return $result;
    }

    // 設定student session資料
    function student_session_load($conn , $account){
        $rel = student_read($conn , $account);
        $rel = $rel->fetch_assoc();

        $_SESSION['department'] = $rel['department'];
    }
    
    //  根據id更新學生系所
    function student_update_department($conn , $account , $department){  

        $sql = "UPDATE student SET department = ? WHERE account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss' ,$department , $account);
        return $stmt->execute();
    }
    
    function student_update($conn , $name, $email , $phone , $account , $gender , $department){
        student_update_department($conn , $account , $department);
        user_update($conn , $name, $email , $phone , $account , $gender);
    }

    function student_read_not_border($conn , $year){
        $sql = "SELECT * FROM user 
                JOIN student ON user.account = student.account 
                WHERE user.account NOT IN (
                    SELECT account FROM border 
                    WHERE year = ?
                )";   
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' , $year);
        $stmt->execute();
        return $stmt->get_result();
    }
?>