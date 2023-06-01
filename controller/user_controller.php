<?php
    require_once('../service/require_all.php');

    if(isset($_POST['create'])){
        student_create($conn , $name , $password , $email , $phone , $account , $gender , $type , $department)
        dorm_manager_create($conn , $name , $password , $email , $phone , $account , $gender , $type)
        $output = explode("-", $_POST['year_account']);
        $year = $output[0];
        $account = $output[1];
        bill_create($conn, $account, $_POST['type'], $_POST['title'], $_POST['fee'], $year);
    } else if(isset($_POST['delete'])){
        bill_delete($conn, $_POST['bill_id']);
    } else if(isset($_POST['update'])){
        bill_update($conn , $_POST['bill_id'], $_POST['fee'], $_POST['type'], $_POST['title'] , $_POST['state']);
    }

    header("Location: ../backstage_main.php#pills-user");
?>