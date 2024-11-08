<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $db_name = "warmindo";
    
    $conn = mysqli_connect($server, $user, $password, $db_name);

    if(!$conn){
        die("gagal terhubung database: "). mysqli_connect_error();
    }
?>