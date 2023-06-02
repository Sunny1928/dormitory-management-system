<?php

    // 新增家長 
    function parents_create($conn , $name , $password , $email , $phone , $account , $gender , $type , $student_account){

        user_create($conn , $name , $password , $email , $phone , $account , $gender , $type);

        $sql = "INSERT INTO parent (parent_account , student_account) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss' , $account ,  $student_account);
        return $stmt->execute();
    }

    // 用學生帳號查詢家長資訊
    function parents_read_student($conn , $account){
        
        $sql = "SELECT * FROM user 
                WHERE account IN 
                    (SELECT parent_account FROM student 
                        JOIN parent ON parent.student_account = student.account 
                        WHERE student.account = ?)";        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        $stmt->execute();
        
        return $stmt->get_result();
    }

    // 用家長帳號查詢小孩學生資訊
    function parents_read_border_info($conn , $account , $year){
        
        $sql = "SELECT student_account FROM parent WHERE parent.parent_account = ?";        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        $stmt->execute();
        
        $rel = $stmt->get_result();
        $student_account = $rel->fetch_assoc()['student_account'];
        
        return border_read_student_year($conn , $student_account , $year);
    }

    // 用家長帳號查詢小孩住宿生資訊
    function parents_read_student_info($conn , $account){
        
        $sql = "SELECT student_account FROM parent WHERE parent.parent_account = ?";        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        $stmt->execute();
        
        $rel = $stmt->get_result();
        $student_account = $rel->fetch_assoc()['student_account'];
        
        return student_read($conn , $student_account);
    }

    // 設定家長 session資料 (家長的小孩user資料及border資料)
    function parents_session_load($conn , $account , $year){
        
        $rel = parents_read_student_info($conn , $account , $year);
        $rel = $rel->fetch_assoc();

        $_SESSION['student_account'] = $rel['account'];
        $_SESSION['student_type'] = $rel['type'];
        $_SESSION['student_gender'] = $rel['gender'];
        $_SESSION['student_name'] = $rel['name'];
        $_SESSION['student_phone'] = $rel['phone'];
        $_SESSION['student_email'] = $rel['email'];

        student_session_load($conn , $rel['account']);

        if(border_check($conn ,$rel['account'], $year))
            border_session_load($conn , $rel['account'] , $year);
        
    }
    
    // 查詢所有家長資訊
    function parents_read_all($conn){
        
        $sql = "SELECT * FROM user 
                JOIN parent ON user.account = parent.parent_account";
        $result = $conn->query($sql);    
        
        return $result;
    }
    
    
    
?>