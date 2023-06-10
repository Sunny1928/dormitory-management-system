<?php

    // 新增公告
    function announcement_create($conn , $account , $title , $content , $send_mail = false){  
    
        $sql = "INSERT INTO announcement (account , title , content) VALUES (? , ? , ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss' ,$account , $title , $content);
        $stmt->execute(); 

        if($send_mail == True)
            announcement_send_mail($conn , $account , $title , $content);

        return;
    }

    //  寄送繳費mail
    function announcement_send_mail($conn , $account , $title , $content){  

        $rel = student_read_all($conn);
        
        if($rel->num_rows > 0){
            while ($student = $rel->fetch_assoc()) {
                $message = $content;
                send_email($student['email'] , "高雄大學宿舍公告 : " . $title , $message);
            }
        }

    }

    // 根據account查詢公告
    function announcement_read($conn , $account){   
               
        $sql = "SELECT * FROM announcement 
                JOIN user ON user.account = announcement.account 
                WHERE user.account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 查詢全部公告
    function announcement_read_all($conn){  
        
        $sql = "SELECT * FROM announcement 
                JOIN user ON user.account = announcement.account";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據id更新公告內容
    function announcement_update($conn , $announcement_id , $title , $content){  

        $sql = "UPDATE announcement 
                SET  title = ? , content = ?
                WHERE announcement_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi' , $title , $content , $announcement_id);
        return $stmt->execute();
    }

    // 根據id刪除公告
    function announcement_delete($conn , $announcement_id){     

        $sql = "DELETE FROM announcement WHERE announcement_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$announcement_id);
        return $stmt->execute();
    }
    
    
?>