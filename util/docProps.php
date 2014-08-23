<html>
<head>
    <title>
    	
    </title>
	<script language="JavaScript">

		bDoFormLoad = true

		function showprops()
			{
			var obj = getElementById("cb")
			var sErrors = ""
			var sBuffer = "<table cellspacing='0' cellpadding='0'>"
			var arr = new Array();
			
			for (var a in obj)
				{
				arr[arr.length] = new Array(a, obj[a])
				}
			
			arr.sort()
			
			for (var a=0;a<arr.length;a++)
				{
				sBuffer += "<tr class='row" + (a % 2) + "'><td><b>" + arr[a][0] + "</b></td><td>" + arr[a][1] + "</td></tr>"
				}
			document.getElementById("reportsec").innerHTML = sBuffer + "</table>"
			
			if (sErrors != "") document.getElementById("errorsec").innerHTML = sErrors

			}
			
		function formload()
			{
			alert("Hey")
			showprops()
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
	<input type='checkbox' name='cb' id='cb'>
	<table>
		<tr>
			<td valign="top" class="list" id="reportsec">RC</td>
			<td valign="top">
				<div id="errorsec">
					No Errorsvvv
				</div>
			</td>
		</tr>
	</table>	
