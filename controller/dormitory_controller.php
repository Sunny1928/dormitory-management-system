<?php
    require_once('../service/dormitory_data_operation/dormitory_crud.php');
    require_once('../service/connect_db.php');

    echo "hihi";
    echo isset($_POST['create']);
    if(isset($_POST['create'])){
        dormitory_create($conn , $_POST['dormitory_id'] , $_POST['name']);
    } else if(isset($_POST['delete'])){
        dormitory_delete($conn , $_POST['dormitory_id']);
    } else if(isset($_POST['update'])){
    }
    header("Location: ../backstage_main.php#pills-dormitory");
    
?>