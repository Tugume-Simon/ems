<?php
    require_once('config.php');

    $id = $_POST['i'];
    $email = $_POST['e'];
    $uname = $_POST['u'];
    $pass = $_POST['p'];

    if($pass == ''){
        $QUERY = "UPDATE employees SET fullname='".$uname."', email='".$email."' WHERE id=$id";
    }else{
        $p = password_hash($pass, PASSWORD_DEFAULT);
        $QUERY = "UPDATE employees SET fullname='".$uname."', email='".$email."', password='".$p."' WHERE id=$id";
    }

    $exec_q = mysqli_query($CONNECT, $QUERY);
    if($exec_q){
        echo "updated";
    }else{
        echo "Failed: ".die(mysqli_error($exec_q));
    }
?>