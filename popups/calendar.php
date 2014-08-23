<html>
<head>
    <title>
    
    </title>
<script language="JavaScript" src="../lib/datefunctions.js"></script>
<script language="JavaScript" src="../lib/innerhtml.js"></script>
<script language="JavaScript">

	var dStartDate = "<?echo $date?>";
	
	if (dStartDate == "")
		{
		dStartDate = new Date();
		}
	else
		{
		dStartDate = new Date(dStartDate);
		}
	
	var iYear = dStartDate.getFullYear();
	var iMonth = dStartDate.getMonth() + 1;
	var iDate = dStartDate.getDate();
	
	function doLoad()
		{
		Q(Cal(iYear,iMonth,iDate));
		QPrint("calsec");
		self.focus();
		}

	try {
		var obj = opener.document.details["<?echo $name?>"];
		}
	catch (e)
		{
		self.close();
		}
	
	function Cal(y,m,d)
		{
		var sBuffer = ""
		var dDate = new Date(y,m-1,1)
		var iStart = dDate.getDay()
		iStart = 1 - iStart
		if (m == 2) setFeb(y)
		
		sBuffer += "<table width='100%' height=100%' cellspacing='1' border='0'>"
		sBuffer += "<tr>"
		sBuffer += "<td class='link' onmouseup='lastmonth(" + m + "," + y + ")'><img hspace='2' src='../img/lastmonth.gif' alt='Back one month'></td>"
		sBuffer += "<td class='cal_heading' colspan='5'>" + arrMonths[pad(m)] + "&nbsp;" + y + "</td>"
		sBuffer += "<td class='link' onmouseup='nextmonth(" + m + "," + y + ")'><img hspace='2' src='../img/nextmonth.gif' alt='Forward one month'></td>"
		sBuffer += "<tr>"
		sBuffer += 		"<td class='daylabel'>S</td>"
		sBuffer += 		"<td class='daylabel'>M</td>"
		sBuffer += 		"<td class='daylabel'>T</td>"
		sBuffer += 		"<td class='daylabel'>W</td>"
		sBuffer += 		"<td class='daylabel'>T</td>"
		sBuffer += 		"<td class='daylabel'>F</td>"
		sBuffer += 		"<td class='daylabel'>S</td>"
		sBuffer += "</tr>"
		for (var a=iStart;a<=31;a+=7)
			{
			sBuffer += drawWeek(a,lastday[m],m,y)
			}
		sBuffer += "<table>"
		return sBuffer;
		}
	
	function drawWeek(d, iMax, m, y)
		{
		var sBuffer = ""
		var iDay;
		sBuffer += "<tr>";
		for (var a=0;a<7;a++)
			{
			iDay = d + a;
			if ((iDay > 0) && (iDay <= iMax))
				{
				sBuffer += "<td class='cal_day' onmouseup='setDate(" + m + "," + iDay + "," + y + ")'>" + iDay + "</td>"
				}
			else
				{
				sBuffer += "<td >&nbsp;</td>"
				}
			}
		sBuffer += "</tr>"
		return sBuffer;
		}

	function lastmonth(m,y)
		{
		m--
		if (m < 1) 
			{
			m = 12;
			y--;
			}
		Q(Cal(y,m,iDate));
		QPrint("calsec");
		}

	function nextmonth(m,y)
		{
		m++
		if (m > 12) 
			{
			m = 1;
			y++;
			}
		Q(Cal(y,m,iDate));
		QPrint("calsec");
		}

	function setDate(m,d,y)
		{
		try {
			obj.value = m + "/" + d + "/" + y
			obj.onkeyup()
			}
		catch(e) {}
		self.close()
		}

</script>
<link rel="stylesheet" href="../config/calendar.css" type="text/css" media="screen">
</head>

<body onload="doLoad()">
<div id="calsec" width="100%" height="100%" align="center" valign="middle"></div>


</body>
</html>
