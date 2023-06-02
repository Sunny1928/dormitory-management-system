<?php
    require_once('../service/require_all.php');

    if(isset($_POST['create'])){
        announcement_create($conn, $_POST['account'], $_POST['title'], $_POST['content']);
    } else if(isset($_POST['delete'])){
        announcement_delete($conn, $_POST['announcement_id']);
    } else if(isset($_POST['update'])){
        announcement_update($conn, $_POST['announcement_id'], $_POST['title'], $_POST['content']);
    }

    // -0 system_admin -1 dorm_manager -2 parent -3 student -4 border -5 story_manager -6 root
    if($_POST['cheche'] == 0){
        header("Location: ../system_admin_main.php#pills-announcement");

    } else if($_POST['cheche'] == 1){
        header("Location: ../dorm_manager_main.php#pills-announcement");

    } else if($_POST['cheche'] == 2){
        header("Location: ../parent_main.php#pills-announcement");

    } else if($_POST['cheche'] == 3){
        header("Location: ../student_main.php#pills-announcement");

    } else if($_POST['cheche'] == 4){
        header("Location: ../border_main.php#pills-announcement");

    } else if($_POST['cheche'] == 5){
        header("Location: ../story_manager_main.php#pills-announcement");

    } else if($_POST['cheche'] == 6){
        header("Location: ../backstage_main.php#pills-announcement");

    }

?>