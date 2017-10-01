<?php
session_start();
include('security.php');
include('../../config/db_conn.php');
include('../../config/includes.php');
?>
<html>
<head>
<title>Administrative Tools</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="../../style.css" rev="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />


</head>
<body bgcolor="#663300">
<table width="90%" height="100%" bgcolor="#FFFFFF"  border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center">
<?php
	if($_GET['error'] == yes){
		echo '<span class="errorMessage">Не се совпаѓаат првиот и вториот password што ги внесе!!!<br>
		Пробај пак!</span>';
	}
?>
<p class="text">&nbsp;</p>
<p class="text"><B>CHANGE YOUR PASSWORD HERE</B></p>
<p class="text">                    
<form action="edit_db.php" method="POST">
  <p class="mainBlack">New Password:					    <br>
	<input type="password" name="new_password"></p>
  <p class="mainBlack"><br>
    <span class="mainBlack">Repeat it again:</span>      
    <br>
    <input type="password" name="new_password2">
  </p>
	  <p class="text"><input type="submit" class="formButton" value="Change it !!!"></p>
  <p class="red"><em>* After you change your password you have to re-login again to the administrative panel.</em></p>
</form>
</p>
	    <p>&nbsp;</p>
	    <p>&nbsp;</p>
	    <p>&nbsp;</p>
	    <p>
	      <input type="submit" name="back" id="back" value="Back to the previous page" onClick="window.history.back(-1);">
      </p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>