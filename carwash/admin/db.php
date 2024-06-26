<?php

    // Enter your host name, database username, password, and database name.
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "LoginSystem";

    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost","root","","LoginSystem");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }



?>