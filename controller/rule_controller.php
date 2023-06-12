<?php
    require_once('../service/require_all.php');

    echo $_POST['rule_id'];

    if(isset($_POST['create'])){
        rule_create($conn, $_POST['point'], $_POST['content']);
    } else if(isset($_POST['delete'])){
        rule_delete($conn, $_POST['rule_id']);
    } else if(isset($_POST['update'])){
        rule_update($conn, $_POST['rule_id'], $_POST['content'], $_POST['point']);
    }

    header("Location: ../main.php?status=success#pills-rule");
?>