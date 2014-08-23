var cdate = new Date();
var today = new Date();
var cdate;
var cmonth;
var today;

var oDates = new Array()
var currentDay

var realdate = today.getDate()
var realmonth = today.getMonth()
var realyear = today.getFullYear()

currentDay = fmtDate(realmonth+1,realdate,realyear)


var nextmonth = realmonth + 1
var nextyear = realyear
var lastmonth = realmonth -1
var lastyear = realyear


var thismonth = realmonth
var thisday   = realdate
var thisyear  = realyear

var lastday = new Array();

lastday[1]  = 31;
lastday[2]  = 29;
lastday[3]  = 31;
lastday[4]  = 30;
lastday[5]  = 31;
lastday[6]  = 30;
lastday[7]  = 31;
lastday[8]  = 31;
lastday[9]  = 30;
lastday[10] = 31;
lastday[11] = 30;
lastday[12] = 31;

var monthname = new Array();

monthname[0]  = "Jan";
monthname[1]  = "Feb";
monthname[2]  = "Mar";
monthname[3]  = "Apr";
monthname[4]  = "May";
monthname[5]  = "Jun";
monthname[6]  = "Jul";
monthname[7]  = "Aug";
monthname[8]  = "Sep";
monthname[9]  = "Oct";
monthname[10] = "Nov";
monthname[11] = "Dec";

bg = "";

var calsize = 2;
var caltext = "000000";

function day(m,d,y,cls)
	{
	var sBuffer = "";
	var etc = "";
	
	
	if ((String(oDates[fmtDate(m,d,y)]) != "undefined") && (String(oDates[fmtDate(m,d,y)]) != ""))
		{
		etc = " ondblclick=\"editDayDetails('" + fmtDate(m,d,y) + "')\" onmouseup=\"getDayDetails('" + fmtDate(m,d,y) + "');showToDos('" + fmtDate(m,d,y) + "')\" style='border-color:#000;color:#000;cursor:hand;'";
		}
	else
		{
		etc = " ondblclick=\"editDayDetails('" + fmtDate(m,d,y) + "')\" onmouseup=\"clearDayDetails();showToDos('" + fmtDate(m,d,y) + "')\"";
		}
		
	
	sBuffer += "<td class='" + cls + "' align='center'" + etc + ">\n";
	if ((d <= lastday[m]) && (d > 0)) 
		{
		sBuffer += d + "\n";
		}
	else
		{
		sBuffer += "&nbsp";
		}
	sBuffer += "</td>\n";
	return sBuffer;
	}
	

function week(m,s,y)
	{
	var sBuffer = "";
	if (s > lastday[m]) return sBuffer;
	sBuffer += "<tr>\n";
	for (var a=0; a<7; a++)
		{
		c = "caldaynorm";
		if (a==0) c = "calweekend";
		if (a==6) c = "calweekend";	
		if ((realdate==(s+a)) && (realmonth == m-1) && (realyear == y))
			{ 
			c = "caltoday";
			}
		sBuffer += day(m, s+a, y, c);
		}
	sBuffer += "</tr>\n";
	return sBuffer;
	}

function mdate(m, d, y)
	{
	ts = new Date(m + "/" + d + "/"  + y);
	return ts;
	}
	

function Calendar(month,year,sec)
	{
	var sBuffer = "";
	nextmonth = month + 1
	if (nextmonth > 12)
		{
		nextmonth = 1;
		nextyear = year + 1
		}
	
	lastmonth = month - 1
	if (lastmonth < 1) 
		{
		lastmonth = 12
		lastyear = year - 1
		}
	
	thismonth = month;
	thisday = day;
	thisyear = year;

	sdate = new Date (month + "/1/" + year);
		m  = sdate.getMonth();
		m1 = sdate.getDate();
		y  = sdate.getFullYear();
	
	sd = 1 - sdate.getDay();
	
	
	sBuffer += "<table cellpadding=0 border='0'><tr><td class='caltable'>";
	sBuffer += "<table cellpadding=2 cellspacing=2 border='0'>";
	sBuffer += "<tr>";
	sBuffer += "<td class='calheader' align='center'><a href=\"JavaScript:last_month('" + sec + "')\"><img src='img/callast.gif' border='0'></a></td>";
	sBuffer += "<td class='calheader' colspan='5' align='center'>";
	sBuffer += monthname[m] + "&nbsp;" + y;
	sBuffer += "<td class='calheader' align='center'><a href=\"JavaScript:next_month('" + sec + "')\"><img src='img/calnext.gif' border='0'></a></td>";
	sBuffer += "</td></tr>";
	
	
	for (var w=0; w<=5; w++)
		{
		sBuffer += week(month, sd + (w * 7), year);
		}
	
	sBuffer += "</tr>\n";
	sBuffer += "</table>\n";
	sBuffer += "</td></tr></table>\n";
	
	if (arguments.length > 2)
		{
		var obj = document.getElementById(sec)
		obj.innerHTML = sBuffer;
		}
	else
		{
		return sBuffer;
		}
	}

function this_month(sec)
	{
	Calendar(realmonth+1,realyear,sec)
	}



function last_month(sec)
	{
	Calendar(lastmonth,lastyear,sec)
	}


function next_month(sec)
	{
	Calendar(nextmonth,nextyear,sec)
	}


function fmtDate(m,d,y)
	{
	return y + "-" + datePad(m) + "-" + datePad(d);
	}
	

function datePad(s)
	{
	s = "00" + s
	return s.substr(s.length - 2, 2)
	}


function addDate(d,s)
	{
	oDates[d] = s;
	}

function getDayDetails(d)
	{
	displayKey = d
	document.getElementById("caldetailsec").innerHTML = "<b>" + d + "</b><p>" +oDates[d];
	}

function clearDayDetails()
	{
	document.getElementById("caldetailsec").innerHTML = "";
	document.getElementById("todosec").innerHTML = "";
	}
