<?php
    require_once('../service/require_all.php');

    echo $_POST['account'].' '.$_POST['year'].' '.$_POST['first_priority_dorm'].' '.$_POST['second_priority_dorm'];

    if(isset($_POST['create'])){
        // apply_dorm_create($conn , $account , $year , $first_priority_dorm,$second_priority_dorm)
        apply_dorm_create($conn, $_POST['account'], $_POST['year'], $_POST['first_priority_dorm'], $_POST['second_priority_dorm']);
    } else if(isset($_POST['delete'])){
        apply_dorm_delete($conn, $_POST['apply_dorm_id']);
    } else if(isset($_POST['update'])){
        apply_dorm_update($conn, $_POST['apply_dorm_id'], $_POST['state']);
    } else if(isset($_POST['allocation-room'])){
        system_admin_dorm_room_allocation_process($conn , $_POST['year'],true);
    }

    header("Location: ../main.php#pills-apply-dorm");
?>