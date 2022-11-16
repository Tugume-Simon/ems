<?php
    require_once('config.php');

    $id = $_POST['i'];
    $email = $_POST['e'];
    $uname = $_POST['u'];
    $pass = $_POST['p'];

    $QUERY = "UPDATE admins SET uname='".$uname."', email='".$email."', passwd='".$pass."' WHERE id=$id";
    $exec_q = mysqli_query($CONNECT, $QUERY);
    if($exec_q){
        echo "updated";
    }else{
        echo "Failed: ".die(mysqli_error($exec_q));
    }
?>