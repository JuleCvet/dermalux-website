<?php
session_start();
include('security.php');
include('../../config/db_conn.php');
	$new_password = $_POST['new_password'];
	$new_password2 = $_POST['new_password2'];
	if ($new_password == $new_password2){
		$query_update = "UPDATE adminlogin SET password=ENCODE('".$new_password."', '98dsg98sd78ng798s7d897g') WHERE autoID=".$_SESSION['adminID'];
		mysql_query($query_update, $connection) or mysql_error();
		require_once('logout.php');
		$redirekcija = "Location: login.php?login=new";
		header($redirekcija);
	}
	else{
		$redirekcija = "Location: edit.php?error=yes";
		header($redirekcija);
	}
?>