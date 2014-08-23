	var Month = monthname;

	function showTime()
		{
		var sBuffer = ""
		var dt = new Date()
		var hours
		var ampm
		
		sBuffer += Month[dt.getMonth()] + " ";
		sBuffer += dt.getDate() + ", ";
		sBuffer += dt.getFullYear() + "<br>";
		
		datesec.innerHTML = sBuffer;
		
		hours = dt.getHours();
		
		if (hours >= 12)
			{
			ampm = " pm";
			}
		else
			{
			ampm = " am";
			}

		if (hours > 12) hours = hours -12;
		
		sBuffer = hours + ":";
		sBuffer += pad(dt.getMinutes()) + ":";
		sBuffer += pad(dt.getSeconds()) + ampm;
		
		timesec.innerHTML = sBuffer;
		
		
		setTimeout("showTime()",1000);
		}
		
	function pad(s)
		{
		s = "00" + s
		return s.substr(s.length-2,2)
		}