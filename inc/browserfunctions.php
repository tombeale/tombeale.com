<?
	$sBrowserFull = "??";
	$sBrowser     = "??";
	$sPlatform    = "??";
	$iVersion     = -1;
	$sUserAgent   = "";
	$iPod         = 0;
	$iPad         = 0;
	$iPhone       = 0;
	$isMobile     = 0;
/*
HTC Hero
   Mozilla/5.0 (Linux; U; Android 1.5; en-us; A6277 Build/CUPCAKE) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1
Droid
   Mozilla/5.0 (Linux; U; Android 2.0.1; en-us; Droid Build/ESD56) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17
iPhone
   Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_1_2 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7D11 Safari/528.16
iPod Touch
   Mozilla/5.0 (iPod; U; CPU iPhone OS 3_1_2 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7D11 Safari/528.16
Nintendo DS
   Opera/9.50 (Nintendo DSi; Opera/507; U; en-US)
Red Hat Enterprise 4u6
   Mozilla/5.0 (X11; U; Linux i686 (x86_64); en-US; rv:1.9.0.14) Gecko/2009082504 Red Hat/3.0.14-1.el4 Firefox/3.0.14
Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727)
Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9) Gecko/2008052906 Firefox/3.0
Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Version/3.1 Safari/525.13
Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/532.0 (KHTML, like Gecko) Chrome/3.0.195.38 Safari/532.0
The word "nokia" can be found in the User-Agent header of Nokia's cell phones.
The word "motorola" or "mot-" can be found in the User-Agent header of Motorola's cell phones.
The word "samsung" or "sec-" can be found in the User-Agent header of Samsung's cell phones.
The word "lg-" can be found in the User-Agent header of LG's cell phones.
The word "sonyericsson" can be found in the User-Agent header of Sony Ericsson's cell phones.
The word "sie-" can be found in the User-Agent header of Siemens' cell phones.
The word "up.b" or "up/" can be found in the User-Agent header of cell phones that uses the Openwave Mobile Browser.
*/

function getOS($s) {

	if (strpos($s, "Windows") > 0)  { return "Windows"; }
	if (strpos($s, "Mac") > 0)      { return "Mac"; }
	if (strpos($s, "iPod") > 0)     { return "iPod"; }
	if (strpos($s, "iPad") > 0)     { return "iPad"; }
	if (strpos($s, "iPhone") > 0)   { return "iPhone"; }
	if (strpos($s, "Nintendo DSi") > 0) { return "Nintendo DSi"; }
	if (strpos($s, "Android") > 0)  { return "Android"; }
	if (strpos($s, "nokia") > 0)    { return "Nokia"; }
	if (strpos($s, "motorola") > 0) { return "Motorola"; }
	if (strpos($s, "mot-") > 0)     { return "Motorola"; }
	if (strpos($s, "samsung") > 0)  { return "Samsung"; }
	if (strpos($s, "sec-") > 0)     { return "Samsung"; }
	if (strpos($s, "lg-") > 0)      { return "LG"; }
	if (strpos($s, "sonyericsson") > 0) { return "SonyEricsson"; }
	if (strpos($s, "sie-") > 0)     { return "Siemens"; }
	if (strpos($s, "up.b") > 0)     { return "Openwave"; }
	if (strpos($s, "up/") > 0)      { return "1"; }
	if (strpos($s, "Linux") > 0)    { return "Linux"; }
	
	return "Unknown";
}


function parseUserAgent() {

	global $sBrowserFull;
	global $sBrowser;
	global $sPlatform;
	global $iVersion;
	global $sUserAgent;
	global $iPhone;
	global $iPod;
	global $isMobile;

	$iOffset = -1;
	$sUserAgent = $_SERVER['HTTP_USER_AGENT'];
	$sTemp = "";

	// ----- Get Browser and Version

	if (($iOffset = strpos($sUserAgent, "MSIE")) > 0) {
		$sBrowser     = "I";
		$sTemp        = substr($sUserAgent, $iOffset, 8);
		$sBrowserFull = $sTemp;
		$sTemp        = split(" ", $sTemp);
		$iVersion     = floatval($sTemp[1]);
	}
	else if (($iOffset = strpos($sUserAgent, "Firefox")) > 0) {
		$sBrowser     = "F";
		$sTemp        = substr($sUserAgent, $iOffset, 11);
		$sTemp        = str_replace("/", " ",  $sTemp);
		$sBrowserFull = $sTemp;
		$sTemp        = split(" ", $sTemp);
		$iVersion     = floatval($sTemp[1]);
	}
	else if (($iOffset = strpos($sUserAgent, "Chrome")) > 0) {
		$sBrowser     = "C";
		$sTemp        = substr($sUserAgent, $iOffset, 10);
		$sTemp        = str_replace("/", " ",  $sTemp);
		$sBrowserFull = $sTemp;
		$sTemp        = split(" ", $sTemp);
		$iVersion     = floatval($sTemp[1]);
	}
	else if (($iOffset = strpos($sUserAgent, "Safari")) > 0) {
		$sBrowser     = "S";
		$sTemp        = substr($sUserAgent, $iOffset, 13);
		$sTemp        = str_replace("/", " ",  $sTemp);
		$sBrowserFull = $sTemp;
		$sTemp        = split(" ", $sTemp);
		$iVersion     = floatval($sTemp[1]);
	}

	// ----- Get OS
	if (strpos($sUserAgent, "Mobile") > 0) $isMobile = "1";
	if (strpos($sUserAgent, "iPad") > 0) $isMobile = "0";
	$sPlatform = getOS($sUserAgent);

}
// Mozilla/5.0 (iPod; U; CPU iPhone OS 3_1_2 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7D11 Safari/528.16

function browserVersion($sB, $iVer) {
	$iVer = intval($iVer);
	if (($sBrowser == $sB) && ($iVer <= $iVersion)) return true;
	return false;
}


parseUserAgent();


?>