<?php
// Enter your host name, database username, password, and database name.
$host = "localhost";
$user = "root";
$password = "";
$db = "loginsystem";

// Establish a connection to the database
$con = mysqli_connect($host, $user, $password, $db);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
