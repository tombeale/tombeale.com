<html>
<head>
<title>Debugging Window</title>
<style>
	body {
		font-family: arial;
		font-size: 8pt;
		}
		
	td {
		font-family: arial;
		font-size: 8pt;
		border-width: 1px;
		border-style: solid;
		border-color: #cccccc;
		}
		
	td.parsedr {
		font-family: arial;
		font-size: 8pt;
		font-weight: bold;
		color: blue;
		border-width: 0px 0px 1px 0px;
		border-style: none none solid none;
		border-color: #999999;
		}
		
	td.parsed {
		font-family: arial;
		font-size: 8pt;
		border-width: 0px 0px 1px 0px;
		border-style: none none solid none;
		border-color: #999999;
		padding-left: 4px;
		}
</style>
<script language="JavaScript">

	function doLoad() {
		oOutSec   = document.getElementById("outsec")
		oFormSec   = document.getElementById("formsec")
		oEPrintSec = document.getElementById("eprintsec")
		oWatchSec  = document.getElementById("watchsec")
		self.focus()
		dumpForm();
		ParseEPrints();
		genWatchSection();
	}
</script>


<body onload="doLoad()">
<script language="JavaScript" src="../lib/tables.js"></script>
<script language="JavaScript">

var oForm      = opener.document.details;
var oWatchList = opener.watchList;
var oWatches   = new Array();

var oFormSec
var oOutSec
var oEPrintSec
var iWatchColumns = 3
var iWatchColumnCount = 0

function genWatchSection() {
	var oWatchItem
	var oBuffer = new Array("<table border='0' cellspacing='1'></tr>")
	oBuffer.push(addWatchItem("Main Form",     false, "FORM"))
	oBuffer.push(addWatchItem("EPrint Buffer", false, "EPRINT"))
	for (var a=0;a<oWatchList.length;a++) {
		oWatchItem = oWatchList[a]
		oBuffer.push(addWatchItem(oWatchItem[0], oWatchItem[1], oWatchItem[2]));
	}
	oBuffer.push(addWatchItem("</tr><table>"));
	oWatchSec.innerHTML = oBuffer.join("");
}

function addWatchItem(cap, Item, option) {
	var iIndex = oWatches.length;
	oWatches[iIndex] = new Array(Item, option)
	var sReturn = "<td><a href='JavaScript:dumpWatch(" + iIndex + ")'>" + cap + "</td>"
	iWatchColumnCount++
	if (iWatchColumnCount > iWatchColumns) sReturn += "</tr><tr>"
	return sReturn;
}

function dumpWatch(iIndex) {
	var obj = oWatches[iIndex];
	switch (obj[1]) {
		case "FORM":
			dumpForm();
			break;
		case "EPRINT":
			ParseEPrints();
			break;
		case "DUMP":
			oOutSec.innerHTML = obj[0].dump();
			break;
		default:
			ParseArray(obj[0])
	}
}

function dumpForm() {
	var oBuffer = [
		"<p><b>Details (Main Form)</b>",
		"<table border='0' cellspacing='1'>",
		"<tr><td><i>Name</i></td><td><i>Type</i></td><td><i>Value</i></td></tr>"
	]
	for (var a=0;a<oForm.length;a++) {
		oBuffer.push([
			"<tr>",
				"<td>" + oForm[a].name + "&nbsp;</td>",
				"<td>" + oForm[a].type + "&nbsp;</td>",
				"<td>" + oForm[a].value + "&nbsp;</td>",
			"</tr>"
		].join(""));
	}
	oBuffer.push("</table>");
	oOutSec.innerHTML = oBuffer.join("");
}

for (var a=0;a<opener.watchList.length;a++) {
	switch (opener.watchList[a][1]) {
		case "TABLE":
			PT(opener.watchList[a][0], opener[opener.watchList[a][0]])
			break;
	}
}


function PT(cap,obj) {
	try {
		P(dumpTable(cap,obj));
	}
	catch (e) {
		P(e.description)
	}
}

function PL(cap,obj) {
	try {
		P(dumpLookupTable(cap,obj));
	}
	catch(e) {}
}

function P(s) {
	document.write(s)
}

function ParseEPrints() {
	arr = opener.oDebugBuffer;
	var oBuffer = new Array("<table class='parsed' cellspacing='0' width='100%'>");
	for (var a=0;a<arr.length;a++) {
		oBuffer.push([
			"<tr><td align='right' class='parsedr'>",
			arr[a].join("</td><td class='parsed'>"),
			"</dt></tr>"
		].join(""));
	}
	oBuffer.push("</table>");
	oOutSec.innerHTML = oBuffer.join("");
}

function ParseArray(arr) {
	var oBuffer = new Array("<table class='parsed' cellspacing='0' width='100%'>");
	for (var a in arr) {
		oBuffer.push("<tr>")
		for (var b in arr[a]) {
			oBuffer.push("<td class='parsedr'>" + arr[a][b] + "</td>")
		}
		oBuffer.push("<tr>")
		
	}
	oBuffer.push("</table>");
	oOutSec.innerHTML = oBuffer.join("");
}



</script>
<div id="watchsec"></div>
<hr>
<div id="outsec"></div>
<hr>
<div id="eprintsec"></div>
</body>