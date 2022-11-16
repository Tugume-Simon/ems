<?php
    require_once('config.php');

    $id = $_POST['i'];

    $exec_q = mysqli_query($CONNECT, "DELETE FROM employees WHERE id=$id");
    if($exec_q){
        echo "deleted";
    }else{
        echo "Failed: ".die(mysqli_error($exec_q));
    }

?>