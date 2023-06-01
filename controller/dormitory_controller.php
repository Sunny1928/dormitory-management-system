<?php
    require_once('../service/require_all.php');

    if(isset($_POST['create'])){
        dormitory_create($conn , $_POST['dormitory_id'] , $_POST['name']);
    } else if(isset($_POST['delete'])){
        dormitory_delete($conn , $_POST['dormitory_id']);
    } else if(isset($_POST['update'])){
        dormitory_update($conn , $_POST['dormitory_id'] , $_POST['name']);
    }

    header("Location: ../backstage_main.php#pills-dormitory");
?>