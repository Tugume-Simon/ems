<?php
    require_once('config.php');

    session_start();
    $id = $_SESSION['id'];
    $userdep = mysqli_query($CONNECT,"SELECT * FROM employees WHERE id=$id");
    $data = mysqli_fetch_assoc($userdep);
    $d = $data['department'];

    $getD = mysqli_query($CONNECT, "SELECT * FROM deps WHERE id=$d");
    $res = mysqli_fetch_assoc($getD);
    $dep = $res['department'];

    $ann = mysqli_query($CONNECT, "SELECT * FROM announcements WHERE grp='$dep' || grp='all' ORDER BY id DESC");
    if(mysqli_num_rows($ann)){
        echo '<h1>Announcements</h1>';
        while($rec = mysqli_fetch_assoc($ann)){
            echo '
                <div>
                    <h2>'.$rec['title'].'</h2>
                    <span>Created on: '.$rec['created'].'</span>
                    <p>'.$rec['announcement'].'</p>
                    <small>To: '.$rec['grp'].'</small>
                </div>
            ';
        }
    }
?>