<?

if (file_exists("util/data/dates.dat")) 
	{
	$datedata = file("util/data/dates.dat");

	$arrDateLines = split("\1", $datedata[0]);
	
	for ($a=0;$a<count($arrDateLines);$a++)
		{
		$arr = split("\2", $arrDateLines[$a]);
		echo "addDate('" . $arr[0] . "',unescape('" . $arr[1] . "'));\n";
		}
	}

?>
