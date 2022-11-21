<?php
    require_once('config.php');

    $id = $_POST['i'];

    $DEL_ANN = mysqli_query($CONNECT, "DELETE FROM announcements WHERE id=$id");
    if($DEL_ANN){
        echo "deleted";
    }else{
        echo "Failed: ".die(mysqli_error($DEL_ANN));
    }
?>