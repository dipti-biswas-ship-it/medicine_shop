<?php
$con = new mysqli('localhost', 'root', '', 'medicinecare');

if (!$con) {
    die(mysqli_error($con));
}
?>