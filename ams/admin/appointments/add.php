<?php
session_start();
include('../login/security.php');
include('../../config/db_conn.php');
include('../../config/includes.php');



$newAppointmentPeriodStart = $_POST['appointmentDate'].' '.$_POST['appointmentTime'];
$newAppointmentNumberOfPeriods = 0;


$isBusy = 0;

$query_appointmentsPeriods = "SELECT * FROM appointments_periods ORDER BY appointmentPeriodStart ASC";
$result_appointmentsPeriods = mysql_query($query_appointmentsPeriods);
$row_appointmentsPeriods = mysql_fetch_assoc($result_appointmentsPeriods);

do{

$appointmentPeriodStartDateTime = $_POST['appointmentDate']." ".$row_appointmentsPeriods['appointmentPeriodStart'];

//proverka dali ima zakazano na toj datum/vreme tretman
$query_appointment = "SELECT * FROM appointments WHERE appointmentForSaloonID='".intval($_GET['saloonID'])."' AND appointmentDatetime='".$appointmentPeriodStartDateTime."'";
$result_appointment = mysql_query($query_appointment);
$row_appointment = mysql_fetch_assoc($result_appointment);


if($newAppointmentPeriodStart == $appointmentPeriodStartDateTime && @mysql_num_rows($result_appointment) > 0) { $isBusy=1; }

if(@mysql_num_rows($result_appointment) > 0) {
	$numberOfPeriods = $row_appointment['numberOfPeriods'];
}

if($newAppointmentPeriodStart == $appointmentPeriodStartDateTime) { $newAppointmentNumberOfPeriods = $_POST['numberOfPeriods']; }

	if($newAppointmentNumberOfPeriods > 0 && $numberOfPeriods > 0) { $isBusy = 1; }


if($numberOfPeriods > 0 && $newAppointmentPeriodStart == $appointmentPeriodStartDateTime) { $isBusy=1; }


if($numberOfPeriods > 0 && $numberOfPeriods != $row_appointment['numberOfPeriods']) { $timePeriod = ''; $borderColor=$bgColor; }


$numberOfPeriods--;
$newAppointmentNumberOfPeriods--;


}while($row_appointmentsPeriods = mysql_fetch_assoc($result_appointmentsPeriods));


if($isBusy == 1) {
	
	

header('Location: listframe.php?isBusy=1&date='.$_POST['appointmentDate'].'&saloonID='.$_GET['saloonID']);
exit;
}

else {
	
	//insert dokolku se prateni vrednosti
	$query_insert = "INSERT INTO appointments (appointmentClientName,appointmentType,appointmentForSaloonID,appointmentDatetime,numberOfPeriods)
	VALUES ('".quote_smart($_POST['appointmentClientName'])."',
	'".quote_smart($_POST['appointmentType'])."',
	'".intval($_GET['saloonID'])."',
	'".$_POST['appointmentDate']." ".$_POST['appointmentTime']."',
	'".$_POST['numberOfPeriods']."')
	";
	mysql_query($query_insert);
	
header('Location: listframe.php?date='.$_POST['appointmentDate'].'&saloonID='.$_GET['saloonID']);
exit;
}


?>