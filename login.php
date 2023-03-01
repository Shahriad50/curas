<?php
    session_start(); 
    include_once('../connect.php');
    $email_does_not_exist = false;
    $pass_incorrect = false;
    if (isset($_POST['submit']) && isset($_POST['email']) && 
        isset($_POST['pass']) && isset($_POST['type'])) {

        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $type = $_POST['type'];

        $sql = "select * from `user` where username='$email' limit 1";

        $result = mysqli_query($con, $sql);
        
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                if ($row['username'] == $email && $row['password'] == $pass && $type == $row['type']) {
                    $_SESSION['type'] = $row['type'];
                    $_SESSION['email'] = $email; 
                    if ($_SESSION['type'] == 'admin') {
                        header('Location: ../index.php'); 
                    }
                    else if ($_SESSION['type'] == 'owner') {
                        header('Location: ../ownerInterface.php'); 
                    } else if ($_SESSION['type'] == 'tenant') {
                        header('Location: ../tenant/tenant_interface.php?id='.$email.'');
                    }
                } else {
                    // pass wrong
                    $pass_incorrect = true;
                }
            }
        } else {
            // email not do not exist
            $email_does_not_exist = true;
        }

    } 
?>  

<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Log In</title>
    </head>
    <body>
        <?php 
            require_once('../home/login_nav.php'); 
            if ($email_does_not_exist) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Email Does not Exist. </strong> Please sign up first or check your email.
                    </div>';
            } 
            if ($pass_incorrect) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Wrong Password</strong>
                    </div>';
            }
        ?>
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex align-items-center justify-content-center h-100">
                    <div class="col-md-8 col-lg-7 col-xl-6">
                        <img src="images.jpg"
                        class="img-fluid" alt="Phone image">
                        </div>
                        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                        <form method="post">

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form1Example13">Email address</label>
                                <input type="email" id="form1Example13" placeholder="Enter your email" class="form-control form-control-lg" name = "email"/>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form1Example23">Password</label>
                                <input type="password" id="form1Example23" placeholder="Enter your password" class="form-control form-control-lg" name = "pass"/>

                            </div>

                            <!-- CheckBox --->
                            <div class="form-outline mb-4">
                                <label for="user">Choose Your Type:</label>
                                <select name="type" id="" class="form-control"> 
                                    <option value="node" selected disabled hidden> Choose You Account</option>
                                    <option value="admin"> Admin</option>
                                    <option value="owner"> Owner</option>
                                    <option value="tenant"> Tenant</option>
                                    <option value="manager"> Manager</option>
                                </select>
                            </div> 
                            <div class="d-flex justify-content-around align-items-center mb-4">
                                <!-- Checkbox -->
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                <label class="form-check-label" for="form1Example3"> Remember me </label>
                            </div>

                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit">Log in</button>



                        </form>
                    </div>
                </div>
            </div>
        </section>

    </body>
</html>
