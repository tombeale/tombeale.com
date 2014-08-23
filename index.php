<!--------------- 
<?
$page = $_REQUEST["page"];
$main = $_REQUEST["main"];
$sub  = $_REQUEST["sub"];
$editmode = "";

if ($main == "") $main = 0;
if ($sub == "") $sub = 0;

if ($cmd == "EDIT") {
	SetCookie("editmode","EDIT");
	$editmode = "EDIT";
}

if ($cmd == "EDITS") {
	SetCookie("editmode","EDITS");
	$editmode = "EDITS";
}

if ($cmd == "NORM") {
	SetCookie("editmode","");
	$editmode = "";
}

$showmenu = "Y";
require "inc/browserfunctions.php";
//$iPhone = true;	
if ($isMobile == "1") {
	?>
	-->
<script language="JavaScript">
	self.location = "mobile";
</script>
	<?php
	exit();
}
require "config/globals.php";
require "inc/content.php";
require "inc/watchdog.php";
require "inc/utility_functions.php";

function parseParams() {
	global $params;
	$temp = split("&",$params);
	for ($a=0;$a<Count($temp);$a++) {
		$temp2 = split("=",$temp[$a]);
		$oTemp[$temp2[0]] = $temp2[1];
	}
	return $oTemp;
}
	
if ($myhome == "y") $page = "myhome.php";
if ($page == "") { 
	$page = "home.php";
	

}
if ($uid != "") SetCookie("uid",$uid);
# echo "$hostname,\n $username,\n $password";
?>
 -->
<html>
<head>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
    <title>
    	Tom Beale - Web Development
    </title>
<script language="JavaScript" src="<?echo $basepath?>lib/innerhtml.js"></script>
<script language="JavaScript" src="<?echo $basepath?>lib/debug.js"></script>
<script language="JavaScript" src="<?echo $basepath?>lib/functions.js"></script>
<script language="JavaScript" src="<?echo $basepath?>lib/contextmenu.js"></script>
<script language="JavaScript" src="<?echo $basepath?>lib/help.js"></script>
<script language="JavaScript" src="<?echo $basepath?>lib/ajax.js"></script>
<script language="JavaScript" src="<?echo $basepath?>lib/info.js"></script>
<script language="JavaScript" src="<?echo $basepath?>lib/jquery-min.js"></script>
<script language="JavaScript">
	
	$(window).bind("resize", handleResize) ;
	
	function handleResize(e) {
		var iWidth = $(window).width();
		
		$("#hdr2").width(iWidth - 250);
		$("#sp1").height(1);
		$("#sp1").width(iWidth - 255);
	}
	
	
	$(document).ready(function(){
		$("#hdr2").width($(window).width() - 250);
		$("#sp1").height(1);
		$("#sp1").width($(window).width() - 255);
	});
	
	var main        = "<?echo $main?>";
	var sub         = "<?echo $sub?>";
	var page        = "<?echo $page?>";
	var bTesting    = <?echo $bTesting?>;
	var bDoFormLoad = false;
	var inforoot    = "<?echo $inforoot?>"

	var eMode = "<?echo $editmode?>";
	var currentURL = self.location;

	var mousex, mousey;

	document.onmousemove = catchmouse;
	
	function catchmouse(e) {
		mousex = event.x;
		mousey = event.y;
	}

	function doFormLoad() {
		addWatchTable("menu", menu, "DUMP");
		menu.draw(<?echo $main?>,<?echo $sub?>);
		if (document.formload) formload();
	}

	function MouseTrap() {
		iPrint("cmenusec","");
		if (closeOpenMenus) closeOpenMenus();
		if (closehelp) closehelp();
	}

/*
	$sUserAgent   = <?echo "$sUserAgent\n" ?>
	$basepath     = <?echo "$basepath\n" ?>
	$sBrowserFull = <?echo "$sBrowserFull\n" ?>
	$sBrowser     = <?echo "$sBrowser\n" ?>
	$sPlatform    = <?echo "$sPlatform\n" ?>
	$iVersion     = <?echo "$iVersion\n" ?>
*/
	
	var sBrowser = "<?echo "$sBrowser"?>";

