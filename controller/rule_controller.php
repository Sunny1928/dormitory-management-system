<?php
    require_once('../service/require_all.php');

    echo "hihi";
    echo $_POST['rule_id'];

    if(isset($_POST['create'])){
        rule_create($conn, $_POST['point'], $_POST['content']);
    } else if(isset($_POST['delete'])){
        rule_delete($conn, $_POST['rule_id']);
    } else if(isset($_POST['update'])){

    }

    header("Location: ../backstage_main.php#pills-rule");
?>