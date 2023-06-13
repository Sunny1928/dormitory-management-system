<?php
    require_once('../service/require_all.php');
    echo "start ";
    data_delete_all($conn);
    echo "delete all";

    data_create_init($conn);
    echo "success ";
?>