<?php

    // 新增公告
    function announcement_create($conn , $account , $content){  
    
        $sql = "INSERT INTO announcement (account , content) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss' ,$account ,$content);
        return $stmt->execute(); 
    }

    // 根據account查詢公告
    function announcement_read($conn , $account){   
               
        $sql = "SELECT * FROM announcement WHERE account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        return $stmt->execute();
    }

    // 查詢全部公告
    function announcement_read_all($conn){  
        
        $sql = "SELECT * FROM announcement";
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    // 根據id更新公告內容
    function announcement_update($conn , $announcement_id , $content){  

        $sql = "UPDATE announcement SET content = ? WHERE announcement_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,$content ,$announcement_id);
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