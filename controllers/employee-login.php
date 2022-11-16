<?php
    require_once('config.php');

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $QUERY = "SELECT * FROM employees WHERE email='".$email."'";
    $exec_q = mysqli_query($CONNECT, $QUERY);
    
    if (mysqli_num_rows($exec_q)){
        $row = mysqli_fetch_assoc($exec_q);

        if(password_verify($pass, $row['password'])){
            session_start();
            $_SESSION['id'] = $row['id'];
        }
    }else{
        echo "invalid";
    }
?>
