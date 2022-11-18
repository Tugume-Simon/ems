<!DOCTYPE html>
<?php
    session_start();
    if(isset($_SESSION['_id'])){
        header('location: index.php');
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/general.css">
    <style>
        .center{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        h1{
            letter-spacing: -2px;
            margin-top: 0;
            font-weight: 400;
        }
        h1::after{
            content: '';
            width: 200px;
            height: 1px;
            border-bottom: 1px dashed blue;
        }
        input, label{
            display: block;
        }
        input:not([type='submit']){
            width: 90%;
        }
    </style>
</head>
<body>
    <div class="center">
        <h1>Employee Management System</h1>
        <p>Hello admin. Login with your credentials</p>
        <form>
            <label for="email">Email</label>
            <input type="email" id="email">
            <label for="password">Password</label>
            <input type="password" id="password">
            <input type="submit" value="Login">
        </form>
        <p>Forgot password? Contact Admin.</p>
    </div>
    <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            let email = document.getElementById('email').value.trim();
            let password = document.getElementById('password').value.trim();

            if (!email){
                alert('Email is empty!');
                return;
            }

            if (!password){
                alert('Password is empty');
                return;
            }

            let params = `email=${email}&password=${password}`;
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'controllers/handle-login.php', true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    if (this.responseText == 'invalid'){
                        alert('User not found!!');
                    }
                    else{
                        window.location.href = "index.php";
                    }
                }
            };
            xhr.send(params);

            form.reset();
        })
    </script>
</body>
</html>