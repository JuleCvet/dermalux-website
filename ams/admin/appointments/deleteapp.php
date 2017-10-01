<?php
session_start();
include('../login/security.php');
include('../../config/db_conn.php');
include('../../config/includes.php');


if(intval($_GET['appointmentID']) > 0) {
	
	$query_delete = "DELETE FROM appointments WHERE appointmentID=".intval($_GET['appointmentID']);
	mysql_query($query_delete);
	
}

header('Location: listframe.php?date='.$_GET['date'].'&saloonID='.$_GET['saloonID']);
?>