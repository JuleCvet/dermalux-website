<?php
if (intval($_SESSION['isLogged']) == 0 || strval($_SESSION['adminName']) == ''){
	//toa znaci deka ne e najaven ili istekla sesijata
	$redirekcija="Location: ../index.php";
	$_SESSION['loginRedirectUrl'] = $_SERVER['HTTP_REFERER'];
	header($redirekcija);
}
?>