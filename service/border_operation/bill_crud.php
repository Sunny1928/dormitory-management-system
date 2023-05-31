<?php

    //  新增住宿繳費 
    function bill_create_room_fee($conn , $account , $title , $year){  
    
        $sql = "SELECT fee FROM room 
                JOIN border ON room.room_number = border.room_number
                    AND room.dormitory_id = border.dormitory_id
                WHERE border.account = ? AND border.year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' ,  $account , $year);
        $stmt->execute();
        $rel = $stmt->get_result();
        $fee = $rel->fetch_assoc()["fee"];
        mysqli_stmt_close($stmt);

        $sql = "INSERT INTO bill (account , type , title , fee , year) VALUES (?, 0, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssii' ,  $account , $title , $fee , $year);
        return $stmt->execute(); 
    }

    //  新增其他繳費 
    function bill_create($conn , $account , $type , $title , $fee , $year){  

        $sql = "INSERT INTO bill (account , type , title , fee , year) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sisii' ,  $account , $type , $title , $fee , $year);
        return $stmt->execute(); 
    }

    //  根據帳號和年份查詢繳費
    function bill_read_account_year($conn , $account , $year){   
               
        $sql = "SELECT * FROM bill
                JOIN border ON bill.account = border.account 
                    AND bill.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE bill.account = ? AND border.year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si' , $account , $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據帳號、年份和是否繳費查詢繳費
    function bill_read_account_year_state($conn , $account , $year , $state){   
               
        $sql = "SELECT * FROM bill
                JOIN border ON bill.account = border.account 
                    AND bill.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account 
                WHERE bill.account = ? AND border.year = ? AND bill.state = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii' , $account , $year , $state);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據年份和是否繳費查詢繳費
    function bill_read_year_state($conn , $year , $state){  
        
        $sql = "SELECT * FROM bill
                JOIN border ON bill.account = border.account 
                    AND bill.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account
                WHERE border.year = ? AND bill.state = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' , $year , $state);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  根據年份查詢繳費
    function bill_read_year($conn , $year){  
        
        $sql = "SELECT * FROM bill
                JOIN border ON bill.account = border.account 
                    AND bill.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account
                WHERE border.year = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $year);
        $stmt->execute();
        return $stmt->get_result();
    }

    //  查詢全部繳費
    function bill_read_all($conn){  
        
        $sql = "SELECT * FROM bill
                JOIN border ON bill.account = border.account 
                    AND bill.year = border.year 
                JOIN student ON student.account = border.account 
                JOIN user ON user.account = student.account";

        $result = $conn->query($sql);
        return $result;
    }

    // 根據bill_id更新state
    function bill_update($conn , $bill_id , $state){  

        $sql = "UPDATE bill SET state = ? WHERE bill_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' , $state , $bill_id);
        return $stmt->execute();
    }

    //  根據id刪除繳費
    function bill_delete($conn , $bill_id){     

        $sql = "DELETE FROM bill WHERE bill_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $bill_id);
        return $stmt->execute();
    }
    
    
?>