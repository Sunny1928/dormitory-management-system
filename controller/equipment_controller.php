<?php
    // wait
    require_once('../service/require_all.php');

    if(isset($_POST['create'])){
        equipment_create($conn, $_POST['dormitory_id'], $_POST['room_number'], $_POST['name'] , $_POST['expired_year']);
    } else if(isset($_POST['delete'])){
        equipment_delete($conn, $_POST['equipment_id']);
    } else if(isset($_POST['update'])){
        $output = explode("-", $_POST['dormitory_room']);
        $dormitory = $output[0];
        $room = $output[1];
        equipment_update($conn, $_POST['equipment_id'], $_POST['expired_year'], $_POST['name'], $_POST['apply_fix_state'], $room, $dormitory);
    }

    header("Location: ../backstage_main.php#pills-equipment");
?>