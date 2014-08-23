	document.body.ondblclick = adMenu;
	document.body.onclick = clearAdMenu;
	
	var oAdminMenu = new Array();

	if (eMode == "")
		{
		addAdmItem("Edit Mode (Rich Text)","EDIT")
		addAdmItem("Edit Mode (Source)","EDITS")
		}
	else
		{
		addAdmItem("Normal Mode","NORM")
		}
	

	function addAdmItem(label,tag)
		{
		oAdminMenu[oAdminMenu.length] = new Array(label,tag);
		}


	function adMenu()
		{
		var sBuffer = ""
		
		var obj = document.getElementById("amenusec")
		
		obj.style.left = mousex - 30;
		obj.style.top = mousey - 30;
		
		sBuffer += "<table cellspacing='0' cellpadding='0' border='0'>";
		sBuffer += "<tr height='5'>";
		sBuffer += "	<td><div class='submenu'>";
		sBuffer += "	<table cellspacing='0' cellpadding='0' border='0'>";
		for (var a=0;a<oAdminMenu.length;a++)
			{
			sBuffer += adMenuRow(a);
			}
		sBuffer += "	</table></td>";
		sBuffer += "	<td class='mshadow' width='5' background='img/shadow-side.gif'><img src='img/spacer.gif' width='5' height='5'></td>";
		sBuffer += "</tr>";
		sBuffer += "<tr>"
		sBuffer += "	<td class='mshadow' background='img/shadow-bottom.gif' colspan='2'><img src='img/spacer.gif' width='5' height='5'></td>";
		sBuffer += "</tr>";
		sBuffer += "</table>";
		
		
		obj.innerHTML = sBuffer
		
		}


	function adMenuRow(i)
		{
		var sBuffer = ""
		
		sBuffer += "<tr><td class='submenuitem' width='80px'"
		sBuffer += " onmouseover='hiliteSubMenuItem(this)'"
		sBuffer += " onmouseout='normMenuItem(this)'"
		sBuffer += " onmouseup='admCmd(\"" + oAdminMenu[i][1] + "\")'><nobr>"
		sBuffer += oAdminMenu[i][0];
		sBuffer += "</nobr></td></tr>"
		return sBuffer;
		}

	function clearAdMenu()
		{
		document.getElementById("amenusec").innerHTML = "";
		}
	
	function admCmd(tag)
		{
		document.details.cmd.value = tag;
		document.details.submit();
		}
	