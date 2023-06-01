<?php

    // 新增舍監 
    function dorm_manager_create($conn , $name , $password , $email , $phone , $account , $gender , $type){

        user_create($conn , $name , $password , $email , $phone , $account , $gender , $type);

        $sql = "INSERT INTO dorm_manager (account) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' , $account);
        return $stmt->execute();
    }

    // 查詢舍監
    function dorm_manager_read($conn , $account){

        $sql = "SELECT * FROM user 
                JOIN dorm_manager ON user.account = dorm_manager.account 
                WHERE user.account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        $stmt->execute();
        return $stmt->get_result();
    }
    
    // 查詢所有舍監
    function dorm_manager_read_all($conn){

        $sql = "SELECT * FROM user 
                JOIN dorm_manager ON user.account = dorm_manager.account";
        $result = $conn->query($sql);  
        return $result;
    }

    
?>