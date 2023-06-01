<?php
    // wait
    require_once('../service/require_all.php');

    if(isset($_POST['create'])){
        public_equipment_create($conn, $_POST['dormitory_id'], $_POST['name'] , $_POST['expired_year']);
    } else if(isset($_POST['delete'])){
        public_equipment_delete($conn, $_POST['public_equipment_id']);
    } else if(isset($_POST['update'])){
        public_equipment_update($conn, $_POST['public_equipment_id'], $_POST['name'], $_POST['apply_fix_state'], $_POST['expired_year'], $_POST['dormitory_id']);
    }

    header("Location: ../backstage_main.php#pills-public-equipment");
?>