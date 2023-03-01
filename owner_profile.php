<?php
session_start();
    include_once('../connect.php');
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        if (!empty($email)) {
            $sql = "SELECT * from owner where email = '$email' limit 1";
            $result = mysqli_query($con, $sql);

            $sql1 = "SELECT * from user where username = '$email' limit 1";
            $result1 = mysqli_query($con, $sql1);

            $row = mysqli_fetch_assoc($result);
            $row1 = mysqli_fetch_assoc($result1);

            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $phone = $row['phone'];
            $image = $row['image'];

            $pass = $row1['password'];


        }
    }
    if (isset($_POST['submit'])) {
        $ufname = $_POST['fname'];

        $ulname = $_POST['lname'];
        $uphone = $_POST['phone'];
        $upass = $_POST['password'];
        if (!empty($ufnmae) && !empty($ulname) && !empty($uphone) && !empty($upass)){
            if ($fname != $ufname || $lname != $ulname ||
                $phone != $uphone)  {

                $sql = "UPDATE owner
                            set first_name = '$ufname', last_name = '$ulname', phone = '$uphone'
                            where email = '$email'";

                mysqli_query($con, $sql);

            }
            if ($pass != $upass) {
                $sql = "UPDATE user
                            set password = '$upass'
                            where username = '$email'";
                mysqli_query($con, $sql);

                unset($_SESSION['email']);
                unset($_SESSION['type']);

                session_destroy();

                header('Location:../ProfileSystem/login.php');
            }
            if ($pass == $upass) {
                header('Location:../ownerInterface.php');
            }
        } else {
            // alert field empty
        }
    }


?>

<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title><?php echo $fname; echo ' '; echo $lname; ?></title>
    </head>
    <body>
    
    <?php require_once('../home/_nav_from_show_building_info.php');?>
    <div class="container my-4">
            <form method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" name="fname" value=<?php echo $fname?>>
                </div>

                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" name = "lname" value=<?php echo $lname?>>
                </div>

                <div class="form-group">
                    <label for="lname">Phone</label>
                    <input type="text" class="form-control" name="phone" value=<?php echo $phone?>>
                </div>

                <div class="form-group">
                    <label for="lname">Email</label>
                    <input type="email" class="form-control" readonly value=<?php echo $email?>>
                </div>


                <div class="form-group">
                    <label for="lname">Image</label>
                    <img src="../images/<?php echo $image?>" readonly style="width: 200px;">
                </div>


                <div class="form-group">
                    <label for="lname">Password</label>
                    <input type="text" class="form-control" name="password" value=<?php echo $pass?>>
                </div>


                <button type="submit" class="btn btn-dark" name="submit">Submit</button>
            </form>

        </div>
    </body>
</html>
