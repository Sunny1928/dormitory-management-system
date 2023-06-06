<?php
    require_once('../service/require_all.php');
    
    if(isset($_POST['create'])){
        $output = explode("-", $_POST['year_account']);
        $year = $output[0];
        $account = $output[1];
        entry_and_exit_create($conn, $account, $_POST['state'], $year);
    } else if(isset($_POST['delete'])){
        entry_and_exit_delete($conn , $_POST['entry_and_exit_dormitory_record_id']);
    } else if(isset($_POST['update'])){
        entry_and_exit_update($conn , $_POST['entry_and_exit_dormitory_record_id'] , $_POST['state']);
    }

    header("Location: ../main.php#pills-entry-and-exit");
?>