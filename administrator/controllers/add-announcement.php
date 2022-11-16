<?php
    require_once('config.php');

    $title = $_POST['t'];
    $grp = $_POST['g'];
    $msg = mysqli_escape_string($CONNECT, $_POST['m']);

    $INSERT = "INSERT INTO announcements(title, grp, announcement, created) VALUES ('".$title."', '".$grp."', '".$msg."', now())";
    $exec_q = mysqli_query($CONNECT, $INSERT);

    if($exec_q){
        echo "posted";
    }else{
        echo "Failed: ".die(mysqli_error($exec_q));
    }
?>