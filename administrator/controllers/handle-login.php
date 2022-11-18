<?php
    require_once('config.php');

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $QUERY = "SELECT * FROM admins WHERE email='".$email."' AND passwd='".$pass."'";
    $exec_q = mysqli_query($CONNECT, $QUERY);
    
    if (mysqli_num_rows($exec_q)){
        $row = mysqli_fetch_assoc($exec_q);
        session_start();
        $_SESSION['_id'] = $row['id'];
    }else{
        echo "invalid";
    }
?>