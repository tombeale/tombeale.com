<?
$showmenu = false;
$key     = $_REQUEST["key"];
$outdata = $_REQUEST["outdata"];


require "../config/globals.php";
require "../inc/dbfunctions.php";

echo "$key\n\n$outdata\n\n";


connect();

$rs = SQL("SELECT COUNT(*) FROM content WHERE tag = '" . $key ."'");
$t = mysql_fetch_array($rs);

$content = ereg_replace("'","''", $outdata);


if ($t[0] == 0)
	{
	$sql = "INSERT INTO content (tag,content) VALUES ('$key','$content')";
	}
else
	{
	$sql = "UPDATE content SET content = '$content' WHERE tag = '$key'";
	}

SQL($sql);

?>
<script language="JavaScript">
function done()
	{
	window.close();
	}
</script>
<body onload="done()">
</body>