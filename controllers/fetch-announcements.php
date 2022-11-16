<?php
    require_once('config.php');

    $ann = mysqli_query($CONNECT, "SELECT * FROM announcements ORDER BY id DESC");
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