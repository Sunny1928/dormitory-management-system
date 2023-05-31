<!-- 建立SQL連線 -->
<?php

    $servername = "localhost";
    $username = "root";
    $password = "12345678";
    $dbname = "Nukdms";
    $port = "3307";


    $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
        

?>