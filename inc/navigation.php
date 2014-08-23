<?
if ($main == "") $main = 1;

switch ($main)
	{
	case 1:
		$url = "content/metronome.php";
		break;
	
	default:
		$url = "content/page" . $main .".php";
	}


?>