<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ysm_library";

    //Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    //if database connected
    if($conn){
        echo("Successfully connected to database");
    }

    //Die if connection was not successful
    if(!$conn){
        die("Sorry we failed to connect: ". mysqli_connect_error());
    }
?>