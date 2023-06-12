<?php
    require_once('../service/require_all.php');
    // echo $_POST['room_number'].' '.$_POST['dormitory_id'].' '.$_POST['num_of_people'].' '.$_POST['fee'].' '.$_POST['clean_state'];

    if(isset($_POST['create'])){
        room_create($conn, $_POST['dormitory_id'], $_POST['room_number'], $_POST['num_of_people'] , $_POST['fee']);
    } else if(isset($_POST['delete'])){
        room_delete($conn, $_POST['room_number'], $_POST['dormitory_id']);
    } else if(isset($_POST['update'])){
        room_update($conn , $_POST['room_number'] , $_POST['dormitory_id'] , $_POST['num_of_people'] , $_POST['fee'] , $_POST['clean_state']);
    }

    header("Location: ../main.php#pills-room");
?>