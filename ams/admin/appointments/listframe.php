<?php
session_start();
include('../login/security.php');
include('../../config/db_conn.php');
include('../../config/includes.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Untitled Document</title>
<script>
window.name='listframe';
</script>


<?php
if($_GET['isBusy']==1) {
echo "<script>
alert('Error: Your appointment time period overlaps with other appointment period.');
</script>";
}

?>

<script language="JavaScript" type="text/JavaScript">
<!--
function brisenje(adresa){
	var Odgovor = confirm("Are you sure?")
	if (Odgovor == true)
	{
		location=adresa
	}
}

<!--

//-->//--><a href="../admin/login">login</a>
</script>


<style>
input, textarea, button, select {
	vertical-align:middle;
	font-size:11px;
	height:12px;
	background-color:transparent;
	border-width:0;
}
</style>
<link href="../../style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
$query_saloons = "SELECT * FROM saloons WHERE saloonID=".intval($_GET['saloonID']);
$result_saloons = mysql_query($query_saloons);
$row_saloons = mysql_fetch_assoc($result_saloons);
?>
<span class="title"><b><?php echo $row_saloons['saloonName']; ?></b> - Schedule for <?php echo dataFormat($_GET['date'], 1); ?></span>
<table width="633" border="1" cellpadding="1" cellspacing="0" class="black">
  <tr bgcolor="#FFFFCC">
    <td width="90" align="center" bgcolor="#b6d1ee"><strong>Period</strong></td>
    <td width="199" align="center" bgcolor="#b6d1ee"><strong>Client info</strong></td>
    <td width="270" align="center" bgcolor="#b6d1ee"><strong>Appointment type</strong></td>
    <td width="56" align="center" bgcolor="#b6d1ee"><strong>Delete</strong></td>
  </tr>
              
              
              
  <?php
$saloonID=intval($_GET['saloonID']);
if($saloonID==0) { $saloonID=1; }

$query_appointmentsPeriods = "SELECT * FROM appointments_periods ORDER BY appointmentPeriodStart ASC";
$result_appointmentsPeriods = mysql_query($query_appointmentsPeriods);
$row_appointmentsPeriods = mysql_fetch_assoc($result_appointmentsPeriods);
do{

//proverka dali ima zakazano na toj datum/vreme tretman
$query_appointment = "SELECT * FROM appointments WHERE appointmentForSaloonID='".$saloonID."' AND appointmentDatetime='".$_GET['date']." ".$row_appointmentsPeriods['appointmentPeriodStart']."'";
$result_appointment = mysql_query($query_appointment);
$row_appointment = mysql_fetch_assoc($result_appointment);


$bgColor="#FFFFFF"; $deleteBtn=''; $borderColor='#000000';
if(@mysql_num_rows($result_appointment)>0) {
	$numberOfPeriods = $row_appointment['numberOfPeriods'];
}
$timePeriod = substr($row_appointmentsPeriods['appointmentPeriodStart'], 0, 5). ' - '.substr($row_appointmentsPeriods['appointmentPeriodEnd'], 0, 5);
if($numberOfPeriods > 0 ) {	$bgColor = "#6F6";  $borderColor=$bgColor; }
if($numberOfPeriods > 0 && $numberOfPeriods != $row_appointment['numberOfPeriods']) { $timePeriod = ''; $borderColor=$bgColor; }


?>
      <tr bgcolor="<?php echo $bgColor; ?>" height="12px" style="border-color:<?php echo $borderColor;?>">
        <td align="center" bgcolor="<?php echo $bgColor; ?>" class="black"><?php echo $timePeriod; ?>&nbsp;</td>
        <td bgcolor="<?php echo $bgColor; ?>" class="black"><?php echo (($row_appointment['appointmentClientName'])); ?></td>
        <td bgcolor="<?php echo $bgColor; ?>" class="black"><?php echo $row_appointment['appointmentType']; ?></td>
        <td align="center" valign="middle" bgcolor="<?php echo $bgColor; ?>">
        <?php
		if(@mysql_num_rows($result_appointment)>0) {
		?>
		<img style="cursor:pointer;" src="../images/delete.gif" border="0" onclick="brisenje('deleteapp.php?saloonID=<?php echo $_GET['saloonID']; ?>&date=<?php echo $_GET['date']; ?>&appointmentID=<?php echo $row_appointment['appointmentID']; ?>');">
        <?php
		}
		?>
        </td>
      </tr>
                
                
      <?php
$numberOfPeriods--;
}while($row_appointmentsPeriods = mysql_fetch_assoc($result_appointmentsPeriods));
?>
</table>
</body>
</html>