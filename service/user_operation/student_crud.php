<?php

    require_once('service/user_operation/user_crud.php');
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
    
    
    
?>