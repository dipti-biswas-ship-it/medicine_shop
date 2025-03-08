<?php
session_start();
unset($_SESSION['USER_LOGIN']);
unset($_SESSION['uid']);
unset($_SESSION['email']);

header('location:login.php');
die();
?>