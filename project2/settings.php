<?php
$host = 'localhost';
$user = 'root';
$pwd = '';
$sql_db = 'assignment2';

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!mysqli_connect($host, $user, $pwd, $sql_db)) {
    die("<p style='color:red;'>Database connection failed: </p>" . mysqli_connect_error());
}
?>