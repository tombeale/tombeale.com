
	function genDBTable(r,ext)
		{
		var t = new Array();
		var iCount = 0
		var temp = r.split("\2");
		for (var a=0;a<temp.length;a++)
			{
			t[a] = temp[a].split("\3");
			if ((arguments.length > 1) && (iCount == 0))
				{
				t[a][t[a].length] = ext;
				iCount = 1;
				}
			}
		return t;
		}
	
	
	function genDBDateTable(r,dateCol)
		{
		var process
		var t = new Array();
		var iCount = 0
		var temp = r.split("\2");
		for (var a=0;a<temp.length;a++)
			{
			tx = temp[a].split("\3");
			process = false
			if (tx[dateCol].substr(0,4) == "0000") 
				{
				process = true;
				}
			else 
				{
				tx = tx[dateCol].split(" ")
				if ( currentSysDate <= tx[0]) process = true
				}
			if (process)
				{
				t[t.length] = temp[a].split("\3");
				}
			}
		return t;
		}
	
	
	function genLookupTable(r, col)
		{
		var t = new Array();
		var temp = r.split("\2");
		var temp2;
		if (arguments.length < 2) col = 0;
		
		for (var a=0;a<temp.length;a++)
			{
			temp2 = temp[a].split("\3");
			t[temp2[col]] = temp[a].split("\3");
			}
		return t;
		}
	
	
	function dumpTable(n,t)
		{
		var sBuffer = ""
		var iCount = 0;
		sBuffer += "<p><b>" + n + "</b><br><table style='border-style:solid; border-width:2px;' cellspacing='0'>"
		for (var a in t)
			{
			if (iCount == 0)
				{
				sBuffer +="<tr><td></td>";
				for (var c=0;c<t[a].length;c++) sBuffer +="<td><b>" + c + "</b></td>";
				}
				sBuffer +="</tr>";
			sBuffer += "<tr><td align='right'><b>" + a + "</b></td>";
			for (var b=0;b<t[a].length;b++)
				{
				sBuffer += "<td style='border-style:solid; border-width:1px;'>" + t[a][b] + "</td>"
				}
			sBuffer += "</tr>"
			iCount++
			}
		sBuffer += "</table>"
		return sBuffer;
		}

	function dumpLookupTable(n,t)
		{
		var sBuffer = ""
		var iCount = 0;
		sBuffer += "<p><b>" + n + "</b><br><table  style='border-style:solid; border-width:2;' cellspacing='0'>"
			sBuffer +="<tr><td></td>";
			for (var c=0;c<t[0].length;c++) sBuffer +="<td><b>" + c + "</b></td>";
			sBuffer +="</tr>";
		for (var a in t)
			{
			sBuffer += "<tr>"
			sBuffer += "<td style='border-style:solid; border-width:1px;' align='right'><b>" + a + "</b></td>"
			for (var b=0;b<t[a].length;b++)
				{
				sBuffer += "<td style='border-style:solid; border-width:1;'>" + t[a][b] + "</td>"
				}
			sBuffer += "</tr>"
			}
		sBuffer += "</table>"
		return sBuffer;
		}

	function addColumn(table,name,init)
		{
		var iCount = 0
		for (var a in table)
			{
			if (iCount < 1)
				table[a][table[a].length] = name;
			else
				table[a][table[a].length] = init;
			iCount++;
			}
		}

	function serialize(obj)
		{
		var sBuffer = String(obj[0])
		for (var a=1;a<obj.length;a++)
			{
			sBuffer += "\2"
			for (var b=0;b<obj[a].length;b++)
				{
				if (b == 0) sBuffer += "\3"
				sBuffer += obj[a][b]
				}
			}
		document.details.fieldmap.value = sBuffer;
		}
