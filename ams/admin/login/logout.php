<?php
session_start();
$_SESSION['isLogged'] = 0;
header("Location: login.php");
?>