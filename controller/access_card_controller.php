<?php
    require_once('../service/require_all.php');
    
    if(isset($_POST['create'])){
        $output = explode("-", $_POST['year_account']);
        $year = $output[0];
        $account = $output[1];
        access_card_create($conn , $account, $year);
    } else if(isset($_POST['delete'])){
        access_card_delete($conn , $_POST['temporary_access_card_record_id']);
    } else if(isset($_POST['update'])){
        access_card_update($conn , $_POST['temporary_access_card_record_id'] , $_POST['state']);
    }

    header("Location: ../backstage_main.php#pills-access-card");
?>