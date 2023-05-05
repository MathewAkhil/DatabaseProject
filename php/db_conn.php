<?php
// Developed by Akhil Mathew
// This file is used to connect to the database
    $sname = "localhost";
    $unmae = "root";
    $password = "";

    $db_name = "csce310";

    $conn = mysqli_connect($sname, $unmae, $password, $db_name);

    if(!$conn) {
        echo "Connection Failed";
    }