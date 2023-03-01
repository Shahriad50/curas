<?php 
session_start(); 
$alert = false; 
    include_once('connect.php');
    if (isset($_GET['hld']) && isset($_GET['email'])) {
        $hld = $_GET['hld']; 
        $email = $_GET['email']; 

        if (!empty($hld) && !empty($email)) {
            $sql = "SELECT * from `owner` where email='$email' limit 1"; 
            $result = mysqli_query($con, $sql); 
                                   
            $row = mysqli_fetch_assoc($result); 

            $name = $row['first_name'] . ' ' . $row['last_name']; 
            $image = $row['image']; 

            $sql = "SELECT buildingName from own NATURAL JOIN building where email='$email'";  
            $result = mysqli_query($con, $sql); 
            $building_name = (array) null;
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($building_name, $row['buildingName']);
            }
        }
    }
    if (isset($_POST['submit'])){ 
        if (isset($_POST['password'])) {
            $password = $_POST['password']; 
            $eml =$_SESSION['email'];
            $sql = "SELECT password from `user` where username='$eml' limit 1"; 
            $result = mysqli_query($con, $sql); 
            $row = mysqli_fetch_assoc($result); 
            if ($row['password'] == $password) { 

                
                
                $sql2 = "SELECT * from `own` where email='$email'";
                $result2 = mysqli_query($con, $sql2);

                while ($row = mysqli_fetch_assoc($result2)) {
                    $holding_delete = $row['holdingNumber']; 
                    $sql1 = "SELECT * from `own` where holdingNumber=$holding_delete and email<>'$email'"; 
                    $result1=mysqli_query($con, $sql1);
                    if (mysqli_num_rows($result1)) {
                        // this holding has another owner
                        // ~~do nothing~~
                    } else {
                        // this holding has only one owner with the $email
                        $sql = "DELETE from `building` where holdingNumber=$holding_delete"; 
                        $result = mysqli_query($con, $sql);
        
                        $sql = "DELETE from `user` where username LIKE '$hld-%@ras.com'";
                        $result = mysqli_query($con, $sql);
                    }
                }

                // Owner Delete Version - 1
                // $sql = "SELECT * from `own` where holdingNumber=$hld";
                // $result = mysqli_query($con, $sql); 
                // // if (mysqli_num_rows($result) == 1) {
                //     $sql = "DELETE from `building` where holdingNumber=$hld"; 
                //     $result = mysqli_query($con, $sql);

                //     $sql = "DELETE from `user` where username LIKE '$hld-%@ras.com'";
                //     $result = mysqli_query($con, $sql);
                // } 
                $sql = "DELETE from `user` where username = '$email'"; 
                $result = mysqli_query($con, $sql);
                if ($result) {
                    // deletion success
                    echo 'Success'; 

                    header('Location: index.php');
                } else {
                    
                }

            } else {
                $alert = true; 
            }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Delete Owner</title>
    </head>
    <body>
        <?php 
            require_once('home/_nav.php');
            if ($alert) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Wrong Password</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            }
        ?>
        <div class="container my-5" id="update-b-form">
        <h1 id="mod-building">Confirm Deletion of Owner</h1>
        <form method="post">

            <div class="form-group">
                <img src="images/<?php echo $image; ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" value="<?php echo $name; ?>" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" value="<?php echo $email; ?>" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Enlisted Building</label>
            <?php 

                foreach($building_name as $temp) {
                    echo '<input type="text" value="'.$temp.'" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">';
                    echo '<br>';
                }
            ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <button type="submit" name="submit"class="btn btn-danger">Confirm Delete</button>
        </form>
        </div>
    </body>
</html>
