<!--
<?php
$cmd   = $_REQUEST["cmd"];
$notes = $_REQUEST["notes"];
$saved = "0";
?>
-->
<?php
?>

<html>
<?php
require "../inc/browserfunctions.php";

if ($cmd == "SAVE") {
	$myFile = "useragents.log";
	$fh = fopen($myFile, 'a') or die("can't open file");
	$stringData = $sUserAgent . "\1" . $notes . "\n";
	fwrite($fh, $stringData);
	fclose($fh);
	$saved = "1";

	if ($saved == "1") { ?>
	<script language="JavaScript">
		self.location = "listing.php";
	</script>
	<?php
	}

}

echo ("
	<style>
		body,td {
			font-family: Arial;
			font-size: 10pt;
		}

		textarea {
			font-family: Arial;
			font-size: 10pt;
			border: solid #ccc 1px;
			width: 100%;
			height: 2em;
			overflow: visible;
		}

	</style>
	<body>
		UserAgent: $sUserAgent<p>
		<table cellspacing='0' border='1'>
			<tr><td>BrowserFull:</td><td><b>$sBrowserFull</b></td></tr>
			<tr><td>Browser:</td><td><b>$sBrowser</b></td></tr>
			<tr><td>Platform:</td><td><b>$sPlatform</b></td></tr>
			<tr><td>Version:</td><td><b>$iVersion</b></td></tr>
			<tr><td>iPod:</td><td><b>$iPod</b></td></tr>
			<tr><td>iPhone:</td><td><b>$iPhone</b></td></tr>
			<tr><td>isMobile:</td><td><b>$isMobile</b></td></tr>
		</table>
		<p>
		<form name='form1' method='post'>
			Note:
			<textarea name='notes'>$notes</textarea>
			<input type='hidden' name='cmd' value='SAVE'>
			<input type='submit' value='Save'>
		</form>
");
?>
	</body>
</html>
