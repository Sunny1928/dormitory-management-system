<?php
    require_once('../service/require_all.php');

    // echo $_POST['account'];
    // echo $_POST['year'];

    if(isset($_POST['create'])){
        border_create($conn, $_POST['account'], $_POST['year']);
    
    } else if(isset($_POST['delete'])){
        border_delete($conn , $_POST['account'], $_POST['year']);

    } else if(isset($_POST['update'])){
        // $output = explode("-", $_POST['dorm_room']);
        // $dorm = $output[0];
        // $room = $output[1];
        // border_update($conn, $_POST['account'], $_POST['year'], $_POST['type'], $_POST['apply_story_manager_state'], $room, $dorm);
        border_update($conn, $_POST['account'], $_POST['year'], $_POST['type'], $_POST['apply_story_manager_state'], $_POST['room_number'], $_POST['dormitory_id']);

    } 
    else if(isset($_POST['story_manager_create'])){
        story_manager_create($conn, $_POST['account'], $_POST['year'], $_POST['type']);

    }
    
    header("Location: ../main.php?status=success#pills-border");
?>