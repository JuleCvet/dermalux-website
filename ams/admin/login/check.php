<?php
session_start();
include('../../config/db_conn.php');

$query = "SELECT *, DECODE(PASSWORD, '98dsg98sd78ng798s7d897g') AS decoded FROM adminlogin";
$result = mysql_query($query, $connection) or mysql_error();
$row_user = mysql_fetch_assoc($result);
$numRows = mysql_num_rows($result);

$_SESSION['adminName']=0;
$_SESSION['isLogged']=0;

$username=strval($_POST['username']);
$password=strval($_POST['password']);

do{

	if (strval($row_user['username'])==strval($username) && strval($row_user['decoded'])==strval($password)){
		
		$_SESSION['adminID']=strval($row_user['autoID']);
		$_SESSION['adminName']=strval($row_user['name']);
		$_SESSION['adminLevel']=intval($row_user['privileges']);
		$_SESSION['isLogged']=1;
	}

} while ($row_user = mysql_fetch_assoc($result));

//ako nema zapamteno od koj link e izgubena sesijata, togas odi na standard - welcome.php
if(!isset($_SESSION['loginRedirectUrl']) ) { $_SESSION['loginRedirectUrl'] = "../appointments/list.php"; }

//proverka dali ima dodeleno vrednost za $_SESSION['isLogged']
if (intval($_SESSION['isLogged']) > 0){
	//ako e pronajden soodveten user
	$redirekcija="Location: ".$_SESSION['loginRedirectUrl'];
	header($redirekcija);
}
else{
	//dokolku ne e pronajden soodveten user
	$redirekcija="Location: login.php?error=wrong&u=".$username;
	header($redirekcija);
}
?>