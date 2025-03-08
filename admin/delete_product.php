<?php
include("../includes/db.php");
$query="DELETE FROM medicine WHERE m_id=".$_GET['m_id'];
mysqli_query($con,$query);
echo "Medicine Deleted Successfully";
header("Location:./product.php");
?>