<html>
<head>
    <title>
    	
    </title>
	<script language="JavaScript">

		function showprops(obj)
			{
			obj = obj.currentStyle
			var sErrors = ""
			tobj = document.getElementById("sample")
			var sBuffer = "<table cellspacing='0' cellpadding='0'>"
			var arr = new Array();
			
			for (var a in obj)
				{
				arr[arr.length] = new Array(a, obj[a])
				try {
					tobj.style[a] = obj[a]
					}
				catch (e)
					{
					sErrors += e.description + "</br>"
					}
				}
			
			arr.sort()
			
			for (var a=0;a<arr.length;a++)
				{
				sBuffer += "<tr class='row" + (a % 2) + "'><td><b>" + arr[a][0] + "</b></td><td>" + arr[a][1] + "</td></tr>"
				}
			document.getElementById("reportsec").innerHTML = sBuffer + "</table>"
			
			if (sErrors != "") document.getElementById("errorsec").innerHTML = sErrors
			}
	</script>
	<style>
		a:hover { color: #6666ff; }	
		a:link,
		a:visited,
		a:active
		{text-decoration : none}
		
		td {
			font-family: arial;
			font-size: 9pt;
			}
		
		.row0 {
			background-color: #ffffff;
			}
		
		.row1 {
			background-color: #cccccc;
			}
		
		.mystyle2 {
			background-color: #ff0000;
			font-family: verdana;
			font-weight: bold;
			font-color: #ffff00;
			font-size: 24pt;
			}

		.mystyle {
			background-color: #ffff00;
			font-family: verdana;
			font-weight: bold;
			font-color: #ff0000;
			font-size: 24pt;
			border-color: red;
			border-style: solid;
			border-weight: 3;
			}
	</style>
</head>
<body bgcolor="ffffff">
	
	<div class="mystyle2" onclick="showprops(this)">
		obj.currentStyle
	</div>
	<div class="mystyle" onclick="showprops(this)">
		obj.currentStyle
	</div>
	<table>
		<tr>
			<td valign="top" class="list" id="reportsec"></td>
			<td valign="top">
				<div id="sample">
					This is some content
				</div>
				<div id="errorsec">
					No Errors
				</div>
			</td>
		</tr>
	</table>	
	</div>
</body>
</html>
