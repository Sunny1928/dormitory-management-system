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
               
        $sql = "SELECT * FROM public_equipment 
                JOIN dormitory ON dormitory.dormitory_id = public_equipment.dormitory_id
                WHERE public_equipment.dormitory_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i' ,$dormitory_id );
        $stmt->execute();
        return $stmt->get_result();
    }

    //  查詢全部公共設備
    function public_equipment_read_all($conn){  
        
        $sql = "SELECT * FROM public_equipment
                JOIN dormitory ON dormitory.dormitory_id = public_equipment.dormitory_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 根據public_equipment_id更新公共設備
    function public_equipment_update($conn , $public_equipment_id , $name ,  $apply_fix_state  , $expired_year){  

        $sql = "UPDATE public_equipment 
                SET name = ? , apply_fix_state = ? , expired_year = ?
                WHERE public_equipment_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('siis' , $name ,$apply_fix_state , $expired_year , $public_equipment_id);
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