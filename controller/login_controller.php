<?php
session_start();

require_once('../service/require_all.php');
if(isset($_POST['user_login'])){
    $_SESSION['error'] = user_login($conn , $_POST['account'], $_POST['password'], 110);
}
header("Location: ../main.php");

?>