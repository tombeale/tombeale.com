var editObj

function getPage(page,main,sub)
	{
	var pTemp
	document.details.action = "index.php"
//	document.details.action = "//picard/echo.asp"
	document.details.target = ""
	document.details.params .value = "";
	
	if (page.search(/\?/) > -1)
		{
		pTemp = page.split("?")
		page = pTemp[0]
		document.details.params.value = pTemp[1]
		}
	
	document.details.page.value = page;
	document.details.main.value = main;
	document.details.sub.value = sub;
	document.details.submit();
	}

function getURL(page,params)
	{
	document.details.action = "index.php"
	document.details.target = ""
	document.details.params.value = params;
	
	document.details.page.value = page;
	document.details.main.value = main;
	document.details.sub.value = sub;
	document.details.submit();
	}

function testPage(page,main,sub)
	{
	document.details.action = "http://picard/echo.asp"
	document.details.target = "_new"
	document.details.page.value = page;
	document.details.main.value = main;
	document.details.sub.value = sub;
	document.details.submit();
	}
function iPrint(id,s)
	{
	var obj = document.getElementById(id);
	obj.innerHTML = s;
	}

function setInnerHTML(id, s)
	{
	var obj = document.getElementById(id);
	if (obj) obj.innerHTML = s;
	}

function getPopup(url,winName,opts)
	{
	window.open(url,winName,opts)
	}

function popeditID(key)
	{
	var obj = document.getElementById(key)
	popedit(obj,key)
	}

function popeditIDS(key)
	{
	var obj = document.getElementById(key)
	popedits(obj,key)
	}

function popedit(obj,key)
	{
	var pfx = ""
	editObj = obj
	document.details.odata.value = obj.innerHTML

	win = window.open("redit/editor.php?key=" + key,"editwin","width=523,height=440")
	}

function popedits(obj,key)
	{
	var pfx = ""
	editObj = obj

	document.details.odata.value = obj.innerHTML
	win = window.open("redit/htmleditor.php?key=" + key,"editwin","width=523,height=440")
	}

function easterEgg() {
	window.open("content/Resume/eegg/eeg.html","eggwin","width=300,height=150")
	}

function showDate(d)
	{
	if (d == "")  return "";
	if (d.search(/[^0\-]/) == -1) return "";
	return d;
	}

function goCal(name,iIndex)
	{
	var handler = ""
	if (arguments.length < 2) 
		{
		handler = "" 
		}
	else
		{
		handler = "&" + handler
		}
	window.open("popups/calendar.php?name=" + name + handler ,"cal","width=180,height=150");
	}

function setImage(obj, sSrc) {
	obj.src = sSrc;
}

function goMainPage(sTag) {
	switch(sTag) {
		case "WEB":
			getPage("webdev.php",4,3)
			break;
		case "DB":
			
			break;
		case "GFX":
			getPage("Portfolio/listing.php",4,5)
			break;
		case "EDIT":
			getPage("editablecontent.php",4,3)
			break;
	}
}

