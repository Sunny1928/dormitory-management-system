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
    
    // 查詢所有家長資訊
    function parents_read_all($conn){
        
        $sql = "SELECT * FROM user 
                JOIN parent ON user.account = parent.parent_account";
        $result = $conn->query($sql);    
        
        return $result;
    }
    
    
    
?>