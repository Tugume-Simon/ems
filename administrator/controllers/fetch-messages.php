<?php
    require_once('config.php');

    $mesg = mysqli_query($CONNECT, "SELECT * FROM messages ORDER BY id DESC");
    if(mysqli_num_rows($mesg)){
        echo '<h1>Messages</h1>';
        while($rec = mysqli_fetch_assoc($mesg)){
            $id = $rec['person'];
            $QE = mysqli_query($CONNECT, "SELECT fullname FROM employees WHERE id=$id");
            if($QE){
                $set = mysqli_fetch_assoc($QE);
                $person = $set['fullname'];
            }
            echo '
                <div>
                    <h3>'.$rec['subject'].'</h3>
                    <span>Sent on: '.$rec['sent'].'</span>
                    <p>'.$rec['message'].'</p>
                    <small>From: '.$person.'</small>
                </div>
            ';
        }
    }
?>