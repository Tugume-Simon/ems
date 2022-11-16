<?php
    require_once('config.php');

    $dep = $_POST['a'];
    $QUERY = "INSERT INTO deps(department) VALUES ('".$dep."')";

    $exec_q = mysqli_query($CONNECT, $QUERY);
    if($exec_q){
        echo "success";
    }else{
        echo "Failed: ".die(mysqli_error($exec_q));
    }
?>