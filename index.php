<!DOCTYPE html>
<?php
    require_once('controllers/config.php');
    session_start();
    if(!isset($_SESSION['id'])){
        header('location: login.php');
    }else{
        $e_id = $_SESSION['id'];
        $USER = "SELECT * FROM employees WHERE id=$e_id";
        $user_q = mysqli_query($CONNECT, $USER);
        if($user_q){
            $result = mysqli_fetch_assoc($user_q);  
        }

        $dept_id = $result['department'];
        $DEP = "SELECT * FROM deps WHERE id=$dept_id";
        $D_Q = mysqli_query($CONNECT, $DEP);
        if($D_Q){
            $dept = mysqli_fetch_assoc($D_Q);
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velp EMS</title>
    <link rel="stylesheet" href="administrator/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="administrator/styles/general.css" />
</head>
<body>
    <aside>
        <h3>EMS</h3>
        <ul>
            <li class="view active" id="ann">Announcements</li>
            <li class="view" id="msg">Message</li>
        </ul>
    </aside>
    <main>
        <header>
            <h4>
                <span>User -></span>
                <?php
                    echo $result['fullname'];
                ?>
            </h4>
            <ul>
                <li class="view" id="prof">Profile</li>
                <li>
                    <i class="fa fa-power-off"></i>
                </li>
            </ul>
        </header>
        <div id="content">
            <div id="section-container">
                <section id="prof">
                    <h1>Profile</h1>
                    <h2>Your details:</h2>
                    <p>
                        {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            username: <?php echo $result['fullname']; ?><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            email: <?php echo $result['email']; ?><br />
                        }
                    </p>
                    <a id="prof-update">Update details?</a>
                    <form id="edit-profile" data-id="<?php echo $result['id']?>">
                        <fieldset>
                            <legend>Edit your details</legend>
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" value="<?php echo $result['fullname']; ?>">
                            <label for="ade">Email</label>
                            <input type="email" name="email" id="ade" value="<?php echo $result['email']; ?>">
                            <label for="pss">Password</label>
                            <input type="text" name="password" id="pss">
                            <input type="submit" value="Update">
                            <p style="color: #f74040">If you do not wish to update a field, leave it as it is.</p>
                        </fieldset>
                    </form>
                </section>
                <section id="ann" class="show">
                </section>
                <section id="msg">
                    <h1>Message</h1>
                    <form id="mk-announ">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject">
                        <label for="message">The Message</label>
                        <textarea name="message" id="message" cols="60" rows="10"></textarea>
                        <input type="submit" value="Send">
                    </form>
                </section>
            </div>
            <div id="notice">
                <h1>
                    Department:
                    <?php echo $dept['department']?>
                </h1>
                <?php
                    $de = $result['department'];
                    $SELECT = "SELECT * FROM employees WHERE department=$de";
                    $QUry = mysqli_query($CONNECT, $SELECT);
                    if($QUry){
                        echo '<ul>';
                        while($set = mysqli_fetch_assoc($QUry)){
                            echo '<li>';
                            echo $set['fullname'];
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                ?>
                <p>Total of <?php echo mysqli_num_rows($QUry)?></p>
                <h2>Other Departments</h2>
                <?php
                    $qd = mysqli_query($CONNECT, "SELECT department FROM deps WHERE id!=$dept_id");
                    if(mysqli_num_rows($qd)){
                        while($other = mysqli_fetch_assoc($qd)){
                            echo '<li>';
                            echo $other['department'];
                            echo '</li>';
                        }
                    }   
                ?>
            </div>
        </div>
    </main>
    <script src="client.js"></script>
</body>
</html>