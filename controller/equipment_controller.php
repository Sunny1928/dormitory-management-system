<?php
    // wait
    require_once('../service/require_all.php');
    echo "hihi";
    echo $_POST['equipment_id'];

    if(isset($_POST['create'])){
        equipment_create($conn, $_POST['dormitory_id'], $_POST['room_number'], $_POST['name'] , $_POST['expired_year']);
    } else if(isset($_POST['delete'])){
        equipment_delete($conn, $_POST['equipment_id']);
    } else if(isset($_POST['update'])){

    }
    echo "hihi";

    header("Location: ../backstage_main.php#pills-equipment");
?>