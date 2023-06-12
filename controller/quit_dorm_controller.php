<?php
    require_once('../service/require_all.php');
    
    if(isset($_POST['create'])){
        $output = explode("-", $_POST['year_account']);
        $year = $output[0];
        $account = $output[1];
        quit_dorm_create($conn , $account, $year);
    } else if(isset($_POST['delete'])){
        //   echo "delete";
        quit_dorm_delete($conn , $_POST['apply_quit_dorm_id']);
    } else if(isset($_POST['update'])){
          echo $_POST['apply_quit_dorm_id'];
          echo $_POST['state'];
          echo $_POST['account'];
          
          echo $_POST['year'];
          quit_dorm_delete_data($conn , $_POST['apply_quit_dorm_id'] , $_POST['state']);
    }

    header("Location: ../main.php?status=success#pills-quit-dorm");
?>