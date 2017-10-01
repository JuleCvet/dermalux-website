<?php
	require("db_config.php");
	$connection = @mysql_connect($db_host, $db_user, $db_password) or die(mysql_error());
	@mysql_select_db($db_name, $connection);
?>