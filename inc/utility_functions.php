<?
function input($cap,$name,$value,$size,$max)
	{
	if ($size == "") $size = "30";
	if ($max == "") $max = $size;
	print "
	<div class='caption'>$cap</div>
	<input class='input' type='text' name='$name' value='$value' size='$size' maxlength='$max'>
	<br>
	";
	}


function pad($s)
	{
	$s = "00" . $s;
	return substr($s, -2);
	}
/*
function clean($s)
	{
	$s = ereg_replace("\n","<br>",$s);
	$s = ereg_replace("\r","",$s);
	$s = ereg_replace("\"","",$s);
	$s = ereg_replace("'","\\'",$s);
	return $s;
	}

function truefalse($v)
	{
	if ($v) return "true";
	return "false";
	}
	
function ePrint($s)
	{
	global $bTesting;
	if ($bTesting)	echo "$s\n";
	}

function ePrint2($s1,$s2)
	{
	global $bTesting;
	if ($bTesting)	echo "$s1 = $s2<br>\n";
	}

function parseParams()
	{
	global $params;
	$temp = split("&",$params);
	for ($a=0;$a<Count($temp);$a++)
		{
		$temp2 = split("=",$temp[$a]);
		$oTemp[$temp2[0]] = $temp2[1];
		}
	return $oTemp;
	}
*/
?>