<?php
    require_once('../service/require_all.php');

    if(isset($_POST['create'])){
        message_create($conn, $_POST['account'], $_POST['content']);
    } else if(isset($_POST['delete'])){
        message_delete($conn, $_POST['message_id']);
    } else if(isset($_POST['update'])){
        message_update($conn, $_POST['message_id'], $_POST['content']);
    }

    header("Location: ../backstage_main.php#pills-message");
?>