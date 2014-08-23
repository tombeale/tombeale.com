<?
if ($datedata == "") 
	{
	echo "No Data";
	}
else
	{
	$fp = fopen("data/dates.dat", 'w');
	fwrite($fp, $datedata, strlen($datedata));
	fclose($fp);
	}




?>