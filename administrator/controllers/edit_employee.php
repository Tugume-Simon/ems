<?php
    require_once('config.php');

    $id = $_POST['i'];
    $title = $_POST['t'];
    $name = $_POST['n'];
    $dob = $_POST['d'];
    $gender = $_POST['g'];
    $email = $_POST['e'];
    $address = $_POST['a'];
    $dep = $_POST['dp'];
    $tel = $_POST['l'];
    $salary = $_POST['s'];

    $QUERY = "UPDATE employees SET title='".$title."', fullname='".$name."', dob='$dob', gender='".$gender."', 
        email='".$email."', address='".$address."', department=$dep, telephone='".$tel."', salary=$salary 
        WHERE id=$id";
    
    $exec_q = mysqli_query($CONNECT, $QUERY);
    if($exec_q){
        echo "updated";
    }else{
        echo "Update failed: ".die(mysqli_error($exec_q));
    }
    
?>