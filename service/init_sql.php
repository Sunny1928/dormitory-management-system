<?php
    
    # 新增 table 初始化資料 
    function data_create_init($conn){
        
        # 學生user 有 A10955 99位 ， A10951 99 位

        # 112 學生 建立10位學生住宿申請 ，均還沒有分配成住宿生 
        # 110 學生 建立198位學生住宿申請，160位有分配成住宿生，38位沒有分配到住宿


        # 新增student
        add_student($conn);
        # 申請變成住宿生 & 更新狀態
        add_apply_dorm($conn);
        # 新增宿舍
        add_dorm($conn);
        # 新增系統管理員
        add_system_admin($conn);
        # 新增宿舍規則
        add_rule($conn);
        # 新增房間、設備、公告設備
        add_room_and_equipment_and_public_equipment($conn);
        # 申請住宿 抽籤
        system_admin_choose_all_border($conn,110);
        # 建立家長帳號
        add_parent($conn);
        # 申請停車證 & 更新狀態
        add_parking_permit($conn);
        # 新增舍監
        add_dorm_manager($conn);
        # 建立樓長
        story_manager_create($conn,'A1095514',110,2);
        # 新增進出紀錄
        add_entry_and_exit($conn);
        # 新增臨時證
        add_access_card($conn);
        # 新增點名
        add_roll_call($conn);
        # 新增帳單、公告、留言
        add_announcement_and_message($conn);
        # 建立退宿申請
        quit_dorm_create($conn,"A1095550",110);
        
        
        
    }

    function add_student($conn){

        for($i=1;$i<=99;$i++){

            if($i < 10 ) $i = "0".$i;
            $gender = 0;
            if($i>=31) $gender =1 ;
            
            student_create($conn,'A10955'.$i,'A10955'.$i,'A10955'.$i.'@mail.nuk.edu.tw','0987654321','A10955'.$i,$gender,3,'CSIE');
            student_create($conn,'A10951'.$i,'A10951'.$i,'A10951'.$i.'@mail.nuk.edu.tw','0987654321','A10951'.$i,$gender,3,'EE');
    
        }
    }
    
    function add_apply_dorm($conn){

        # 新增 112 住宿申請
        for($i=1;$i<=10;$i++){
            if($i < 10 ) {
                $i = "0".$i;
            }
            apply_dorm_create($conn , "A10955".$i,112,0,1);
        }
        # 新增 110 住宿申請 (分發測試用)
        for($i=1;$i<=99;$i++){

            if($i < 10 ) {    
                $i = "0".$i;
                apply_dorm_create($conn , "A10955".$i,110,0,1);
                apply_dorm_create($conn , "A10951".$i,110,0,1);
            }
            else if($i >= 10 && $i < 60) {
                
                apply_dorm_create($conn , "A10955".$i,110,1,2);
                apply_dorm_create($conn , "A10951".$i,110,0,1);
            }
            else if($i >= 60 && $i < 90) {
                
                apply_dorm_create($conn , "A10955".$i,110,2,3);
                apply_dorm_create($conn , "A10951".$i,110,0,1);
            }
            else if($i >= 90 && $i <= 99) {
                
                apply_dorm_create($conn , "A10955".$i,110,3,0);
                apply_dorm_create($conn , "A10951".$i,110,0,1);
            }
        }
        
        for($i=1;$i<=10;$i++){
            if($i < 10 ) $i = "0".$i;
            apply_dorm_create($conn , "A10955".$i,109,1,0);
        }

        # 測試用 109學生變成住宿生
        border_create($conn , 'A1095509' , 109);
    }
    
    function add_dorm($conn){
        dormitory_create($conn,0,'學一男');
        dormitory_create($conn,1,'學一女');
        dormitory_create($conn,2,'學二男');
        dormitory_create($conn,3,'學二女');
    }
    
    function add_system_admin($conn){
        system_admin_create($conn,'admin1','admin1','a1095558@mail.nuk.edu.tw','0987654321','admin1',0,0);
        system_admin_create($conn,'admin2','admin2','a1095559@mail.nuk.edu.tw','0987654321','admin2',1,0);
        system_admin_create($conn,'admin3','admin3','a1095560@mail.nuk.edu.tw','0987654321','admin3',1,0);
        system_admin_create($conn,'admin4','admin4','a1095561@mail.nuk.edu.tw','0987654321','admin4',1,0);
        system_admin_create($conn,'admin5','admin5','a1095562@mail.nuk.edu.tw','0987654321','admin5',1,0);
        system_admin_create($conn,'admin6','admin6','a1095563@mail.nuk.edu.tw','0987654321','admin6',1,0);
        system_admin_create($conn,'root','root','a1095564@mail.nuk.edu.tw','0987654321','root',1,0);
    }

    function add_rule($conn){
        rule_create($conn,3,'攜帶違禁品');
        rule_create($conn,5,'使用自有冰箱');
        rule_create($conn,2,'晚上太吵');
        rule_create($conn,4,'惡意破壞器材');
        rule_create($conn,3,'使用禁用的電器');
    }

    function add_room_and_equipment_and_public_equipment($conn){
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

    function add_parent($conn){
        parents_create($conn , "father1" , "father1" , "a1095551@mail.nuk.edu.tw" , "0987654321" , "father1" , 0 , 2 , "A1095551");
        parents_create($conn , "father2" , "father2" , "a1095552@mail.nuk.edu.tw" , "0987654321" , "father2" , 0 , 2 , "A1095552");
        parents_create($conn , "father3" , "father3" , "a1095553@mail.nuk.edu.tw" , "0987654321" , "father3" , 0 , 2 , "A1095553");
        parents_create($conn , "father4" , "father4" , "a1095554@mail.nuk.edu.tw" , "0987654321" , "father4" , 0 , 2 , "A1095554");
        parents_create($conn , "father5" , "father5" , "a1095555@mail.nuk.edu.tw" , "0987654321" , "father5" , 0 , 2 , "A1095555");
        parents_create($conn , "father6" , "father6" , "a1095556@mail.nuk.edu.tw" , "0987654321" , "father6" , 0 , 2 , "A1095556");
        parents_create($conn , "father7" , "father7" , "a1095557@mail.nuk.edu.tw" , "0987654321" , "father7" , 0 , 2 , "A1095557");
    }

    function add_parking_permit($conn){
        parking_permit_create($conn , "father1");
        parking_permit_create($conn , "father2");
        parking_permit_update($conn , 0, 1);
    }

    function add_dorm_manager($conn){
        dorm_manager_create($conn,'dorm1','dorm1','a1095509@mail.nuk.edu.tw','0987654321','dorm1',0,1);
        dorm_manager_create($conn,'dorm2','dorm2','a1095514@mail.nuk.edu.tw','0987654321','dorm2',1,1);
        dorm_manager_create($conn,'dorm3','dorm3','a1095546@mail.nuk.edu.tw','0987654321','dorm3',0,1);
        dorm_manager_create($conn,'dorm4','dorm4','a1095550@mail.nuk.edu.tw','0987654321','dorm4',1,1);
        dorm_manager_create($conn,'dorm5','dorm5','a1095551@mail.nuk.edu.tw','0987654321','dorm5',0,1);
        dorm_manager_create($conn,'dorm6','dorm6','a1095562@mail.nuk.edu.tw','0987654321','dorm6',1,1);
        dorm_manager_create($conn,'dorm7','dorm7','a1095564@mail.nuk.edu.tw','0987654321','dorm7',1,1);
    }

    function add_entry_and_exit($conn){
        entry_and_exit_create($conn,"A1095509",0,110);
        entry_and_exit_create($conn,"A1095509",0,110);
        entry_and_exit_create($conn,"A1095550",0,110);
    }
    function add_access_card($conn){
        access_card_create($conn,"A1095550",110);
        access_card_create($conn,"A1095509",110);
    }
    function add_roll_call($conn){
        roll_call_create($conn,"A1095550",110,0);
        roll_call_create($conn,"A1095509",110,0);
    }

    function add_announcement_and_message($conn){
        
        bill_create($conn,"A1095550","1","電費",200,110);
        bill_create($conn,"A1095509","1","電費",200,109);
        bill_create($conn,"A1095550","2","水費",200,110);
        bill_create($conn,"A1095550","3","網路費",200,110);
        bill_create($conn,"A1095550","4","修繕費",200,110);

        announcement_create($conn,"A1095514","A1095514","A1095514");
        announcement_create($conn,"admin1","admin1","admin1");
        announcement_create($conn,"dorm1","dorm1","dorm1");
        
        message_create($conn,"A1095514","A1095514");
        message_create($conn,"admin1","admin1");
        message_create($conn,"dorm1","dorm1");
        message_create($conn,"A1095550","A1095550");
        message_create($conn,"A1095549","A1095549");
    }
    # 刪除 table 全部資料 
    function data_delete_all($conn){
        user_delete_all($conn);
        dormitory_delete_all($conn);
        rule_delete_all($conn);
    }
    

?>