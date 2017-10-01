<?php
/*------------------------------------------------------------------------------------------------------------*/
//za jazikot
//ako ima prateno vrednost za jazik, se setira na toj jazik
if(intval($_GET['language']) > 0 ) { $_SESSION['language']=$_GET['language']; }
//ako seuste nema dobieno sesija za jazik, ja zima default vrednosta
if(!isset($_SESSION['language']) ) { $_SESSION['language']=1; }
if(strstr($_SERVER['REQUEST_URI'], "?") ) { $request = str_replace("language=".$_GET['language'], "", $_SERVER['REQUEST_URI'])."&"; } else { $request = str_replace("&language=".$_GET['language'], "", $_SERVER['REQUEST_URI'])."?"; }
/*------------------------------------------------------------------------------------------------------------*/

$hoursDifference = "0";
$secondsDifference = $hoursDifference*3600;
$now = " FROM_UNIXTIME(UNIX_TIMESTAMP(now())+".$secondsDifference.") ";

// Quote variable to make safe
function quote_smart($value)
{
   // Stripslashes
   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }
   // Quote if not integer
   if (!is_numeric($value)) {
       $value = mysql_real_escape_string($value);
   }
   return $value;
}




function dataFormat($value, $mode) {

//mesecite
$mesec[1] = "јануари";
$mesec[2] = "февруари";
$mesec[3] = "март";
$mesec[4] = "април";
$mesec[5] = "мај";
$mesec[6] = "јуни";
$mesec[7] = "јули";
$mesec[8] = "август";
$mesec[9] = "септември";
$mesec[10] = "октомври";
$mesec[11] = "ноември";
$mesec[12] = "декември";


		switch($mode) {
			case 1:
				$value = date("l", strtotime($value)).', '.intval(substr($value, 8, 2)).' '.date("F", strtotime($value)).' '.substr($value, 0, 4).' '.substr($value, 11, 8);
			break;
			case 2:
				$value = intval(substr($value, 8, 2)).'.'.substr($value, 5, 2).'.'.substr($value, 0, 4);
			break;
			case 3:
				$value = intval(substr($value, 8, 2)).'/'.substr($value, 5, 2).'/'.substr($value, 0, 4);
			break;
			case 4:
				$value = intval(substr($value, 8, 2)).' '.$mesec[intval(substr($value, 5, 2))].' '.substr($value, 0, 4);
			break;
			case 5:
				$value = intval(substr($value, 8, 2)).' '.substr($mesec[intval(substr($value, 5, 2))], 0, 3).' '.substr($value, 0, 4).' '.substr($value, 11, 8);
			break;
			case 6:
				$value = substr($value, 8, 2).'-'.substr($value, 5, 2).'-'.substr($value, 0, 4).'&nbsp;&nbsp;&nbsp;'.substr($value, 11, 2).'ч и '.substr($value, 14, 2).'мин';
			break;
		}
return $value;
	
}



?>