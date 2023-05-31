<?php

    //  新增留言
    function message_create($conn , $account , $content){  
    
        $sql = "INSERT INTO message (account , content) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss' ,$account ,$content);
        return $stmt->execute(); 
    }

    //  根據account查詢留言
    function message_read($conn , $account){   
               
        $sql = "SELECT * FROM message 
                JOIN user ON message.account = user.account 
                WHERE user.account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  查詢全部留言
    function message_read_all($conn){  
        
        $sql = "SELECT * FROM message
                JOIN user ON message.account = user.account";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據id更新留言內容
    function message_update($conn , $message_id , $content){  

        $sql = "UPDATE message SET content = ? WHERE message_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,$content ,$message_id);
        return $stmt->execute();
    }

    //  根據id刪除留言
    function message_delete($conn , $message_id){     

        $sql = "DELETE FROM message WHERE message_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$message_id);
        return $stmt->execute();
    }
    
    
?>