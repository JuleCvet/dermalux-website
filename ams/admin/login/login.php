<?php
session_start();
ini_set("session.gc_maxlifetime", 14400);
//ako e logiran direkno go nosi na stranata za welcome :-)
if (intval($_SESSION['isLogged']) > 0){
	//ako e pronajden soodveten user vednas vleguva vo administracija
	$redirekcija="Location: ../appointments/list.php";
	header($redirekcija);
	exit;
}
?>
<title>Login</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
<script language="javascript" type="text/jscript">
function setFocus() {	document.login.username.focus(); }
window.onload = setFocus; 
</script>
<?php
if (strlen($_GET['u']) > 0) {
?>
<script language="javascript" type="text/jscript">
function setFocus() {	document.login.password.focus(); }
window.onload = setFocus; 
</script>
<?php
} //kraj na if (strlen($_GET['u']) > 0) {  //ako e pogresen username, se fokusira na password
?>
<HEAD>
</HEAD>
<BODY>
<h1>Login</h1>
<form name="login" action="check.php" method="POST">
Username: <input type="text" name="username" size="12" value="<?php echo $_GET['u']; ?>">
<br>
Password: <input type="password" name="password" size="18"><br>
<input type="submit" value="Login">
</form>

<?php
	if ($_GET['error'] == wrong){
	echo '<h1 color="#FF0000">Wrong! Try again.</h1>';
	}
?>

</BODY>
</HTML>