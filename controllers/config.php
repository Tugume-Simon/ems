<?php
    $host = 'localhost';
    $username = 'peter';
    $password = '';
    $database = 'velp';

    $CONNECT = mysqli_connect($host, $username, $password, $database);
    if(!$CONNECT)
    {
        die("Error: Connection to database failed!".mysqli_connect_error());
    }
?>