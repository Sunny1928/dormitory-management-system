<?php
    
    require  "./service/user_operation/user_crud.php";
    require  "./service/dormitory_data_operation/dormitory_crud.php";
    require  "./service/dormitory_data_operation/rule_crud.php";
    require  "./service/dormitory_data_operation/equipment_crud.php";
    require  "./service/dormitory_data_operation/public_equipment_crud.php";
    require  "./service/dormitory_data_operation/room_crud.php";
    
    
    function data_create_init($conn){
        # 讀檔
        $file  = fopen("./service/init_table.txt","r") or die("Unable to open file!");
    
        while (!feof($file)){
            $command = fgets($file); 

            if ($command[0]== "\r" ){
                continue;
            }
            $command =  preg_split('{,}',$command);
            if ($command[0]=="room"){
                $fee = $command[1];
                for($i = 0 ;$i<4;$i++){
                    $dormitory = $command[3] + $i; 
                    if($i >=2){
                        $fee = 9985;
                    }
                    for($j = 0 ;$j<10;$j++){
                        $room_number = $command[2]+$j;
                        room_create($conn,$dormitory,$room_number,4,$fee);
                        # 新增 equipment
                        equipment_create($conn,$dormitory,$room_number,'檯燈',2);
                        equipment_create($conn,$dormitory,$room_number,'桌子',3);
                        equipment_create($conn,$dormitory,$room_number,'椅子',3);
                        equipment_create($conn,$dormitory,$room_number,'床',5);
                    }
                }
            }
            else if($command[0]=="user"){
                user_create($conn,$command[1],$command[2],$command[3],$command[4],$command[5],$command[6],$command[7]);
            }
            else if($command[0]=="dormitory"){
                dormitory_create($conn,$command[1],$command[2]);
            }   
            else if($command[0]=="rule"){
                rule_create($conn,$command[1],$command[2]);
            }
            else if($command[0]=="public_equipment"){
                for($i=0;$i<4;$i++){
                    public_equipment_create($conn,$i,"垃圾桶",5);   
                    public_equipment_create($conn,$i,"洗衣機",4);
                    public_equipment_create($conn,$i,"飲水機",3);   
                }
            }
            
        }
    
        # 關檔
        fclose($file);
    }

    function data_delete_all($conn){
        user_delete_all($conn);
        dormitory_delete_all($conn);
    }
    

?>