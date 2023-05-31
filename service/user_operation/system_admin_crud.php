<?php

    require_once('service/user_operation/user_crud.php');
    // 新增系統管理員 
    function system_admin_create($conn , $name , $password , $email , $phone , $account , $gender , $type){

        user_create($conn , $name , $password , $email , $phone , $account , $gender , $type);

        $sql = "INSERT INTO system_administrator (account) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' , $account);
        return $stmt->execute();
    }

    // 查詢系統管理員
    function system_admin_read($conn , $account){

        $sql = "SELECT * FROM user JOIN system_administrator ON user.account = system_administrator.account WHERE user.account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        $stmt->execute();
        return $stmt->get_result();
    }
    
    // 查詢所有系統管理員
    function system_admin_read_all($conn){

        $sql = "SELECT * FROM user JOIN system_administrator ON user.account = system_administrator.account";
        $result = $conn->query($sql);  
        return $result;
    }

    function system_admin_root_check($conn , $account){

        return ($account == "root");
    }

    
?>