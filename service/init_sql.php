<?php
    
    # 新增 table 初始化資料 
    function data_create_init($conn){
        
        # 學生user 有 A10955 99位 ， A10951 99 位

        # 112 學生 建立10位學生住宿申請 ，均還沒有分配成住宿生 
        # 110 學生 建立4個系所 * $department_student_num 學生住宿申請
        
        set_time_limit(500);
        $department_student_num = 45;
        # 新增student
        add_student($conn , $department_student_num);
        # 申請變成住宿生 & 更新狀態
        add_apply_dorm($conn , $department_student_num);
        # 新增宿舍
        add_dorm($conn);
        # 新增系統管理員
        add_system_admin($conn);
        # 新增宿舍規則
        add_rule($conn);
        # 新增房間、設備、公告設備
        add_room_and_equipment_and_public_equipment($conn);
        # 申請住宿 抽籤 -> 分配房間 -> 新增住宿帳單 -> 新增家長帳號
        // system_admin_dorm_room_allocation_process($conn , 110);
        # 加家長
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
        quit_dorm_create($conn,"A1095551",109);
        
        
        
    }

    function add_student($conn , $department_student_num){

        $name = array("吳姿康", "陳依欣", "林漢侑", "鐘怡珊", "宋珮甄", "吳佳香", "駱冠志", "吳玫偉", "袁怡婷", "黃英恒", "陳柏全", "金胤凌", "吳元", "蔡玉婷", "黃恒宇", "陳柏來", "鄧明輝", "徐耀中", "王偉幸", "林俊安", "曾心夢", "吳寶愛", "趙勇志", "何靖軒", "奚聖苓", "鄭雅年", "何志孝", "楊學愛", "陳可其", "侯冠志", "張姿瑩", "謝冰發", "韓枝臻", "侯合偉", "李可白", "張嬌彬", "黃冠茵", "童柔弘", "李呈佳", "李淑正", "蔡佳名", "吳羽念", "林彥秀", "陳欣鳳", "楊智齊", "李承念", "王裕法", "戴雅雯", "諸彥智", "傅綠謙", "黃莉雯", "李佳駿", "陳詩昆", "張雅希", "曾慧玲", "蔡淑珍", "瞿心怡", "王慈榮", "韓鎮剛", "黃巧綠", "魏宇傑", "陳志豪", "劉育軍", "黃憶桓", "卓義瑄", "陳珮白", "童台漢", "劉美芸", "涂志穎", "黃宜靜", "游子軒", "魏湖齊", "張秉勳", "張祐佩", "姜岳一", "陳玉妹", "黃庭忠", "明姿婷", "賴廷法", "楊君宜", "劉盛喜", "李瑋為", "王柏辰", "王若寧", "侯淳甫", "張淑美", "李佳瑞", "劉雅萍", "許國偉", "黃詩勇", "洪宏玄", "謝志宏", "蔡怡萱", "吳益謙", "曾劭原", "林美雲", "王昌均", "馮文彬", "張國維", "李尹鈺", "黃詩瑞", "王其嘉", "潘亮丹", "王綺瑋", "黃雅芷", "林牧鈺", "蔡大茹", "陳鳳珠", "錢子紋", "洪郁治", "黃鈺婷", "黃怡霖", "洪政霖", "吳泓城", "陳昱霖", "李雅筑", "戴雯俐", "王寧鈺", "陳佳芳", "林政勳", "張恭恬", "張淑昌", "宋秀宜", "田明慧", "曹香依", "蔡建志", "崔珊陽", "吳孟瑋", "邊怡如", "鄭凱宸", "林宜恭", "陳子揚", "杜心怡", "夏淑華", "林依新", "曾玉鳳", "蔡正偉", "張雅帆", "趙嘉卿", "蔡嬌綺", "李宗綸", "陳信豪", "黃俊毅", "張珮玉", "柳欣儀", "張嘉泰", "楊辰方", "胡伯迪", "楊淑筠", "吳毅育", "洪皓和", "王嘉雯", "黃世伯", "曹怡婷", "江依平", "張佳蓉", "朱弘芷", "毛立雲", "林曼尹", "謝康茹", "鄭志強", "黃孟儒", "陳韻齊", "陳智意", "王韻仁", "易淑美", "林佳生", "許景柔", "黃佩芬", "林玄雲", "錢合臻", "林兆凌", "翁世偉", "藍珍妤", "劉克發", "崔雅茹", "林心怡", "蔡宗斌", "鄭靜宜", "黃彥伶", "陳孟哲", "黃建民", "楊雅鈴", "馬紋祥", "陳台喬", "陳妍添", "周欣怡", "孫峻豪", "傅堅亮", "柯偉翔", "陳于珊", "黃翰柔", "溫婷諭", "黃詠麟", "吳明惠", "洪富胤", "林若靖", "涂子芸", "蔡孟花", "林士如", "李偉倫"," 楊雅鑫"," 袁雅芳"," 蘇宜俐"," 夏淑芳"," 連雅婷"," 柯姵君"," 陳怡士"," 劉珈郁"," 陳映瑄"," 劉夙容"," 楊彥智"," 張淳平"," 倪中季"," 劉翊惠"," 謝韻如"," 劉慧宇"," 鄭靖諭"," 陳正吟"," 張志華"," 馮志方"," 連俊諺"," 陳玉萍"," 阮坤綸"," 金佩璇"," 陳依春"," 蔣佩琪"," 葉惠婷"," 夏淑如"," 郭淑玲"," 陳佩玲"," 蔡國榮"," 王亦光"," 謝聖念"," 倪芳瑜"," 陳家堯"," 郭宜蓁"," 郭雅慧"," 陳慶青"," 袁智翔"," 蔡文琳"," 李怡婷"," 黃仁歡"," 陳郁文"," 童詩涵"," 陳秀珍"," 蘇怡君"," 林仁柔"," 黃姿婷"," 陳冠秀"," 池宏達"," 呂佳惠"," 林宛成"," 朱依萍"," 常心怡"," 丁真民"," 鄭文婷"," 蔡婉玲"," 吳家慈"," 孫綺妃"," 陳志銘"," 何紹茵"," 黃儒修"," 劉木睿"," 黃常卿"," 張哲惟"," 韓益睿"," 呂禹念"," 吳和士"," 王彥博"," 林素蓁"," 張佳男"," 陳宜婷"," 吳俊城"," 黃郁純"," 李家和"," 梁與恬"," 姚宜芳"," 高俊賢"," 楊仁延"," 彭崇馨"," 王韋廷"," 陳俐諭"," 朱怡樺"," 劉依柏"," 郭賢辰"," 劉峻珮"," 李舒貴"," 劉淑芬"," 張俊豪"," 王宗翰"," 林立偉"," 黃淑玟"," 馮有筠"," 張雅惠"," 涂倩美"," 嵇呈秋"," 祁予輝"," 謝怡臻"," 林士源");

        for($i=1;$i<=$department_student_num;$i++){

            if($i < 10 ) $i = "0".$i;
            
            
            $gender = ($i+1) % 2;

            student_create($conn,$name[3*($i-1)]  ,'A10955'.$i,'A10955'.$i.'@asdasdasda','0987654321','A10955'.$i,$gender,3,'資工');
            student_create($conn,$name[3*($i-1)+1],'A10951'.$i,'A10951'.$i.'@fdfdsfasad','0987654321','A10951'.$i,$gender,3,'電機');
            student_create($conn,$name[3*($i-1)+2],'A10940'.$i,'A10940'.$i.'@fdfdsfasad','0987654321','A10940'.$i,$gender,3,'應數');
            student_create($conn,$name[3*($i-1)+2],'A10939'.$i,'A10939'.$i.'@fdfdsfasad','0987654321','A10939'.$i,$gender,3,'亞太');
    
        }
        # 建立實際需要用的
        $using_arr = array('A1095509','A1095514','A1095546','A1095550','A1095551','A1095562','A1095564');
        $using_name = array('李品妤','朱祐誼','胡哲研','莊郁誼','廖怡誠','鄭詠柔','富宇璽');
        for($i=0; $i<7; $i++){
            user_delete($conn,$using_arr[$i]);
            student_create($conn,$using_name[$i],$using_arr[$i],$using_arr[$i].'@mail.nuk.edu.tw','0987654321',$using_arr[$i],$gender,3,'資工');
        }
                
    }
    
    function add_apply_dorm($conn , $department_student_num){

        // # 新增 112 住宿申請
        // for($i=1;$i<=10;$i++){
        //     if($i < 10 ) {
        //         $i = "0".$i;
        //     }
        //     apply_dorm_create($conn , "A10955".$i,112,0,1);
        // }
        # 新增 110 住宿申請 (分發測試用)
        for($i=1;$i<=$department_student_num;$i++){

            if($i < 10 ) {    
                $i = "0".$i;
            }

            apply_dorm_create($conn , "A10955".$i,110, $i % 4 ,($i+2) % 4);
            apply_dorm_create($conn , "A10951".$i,110, $i % 4 ,($i+2) % 4);
            apply_dorm_create($conn , "A10940".$i,110, $i % 4 ,($i+2) % 4);
            apply_dorm_create($conn , "A10939".$i,110, $i % 4 ,($i+2) % 4);

        }
        
        for($i=1;$i<=10;$i++){
            if($i < 10 ) $i = "0".$i;
            apply_dorm_create($conn , "A10955".$i,109,1,0);
        }

        # 測試用 109學生變成住宿生
        border_create($conn , 'A1095509' , 109);
        border_create($conn , 'A1095514' , 109);
        border_create($conn , 'A1095546' , 109);
        border_create($conn , 'A1095550' , 109);
        border_create($conn , 'A1095551' , 109);
        border_create($conn , 'A1095562' , 109);
        border_create($conn , 'A1095564' , 109);
    
    }
    
    function add_dorm($conn){
        dormitory_create($conn,0,'學一男');
        dormitory_create($conn,1,'學一女');
        dormitory_create($conn,2,'學二男');
        dormitory_create($conn,3,'學二女');
    }
    
    function add_system_admin($conn){
        system_admin_create($conn,'高虹孝','admin1','a1095509@mail.nuk.edu.tw','0987654321','admin1',0,0);
        system_admin_create($conn,'李嘉淑','admin2','a1095514@mail.nuk.edu.tw','0987654321','admin2',1,0);
        system_admin_create($conn,'李嘉淑','admin3','a1095546@mail.nuk.edu.tw','0987654321','admin3',1,0);
        system_admin_create($conn,'胡柏恬','admin4','a1095551@mail.nuk.edu.tw','0987654321','admin4',1,0);
        system_admin_create($conn,'謝明筠','admin5','a1095562@mail.nuk.edu.tw','0987654321','admin5',1,0);
        system_admin_create($conn,'王佳靜','admin6','a1095564@mail.nuk.edu.tw','0987654321','admin6',1,0);
        system_admin_create($conn,'root','root','a1095550@mail.nuk.edu.tw','0987654321','root',1,0);
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
                public_equipment_create($conn,$i, $public_equipment[$q] , $equipment_year[$q]);
        }
    }

    function add_parent($conn){
        parents_create($conn , "李一郎" , "father1" , "a1095509@mail.nuk.edu.tw" , "0987654321" , "father1" , 0 , 2 , "A1095509");
        parents_create($conn , "朱二郎" , "father2" , "a1095514@mail.nuk.edu.tw" , "0987654321" , "father2" , 0 , 2 , "A1095514");
        parents_create($conn , "胡三郎" , "father3" , "a1095546@mail.nuk.edu.tw" , "0987654321" , "father3" , 0 , 2 , "A1095550");
        parents_create($conn , "莊四郎" , "father4" , "a1095550@mail.nuk.edu.tw" , "0987654321" , "father4" , 0 , 2 , "A1095551");
        parents_create($conn , "廖五郎" , "father5" , "a1095551@mail.nuk.edu.tw" , "0987654321" , "father5" , 0 , 2 , "A1095546");
        parents_create($conn , "鄭六郎" , "father6" , "a1095562@mail.nuk.edu.tw" , "0987654321" , "father6" , 0 , 2 , "A1095562");
        parents_create($conn , "富七郎" , "father7" , "a1095564@mail.nuk.edu.tw" , "0987654321" , "father7" , 0 , 2 , "A1095564");
    }

    function add_parking_permit($conn){
        parking_permit_create($conn , "father1");
        parking_permit_create($conn , "father2");
        parking_permit_update($conn , 0, 1);
    }

    function add_dorm_manager($conn){
        dorm_manager_create($conn,'洪香穎','dorm1','a1095509@mail.nuk.edu.tw','0987654321','dorm1',0,1);
        dorm_manager_create($conn,'趙子傑','dorm2','a1095514@mail.nuk.edu.tw','0987654321','dorm2',1,1);
        dorm_manager_create($conn,'馮怡婷','dorm3','a1095546@mail.nuk.edu.tw','0987654321','dorm3',0,1);
        dorm_manager_create($conn,'徐佩珊','dorm4','a1095550@mail.nuk.edu.tw','0987654321','dorm4',1,1);
        dorm_manager_create($conn,'唐景全','dorm5','a1095551@mail.nuk.edu.tw','0987654321','dorm5',0,1);
        dorm_manager_create($conn,'藍佳儀','dorm6','a1095562@mail.nuk.edu.tw','0987654321','dorm6',1,1);
        dorm_manager_create($conn,'林冠良','dorm7','a1095564@mail.nuk.edu.tw','0987654321','dorm7',1,1);
    }

    function add_entry_and_exit($conn){
        entry_and_exit_create($conn,"A1095509",0,109);
        entry_and_exit_create($conn,"A1095509",1,109);
        entry_and_exit_create($conn,"A1095550",1,109);
        entry_and_exit_create($conn,"A1095550",1,109);
        entry_and_exit_create($conn,"A1095550",1,109);
        entry_and_exit_create($conn,"A1095550",1,109);
        
    }
    function add_access_card($conn){
        access_card_create($conn,"A1095550",109);
        access_card_create($conn,"A1095551",109);

    }
    function add_roll_call($conn){
        roll_call_create($conn,"A1095514",109,0);
        roll_call_create($conn,"A1095550",109,0);
        roll_call_create($conn,"A1095550",109,1);
        roll_call_create($conn,"A1095509",109,0);
        roll_call_create($conn,"A1095509",109,0);
        roll_call_create($conn,"A1095551",109,1);
        roll_call_create($conn,"A1095551",109,0);
        roll_call_create($conn,"A1095550",109,0);
        roll_call_create($conn,"A1095550",109,1);
    }

    function add_announcement_and_message($conn){
        
        bill_create($conn,"A1095550","1","電費",200,109);
        bill_create($conn,"A1095509","1","電費",200,109);
        bill_create($conn,"A1095550","2","水費",200,109);
        bill_create($conn,"A1095550","3","網路費",200,109);
        bill_create($conn,"A1095550","4","修繕費",200,109);

        announcement_create($conn,"root","停電通知","6/13凌晨 0200 ~ 0500 因學校高壓電維修檢測，將會暫時停電，請學生多加留意，謝謝");
        announcement_create($conn,"admin1","宿舍分發結果", "宿舍已全數分發完畢，有抽取宿舍的同學請上宿舍網站查詢最終結果，謝謝");
        announcement_create($conn,"admin2","宿舍辦公室工讀生徵求","在學二一樓的宿舍辦公室這學期需要兩位工讀生，工作時間為每天下午17:00~19:00，處理宿舍相關事項，有興趣的同學歡迎來學二宿舍辦公室洽詢");
        
        message_create($conn,"A1095514","大家好 我是廖怡誠 住在學2 332");
        message_create($conn,"admin1","同學們好!有問題都可以來宿舍辦公室詢問");
        message_create($conn,"dorm1","大家好，我是這學期學2的樓長");
        message_create($conn,"A1095550","你們好!");
        message_create($conn,"A1095551","Hello!");
    }
    # 刪除 table 全部資料 
    function data_delete_all($conn){
        user_delete_all($conn);
        dormitory_delete_all($conn);
        rule_delete_all($conn);
    }
    

?>