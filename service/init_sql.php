<?php
    
    # 新增 table 初始化資料 
    function data_create_init($conn){
        
        # 新增學生
        for($i=1;$i<=60;$i++){

            if($i < 10 ) $i = "0".$i;
            $gender = 0;
            if($i>=31) $gender =1 ;
            
            student_create($conn,'A10955'.$i,'A10955'.$i,'A10955'.$i.'@mail.nuk.edu.tw','0987654321','A10955'.$i,$gender,3,'csie');
    
        }
        
        # 申請變成住宿生 & 更新狀態
        for($i=1;$i<=50;$i++){
            if($i < 10 ) $i = "0".$i;
            apply_dorm_create($conn , "A10955".$i);
        }

        
        apply_dorm_update($conn , 1 , 1);
        apply_dorm_update($conn , 2 , 1);    
        # 建立家長帳號
        parents_create($conn , "father1" , "father1" , "father1@gmail.com" , "0987654321" , "father1" , 0 , 2 , "A1095514");
        parents_create($conn , "father2" , "father2" , "father2@gmail.com" , "0987654321" , "father2" , 0 , 2 , "A1095509");
        # 申請停車證 & 更新狀態
        parking_permit_create($conn , "father1");
        parking_permit_create($conn , "father2");
        parking_permit_update($conn , 0, 1);
        # 新增系統管理員
        system_admin_create($conn,'admin1','admin1','admin1@mail.nuk.edu.tw','0987654321','admin1',0,0);
        system_admin_create($conn,'admin2','admin2','admin2@mail.nuk.edu.tw','0987654321','admin2',1,0);
        system_admin_create($conn,'root','root','root@mail.nuk.edu.tw','0987654321','root',1,0);
        # 新增舍監
        dorm_manager_create($conn,'dorm1','dorm1','dorm1@mail.nuk.edu.tw','0987654321','dorm1',0,1);
        dorm_manager_create($conn,'dorm2','dorm2','dorm2@mail.nuk.edu.tw','0987654321','dorm2',1,1);
        # 將學生變成住宿生
        border_create($conn , 'A1095509' , 109);
        border_create($conn , 'A1095509' , 110);
        border_create($conn , 'A1095551' , 110);
        border_create($conn , 'A1095514' , 110);
        story_manager_create($conn,'A1095514',110,1);
        # 新增進出紀錄
        entry_and_exit_create($conn,"A1095509",0,110);
        entry_and_exit_create($conn,"A1095509",0,110);
        entry_and_exit_create($conn,"A1095551",0,110);
        # 新增臨時證
        access_card_create($conn,"A1095551",110);
        access_card_create($conn,"A1095509",110);
        # 新增點名
        roll_call_create($conn,"A1095551",110,0);
        roll_call_create($conn,"A1095509",110,0);
        # 新增bill
        bill_create($conn,"A1095551","1","電費",200,110);
        bill_create($conn,"A1095509","1","電費",200,109);
        bill_create($conn,"A1095551","2","水費",200,110);
        bill_create($conn,"A1095551","3","網路費",200,110);
        bill_create($conn,"A1095551","4","修繕費",200,110);
        # 新增公告
        announcement_create($conn,"A1095514","A1095514","A1095514");
        announcement_create($conn,"admin1","admin1","admin1");
        announcement_create($conn,"dorm1","dorm1","dorm1");
        # 新增留言
        message_create($conn,"A1095514","A1095514");
        message_create($conn,"admin1","admin1");
        message_create($conn,"dorm1","dorm1");
        message_create($conn,"A1095551","A1095551");
        message_create($conn,"A1095550","A1095550");
        # 新增宿舍
        dormitory_create($conn,0,'學一男');
        dormitory_create($conn,1,'學一女');
        dormitory_create($conn,2,'學二男');
        dormitory_create($conn,3,'學二女');
        # 新增宿舍規則
        rule_create($conn,3,'攜帶違禁品');
        rule_create($conn,5,'使用自有冰箱');
        rule_create($conn,2,'晚上太吵');
        rule_create($conn,4,'惡意破壞器材');
        rule_create($conn,3,'使用禁用的電器');
        
        $fee = array(7463 , 7463 , 9985 , 9985);
        $equipment = array('檯燈' , '桌子' , '椅子' , '床');
        $equipment_year = array(3 , 4 , 5 , 6);
        $public_equipment = array('垃圾桶' , '洗衣機' , '飲水機');
        for($i = 0;$i<4;$i++){

            for($j = 101 ;$j<111;$j++){
                room_create($conn,$i,$j,4,$fee[$i]);
                # 新增 equipment
                for($k = 0 ;$k<4;$k++){
                    for($q = 0; $q < count($equipment); $q++)
                        equipment_create($conn,$i,$j ,$equipment[$q],$equipment_year[$q]);
                }
                
            }
        }

        for($i=0;$i<4;$i++){
            # 新增公共設施
            for($q = 0; $q < count($public_equipment); $q++)
                public_equipment_create($conn,$i,$j , $public_equipment[$q] , $equipment_year[$q]);
        }
        
        
    }
    
    
    # 刪除 table 全部資料 
    function data_delete_all($conn){
        user_delete_all($conn);
        dormitory_delete_all($conn);
        rule_delete_all($conn);
    }
    

?>