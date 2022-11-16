<?php
    require_once('config.php');

    $id = $_POST['i'];
    $QUERY = "SELECT * FROM employees WHERE department=$id";
    $check = mysqli_query($CONNECT, $QUERY);

    if(mysqli_num_rows($check) > 0){
        echo "cannot";
    }else{
        $exec_q = mysqli_query($CONNECT, "DELETE FROM deps WHERE id=$id");
        if($exec_q){
            echo "deleted";
        }else{
            echo "Failed: ".die(mysqli_error($exec_q));
        }
    }

?>