<?php

    //  新增公共設備 
    function public_equipment_create($conn , $dormitory_id  , $name , $expired_year){  
    
        $sql = "INSERT INTO public_equipment (dormitory_id  , name , expired_year) VALUES (? ,? ,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isi' , $dormitory_id  , $name , $expired_year);
        return $stmt->execute(); 
    }

    //  根據宿舍查詢公共設備
    function public_equipment_read($conn , $dormitory_id ){   
               
        $sql = "SELECT * FROM public_equipment WHERE dormitory_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$dormitory_id );
        return $stmt->execute();
    }

    //  查詢全部公共設備
    function public_equipment_read_all($conn){  
        
        $sql = "SELECT * FROM public_equipment";
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }

    // 根據public_equipment_id更新設備apply_fix_state
    function public_equipment_update($conn , $public_equipment_id , $apply_fix_state){  

        $sql = "UPDATE public_equipment SET apply_fix_state = ? WHERE public_equipment_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii' ,$apply_fix_state , $public_equipment_id);
        return $stmt->execute();
    }



    //  根據公共設備id刪除公共設備
    function public_equipment_delete($conn , $public_equipment_id){     

        $sql = "DELETE FROM public_equipment WHERE public_equipment_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' , $public_equipment_id);
        return $stmt->execute();
    }
    
    
?>