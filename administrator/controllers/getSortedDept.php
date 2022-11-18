<?php
    require_once('config.php');

    $DEPT = mysqli_query($CONNECT, "SELECT * FROM deps");
    if(mysqli_num_rows($DEPT)){
        while($dpt = mysqli_fetch_assoc($DEPT)){
            $d = $dpt['department'];
            $i = $dpt['id'];

            $EMPLOYEES = "SELECT employees.id as empID, employees.title, employees.fullname, employees.dob, 
            employees.gender, employees.email, employees.address, employees.department, employees.telephone, 
            employees.salary, deps.department FROM employees INNER JOIN deps ON employees.department=deps.id
            WHERE employees.department=$i";

            $get = mysqli_query($CONNECT, $EMPLOYEES);
            echo '<h4 style="margin-bottom: 10px">'.$d.'</h4>';
            if(mysqli_num_rows($get)){
                while($emp = mysqli_fetch_assoc($get)){
                    $now = new DateTime(date("Y-m-d"));
                    $then = new DateTime($emp['dob']);
                    $age = $now->diff($then);
                    echo '
                        <tr id="'.$emp['empID'].'">
                            <td>'.$emp['title'].' '.$emp['fullname'].'</td>
                            <td>'.$age->format('%Y years').'</td>
                            <td>'.$emp['gender'].'</td>
                            <td>'.$emp['email'].'</td>
                            <td>'.$emp['address'].'</td>
                            <td>'.$emp['department'].'</td>
                            <td>'.$emp['telephone'].'</td>
                            <td>'.$emp['salary'].'</td>
                            <td class="controls">
                                <i class="fa fa-edit" onclick="editEmp(event)"></i>
                                <i class="fa fa-trash" onclick="delEmp(event)"></i>
                            </td>
                        </tr>
                    ';
                }
            }
        }
    }

?>