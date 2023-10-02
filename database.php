<?php

$hostName = "mysql://mysqlwebdevuser1.c455kvgxudr3.ca-central-1.rds.amazonaws.com";
$dbUser = "mysqlwebdevuser1";
$dbPassword = "mysqlwebdevuser1";
$dbName = "web_project";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>
