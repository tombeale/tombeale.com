 function showhelp(key) {
 	var obj = document.getElementById("helpsec");
 	var sBuffer
	var sContent 
		
 	obj.style.top = mousey - 50
 	obj.style.left = mousex - 100
 	
 	sBuffer  = "<table style='border-style: solid; border-color: red; border-width:1;' cellspacing='0' cellpadding='5' width='170'>"
 	sBuffer += "<tr><td class='link' style='background-color: #ffffee;color: #333;' onmouseup='closehelp()'><div>"

	sContent = String(helptext[key.toUpperCase()])
	if (sContent == "undefined") sContent = "No help available on <nobr>'" + key + "'</nobr>."
	sContent = sContent.replace("<p>","</div><div style='padding: 5 0 0 0;'>");

 	sBuffer += sContent
	sBuffer += "</div></td></tr></table>" 	
 	
 	obj.innerHTML = sBuffer
 }
 
 function closehelp() {
 	var obj = document.getElementById("helpsec");
 	obj.innerHTML = ""
 }
 
 
var helptext = new Array()

	helptext["ASP"] = "<b>Active Server Pages</b><br>Web pages that execute code on the web server before sending the page to the browser. <p>ASP is part of Microsoft's IIS Web Server and ChiliSoft makes a version of it for Unix/Linux servers as well."
	helptext["PHP"] = "<b>PHP</b> is a language that combines server and client side processing. It is similar to ASP in function, but the language itself is like a cross between JavaScript and PERL.<br>PHP is most popular on Linux servers and is usually packaged with the Apache web server."
	helptext["VB"] = "Visual Basic"
	helptext["JAVASCRIPT"] = "<b>JavaScript</b><br> is scripting language supported by most browsers. It is often used for form validation, rollover graphics and modifying dynamic content."

	helptext["DATABASE INTEGRATION"] = "<b>Database Integration</b> refers to the use of programming to extract information from a database and use it as the content in a web page. Common examples include banking sites, online shopping, and most sites that gather and display information."
	helptext["DYNAMIC WEB CONTENT"] = "<b>Dynamic Web Content</b> simply means that a web page's content will not be the same each time it is displayed. The content may come from many sources, or it may be generated in real time on the user's machine."
	
	helptext["SERVER-SIDE"] = ""
	helptext["CLIENT-SIDE"] = ""

	helptext["LINUX"] = "An open-source operating system based on Unix. Linux is especially suited for use in servers, and is usually packaged with the Apache web server."
	
	
	helptext["WYSIWIG"] = "<b>What You See Is What <nobr>You Get</nobr></b><br>This term originally became popular in the early years of Desktop Publishing when products like PageMaker and Quark Express let you see what the finished product would look like. There are some notable WYSIWIG HTML editors, such as Microsoft's FrontPage, Macromedia's DreamWeaver and Adobe's GoLive."
	
