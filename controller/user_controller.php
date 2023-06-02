<?php
    require_once('../service/require_all.php');

    // echo $_POST['account'];

    if(isset($_POST['student_create'])){
        student_create($conn, $_POST['name'], $_POST['password'], $_POST['email'], $_POST['phone'], $_POST['account'], $_POST['gender'], $_POST['type'], $_POST['department']);
    
    } else if(isset($_POST['dorm_manager_create'])){
        dorm_manager_create($conn, $_POST['name'], $_POST['password'], $_POST['email'], $_POST['phone'], $_POST['account'], $_POST['gender'], $_POST['type']);
    
    } else if(isset($_POST['parents_create'])){
        parents_create($conn, $_POST['name'], $_POST['password'], $_POST['email'], $_POST['phone'], $_POST['account'], $_POST['gender'], $_POST['type'], $_POST['student_account']);

    }  else if(isset($_POST['system_admin_create'])){
        system_admin_create($conn, $_POST['name'], $_POST['password'], $_POST['email'], $_POST['phone'], $_POST['account'], $_POST['gender'], $_POST['type']);

    } else if(isset($_POST['delete'])){
        user_delete($conn , $_POST['account']);
    
    } else if(isset($_POST['update'])){
        user_update($conn, $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['account'], $_POST['gender']);

    } else if(isset($_POST['student_update'])){
        student_update($conn , $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['account'], $_POST['gender'], $_POST['department']);

    }
    echo $_POST['type'];
    
    //$types = array("系統管理員", "舍監", "家長", "學生");
    // 10 login page
    if($_POST['cheche'] == 10){
        header("Location: ../index.php");

    }else if($_POST['type']==0){
        header("Location: ../backstage_main.php#pills-system-admin");
    
    } else if($_POST['type']==1){
        header("Location: ../backstage_main.php#pills-dorm-manager");
    
    } else if($_POST['type']==2){
        header("Location: ../backstage_main.php#pills-parents");

    } else if($_POST['type']==3){
        header("Location: ../backstage_main.php#pills-student");
    }

    // header("Location: ../backstage_main.php");
?>