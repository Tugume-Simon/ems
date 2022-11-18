<!DOCTYPE html>
<?php
    require_once('controllers/config.php');
    session_start();
    if(!isset($_SESSION['_id'])){
        header('location: login.php');
    }else{
        $a_id = $_SESSION['_id'];
        $USER = "SELECT * FROM admins WHERE id=$a_id";
        $user_q = mysqli_query($CONNECT, $USER);
        if($user_q){
            $result = mysqli_fetch_assoc($user_q);  
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velp EMS</title>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="styles/general.css" />
</head>
<body>
    <aside>
        <h3>EMS</h3>
        <ul>
            <li class="view active" id="emps">Employees</li>
            <li class="view" id="deps">Departments</li>
            <li class="view" id="annou">Announcements</li>
            <li class="view" id="msg">Messages</li>
        </ul>
    </aside>
    <main>
        <header>
            <h4>
                <span>Admin -></span>
                <?php
                    echo $result['uname'];
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
                <section id="emps" class="show">
                    <h1>Employees</h1>
                    <div class="ctrl">
                        <label for="sort">Sort: </label>
                        <select id="sort">
                            <option value="all">All</option>
                            <option value="dept">Dept</option>
                        </select>
                        <input type="search" id="search" placeholder="search by name">
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Department</th>
                                <th>Telephone</th>
                                <th>Salary</th>
                                <th></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <form id="employee-form" class="add-form" autocomplete="off">
                        <div class="fields">
                            <div class="form-field">
                                <label for="title">Title</label>
                                <select name="title" id="title">
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Miss.">Miss.</option>
                                </select>
                            </div>
                            <div class="form-field">
                                <label for="fullname">Full name</label>
                                <input type="text" name="fullname" id="fullname">
                            </div>
                            <div class="form-field">
                                <label for="dob">Date of birth</label>
                                <input type="date" name="dob" id="dob">
                            </div>
                            <div class="form-field">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-field">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email">
                            </div>
                            <div class="form-field">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address">
                            </div>
                            <div class="form-field">
                                <label for="department">Department</label>
                                <select name="department" id="department">
                                    
                                </select>
                            </div>
                            <div class="form-field">
                                <label for="telephone">Telephone</label>
                                <input type="text" name="telephone" id="telephone">
                            </div>
                            <div class="form-field">
                                <label for="salary">Salary</label>
                                <input type="number" name="salary" id="salary">
                            </div>
                            <div class="form-field">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password">
                            </div>
                        </div>
                        <input type="submit" value="Submit">
                    </form>
                </section>
                <section id="deps">
                    <h1>Departments</h1>
                    <div class="grid-2-col">
                        <table>
                            <thead>
                                <th>Department</th>
                                <th>Count</th>
                                <th></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <form id="edit-dep" autocomplete="off">
                            <fieldset>
                                <legend>Edit Department</legend>
                                <input type="text" name="edp" id="edp" />
                                <input type="submit" value="Edit" />
                            </fieldset>
                        </form>
                    </div>
                    <p>
                        Note that you cannot delete a department while it still has got members/employees in it.<br />
                        If you are to delete a department, make sure that you delete members belonging to it or<br />
                        move them to other departments. The count must be zero (0);
                    </p>
                    <form id="add-dep" autocomplete="off">
                        <fieldset>
                            <legend>Add Department</legend>
                            <p>Create a new department here.</p>
                            <input type="text" name="adp" id="adp" />
                            <input type="submit" value="Add" />
                        </fieldset>
                    </form>
                </section>
                <section id="prof">
                    <h1>Profile</h1>
                    <h2>Your details:</h2>
                    <p>
                        {<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            username: <?php echo $result['uname']; ?><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            email: <?php echo $result['email']; ?><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            password: <?php echo $result['passwd']; ?><br />
                        }
                    </p>
                    <a id="prof-update">Update details?</a>
                    <form id="edit-profile" data-id="<?php echo $result['id']?>">
                        <fieldset>
                            <legend>Edit your details</legend>
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" value="<?php echo $result['uname']; ?>">
                            <label for="ade">Email</label>
                            <input type="email" name="email" id="ade" value="<?php echo $result['email']; ?>">
                            <label for="pss">Password</label>
                            <input type="text" name="password" id="pss" value="<?php echo $result['passwd']; ?>">
                            <input type="submit" value="Update">
                            <p style="color: #f74040">If you do not wish to update a field, leave it as it is.</p>
                        </fieldset>
                    </form>
                </section>
                <section id="annou">
                    <h1>Announcements</h1>
                    <form id="mk-annou" data-by="<?php echo $result['uname']?>">
                        <label for="a-title">Title</label>
                        <input type="text" name="a-title" id="a-title">
                        <label for="to">Concerned</label>
                        <select name="to" id="to"></select>
                        <label for="a-ancmt">The Announcement</label>
                        <textarea name="announcement" id="a-ancmt" cols="60" rows="10"></textarea>
                        <input type="submit" value="Post">
                    </form>
                </section>
                <section id="msg">
                </section>
            </div>
            <div id="notice">
            </div>
        </div>
    </main>
    <div class="overlay">
    </div>
    <form id="edit-employee">
        <i class="fa fa-times"></i>
        <div class="fields">
            <div class="form-field">
                <label for="tit">Title</label>
                <select name="title" id="tit">
                    <option value="Mr.">Mr.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Miss.">Miss.</option>
                </select>
            </div>
            <div class="form-field">
                <label for="fullnm">Full name</label>
                <input type="text" name="fullname" id="fullnm">
            </div>
            <div class="form-field">
                <label for="DOB">Date of birth</label>
                <input type="date" name="dob" id="DOB">
            </div>
            <div class="form-field">
                <label for="gen">Gender</label>
                <select name="gender" id="gen">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-field">
                <label for="em">Email</label>
                <input type="email" name="email" id="em">
            </div>
            <div class="form-field">
                <label for="add">Address</label>
                <input type="text" name="address" id="add">
            </div>
            <div class="form-field">
                <label for="dpt">Department</label>
                <select name="department" id="dpt">
                    
                </select>
            </div>
            <div class="form-field">
                <label for="telp">Telephone</label>
                <input type="text" name="telephone" id="telp">
            </div>
            <div class="form-field">
                <label for="sal">Salary</label>
                <input type="number" name="salary" id="sal">
            </div>
        </div>
        <input type="submit" value="Edit">
    </form>
    <script src="js/client.js"></script>
</body>
</html>