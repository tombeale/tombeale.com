<script language="JavaScript">
	
	function Version(sUserAgent) {
		if (!sUserAgent) {
			this.browser = "<?php $sBrowser ?>";
			this.browserFull = "<?php $sBrowserFull ?>";
			this.version = parseFloat("<?php $iVersion ?>");
			if (!this.version) this.version = 0;
			this.platform = "<?php $sPlatform ?>";
			this.mobile = "<?php $isMobile ?>";
		}
		else {
			this.parseUserAgent(sUserAgent);
		}
	}
	
	Version.prototype.parseUserAgent = function(sUserAgent) {
		if ((iOffset = sUserAgent.indexOf("MSIE")) > 0) {
			this.browser     = "I";
			sTemp            = sUserAgent.substr(iOffset, 8);
			this.browserFull = sTemp;
			sTemp            = sTemp.split(" ");
			this.version     = parseFloat(sTemp[1]);
		}
		else if ((iOffset = sUserAgent.indexOf("Firefox")) > 0) {
			this.browser     = "F";
			sTemp            = sUserAgent.substr(iOffset, 11);
			sTemp            = sTemp.replace(/\//g, " ");
			this.browserFull = sTemp;
			sTemp            = sTemp.split(" ");
			this.version     = parseFloat(sTemp[1]);
		}
		else if ((iOffset = sUserAgent.indexOf("Chrome")) > 0) {
			this.browser     = "C";
			sTemp            = sUserAgent.substr(iOffset, 10);
			sTemp            = sTemp.replace(/\//g, " ");
			this.browserFull = sTemp;
			sTemp            = sTemp.split(" ");
			this.version     = parseFloat(sTemp[1]);
		}
		else if ((iOffset = sUserAgent.indexOf("Safari")) > 0) {
			this.browser     = "S";
			sTemp            = sUserAgent.substr(iOffset, 13);
			sTemp            = sTemp.replace(/\//g, " ");
			this.browserFull = sTemp;
			sTemp            = sTemp.split(" ");
			this.version     = parseFloat(sTemp[1]);
		}
		this.platform = this.getOS(sUserAgent)
		this.mobile = false
		if (sUserAgent.indexOf("Mobile") > 0) this.mobile = true;
	}
	
	Version.prototype.summary = function() {
		var sBuffer = "<table>"
			sBuffer += this.summaryRow("Browser (full)", "browserFull");
			sBuffer += this.summaryRow("Browser", "browser");
			sBuffer += this.summaryRow("Version", "version");
			sBuffer += this.summaryRow("Platform", "platform");
			sBuffer += this.summaryRow("Is Mobile?", "mobile");
		
		sBuffer += "</table>"
		var obj = document.getElementById("popup");
		if (obj) obj.innerHTML = sBuffer;
	}
	
	Version.prototype.summaryRow = function(sCaption, sKey) {
		var sBuffer = "<tr>";
		sBuffer += "<td class='caption'>" + sCaption + "</td>";
		sBuffer += "<td class='value'>" + this[sKey] + "</td>";
		sBuffer += "</tr>";
		return sBuffer;
	}
	
	Version.prototype.getOS = function(s) {
		if (s.indexOf("Windows") > 0)  { return "Windows"; }
		if (s.indexOf("iPod") > 0)     { return "iPod"; }
		if (s.indexOf("iPhone") > 0)   { return "iPhone"; }
		if (s.indexOf("Mac") > 0)      { return "Mac"; }
		if (s.indexOf("Nintendo DSi") > 0) { return "Nintendo DSi"; }
		if (s.indexOf("Android") > 0)  { return "Android"; }
		if (s.indexOf("nokia") > 0)    { return "Nokia"; }
		if (s.indexOf("motorola") > 0) { return "Motorola"; }
		if (s.indexOf("mot-") > 0)     { return "Motorola"; }
		if (s.indexOf("samsung") > 0)  { return "Samsung"; }
		if (s.indexOf("sec-") > 0)     { return "Samsung"; }
		if (s.indexOf("lg-") > 0)      { return "LG"; }
		if (s.indexOf("sonyericsson") > 0) { return "SonyEricsson"; }
		if (s.indexOf("sie-") > 0)     { return "Siemens"; }
		if (s.indexOf("up.b") > 0)     { return "Openwave"; }
		if (s.indexOf("up/") > 0)      { return "1"; }
		if (s.indexOf("Linux") > 0)    { return "Linux"; }
		return "Unknown";
	}
	
</script>



