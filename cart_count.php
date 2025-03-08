<?php
session_start();
include "includes/db.php";

$u_id =$_SESSION['uid'] ?? 0;
$query = "SELECT COUNT(*) AS count FROM cart WHERE u_id = $u_id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

echo json_encode(["count" => $row["count"]]);
?>
