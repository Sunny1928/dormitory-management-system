<?php
    require_once('../service/require_all.php');
    
    if(isset($_POST['create'])){
        $output = explode("-", $_POST['year_account']);
        $year = $output[0];
        $account = $output[1];
        roll_call_create($conn , $account, $year, $_POST['state']);
    } else if(isset($_POST['delete'])){
        roll_call_delete($conn , $_POST['roll_call_state_record_id']);
    } else if(isset($_POST['update'])){
        roll_call_update($conn , $_POST['roll_call_state_record_id'] , $_POST['state']);
    } else if(isset($_POST['create-roll-call'])){
        story_manager_create_roll_call($conn , $_POST['type'] , $_POST['year']);
    }

    header("Location: ../main.php#pills-roll-call");
?>