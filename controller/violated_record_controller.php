<?php
    require_once('../service/require_all.php');

    if(isset($_POST['create'])){
        $output = explode("-", $_POST['year_account']);
        $year = $output[0];
        $account = $output[1];
        violated_record_create($conn, $account, $_POST['rule_id'], $year);
    } else if(isset($_POST['delete'])){
        violated_record_delete($conn, $_POST['violated_record_id']);
    } else if(isset($_POST['update'])){
        violated_record_update($conn, $_POST['violated_record_id'], $_POST['apply_cancel']);
    }

    header("Location: ../backstage_main.php#pills-violated-record");
?>