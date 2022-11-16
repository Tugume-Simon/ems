<?php
    require_once('config.php');

    $val = $_POST['e'];
    $id = $_POST['i'];

    $QUERY = "UPDATE deps SET department='".$val."' WHERE id=$id";
    $exec_q = mysqli_query($CONNECT, $QUERY);

    if($exec_q){
        echo "success";
    }else{
        echo "Failed: ".die(mysqli_error($exec_q));
    }
?>