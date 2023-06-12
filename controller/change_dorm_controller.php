<?php
    require_once('../service/require_all.php');

    echo $_POST['account'];
    echo $_POST['year'];
    echo $_POST['another_border'];
    
    if(isset($_POST['create'])){
        $output = explode("-", $_POST['year_account']);
        $year = $output[0];
        $account = $output[1];
        change_dorm_create_process($conn , $account, $year, $_POST['another_border']);
    } else if(isset($_POST['delete'])){
        change_dorm_delete_process($conn , $_POST['account'] ,  $_POST['year'], $_POST['another_border']);      
    } else if(isset($_POST['update'])){
        change_dorm_update_process($conn , $_POST['apply_change_dorm_id'],$_POST['student_state'], $_POST['final_state'], $_POST['another_border'], $_POST['year']);
    }
    header("Location: ../main.php#pills-change-dorm");
?>