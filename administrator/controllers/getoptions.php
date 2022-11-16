<?php
    require_once('config.php');

    $opt_q = mysqli_query($CONNECT, "SELECT * FROM deps");
    if(mysqli_num_rows($opt_q)){
        while($opt = mysqli_fetch_assoc($opt_q)){
            echo '
                <option value="'.$opt['id'].'">'.
                    $opt['department'].'
                </option>
            ';
        }
    }
?>