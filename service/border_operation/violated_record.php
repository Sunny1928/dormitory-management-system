<?php

    //  新增違規紀錄 
    function violated_record_create($conn , $account , $rule_id, $year){  
    
        $sql = "INSERT INTO violated_record (account , rule_id , year) VALUES (? ,? ,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii' ,  $account , $rule_id , $year);
        return $stmt->execute(); 
    }

    //  根據帳號和年份查詢違規紀錄
    function violated_record_read_account_year($conn , $account, $year){   
            
        $sql = "SELECT * FROM violated_record 
                JOIN rule ON violated_record.rule_id = rule.rule_id 
                JOIN border ON violated_record.account = border.account 
                    AND violated_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE violated_record.account = ?  AND border.year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,$account, $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據帳號查詢違規紀錄
    function violated_record_read_account($conn , $account){   
        
        $sql = "SELECT * FROM violated_record 
                JOIN rule ON violated_record.rule_id = rule.rule_id 
                JOIN border ON violated_record.account = border.account 
                    AND violated_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE violated_record.account = ?
                ORDER BY violated_record.year";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$account);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據年份查詢違規紀錄
    function violated_record_read_year($conn , $year){   
               
        $sql = "SELECT * FROM violated_record 
                JOIN rule ON violated_record.rule_id = rule.rule_id 
                JOIN border ON violated_record.account = border.account 
                    AND violated_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE border.year = ?
                ORDER BY violated_record.account";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  查詢全部違規紀錄
    function violated_record_read_all($conn){  
        
        $sql = "SELECT * FROM violated_record 
                JOIN rule ON violated_record.rule_id = rule.rule_id 
                JOIN border ON violated_record.account = border.account 
                    AND violated_record.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                ORDER BY violated_record.year DESC, violated_record.account";
                
        $result = $conn->query($sql);
        return $result;
    }

    // 根據id更新apply_cancel
    function violated_record_update($conn , $violated_record_id , $apply_cancel,$rule_id){  

        $sql = "UPDATE violated_record SET apply_cancel = ? , rule_id =? WHERE violated_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii' , $apply_cancel,$rule_id , $violated_record_id);
        return $stmt->execute();
    }

    //  根據id刪除違規紀錄
    function violated_record_delete($conn , $violated_record_id){     

        $sql = "DELETE FROM violated_record WHERE violated_record_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $violated_record_id);
        return $stmt->execute();
    }
    
    
?>