<?php
	session_start();

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

    } else if(isset($_POST['user_login'])){
        user_login($conn , $_POST['account'], $_POST['password']);

    }

    // echo "hi";
    // echo $_SESSION['account'].' ';
    // echo $_SESSION['permission'].' ';
    // echo $_SESSION['email'].' ';
    // echo $_SESSION['phone'].' ';
    // echo $_SESSION['gender'].' ';
    // echo $_SESSION['department'].' ';

    if($_POST['type']==0){
        header("Location: ../main.php#pills-system-admin");
    
    } else if($_POST['type']==1){
        header("Location: ../main.php#pills-dorm-manager");
    
    } else if($_POST['type']==2){
        header("Location: ../main.php#pills-parents");

    } else if($_POST['type']==3){
        header("Location: ../main.php#pills-student");
    }

?>