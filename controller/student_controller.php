<?php
    require_once('../service/require_all.php');

    if(isset($_POST['create'])){
        student_create($conn, $_POST['name'], $_POST['password'], $_POST['email'], $_POST['phone'], $_POST['account'], $_POST['gender'], $_POST['type'], $_POST['department']);
    } else if(isset($_POST['delete'])){
        user_delete($conn , $_POST['account'])
    } else if(isset($_POST['update'])){
        //student_update($conn , $account , $department)
        
        //bill_update($conn , $_POST['bill_id'], $_POST['fee'], $_POST['type'], $_POST['title'] , $_POST['state']);
    }

    header("Location: ../backstage_main.php#pills-user");
?>