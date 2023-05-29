<!-- 建立SQL連線 -->
<?php

    

    function user_add($conn , $name , $password , $email , $phone , $account , $gender , $type){
        $password = password_hash($password ,PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (name, password, email, phone, account, gender, type) VALUES (?, ?, ?, ?, ?, ? , ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssii' , $name , $password , $email , $phone , $account ,$gender, $type);
        $stmt->execute();
    }

    
        

?>