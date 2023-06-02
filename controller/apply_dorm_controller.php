<?php
    require_once('../service/require_all.php');

    if(isset($_POST['create'])){
        apply_dorm_create($conn, $_POST['account']);
    } else if(isset($_POST['delete'])){
        apply_dorm_delete($conn, $_POST['apply_dorm_id']);
    } else if(isset($_POST['update'])){
        apply_dorm_update($conn, $_POST['apply_dorm_id'], $_POST['state']);
    }

    header("Location: ../backstage_main.php#pills-apply-dorm");
?>