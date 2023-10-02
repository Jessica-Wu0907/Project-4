<?php

$database_host = "mysqlwebdevinstance.cz5qmuqg141p.ca-central-1.rds.amazonaws.com";
$database_user_name = "mysqlwebdevuser1";
$database_password = "19820907Wu$";
$database_name = "shop list";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>