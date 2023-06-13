<?php

// 分發住宿生的宿舍
function assign_dorm($conn, $year)
{
    $sql_check = "SELECT * FROM border 
            WHERE room_number = NULL AND dormitory_id = NULL LIMIT 1";
    //找border內，房號和樓號為空，只找一個
    $switch_num = 0; //樓號計數
    $roommate_count = 0; //室友人數計數
    $OA_count = 101; //各樓房號
    $OB_count = 101;
    $OE_count = 101;
    $OF_count = 101;

    while (($result = $conn->query($sql_check))) { //result 成功接收到資料就繼續

        $row = $result->fetch_assoc(); //將接收資料放到一列，用['']找對應key的單筆資料

        switch ($switch_num) {

            case 0: //OA樓
                $OA_room_number = 'OA' . $OA_count; //將房間計數轉為房號

                $title = 'Border bill : ' . $OA_room_number; //帳單標題名稱

                border_update_dorm_room($conn, $row['account'], $row['dormitory_id'], $OA_room_number, $year);

                bill_create_room_fee($conn, $row['account'], $title, $year);

                pair_roommate($conn, $row['account'], $OA_room_number, $year, $title);
                //找尋另一個同系學生當作室友，找不到留空，第三變數名稱為房號、會隨大樓變更
                $roommate_count = $roommate_count + 2;

                if ($roommate_count == 4) {
                    $OA_count++;
                    $switch_num++;
                    $roommate_count = 0;
                } //房間滿4人後，目前樓的房號+1，換分配下一棟樓的房號，室友人數歸零
                break;

            case 1: //OB樓
                $OB_room_number = 'OB' . $OB_count;

                $title = 'Border bill : ' . $OB_room_number;

                border_update_dorm_room($conn, $row['account'], $row['dormitory_id'], $OB_room_number, $year);

                bill_create_room_fee($conn, $row['account'], $title, $year);

                pair_roommate($conn, $row['account'], $OB_room_number, $year, $title);

                $roommate_count = $roommate_count + 2;

                if ($roommate_count == 4) {
                    $OB_count++;
                    $switch_num++;
                    $roommate_count = 0;
                }
                break;

            case 2: //OE樓
                $OE_room_number = 'OB' . $OE_count;

                $title = 'Border bill : ' . $OE_room_number;

                border_update_dorm_room($conn, $row['account'], $row['dormitory_id'], $OE_room_number, $year);

                bill_create_room_fee($conn, $row['account'], $title, $year);

                pair_roommate($conn, $row['account'], $OE_room_number, $year, $title);

                $roommate_count = $roommate_count + 2;

                if ($roommate_count == 4) {
                    $OE_count++;
                    $switch_num++;
                    $roommate_count = 0;
                }
                break;

            case 3: //OF樓
                $OF_room_number = 'OB' . $OF_count;

                $title = 'Border bill : ' . $OF_room_number;

                border_update_dorm_room($conn, $row['account'], $row['dormitory_id'], $OF_room_number, $year);

                bill_create_room_fee($conn, $row['account'], $title, $year);

                pair_roommate($conn, $row['account'], $OF_room_number, $year, $title);

                $roommate_count = $roommate_count + 2;

                if ($roommate_count == 4) {
                    $OF_count++;
                    $switch_num = 0;
                    $roommate_count = 0;
                } //switch_num 歸零重新回到OA開始分配
                break;
        }
    }

    function pair_roommate($conn, $account, $room_number, $year, $title)
    {
        $sql_department = "SELECT department FROM student 
        WHERE account = ?";
        //提取該帳戶的系所資料
        $pair_department = $conn->prepare($sql_department);
        $pair_department->bind_param('s', $account);

        $sql_pair_roommate = "SELECT * FROM border 
                                JOIN student ON border.account = student.account 
                                WHERE room_number = NULL 
                                AND dormitory_id = NULL 
                                AND student.department = ? 
                                LIMIT 1";
        //從border與student找帳戶相同，且房號、樓號為空，student 系所相同者 

        $pair_result = $conn->prepare($sql_pair_roommate);

        $pair_result->bind_param('s', $pair_department);
        if ($pair_result->execute()) { //執行成功，則進行新找到的另一位室友的房間、帳單資料修改

            $pair_row = $pair_result->fetch_assoc();

            border_update_dorm_room($conn, $pair_row['account'], $pair_row['dormitory_id'], $room_number, $year);

            bill_create_room_fee($conn, $pair_row['account'], $title, $year);
        }
    }
}
