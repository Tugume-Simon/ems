<?php
    require_once('config.php');

    $dep_q = mysqli_query($CONNECT, "SELECT * FROM deps");
    if(mysqli_num_rows($dep_q)){
        while($dep = mysqli_fetch_assoc($dep_q)){
            $_id = $dep['id'];
            $Qc = "SELECT * FROM employees where department=$_id";
            $exec_Qc = mysqli_query($CONNECT, $Qc);
            if($exec_Qc){
                $count = mysqli_num_rows($exec_Qc);
            }
            echo '
                <tr id="'.$dep['id'].'">
                    <td>'.$dep['department'].'</td>
                    <td>'.$count.'</td>
                    <td class="controls">
                        <i class="fa fa-edit" onclick="editDep(event)"></i>
                        <i class="fa fa-trash" onclick="delDep(event)"></i>
                    </td>
                </tr>
            ';
        }
    }
?>