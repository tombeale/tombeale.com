<?
# ==============================================
# D A T E   F U N C T I O N S
# ==============================================

function formatDate($d)
	{
	$time = "24:59";
	
	
	if (strpos($d, "-") == 4) return $d;
		
	if (ereg(" ", $d))
		{
		$t = split(" ", $d);
		$date = $t[0];
		$time = $t[1];
		}
	else
		{
		$date = $d;
		}
	
	if (ereg("\/", $d))
		{
		$t = split("\/",$date);
		$mm = pad2($t[0]);
		$dd = pad2($t[1]);
		$yyyy = formatYear($t[2]);
		}
	
	return "$yyyy-$mm-$dd"	;
	}

function microDate($d)
	{
	$time = "24:59";
	if (ereg(" ", $d))
		{
		$t = split(" ", $d);
		$date = $t[0];
		$time = $t[1];
		}
	else
		{
		$date = $d;
		}
	
	if (ereg("\/", $d))
		{
		$t = split("\/",$date);
		$mm = $t[0];
		$dd = $t[1];
		$yyyy = $t[2];
		mktime(23 , 59 , 59, intval($mm) , intval($dd) , intval($yyyy) );
		}
	
	return "$yyyy-$mm-$dd"	;
	}
function pad($s) {	$s = "00" . $s;	return substr($s,-2);}
function pad2($s)
	{
	$s = "00" . $s;
	return substr($s,-2);
	}

function formatYear($y)
	{
	if (strlen($y) == 2)
		{
		return "20" . $y;
		}
	return $y;
	}


function isFuture($date)
	{
	$date = split(" ", $date);
	$date = split("-", $date[0]);
	if ($date[0] == "0000") return true;	
	$now = date("Ymd");
	$then = date("Ymd", mktime(23,59,59,intval($date[1]),intval($date[2]),intval($date[0])));
	
//	echo "\n\n\\\\ Now: $now   Then: $then\n\n";
	
	if ( $then < $now ) return false;
	return true;
	}
?>