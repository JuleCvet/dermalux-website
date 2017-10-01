<?php
session_start();
include('../login/security.php');
include('../../config/db_conn.php');
include('../../config/includes.php');
?>
<html><!-- InstanceBegin template="/Templates/admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<title>Administrative Tools</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="../../style.css" rev="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />

<?php if(intval($_GET['saloonID'])==0) { $saloonID='1'; } else { $saloonID=intval($_GET['saloonID']); } ?>



<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>


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


<script type="text/javascript">
	window.onload = function(){
		
		
		g_globalObject = new JsDatePick({
			useMode:1,
			isStripped:true,
			target:"div3_example"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});		
		
		g_globalObject.setOnSelectedDelegate(function(){
			var obj = g_globalObject.getSelectedDay();
			window.document.getElementById('listFrame').src="listframe.php?saloonID=<?php echo $saloonID; ?>&date=" + obj.year + "-" + obj.month + "-" + obj.day;
			window.document.getElementById('appointmentDate').value =  obj.year + "-" + obj.month + "-" + obj.day;
			//alert("a date was just selected and the date is : " + obj.day + "/" + obj.month + "/" + obj.year);
			document.getElementById("div3_example_result").innerHTML = obj.day + "/" + obj.month + "/" + obj.year;
		});
		
		
		
		g_globalObject2 = new JsDatePick({
			useMode:1,
			isStripped:false,
			target:"div4_example",
			cellColorScheme:"beige"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
		g_globalObject2.setOnSelectedDelegate(function(){
			var obj = g_globalObject2.getSelectedDay();
			alert("a date was just selected and the date is : " + obj.day + "/" + obj.month + "/" + obj.year);
			document.getElementById("div3_example_result").innerHTML = obj.day + "/" + obj.month + "/" + obj.year;
		});		
		
	};
</script>

</head>
<body bgcolor="#663300">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" height="100%" align="center" valign="middle">
    
    
<table width="930" height="610" border="1" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="245" height="60" align="center" valign="middle" bgcolor="#F5F5F5"><span class="title" style="font-size:30px; color:#00C">DERMA LUX</span><br>
    <span class="black"><em>APPOINTMENTS MANAGEMENT SYSTEM</em></span></td>
    <td width="659" height="625" rowspan="3" align="right" valign="top"><iframe src="listframe.php?saloonID=<?php echo $saloonID; ?>&date=<?php echo date('Y-m-d'); ?>" width="100%" height="600px" frameborder="0" scrolling="no" name="listFrame" id="listFrame" allowtransparency="true" style="padding:0;"></iframe></td>
  </tr>
  <tr>
    <td height="530" align="center" valign="top">
    
    <p><span class="red">      Choose Location:</span></p>
    <p>
      <input name="saloonID" type="radio" value="1" <?php if($saloonID==1) { echo ' checked '; } ?> onClick="javascript: window.location='list.php?saloonID=1'"> 
      Ohrid &nbsp;&nbsp;&nbsp;&nbsp;
      <input name="saloonID" type="radio" value="2" <?php if($saloonID==2) { echo ' checked '; } ?>  onClick="javascript: window.location='list.php?saloonID=2'">
       Bitola    </p>
    <p>__________________________________</p>
<p class="red">Choose Calendar Day:</p>
<div id="div3_example" style="margin:10px 0 30px 0; border:dashed 0px red; width:205px; height:190px;"></div>
<p>__________________________________</p>
    <form name="form1" method="post" action="add.php?saloonID=<?php echo $saloonID; ?>" target="listframe">
      <p><span class="red">Create appointment for chosen date</span></p>
      <p><span class="red">
  <input type="hidden" name="appointmentDate" id="appointmentDate" value="<?php echo date("Y-m-d"); ?>">
        </span>Client Name:
        <input type="text" name="appointmentClientName" id="appointmentClientName" style="width:120px; height:15px; vertical-align:middle; font-size:11px;">
        <br><br>
        Treatment: 
        <input type="text" name="appointmentType" id="appointmentType" style="width:155px; height:15px; vertical-align:middle; font-size:11px;">
        <br>
        <br>
        Start: 
        <select name="appointmentTime" id="appointmentTime" style="width:60px; height:17px; font-size:11px;">
          <?php
$query_appointmentsPeriods = "SELECT * FROM appointments_periods ORDER BY appointmentPeriodStart ASC";
$result_appointmentsPeriods = mysql_query($query_appointmentsPeriods);
$row_appointmentsPeriods = mysql_fetch_assoc($result_appointmentsPeriods);
do{
?>
          <option value="<?php echo $row_appointmentsPeriods['appointmentPeriodStart']; ?>"><?php echo substr($row_appointmentsPeriods['appointmentPeriodStart'], 0, 5); ?></option>
          <?php
}while($row_appointmentsPeriods = mysql_fetch_assoc($result_appointmentsPeriods));
?>
        </select>
        Time period:
        <select name="numberOfPeriods" id="numberOfPeriods" style="width:65px; height:17px; font-size:11px;">
          <option value="1">15 min</option>
          <option value="2">30 min</option>
          <option value="3">45 min</option>
          <option value="4">60 min</option>
          <option value="6">90 min</option>
          <option value="8">120 min</option>
        </select>
      </p>
      <p>`
        <input type="submit" name="button" id="button" value="Create Appointment">
      </p>
    </form></td>
    </tr>
  <tr>
    <td height="30" align="center" valign="middle" bgcolor="#F5F5F5">[ <a href="../login/edit.php">change password</a> ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [ <a href="../login/logout.php">logoff</a> ]</td>
    </tr>
</table></td>
  </tr>
</table>

<!-- InstanceBeginEditable name="mainAdmin" -->

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>