<?php
    require_once('../service/require_all.php');
    
    if(isset($_POST['create'])){
        $output = explode("-", $_POST['year_account']);
        $year = $output[0];
        $account = $output[1];
        quit_dorm_create($conn , $account, $year);
    } else if(isset($_POST['delete'])){
          //echo "delete";
        quit_dorm_delete($conn , $_POST['apply_quit_dorm_id']);
    } else if(isset($_POST['update'])){
          //echo "update";
        quit_dorm_update($conn , $_POST['apply_quit_dorm_id'] , $_POST['state'] ,$_POST['account'] ,$_POST['year']);
    }

    header("Location: ../main.php#pills-quit-dorm");
?>