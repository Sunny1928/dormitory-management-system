<?php
    
    require_once("./service/user_operation/require_all.php");
    require_once("./service/dormitory_data_operation/require_all.php");
    require_once("./service/apply_data_operation/require_all.php");
    require_once("./service/inform_operation/require_all.php");
    require_once("./service/border_operation/require_all.php");
    
    
    # 新增 table 初始化資料 
    function data_create_init($conn){
        
        # 新增學生
        student_create($conn,'A1095551','A1095551','A1095551@mail.nuk.edu.tw','0987654321','A1095551',0,3,'csie');
        student_create($conn,'A1095550','A1095550','A1095550@mail.nuk.edu.tw','0987654321','A1095550',1,3,'csie');
        student_create($conn,'A1095509','A1095509','A1095509@mail.nuk.edu.tw','0987654321','A1095509',1,3,'csie');
        student_create($conn,'A1095514','A1095514','A1095514@mail.nuk.edu.tw','0987654321','A1095514',0,3,'csie');
        # 申請變成住宿生 & 更新狀態
        apply_dorm_create($conn , "A1095514");
        apply_dorm_create($conn , "A1095509");
        apply_dorm_create($conn , "A1095551");
        apply_dorm_create($conn , "A1095550");
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
        dorm_manager_create($conn,'dorm1','dorm1','dorm1@mail.nuk.edu.tw','0987654321','dorm1',0,0);
        dorm_manager_create($conn,'dorm2','dorm2','dorm2@mail.nuk.edu.tw','0987654321','dorm2',1,0);
        # 將學生變成住宿生
        border_create($conn , 'A1095509' , 109);
        border_create($conn , 'A1095509' , 110);
        border_create($conn , 'A1095551' , 110);
        entry_and_exit_create($conn,"A1095509",0,110);
        entry_and_exit_create($conn,"A1095509",0,110);
        entry_and_exit_create($conn,"A1095551",0,110);
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
        $equment = array('檯燈' , '桌子' , '椅子' , '床');
        $equment_year = array(3 , 4 , 5 , 6);
        $public_equipment = array('垃圾桶' , '洗衣機' , '飲水機');
        for($i = 0;$i<4;$i++){

            for($j = 101 ;$j<111;$j++){
                room_create($conn,$i,$j,4,$fee[$i]);
                # 新增 equipment
                for($k = 0 ;$k<4;$k++){
                    for($q = 0; $q < count($equment); $q++)
                        equipment_create($conn,$i,$j ,$equment[$q],$equment_year[$q]);
                }
                
            }
        }

        for($i=0;$i<4;$i++){
            # 新增公共設施
            for($q = 0; $q < count($public_equipment); $q++)
                public_equipment_create($conn,$i,$j , $public_equipment[$q] , $equment_year[$q]);
        }
        
        
    }
    
    
    # 刪除 table 全部資料 
    function data_delete_all($conn){
        user_delete_all($conn);
        dormitory_delete_all($conn);
    }
    

?>