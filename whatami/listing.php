<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
	require "../inc/browserfunctions.php";
	require "../inc/browserclientfunctions.php";
	$iTextSize = "8";
	if ($isMobile == "1") {
		$iTextSize = "24";
	}
?>
<html>
	<style>
		
		a {
			color: #55f;
			text-decoration: none;
		}
		
		a:hover {
			color: #00f;
			text-decoration: underline;
		}

		
		body, td {
			font-family: Arial;
			font-size: <?php echo $iTextSize; ?>pt;
		}

		.note {
			font-weight: bold
		}
		
		.agent {
			padding-left: 2em;
		}
		
		#popup {
			position: absolute;
			left:100px;
			top:100px;
			border: solid blue 1px;
			padding: 5px;
			background-color: white;
		}
		
	</style>
	<script language="JavaScript">
		
		function showUserAgent(sUserAgent) {
			var oVer = new Version(sUserAgent);
			oVer.summary();
		}
		
	</script>
<body>
<?php
	$list = Array();
	$fn = "useragents.log";
	$fp = fopen($fn, "r");
	while (!feof($fp)) {
		$list[] = fgets($fp);
	}
	fclose($fp);

	for ($a=count($list)-1;$a>=0;$a--) {
		row($list[$a]);
	}
	
	function row($s) {
		$line = split("\1", $s);
		
		
		if (count($line) > 1) { 
			echo "<div class='note'>" . $line[1] . "</div>"; 
		}
		$userAgent = $line[0];
		echo "<div class='agent'><a href=\"JavaScript:showUserAgent('$userAgent')\">$userAgent</a></div>";
	}
?>
<div id='popup'></div>
</body>