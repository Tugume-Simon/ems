<?php
    require_once('config.php');

    $id = $_POST['i'];
    $QUERY = "SELECT * FROM employees WHERE id=$id";
    $exec_q = mysqli_query($CONNECT, $QUERY);

    if($exec_q){
        $row = mysqli_fetch_array($exec_q);
        echo $row['title'].'|';
        echo $row['fullname'].'|';
        echo $row['dob'].'|';
        echo $row['gender'].'|';
        echo $row['email'].'|';
        echo $row['address'].'|';
        echo $row['department'].'|';
        echo $row['telephone'].'|';
        echo $row['salary'];
    }
?>