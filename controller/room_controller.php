<?php
    require_once('../service/require_all.php');

    if(isset($_POST['create'])){
        room_create($conn, $_POST['dormitory_id'], $_POST['room_number'], $_POST['num_of_people'] , $_POST['fee']);
    } else if(isset($_POST['delete'])){
        room_delete($conn, $_POST['room_number'], $_POST['dormitory_id']);
    } else if(isset($_POST['update'])){

    }

    header("Location: ../backstage_main.php#pills-room");
?>