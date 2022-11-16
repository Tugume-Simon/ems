<?php
    require_once('config.php');

    $EMPLOYEES = "SELECT employees.id as empID, employees.title, employees.fullname, employees.dob, 
    employees.gender, employees.email, employees.address, employees.department, employees.telephone, 
    employees.salary, deps.department FROM employees INNER JOIN deps ON employees.department=deps.id";
    $get = mysqli_query($CONNECT, $EMPLOYEES);
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
?>