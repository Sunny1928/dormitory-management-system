<?php

    // 新增規範
    function rule_create($conn , $point , $content){  
    
        $sql = "INSERT INTO rule (point , content) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('is' ,$point ,$content);
        return $stmt->execute(); 
    }

    // 根據rule_id查詢規範
    function rule_read($conn , $rule_id){   
               
        $sql = "SELECT * FROM rule WHERE rule_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$rule_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 查詢全部規範
    function rule_read_all($conn){  
        
        $sql = "SELECT * FROM rule";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }


    // 根據id刪除規範
    function rule_delete($conn , $rule_id){     

        $sql = "DELETE FROM rule WHERE rule_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$rule_id);
        return $stmt->execute();
    }
    
    
?>