var bInfoWindowActive = false

function showAbout(fn,width,height)
	{
	if (arguments.length < 2) width = "300"
	if (arguments.length < 3) height = "200"
	var obj = document.getElementById("infosec")
	
	var sBuffer = "<table class='infotable' border='1' width='" + width + "px' height='" + height + "'><tr><td class='infobg'>&nbsp;</td></tr></table>";
	
	sBuffer += "<table border='0' style='position:absolute;top:0;left:0;width:" + width + "px'><tr><td style='padding:10px;' valign='top' width='100%'>"
	sBuffer += "<a href='JavaScript:closeInfoWindow()'><img onmouseover='hiliteinfo(this,1)' onmouseout='hiliteinfo(this,0)' src='img/info-close-0.gif' align='right' border='0'></a>"
	sBuffer += Request(inforoot + fn);
	sBuffer += "</td></tr></table>"
	
	obj.style.top="200px";
	obj.style.left="200px";
	
	Q(sBuffer)
	QPrint("infosec")
	bInfoWindowActive = true
	}


function hiliteinfo(obj,a)
	{
	obj.src = "img/info-close-" + a + ".gif"
	}

function closeInfoWindow()
	{
	bInfoWindowActive = false
	QPrint("infosec")
	}