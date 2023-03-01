<?php 
    function showBuildingName($con, $hld) { 
        $sql = "select buildingName from building where holdingNumber=$hld"; 
        $result = mysqli_query($con, $sql); 
        $row = mysqli_fetch_assoc($result); 
        return $row['buildingName'];

    }
    function show_date($rcd) {
        if ($rcd != 'empty') {
            return date_format($rcd, "d-m-Y"); 
        }
        return '';
    }
?>
