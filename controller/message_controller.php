<?php
    session_start();

    require_once('../service/require_all.php');

    if(isset($_POST['create'])){
        message_create($conn, $_POST['account'], $_POST['content']);
    } else if(isset($_POST['delete'])){
        message_delete($conn, $_POST['message_id']);
    } else if(isset($_POST['update'])){
        message_update($conn, $_POST['message_id'], $_POST['content']);
    }

    header("Location: ../main.php#pills-message");


    // -0 system_admin 
    // -1 dorm_manager 
    // -2 parent 
    // -3 student 
    // -4 border 
    // -5 story_manager 
    // -6 root
    
    // header("Location: ../backstage_main.php#pills-message");


?>