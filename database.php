<?php


$dbServername = "localhost";
$dbUsername = "alexwei";
$dbPassword = "Liyanmei20230321";
$dbName = "wei108_";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        echo 'Connection Error : '. mysqli_connect_error(); 
    }
    else{
    }

?>


