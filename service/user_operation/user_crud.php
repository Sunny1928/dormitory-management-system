<?php

    // 新增用戶 
    function user_create($conn , $name , $password , $email , $phone , $account , $gender , $type){
        $password = password_hash($password ,PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (name, password, email, phone, account, gender, type) VALUES (?, ?, ?, ?, ?, ? , ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssii' , $name , $password , $email , $phone , $account ,$gender, $type);
        return $stmt->execute();
    }

    // 刪除用戶
    function user_delete($conn , $account){
        

        $sql = "DELETE FROM user WHERE account=?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' , $account);
        return $stmt->execute();
    }

    // 刪除全部用戶
    function user_delete_all($conn ){
        
        $sql = "DELETE FROM user ";
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }
    
    // 更新user
    function user_update($conn , $name, $email , $phone , $account , $gender){
        

        $sql = "UPDATE user 
                SET name = ? , email = ? , phone = ? , gender = ? 
                WHERE account = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssis', $name, $email , $phone , $gender , $account);
        return $stmt->execute();
    }

    
    // 更新密碼
    function user_update_password($conn , $account , $password){
        

        $password = password_hash($password ,PASSWORD_DEFAULT);

        $sql = "UPDATE user SET password = ? WHERE account=?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $account , $password);
        return $stmt->execute();
    }

    // 查詢用戶資訊
    function user_read($conn , $account){

        $sql = "SELECT * FROM user WHERE account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 查詢所有用戶資訊
    function user_read_all($conn){

        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);

        return $result;
    }
    
    
    // 登入驗證 帳號錯誤 or 密碼錯誤 False 成功 True
    function user_login_verify($conn , $account , $password){
        
        $rel = user_read($conn, $account);
        
        if($rel->num_rows == 0)
            return False;
        
        return password_verify($password, $rel->fetch_assoc()["password"]);
    }
    
    // 設定權限
    function user_set_permissions($permissions){
        $_SESSION['permission'] = $permissions;
    }

    // 檢查權限
    function user_check_permissions($permissions){
        if (! isset($_SESSION['permission']))
            return False;

        return $_SESSION['permission'] == $permissions;
    }

    // 移除權限
    function user_reset_permissions(){
        unset($_SESSION['permission']);
    }
?>