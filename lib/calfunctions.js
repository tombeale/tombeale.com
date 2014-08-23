	function editDayDetails(sKey)
		{
		editflag = true
		currentKey = sKey
		
		editor.print("caleditsec")
		edt.document.designMode='On';
		edt.focus()
			
		if (String(oDates[sKey]) != "undefined")
			{
			edt.document.open("text/html", "replace");
		 	edt.document.write(oDates[sKey]);
		 	edt.document.close();
			edt.focus();
			}
		}

	function doHandle()
		{
		if (edt.document.all[0].innerText == "")
			{
			oDates[currentKey] = ""
			}
		else
			{
			oDates[currentKey] = stripExcess(edt.document.all[0].innerHTML)
			}
		editflag = false
		QPrint("caleditsec")
		saveDates()
		Calendar(thismonth,thisyear,"calsec")
		getDayDetails(currentKey)
		currentKey = ""
		}


	function saveDates()
		{
		document.details.action = "util/savedates.php"
//		document.details.action = "http://picard/echo.asp";
		document.details.datedata.value = serializeDates();
		document.details.target = "result"
		document.details.submit()
		}

	function serializeDates()
		{
		var sBuffer = ""
		for (var a in oDates)
			{
			if (sBuffer != "") sBuffer += "\1"
			sBuffer += a + "\2" + escape(oDates[a])
			}
		return sBuffer;
		}
	
/*
	addDate("2005-08-15","Payday<br>Work on BVA");
	addDate("2005-08-20","Another thing to do");
	addDate("2005-08-24","<b>Anniversary!</b>");
	addDate("2005-08-26","Some other Date");
	addDate("2006-01-25","Last CAL Check");
	
*/	
