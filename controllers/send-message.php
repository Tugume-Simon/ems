<?php
    require_once('config.php');

    session_start();
    $subj = $_POST['s'];
    $person = $_SESSION['id'];
    $msg = mysqli_escape_string($CONNECT, $_POST['m']);

    $INSERT = "INSERT INTO messages(subject, message, person, sent) VALUES ('".$subj."', '".$msg."', '".$person."', now())";
    $exec_q = mysqli_query($CONNECT, $INSERT);

    if($exec_q){
        echo "posted";
    }else{
        echo "Failed: ".die(mysqli_error($exec_q));
    }
?>