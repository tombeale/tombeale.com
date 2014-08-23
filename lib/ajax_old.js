var httpobj = false;
var ConnectionOpen = false

function Request(sPage)
	{
	if (arguments.length < 1) return "";
	if (sPage == "") return "";

	var querystring = ""

	if (!ConnectionOpen)
		{
		try{
			httpobj=new ActiveXObject('Msxml2.XMLHTTP');
			}
		catch(e1)
			{
			try{httpobj=new ActiveXObject('Microsoft.XMLHTTP');
			}
		catch(e2)
			{
			httpobj=null;}
			}
	
		if (!httpobj&&typeof XMLHttpRequest!='undefined')
			{
			httpobj=new XMLHttpRequest();
			}
		if (!httpobj) return "Unable to Create HTTP Request Object";
		ConnectionOpen = true;
		}

	for (var a=1;a<arguments.length;a++)
		{
		if (a == 1)
			{
			querystring += arguments[a]
			}
		else
			{
			querystring += "&" + arguments[a]
			}
		}


	url = sPage + "?" + querystring + "&rTag=" + Math.random(10)

	httpobj.open("GET",url,false);
	httpobj.send(null);
	return String(httpobj.responseText)
	}