</script>
<link rel="stylesheet" href="config/style.css" type="text/css" media="screen">
</head>

<body background="<?echo $basepath?>img/back.gif" onload="doFormLoad()" onmouseupx="MouseTrap()" oncontextmenuxx="displaymenu()">
<form name="details" target="_self" action="index.php" method="post">
<table id='maintable' cellspacing="0" cellpadding="0" border="0" width="100%" height="100%">
	<tr>
		<td id='hdr1' 
			style="background-image: url(<?echo $basepath?>img/logo.gif);background-repeat: no-repeat;width: 250px;height: 80px;cursor: pointer;"
			><img src="<?echo $basepath?>img/spacer.gif" height="80" width="250" onmouseup="menuSelect(0,1,0)"
			></td
		>
		<td id='hdr2' style="background-image: url(<?echo $basepath?>img/back-top.gif);width:100%;">
			<img id='sp1' src='img/spacer.gif' height='1px' width='200px'>
		</td>
	</td>
	<tr>
		<td colspan="2" style="padding: 0 0 0 70" valign="top">
			<span class='blacklink' onmouseup="goMainPage('WEB')">App Development</span> <img src="<?echo $basepath?>img/bul.gif" hspace="3" vspace="2">  
			<span class='blacklinkx' onmouseup="goMainPage('DB')">Database Integration</span>  <img src="<?echo $basepath?>img/bul.gif" hspace="3" vspace="2">
			<span class='blacklink' onmouseup="goMainPage('GFX')">Design/Illustration</span> 
		</td>
	</tr>
	<tr>
		<td colspan="2" id="addersssec" style="padding: 0 0 0 70" valign="top"></td>
		
	</tr>
	<tr height="100%">
		<td colspan="2" style="padding: 20 0 0 130" valign="top">
			<?
			if ($page != "") include "content/$page";
			?>
		</td>
	</tr>
	<tr>
		<td style="background-image: url(<?echo $basepath?>img/logo-stripe-left.gif); padding: 0 0 0 70;"><img src="<?echo $basepath?>img/spacer.gif" height="7"></td>
		<td style="background-image: url(<?echo $basepath?>img/logo-stripe.gif);"><img src="<?echo $basepath?>img/spacer.gif" height="7"></td>
	</td>
	<tr>
		<td colspan="2" style="padding: 0 0 0 70" valign="top">
			<a class='inline' href="mailto:tom@tombeale.com">tom@tombeale.com</a> <img src="<?echo $basepath?>img/bul.gif" hspace="3" vspace="2">  
			503.481.9421 (cel) <img src="<?echo $basepath?>img/bul.gif" hspace="3" vspace="2">
			503.537.3064 (home)
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding: 0 0 0 70" valign="top">
			<div id="debugsec" style="font-size: 7pt; padding: 2 0 0 130;"></div>
			<input type="hidden" name="main" value="<?echo $main?>">
			<input type="hidden" name="sub" value="<?echo $sub?>">
			<input type="hidden" name="page" value="<?echo $page?>">
			<input type="hidden" name="params" value="">
			<input type="hidden" name="cmd" value="">
			<input type="hidden" name="fieldmap" value="">
			<input type="hidden" name="id" value="">
			</form>
			<?
			require "inc/menu.php"
			?>
			<div class="link" style="position:absolute;top:0px;right:0px;height:10px;width:10px;" onmouseup="debugwin()">&nbsp;</div>
			<iframe name="result" width="100%" height="0" 
				frameborder="0"
				src="about:blank"
				style="border-width: 0px; border-style: none;">
			</iframe>
			<div id="helpsec"  style="position:absolute"></div>
			<div id="amenusec" style="position:absolute"></div>
			<div id="cmenusec" style="position:absolute"></div>
			<div id="infosec"  style="position:absolute"></div>
		</td>
	</tr>
</table>
</body>
</html>

