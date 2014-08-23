// =========================================
//  D A T E / T I M E   F U N C T I O N S
// =========================================

var lastday = new Array()
	lastday[1] = 31;
	lastday[2] = 28;
	lastday[3] = 31;
	lastday[4] = 30;
	lastday[5] = 31;
	lastday[6] = 30;
	lastday[7] = 31;
	lastday[8] = 31;
	lastday[9] = 30;
	lastday[10] = 31;
	lastday[11] = 30;
	lastday[12] = 31;

var arrMonths = new Array();
	arrMonths["01"] = "January";
	arrMonths["02"] = "February";
	arrMonths["03"] = "March";
	arrMonths["04"] = "April";
	arrMonths["05"] = "May";
	arrMonths["06"] = "June";
	arrMonths["07"] = "July";
	arrMonths["08"] = "August";
	arrMonths["09"] = "September";
	arrMonths["10"] = "October";
	arrMonths["11"] = "November";
	arrMonths["12"] = "December";

function setFeb(iYear)
	{
	if ((iYear % 4) == 0)   lastday[2] = 29;
	if ((iYear % 100) == 0) lastday[2] = 28;
	}


function NormalDate(sDate)
	{
	var sBuffer;
	sDate = sDate.split(" ");
	sDate = sDate[0].split("-");
	if (sDate[0] == "0000") return "";
	sBuffer = sDate[1] + "/" + sDate[2] + "/" + sDate[0];
	return sBuffer;
	}

function FriendlyDate(sDate,bShowYear)
	{
	var sBuffer;
	if (arguments.length < 2) bShowYear = false
	sDate = sDate.split("-");
	
	sBuffer = arrMonths[sDate[1]] + " " + sDate[2];
	if (bShowYear) sBuffer += ", " + sDate[0];
	return sBuffer;
	}

function FriendlyTime(sTime)
	{
	var arrDate
	var iHour
	if (sTime.search(/ /) > -1)
		{
		arrDate = sTime.split(" ");
		if ((arrDate[1].toUpperCase == "AM") || (arrDate[1].toUpperCase == "PM")) return sTime
		sTime = arrDate[1];
		}
	arrTime = sTime.split(":")
	iHour = parseInt(arrTime[0],10)
	if (iHour > 12)
		{
		return (iHour - 12) + ":" + arrTime[1] + " pm"
		}
	else if (iHour == 12)
		{
		return iHour + ":" + arrTime[1] + " pm"
		}
	else
		{
		return iHour + ":" + arrTime[1] + " am"
		}
	}

function pad(n)
	{
	n = "00" + n;
	return n.substr(n.length - 2,2)
	}




