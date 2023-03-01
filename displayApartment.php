<?php
session_start();
// What this file is doing? 
// When clicking on a card in index page 
// this file is responsible for showing the information aobut 
// owner and Apartments of the building that was clicked
// there is a view button for each apartment and 
// any user can apply to an empty apartment
// that is beside any empty apartment there should be an apply button. 
// And also any building owner can't apply to a building to reduce cmplexity.
include_once('connect.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/6ec9c7cfba.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Display Building <?php echo $id; ?></title>
</head>

<body class="displayApartmentbody">
    <?php
    require_once('home/_nav.php');
    ?>
    <div class="grid-container">
        <div class="owner-list">
            <!-- <div class="container my-5 displayApartment" id="b-ap-list"> -->
                <?php
                if (isset($_GET['id'])) {
                    //$id = $_GET['id'];
                    $sql = "select * from `owner` where email= ANY (SELECT email from own where holdingNumber = $id)";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row) {
                                $fname = $row['first_name'];
                                $lname = $row['last_name'];
                                $phn = $row['phone'];
                                $email = $row['email'];
                                $img = $row['image'];

                                echo '<div class="owner-card" style="width: 18rem;">
                                <<img src="images/' . $img . '" alt="slow connection" width="100px">">
                                <div class="card-body" >
                                  <h5 class="card-title">Owner</h5>
                                  <p class="card-text"> Name: ' . $fname . '  ' . '  ' . $lname . '<br> Phone:' . $phn . '<br>Email:' . $email . '<br></p>
                                  </div>
                              </div>';

                                if (isset($_SESSION['email']) && isset($_SESSION['type'])) {
                                    if ($_SESSION['type'] == 'admin') {
                                        echo '<div class="delete-btn">
                                        <a href="delete_owner.php?hld=' . $id . '&email=' . $email . '"><button class="btn btn-danger">Delete Owner</button></a>
                                        </div> <br>';
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "select * from `location` where holdingNumber=$id";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row) {
                            $city = $row['city'];
                            $thana = $row['thana'];
                            $area = $row['area'];
                            $strt = $row['street'];
                            $house = $row['houseNo'];
                            $gmap = $row['google_map_location'];

                            echo ' <div class="location-card" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Building Location</h5>
                              <p class="card-text">' . $city . ' , ' . $thana . ' <br>
                               ' . $area . ' <br>' . $strt . ' <br> House No:' . $house . '</p>
                              <a href="' . $gmap . '" class="btn btn-primary">Location in Map</a>
                            </div>
                          </div>';
                        }
                    }
                }
                ?>
            <!-- </div> -->
        </div>
        <div class="apartment-list-table">

            <table class="table" id="ap-cer-building">
                <thead>
                    <tr>
                        <th colspan="6" id="table-title">Apartments</th>
                    </tr>
                    <tr>
                        <th id="table-header" scope="col">Apartment ID</th>
                        <th id="table-header" scope="col">Size </th>
                        <th id="table-header" scope="col">Rent per Month</th>
                        <th id="table-header" scope="col">Availability</th>
                        <th id="table-header" scope="col">Actions</th>
                        <th id="table-header" scope="col">Apply</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        $sql = "select * from `apartment` where holdingNumber=$id";
                        $result = mysqli_query($con, $sql);
                        if ($result) {

                            while ($row = mysqli_fetch_assoc($result)) {
                                $aID = $row['ApartmentID'];
                                $size = $row['size'];
                                $rpdn = $row['rentpermonth'];
                                $avl = $row['availability'] ? "YES" : "NO";

                                echo '<tr>
                                <td style="text-align: center;">' . $aID . '</td>
                                <td style="text-align: center;">' . $size . '</td>
                                <td style="text-align: center;">' . $rpdn . '</td>
                                <td style="text-align: center;">' . $avl . '</td>
                                <td style="text-align: center;"><a href="Building/Apartments/view_apartment.php">
                                    <button class="btn btn-primary">View</button></a></td>';
                                // Changed the condition that an owner/ tenant can't apply to any 
                                // available building.
                                // ~~Not verified~~
                                if ($row['availability'] && !isset($_SESSION['email'])) {
                                    echo '<td style="text-align: center;"><a href="#">
                                <button class="btn btn-success">Apply</button></a></td>';
                                } else
                                    echo '<td></td>';
                                echo '</tr>';
                            }
                        }
                    }
                    ?>


                </tbody>
            </table>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>