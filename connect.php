<?php
    $con = new mysqli('localhost', 'root', '', 'ras');
    if (!$con) {
        die(mysqli_error($con)); 
    }
?>
