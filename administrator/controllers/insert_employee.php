<?php
    require_once('config.php');

    $title = $_POST['t'];
    $name = $_POST['n'];
    $dob = $_POST['d'];
    $gender = $_POST['g'];
    $email = $_POST['e'];
    $address = $_POST['a'];
    $dep = $_POST['dp'];
    $tel = $_POST['l'];
    $salary = $_POST['s'];
    $pass = password_hash($_POST['p'], PASSWORD_DEFAULT);

    $verify = mysqli_query($CONNECT, "SELECT * FROM employees WHERE email='$email'");
    if(mysqli_num_rows($verify)){
        echo "exists";
    }else{
        $QUERY = "INSERT INTO employees(title, fullname, dob, gender, email, address, department, telephone, salary, password) 
        VALUES ('".$title."', '".$name."', '$dob', '".$gender."', '".$email."', '".$address."', $dep, '".$tel."', $salary, '".$pass."')";
    
        $exec_q = mysqli_query($CONNECT, $QUERY);
        if($exec_q){
            echo "success";
        }else{
            echo "Insert failed: ".die(mysqli_error($exec_q));
        }
    }
    
?>