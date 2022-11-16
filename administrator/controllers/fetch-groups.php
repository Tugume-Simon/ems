<?php
    require_once('config.php');

    $dep_q = mysqli_query($CONNECT, "SELECT * FROM deps");
    if(mysqli_num_rows($dep_q)){
        echo '<option value="all">All</option>';
        while($dep = mysqli_fetch_assoc($dep_q)){
            echo '
                <option value='.$dep['department'].'>'.$dep['department'].'</option>
            ';
        }
    }
?>