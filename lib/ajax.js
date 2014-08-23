var httpobj = false;
var ConnectionOpen = false;
var errmsg = "";

// Note: This function requires the JQuery library (jquery.min.js)
function ajax(sPage, sData, fCallback, sType, fError) {
	if (!sPage) return "";
	if (sPage == "") return "";
	try {
		if (bTesting) {
			var sTemp = sPage
			if (sTemp.indexOf("../") == 0) sTemp = sTemp.substr(3);
			ePrint("AJAX", IAG_AppRoot + "/" + sTemp + "?" + sData + "&test=y")
		}
	}
	catch(e) {}
	if (!sType) sType = "GET";
	if (!sData) sData = ""
	if (fCallback) {
		$.ajax({
			url:     sPage,
			type:    sType,
			cache:   false,
			data:    sData,
			success: fCallback,
			error: function(xhr, ajaxOptions, thrownError) {
				ePrint("AJAX Error", sData, ajaxOptions, thrownError);
				}
		});
		return "sent";
	}
	else {
		return $.ajax({
			url:   sPage,
			type:  sType,
			cache: false,
			data:  sData,
			async: false,
			error: function(xhr, ajaxOptions, thrownError) {
				ePrint("AJAX Error", xhr.responseText);
				}
		}).responseText;
	}
}

function ajaxWS(sPage, sData, fCallback, sDataType) {
	if (!sPage) return "";
	if (sPage == "") return "";
	if (!sData) sData = "{}";
	if (sData == "") sData = "{}";
	if (!sDataType) sDataType = "json";
	var sType = "POST";
	try {
		if (bTesting) {
			var sTemp = sPage
			var sArgs = ""
			if (sTemp.indexOf("../") == 0) sTemp = sTemp.substr(3);
				sArgs += "url: <b>" + sPage + "</b><br>";
				sArgs += "data: <b>" + sData + "</b><br>";
				sArgs += "type: <b>" + sType + "</b><br>";
				sArgs += "dataType: <b>" + sDataType + "</b><br>";
				ePrint("AJAX (Web Service)", sArgs, "NOESCAPE")
		}
	}
	catch(e) {}
	if (fCallback) {
		$.ajax({
			url:     sPage,
			type:    sType,
			cache:   false,
			data:    sData,
			dataType: sDataType,
			contentType: "application/json; charset=utf-8",
			success: fCallback,
			error: function(xhr, ajaxOptions, thrownError) {
				ePrint("AJAX Error", xhr.responseText);
				}
		});
		return "sent";
	}
	else {
		return $.ajax({
			url:   sPage,
			type:  sType,
			data:  sData,
			cache: false,
			async: false,
			dataType: sDataType,
			contentType: "application/json; charset=utf-8",
			error: function(xhr, ajaxOptions, thrownError) {
				ePrint("AJAX Error", xhr.responseText);
				}
		}).responseText;
	}
}

function ajaxError(xhr, ajaxOptions, thrownError) {
	ePrint("AJAX Error", xhr.responseText + "<br>Options: " + ajaxOptions + "<br>Thrown: " + thrownError, "NOESCAPE")
}

function splitResponse(sResponse) {
	var sReturn = "" 
	var oReturn
	try {
		var oReturn = eval("(" + sResponse + ")")
		sReturn += oReturn["d"]
	}
	catch(e) {
		ePrint("ajax:splitResponse", e.description + "       " + sResponse)
		return sResponse;
	}
	oReturn = sReturn.split("\1")
	if (oReturn.length < 2)
		return oReturn[0]
	else if (oReturn.length == 2)
		return oReturn[1]
	else 
		return String(sReturn).join("\1")
}

function Request(sPage)
	{
	if (arguments.length < 1) return "";
	if (sPage == "") return "";
	var sReturn;
	var querystring = "";

	if (!ConnectionOpen)
		{
		try{
			httpobj = new ActiveXObject('Msxml2.XMLHTTP');
			}
		catch(e1)
			{
			try {
				httpobj = new ActiveXObject('Microsoft.XMLHTTP');
				}
			catch(e2)
				{
				httpobj = null;
				errmsg = "Error: " + e2.Description;
				}
			}
		if ((!httpobj) && (typeof XMLHttpRequest != 'undefined'))
			{
			httpobj = new XMLHttpRequest();
			if (!httpobj) errmsg = "Error: XMLHttpRequest is not defined";
			}
		
		if (!httpobj)
			{
			ePrint("ajax.js:Request", errmsg)
			return "";
			}
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
	sReturn =  String(httpobj.responseText)
	if (true && (sReturn.indexOf("HTTP 404 - File not found") > 0)) {
		sReturn = "Error: Unable to find file: <br>" + url
	}
	return sReturn
	}

function RequestAsync(sPage)
	{
	if (arguments.length < 1) return "";
	if (sPage == "") return "";

	var querystring = ""

	if (!ConnectionOpen)
		{
		try{
			httpobj = new ActiveXObject('Msxml2.XMLHTTP');
			}
		catch(e1)
			{
			try {
				httpobj = new ActiveXObject('Microsoft.XMLHTTP');
				}
			catch(e2)
				{
				httpobj = null;
				errmsg = e2.Description;
				}
			}
		if ((!httpobj) && (typeof XMLHttpRequest != 'undefined'))
			{
			httpobj = new XMLHttpRequest();
			if (!httpobj) errmsg = "XMLHttpRequest is not defined";
			}
		
		if (!httpobj)
			{
			ePrint("AJAX","Error: " + errmsg)
			return "";
			}
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
	httpobj.open("GET",url,true);
	httpobj.send(null);
	return httpobj
	}


function PostRequest(sPage) {
	if (arguments.length < 1) return "";
	if (sPage == "") return "";

	var querystring = ""
	var sReturn = ""

	if (!ConnectionOpen) {
		try {
			httpobj = new ActiveXObject('Msxml2.XMLHTTP');
		}
		catch(e1) {
			try {
				httpobj = new ActiveXObject('Microsoft.XMLHTTP');
			}
			catch(e2) {
				httpobj = null;
				errmsg = e2.Description;
			}
		}
		if ((!httpobj) && (typeof XMLHttpRequest != 'undefined')) {
			httpobj = new XMLHttpRequest();
			if (!httpobj) errmsg = "XMLHttpRequest is not defined";
		}
		
		if (!httpobj) {
			ePrint("AJAX",errmsg)
			return "";
		}
		ConnectionOpen = true;
	}

	for (var a=1;a<arguments.length;a++) {
		if (a == 1) {
			querystring += arguments[a]
		}
		else {
			querystring += "&" + arguments[a]
		}
	}
	try {
	    httpobj.open('POST', sPage, false);
	    httpobj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    httpobj.setRequestHeader("Content-length", querystring.length);
	    httpobj.send(querystring);
//	    httpobj.setRequestHeader("Connection", "close");
	}
	catch(e) {
		ePrint("AJAX (After POST)", e.description + "<br>" + sPage + "<br>" + querystring)
		sReturn = "Error\3" + e.description
	}
	return sReturn;
}




