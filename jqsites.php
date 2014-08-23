<!DOCTYPE html>
<html>
	<head>
		<link href='fontlib/titillium.css' rel='stylesheet' type='text/css'>
		<link href='fontlib/ghandi.css' rel='stylesheet' type='text/css'>
		<script language="JavaScript" src="lib/jquery-min.js"></script>
		<script language="JavaScript" src="lib/ajax.js"></script>
		<script language="JavaScript" src="lib/tables.js"></script>
		<script language="JavaScript" src="lib/functions.js"></script>
		<script language="JavaScript" src="lib/dialog.js"></script>
		<script language="JavaScript" src="lib/siteinfo.js"></script>
		<style>
			.body, td {
				font-family: 'ghandi', Arial;
				font-size: 10pt;
				overflow: hidden;
			}
			
			.sitename {
				font-family: 'ghandi', Serif;
				padding-left: 25px;
				font-size: 13pt;
				font-weight: bold;
				color: #333377;
			}

			.siteurl {
				font-family: 'ghandi', Sans-Serif;
				padding-left: 50px;
				padding-bottom: 5px;
				font-size: 11pt;
				color: #000099;
				cursor: pointer;
			}
			
			.siteurl:hover {
				color: #2b75c1;
			}
			
			table.button {
				float: right;
				cursor: pointer;
			}
			
			table.button_disabled {
				float: right;
			}
			
			td {
				border: none;
				padding: 0;
			}
			
			TD.row {
				padding: 3px 0;
				border-bottom: solid 1px #f9e0ab;
			}
			
			body {
				margin: 0px;
				padding: 0px;
				font-family: 'titillium', Arial;
			}
			
			.link {
				color: blue;
				cursor: pointer;
			}
			
			#bodysec {
				width: 100%;
			}
			
			#outersec {
				overflow: hidden;
			}
			
			#headersec {
				height: 30px;
				background-image: url("img/jqsites/menu_bg.png");
			}
			
			#mainsec {
				overflow: auto;
				width: 100%;
			}
			
			#masksec {
				position: absolute;
				height: 0px;
				width: 0px;
				background-color: white;
				display: none;
			}
			
			#editsec {
				position: absolute;
				right: 30px;
				
				display: none;
			}
			
			#dialogsec {
				position: absolute;
				height: 600px;
				width: 600px;
				display: none;
			}
			
			.title {
				font-size: 12pt;
			}
			
			.stats {
				font-size: 9pt;
				font-weight: normal;
			}
			
			.label {
				font-size: 10pt;
				text-align: right;
				padding-right: 8px;
			}
			
			.dialog-left {
				background-repeat: repeat-y;
				background-position: left; 
			}
			
			.dialog-right {
				background-repeat: repeat-y;
				background-position: right; 
			}
			
			.dialog-bottom {
				background-repeat: repeat-x;
				background-position: right bottom; 
			}
			
		</style>
		<script language="JavaScript">
			var sRaw = Request("ajax/jquerysites.php","orderby=name");
			
			var oListing = genDBTable(sRaw);
			var oLine;
			var oCats = new Object();
			var iHeaderHeight = 30;
			
			var oBodySec;
			var oHeaderSec;
			var oMainSec;
			var oMaskSec;
			var oDialogSec;
			var oOuterSec;
			
			var oSiteBuffer = new Site();
			
			var oCategories = [
				"Corporate",
				"Design",
				"Education",
				"Entertainment",
				"Family & Kids",
				"Data Driven",
				"E-Commerce",
				"Games",
				"Job Search",
				"News and Info",
				"Social"
			];
			
			$(document).ready(function () {
				oBodySec   = document.getElementById("bodysec");
				oHeaderSec = document.getElementById("headersec");
				oMainSec   = document.getElementById("mainsec");
				oMaskSec   = document.getElementById("masksec");
				oDialogSec = document.getElementById("dialogsec");
				oOuterSec  = document.getElementById("outersec");
				setMetrics();
				drawHeader()
				drawGrid();
			});
			
			function refresh() {
				sRaw = Request("ajax/jquerysites.php","orderby=name");
				oListing = genDBTable(sRaw);
				drawGrid();
			}
			
			$(window).resize(function() {
				setMetrics();
			});
			
			function setMetrics() {
				var iDocHeight = $(window).height();
				var iDocWidth  = $(window).width();
				$(oOuterSec).height(iDocHeight);
				$(oOuterSec).width(iDocWidth);
				$(oHeaderSec).height(iHeaderHeight);
				$(oMainSec).height(iDocHeight - iHeaderHeight);
				
				var iWidth  = $("#bodysec").width();
				
				if (false) alert([
					iDocHeight,
					iDocWidth, 
					iHeaderHeight
				].join("\n"));
				
			}
			
			
			function drawGrid() {
				var oBuffer = ["<table cellspacing='0' cellpadding='0' border='0' width='100%'>"];
				for (var a=1;a<oListing.length;a++) {
					oLine = oListing[a];
					oBuffer.push([
						"<tr class='row' id='" + a + "' onmouseover='hiliteRow(this)' onmouseout='normRow(this)'>",
							"<td class='row'>",
								"<div class='sitename'>" + oLine[1] + "</div>",
								"<div><span class='siteurl'",
									" onmouseup=\"show('" + oLine[2] + "')\"",
								">" + oLine[2] + "</span></div>",
							"</td>",
							"<td class='row'>",
								genRatingControl(oLine[3]),
							"</td>",
						"</tr>"
					].join(""));
				}
				oBuffer.push("</table>");
				setInnerHTML("mainsec", oBuffer.join(""));
				setInnerHTML("statsec", "(" + oListing.length + " rows found)");
			}
			
			function drawHeader() {
				var oBuffer = [
					"<table cellspacing='0' cellpadding='0' border='0' height='" + iHeaderHeight + "px' width='100%'>",
						"<tr>",
							"<td class='title' style='padding-left: 10px;font-weight:bold;'>",
								"Best jQuery Sites&nbsp;",
								"<span class='stats' id='statsec'></span>",
							"</td>",
							"<td style='text-align: right; padding: 4px 25px; 0 0'>",
								genHeaderButtons(),
							"</td>",
						"</tr>",
					"</table>"
				];
				setInnerHTML("headersec", oBuffer.join(""));
			}
			
			function genHeaderButtons() {
				return [
					genButton("btn_new", "Add Site", "addLink()"),
					genButton("btn_export", "Export", "exportData()"),
					genButton("btn_import", "Import", "importData()")
				].join("");
			}
			
			
			function show(url) {
				window.open(url);
			}
			
			function hiliteRow(obj) {
				obj.style.backgroundColor = "#ffe";
				showRowEdit(obj);
			}
			
			function normRow(obj) {
				obj.style.backgroundColor = "";
				hideRowEdit(obj);
			}
			
			function showRowEdit(obj) {
				var p  = $(obj).position();
				var y  = p.top;
				var iHeight = $(obj).height();
				var index = obj.id;
				var oRow = oListing[index];
				$("#editsec").css("top", y);
				$("#editsec").show();
				$("#editsec").height(iHeight);
				$("#editsec").html([
					"<table style='height: " + iHeight + "px;'>",
						"<tr>",
							"<td>",
								
							"</td>",
							"<td>",
								"<img src='img/jqsites/deletesite-0.png'",
									" onmouseover=\"setImage(this, 'img/jqsites/deletesite-1.png')\"",
									" onmouseout=\"setImage(this, 'img/jqsites/deletesite-0.png')\"",
									" onmouseup=\"removeLink('" + index + "')\"",
								">",
							"</td>",
						"</tr>",
					"</table>"
				].join(""));
			}
			
			function removeLink(id) {
				var oRow = oListing[id];
				if (confirm("Remove '" + oRow[1] + "?")) {
					var sData = Request("ajax/deletejquerysite.php", "id=" + oRow[0]);
					sRaw = Request("ajax/jquerysites.php","orderby=name");
					oListing = genDBTable(sRaw);
					drawGrid();
				}
			}
			
			function hideRowEdit(obj) {
				//$("#editsec").hide();
				//$("#editsec").html("");
			}
			
			function handleCategoryClick(obj) {
				oCats[obj.value] = obj.checked;
				oSiteBuffer.category = serializeCats(oCats);
			}
			
			function serializeCats(obj) {
				var oBuffer = [];
				for (a in obj) {
					if (obj[a]) oBuffer.push(a);
				}
				return "|" + oBuffer.join("|") + "|";
			}
			
			
			function addLink() {
				oCats = new Object();
				oSiteBuffer = new Site();
				addSitePopup();
			}
			
			function exportData() {
				var sData = Request("ajax/exportjquerysites.php");
				exportSitesPopup(sData);
			}
			
			function importData() {
				importSitesPopup();
			}
			
			function applyImportData(sRaw) {
				var sData = ajax("ajax/importjquerysites.php", "raw=" + escape(sRaw), false, "POST");
				return sData;
			}
			
			function addSitePopup() {
				var oDialog = new Dialog("dlg", "Add Site", 350);
				var sContent = [
					"<table>",
						"<tr>",
							"<td class='label'><nobr>Site Name</nobr></td>",
							"<td><input id='name' onchange='updateName(this)' style='width: 200px'></td>",
						"</tr>",
						"<tr>",
							"<td class='label'>URL</td>",
							"<td><input id='url' onchange='updateURL(this)' style='width: 300px'></td>",
						"</tr>",
						"<tr>",
							"<td class='label'>Rating</td>",
							"<td>",
								genRatingControl(),
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='label'>Category</td>",
							"<td>",
								genCategoryControl(oSiteBuffer.categories),
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='label'>Comments</td>",
							"<td>",
								"<textarea id='comments'",
								" onkeyup='handleCommentChange(this)'",
								" style='width: 300px; height:90px;'>",
									oSiteBuffer.notes,
								"</textarea>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='label'></td>",
							"<td id='dlg_buttonsec' align='right' style='padding-top: 4px;'>",
								genButton("btn_cancel", "Cancel", "clearDialog()"),
								genButton("btn_save",   "Save",   "addSite()"),
							"</td>",
						"</tr>",
					"</table>"
				].join("");
				
				var iWindowWidth  = $(window).width();
				var iWindowHeight = $(window).height();
				
				$(oDialogSec).html(oDialog.draw(sContent, "<input type='button' onmouseup='hideDialog()'>"));
				$(oDialogSec).css("top",  parseInt((iWindowHeight - 400) / 2, 10));
				$(oDialogSec).css("left", parseInt((iWindowWidth  - oDialog.width) / 2, 10));
				showMask();
				$(oDialogSec).fadeIn(200, checkForm)
			}

			function exportSitesPopup(sData) {
				var oDialog = new Dialog("dlg", "Export Sites", 700);
				var sContent = [
					"<table>",
						"<tr>",
							"<td class='label'>",
								"<textarea style='width: 680px; height:550px;'>",
									sData,
								"</textarea>",
							"</td>",
						"</tr>",
					"</table>"
				].join("");
				
				var iWindowWidth  = $(window).width();
				var iWindowHeight = $(window).height();
				
				$(oDialogSec).html(oDialog.draw(sContent, "<input type='button' onmouseup='hideDialog()'>"));
				$(oDialogSec).css("top",  parseInt((iWindowHeight - 700) / 2, 10));
				$(oDialogSec).css("left", parseInt((iWindowWidth  - oDialog.width) / 2, 10));
				showMask();
				$(oDialogSec).fadeIn(200);
			}

			function importSitesPopup(sData) {
				var oDialog = new Dialog("dlg", "Import Sites", 700);
				var sContent = [
					"<table>",
						"<tr>",
							"<td colspan='2' class='label'>",
								"<textarea id='importdatacontrol' style='width: 680px; height:550px;'>",
								"</textarea>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td id='messagesec'></td>",
							"<td class='importbuttonsec'><nobr>",
								refreshImportButtons(1),
							"</nobr></td>",
						"</tr>",
					"</table>"
				].join("");
				
				var iWindowWidth  = $(window).width();
				var iWindowHeight = $(window).height();
				
				$(oDialogSec).html(oDialog.draw(sContent, "<input type='button' onmouseup='hideDialog()'>"));
				$(oDialogSec).css("top",  parseInt((iWindowHeight - 700) / 2, 10));
				$(oDialogSec).css("left", parseInt((iWindowWidth  - oDialog.width) / 2, 10));
				showMask();
				$(oDialogSec).fadeIn(200);
			}

			function refreshButtons(sState) {
				var sHandler = false;
				if (sState == 1) {
					sHandler = "addSite()"
				}
				return [
						genButton("btn_cancel", "Cancel", "clearDialog()"),
						genButton("btn_save",   "Save",   sHandler)
				].join("");
			}
			
			function refreshImportButtons(sState) {
				var sHandler = false;
				if (sState == 1) {
					sHandler = "submitImportData()"
				}
				return [
						genButton("btn_cancel", "Cancel", "clearDialog()"),
						genButton("btn_save",   "Import",   sHandler)
				].join("");
			}
			
			function addSite() {
				var sBuffer = serialize(oSiteBuffer);
				result = Request("ajax/addjquerysite.php","raw=" + escape(sBuffer));
				clearDialog();
				refresh();
			}
			
			function submitImportData() {
				var obj = document.getElementById("importdatacontrol");
				var sRaw = obj.value;
				var sReturn = applyImportData(sRaw)
				obj.value = sReturn;
			}
			
			
			function showMask() {
				oMaskSec.style.top = "0px";
				oMaskSec.style.left = "0px";
				$(oMaskSec).width($(window).width());
				$(oMaskSec).height($(window).height());
				$(oMaskSec).fadeTo(0,0);
				$(oMaskSec).show();
				$(oMaskSec).fadeTo(0,0.5);
			}
			
			function hideMask() {
				$(oMaskSec).fadeTo(0,0, function() {
					$(oMaskSec).hide();
					$(oMaskSec).width(0);
					$(oMaskSec).height(0);
				});
			}
			
			function clearDialog() {
				$(oDialogSec).fadeOut(200, function() {
					$(oDialogSec).html("");
					$(oDialogSec).css("top",  0);
					$(oDialogSec).css("left", 0);
					hideMask();
				});
			}
			
			function genButton(sID, sLabel, sHandler) {
				var sStatus = "0";
				var sClass  = "button"
				var sHandlers = [
					" onmouseover=\"switchButtonImage('" + sID + "', '1')\"" ,
					" onmouseout=\"switchButtonImage('" + sID + "', '0')\"" ,
				].join("")
				if (!sHandler) {
					sStatus   = "2";
					sClass    = "button_disabled";
					sHandlers = "";
				}
				var oBuffer = [
					"<table class='" + sClass + "' cellspacing='0' cellpadding='0' border='0'>",
						"<tr onmouseup=\"" + sHandler + "\">",
							"<td>&nbsp;</td>",
							"<td><img src='img/jqsites/button-l-" + sStatus + ".png' id='" + sID + "-l'></td>",
							"<td id='" + sID + "-c' style='",
									"background-image: url(img/jqsites/button-c-" + sStatus + ".png);",
									"background-repeat:repeat-x;",
									"padding-top: 2px;",
									"vertical-align: top;'",
								sHandlers,
							"><b>",
								sLabel,
							"</b></td>",
							"<td><img src='img/jqsites/button-r-" + sStatus + ".png' id='" + sID + "-r'></td>",
						"</tr>",
					"</table>"
				]
				return oBuffer.join("");
			}
			
			function switchButtonImage(sBase, sStatus) {
				var objl = document.getElementById(sBase + "-l");
				var objc = document.getElementById(sBase + "-c");
				var objr = document.getElementById(sBase + "-r");
				objl.src = "img/jqsites/button-l-" + sStatus + ".png";
				objc.style.backgroundImage = "URL('img/jqsites/button-c-" + sStatus + ".png')";
				objr.src = "img/jqsites/button-r-" + sStatus + ".png";
			}
			
			function genOptions(oData, sDefault) {
				var oBuffer = [];
				for (var a=0;a<oData.length;a++) {
					oBuffer.push("<option value='" + oData[a] + "'>" + oData[a] + "</option>");
				}
				return oBuffer.join("");
			}
			
			function genRatingControl(iRating) {
				if (!iRating) iRating = oSiteBuffer.rating;
				var oBuffer = ["<nobr>"];
				var iStat = "0"
				for (var a=1;a<=5;a++) {
					iStat = (a <= iRating) ? "1" : "0"; 
					oBuffer.push([
						"<img class='link' id='rating" + a + "'",
						" onmouseover='refreshRatingControl(" + a + ")'",
						" onmouseout='refreshRatingControl()'",
						" onmouseup='setRating(" + a + ")'",
						" src='img/star-" + iStat + ".png'",
						">"
					]);
				}
				oBuffer.push("</nobr>");
				return oBuffer.join("");
			}
			
			function refreshRatingControl(iRating) {
				if (!iRating) iRating = oSiteBuffer.rating;
				var iStat = "0"
				for (var a=1;a<=5;a++) {
					iStat = (a <= iRating) ? "1" : "0"; 
					$("#rating" + a).attr("src", "img/star-" + iStat + ".png");
				}
			}
			
			function setRating(iRating) {
				oSiteBuffer.rating = iRating;
			}
			
			function updateName(obj) {
				oSiteBuffer.name = obj.value;
				checkForm();
			}
			
			function updateURL(obj) {
				oSiteBuffer.url = obj.value;
				checkForm();
			}
			
			function handleCommentChange(obj) {
				oSiteBuffer.notes = obj.value;
			}
			
			function genCategoryControl(sCategories) {
				var oBuffer = ["<table cellspaing='0' border='0'><tr>"];
				for (var a=0;a<oCategories.length;a++) {
					oBuffer.push([
						"<td><input id='cat" + a + "' type='checkbox' value='" + oCategories[a] + "'",
						" onchange='handleCategoryClick(this)'></td>",
						"<td><label for='cat" + a + "'>" + oCategories[a] + "</label></td>"
					].join(""));
					if (a % 2 == 1) oBuffer.push("</tr><tr>");
				}
				oBuffer.push("</tr></table>");
				return oBuffer.join("");
			}
			
			function checkForm() {
				var sStatus = 1;
				if (oSiteBuffer.name == "") sStatus = 0;
				if (oSiteBuffer.url == "") sStatus = 0;
				$("#dlg_buttonsec").html(refreshButtons(sStatus));
			}
			
			function initBuffer() {
				return {
					"id"       : -1,
					"name"     : "",
					"url"      : "",
					"rating"   : 0,
					"category" : "",
					"notes"    : ""
				}
			}
			
			function serialize(oRow) {
				var oBuffer = new Array();
				for (var a in oRow) {
					oBuffer.push(a + "\3" + oRow[a]);
				}
				return oBuffer.join("\2");
			}
			
			function dumpItem(oRow) {
				var oBuffer = new Array();
				for (var a in oRow) {
					oBuffer.push(a + ": " + oRow[a]);
				}
				return oBuffer.join("\n");
			}
			
			function mouseMove(e) {
				if (bDialogDragActive) {
					if (!e) e = window.event;
					var x = e.pageX - iDialogOffestX;
					var y = e.pageY - iDialogOffestY;
					$(oDialogSec).css("top", y);
					$(oDialogSec).css("left", x);
					$("#messagesec").html(x + " : " + y);
					
				}
			}
			
			function mouseUp() {
				bDialogDragActive = false;
			}
		</script>
	</head>
	
	
	<body onmousemove='mouseMove(event)' onmouseup='mouseUp()'>
		<div id="outersec">
			<div id="bodysec">
				<div id="headersec"></div>
				<div id="mainsec"></div>
			</div>
			<div id='masksec''></div>
		</div>
		<div id='dialogsec'></div>
		<div id='editsec'>editsec</div>
	</body>
</html>
