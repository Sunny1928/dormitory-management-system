<?php
    
    require_once("./service/user_operation/user_crud.php");
    require_once("./service/user_operation/border_crud.php");
    require_once("./service/dormitory_data_operation/dormitory_crud.php");
    require_once("./service/dormitory_data_operation/rule_crud.php");
    require_once("./service/dormitory_data_operation/equipment_crud.php");
    require_once("./service/dormitory_data_operation/public_equipment_crud.php");
    require_once("./service/dormitory_data_operation/room_crud.php");
    require_once("./service/user_operation/student_crud.php");
    require_once("./service/user_operation/system_admin_crud.php");
    require_once("./service/user_operation/dorm_manager_crud.php");
    
    # 新增 table 初始化資料 
    function data_create_init($conn){
        
        student_create($conn,'A1095551','A1095551','A1095551@mail.nuk.edu.tw','0987654321','A1095551',0,3,'csie');
        student_create($conn,'A1095550','A1095550','A1095550@mail.nuk.edu.tw','0987654321','A1095550',1,3,'csie');
        student_create($conn,'A1095509','A1095509','A1095509@mail.nuk.edu.tw','0987654321','A1095509',1,3,'csie');
        student_create($conn,'A1095514','A1095514','A1095514@mail.nuk.edu.tw','0987654321','A1095514',0,3,'csie');

        apply_dorm_create($conn , "A1095514");
        apply_dorm_create($conn , "A1095509");
        apply_dorm_create($conn , "A1095551");
        apply_dorm_create($conn , "A1095550");
        apply_dorm_update($conn , 1 , 1);
        apply_dorm_update($conn , 2 , 1);

        parents_create($conn , "father1" , "father1" , "father1@gmail.com" , "0987654321" , "father1" , 0 , 2 , "A1095514");
        parents_create($conn , "father2" , "father2" , "father2@gmail.com" , "0987654321" , "father2" , 0 , 2 , "A1095509");


        parking_permit_create($conn , "father1");
        parking_permit_create($conn , "father2");
        parking_permit_update($conn , 0, 1);

        system_admin_create($conn,'admin1','admin1','admin1@mail.nuk.edu.tw','0987654321','admin1',0,0);
        system_admin_create($conn,'admin2','admin2','admin2@mail.nuk.edu.tw','0987654321','admin2',1,0);
        system_admin_create($conn,'root','root','root@mail.nuk.edu.tw','0987654321','root',1,0);
        dorm_manager_create($conn,'dorm1','dorm1','dorm1@mail.nuk.edu.tw','0987654321','dorm1',0,0);
        dorm_manager_create($conn,'dorm2','dorm2','dorm2@mail.nuk.edu.tw','0987654321','dorm2',1,0);

        border_create($conn , 'A1095509' , 109);
        border_create($conn , 'A1095509' , 110);

        dormitory_create($conn,0,'學一男');
        dormitory_create($conn,1,'學一女');
        dormitory_create($conn,2,'學二男');
        dormitory_create($conn,3,'學二女');
    

        rule_create($conn,3,'攜帶違禁品');
        rule_create($conn,5,'使用自有冰箱');
        rule_create($conn,2,'晚上太吵');
        rule_create($conn,4,'惡意破壞器材');
        rule_create($conn,3,'使用禁用的電器');
        
        $fee = 7463;
        $equment = array('檯燈' , '桌子' , '椅子' , '床')
        for($i = 0 ;$i<4;$i++){

            if($i >=2){
                $fee = 9985;
            }
            for($j = 101 ;$j<111;$j++){
                room_create($conn,$i,$j,4,$fee);
                # 新增 equipment
                for($k = 0 ;$k<4;$k++){
                    equipment_create($conn,$i,$j ,'檯燈',2);
                    equipment_create($conn,$i,$j,'桌子',3);
                    equipment_create($conn,$i,$j,'椅子',3);
                    equipment_create($conn,$i,$j,'床',5);
                }
                
            }
        }
        for($i=0;$i<4;$i++){
            public_equipment_create($conn,$i,"垃圾桶",5);   
            public_equipment_create($conn,$i,"洗衣機",4);
            public_equipment_create($conn,$i,"飲水機",3);   
        }
        
        
    }
    
    
    # 刪除 table 全部資料 
    function data_delete_all($conn){
        user_delete_all($conn);
        dormitory_delete_all($conn);
    }
    

?>