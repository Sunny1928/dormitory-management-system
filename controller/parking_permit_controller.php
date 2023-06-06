<?php
    require_once('../service/require_all.php');

    if(isset($_POST['create'])){
        parking_permit_create($conn, $_POST['account']);
    } else if(isset($_POST['delete'])){
        parking_permit_delete($conn, $_POST['parking_permit_record_id']);
    } else if(isset($_POST['update'])){
        parking_permit_update($conn, $_POST['parking_permit_record_id'], $_POST['state']);
    }

    header("Location: ../main.php#pills-parking-permit");
?>