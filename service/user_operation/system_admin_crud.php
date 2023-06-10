<?php

    // 新增系統管理員 
    function system_admin_create($conn , $name , $password , $email , $phone , $account , $gender , $type){

        user_create($conn , $name , $password , $email , $phone , $account , $gender , $type);

        $sql = "INSERT INTO system_administrator (account) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' , $account);
        return $stmt->execute();
    }

    // 查詢系統管理員
    function system_admin_read($conn , $account){

        $sql = "SELECT * FROM user 
                JOIN system_administrator ON user.account = system_administrator.account 
                WHERE user.account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        $stmt->execute();
        return $stmt->get_result();
    }
    
    // 查詢所有系統管理員
    function system_admin_read_all($conn){

        $sql = "SELECT * FROM user 
                JOIN system_administrator ON user.account = system_administrator.account";
        $result = $conn->query($sql);  
        return $result;
    }

    function system_admin_root_check($conn , $account){

        return ($account == "root");
    }

    function system_admin_choose_all_border($conn,$year){
        
        $need_people =array();
        # 第一、第二優先分配後，剩下的男女生
        $remain_account=array(array(),array());
        # 第一、第二優先分配後，剩下的人數
        $remain_need_people = array(0,0) ;
        
        # 每間宿舍需要的人數
        for($i=0 ; $i<=3 ; $i++){
            array_push($need_people,system_admin_get_room_number($conn,$i));
        }
        for($priority=1; $priority<=2; $priority++){
            for($dorm_id=0 ; $dorm_id<4; $dorm_id++){
                # 獲取當年申請住宿的學生account
                $apply_account = apply_dorm_read_priority_dorm_by_year($conn,$year,$priority,$dorm_id);
                # 抽籤，return 該宿舍剩餘數量，還沒被分配到的學生
                $return_array= system_admin_choose_border($conn,$year,$dorm_id,$need_people[$dorm_id],$apply_account);
                $need_people[$dorm_id] = $return_array[0];
                # 分配完第二次後
                if($priority==2){
                    
                    # 0 , 2 : 男  1 ,3 : 女
                    # 將男女分開
                    for($i=0 ; $i < count($return_array[1]) ;$i++){
                        array_push($remain_account[$dorm_id%2],$return_array[1][$i]);
                    }
                    $remain_need_people[$dorm_id%2] += $need_people[$dorm_id];
                }
            }
        }
        # 如果有剩餘房間 且 還有人沒被抽到 ，就分最後一次
        for($i=0;$i<=1;$i++){
            if($remain_need_people[$i] > 0 && count($remain_account[$i]) > 0){
                for($dorm_id=0 ; $dorm_id<3; $dorm_id+=2){
                    $return_array= system_admin_choose_border($conn,$year,$dorm_id,$need_people[$dorm_id],$remain_account[$i]);
                    $remain_account[$i] = $return_array[1];
                }
            }
            # 設置 apply_state 為 2 不通過
            for($j=0 ; $j < count($remain_account[$i]) ;$j++){
                apply_dorm_update_state($conn,$remain_account[$i][$j],$year,2);
            }
        }
            
    
    }

    // 抽border
    function system_admin_choose_border($conn ,$year,$dorm_id,$need_people,$apply_account){
        
        $cur_people = 0;
        while($cur_people < $need_people && count($apply_account) > 0){
            # 抽號碼
            $number = rand(0,count($apply_account)-1);
            # 抽到變為border
            border_create($conn , $apply_account[$number] , $year);
            # 更改所屬宿舍編號
            border_update_dorm_room($conn, $apply_account[$number], $dorm_id, NULL, $year);
            # 更改該apply_dorm state
            apply_dorm_update_state($conn,$apply_account[$number],$year,1);
            # 移除抽到的號碼
            array_splice( $apply_account, $number,1);
            $cur_people += 1;
        }

        return array($need_people - $cur_people, $apply_account);
    }

    function system_admin_get_room_number($conn,$dorm_id){

        $sql = "SELECT COUNT(room_number) * room.num_of_people FROM room
                WHERE room.dormitory_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $dorm_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_array()[0];
        
    }

?>