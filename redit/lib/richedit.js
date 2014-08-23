

function richedit(name,w,h,handler,template)
	{
	this.name = name
	this.width = w
	this.height = h
	this.handler = handler
	if (arguments.length > 4) this.template = template
	else this.template = "template.html"
	}


function richedit_print(h)
	{
	var sBuffer = ""
	this.sec = h
	sBuffer += "<table cellspacing='0' cellpadding='0' border='0'><tr><td id='retoolbarsec'>"
	sBuffer += this.toolbar();
	sBuffer += "</td></tr><td style='padding: 0 0 0 2;'>"
	sBuffer += "<iframe style='font-family:Arial;border-style:solid;border-width:1px;border-color:#B3997F;' id='" + this.name + "' name='" + this.name + "' width='" + this.width + "' height='" + this.height + "' src='" + this.template + "' frameborder='0'></iframe>"
	sBuffer += "</td></tr><tr><td align='right'>" + this.footer();
	sBuffer += "</td></tr></table>"
	document.getElementById(h).innerHTML = sBuffer;
	}
	richedit.prototype.print = richedit_print;
	
style="border-width: 0px; border-style: none;"	
function richedit_init()
	{
	var obj = document.getElementById(this.name);
	obj.document.designMode='On';
	obj.focus();
	}
	richedit.prototype.init = richedit_init;


function richedit_toolbar()
	{
	var sBuffer = "<table cellspacing='2' cellpadding='2' border='0'><tr>"
	
	sBuffer += this.toolbutton("bold");
	sBuffer += this.toolbutton("italic");
	sBuffer += this.toolbutton("underline");
	sBuffer += this.toolbutton("strikethrough");

	sBuffer += this.toolbutton("justifyleft");
	sBuffer += this.toolbutton("justifycenter");
	sBuffer += this.toolbutton("justifyright");
	sBuffer += this.toolbutton("insertorderedlist");
	sBuffer += this.toolbutton("insertunorderedlist");
	sBuffer += this.toolbutton("outdent");
	sBuffer += this.toolbutton("indent");

	sBuffer += this.fontDropdown();
	sBuffer += this.sizeDropdown();
	sBuffer += this.colorDropdown();
	
	sBuffer += "</tr></table>"
//	alert(sBuffer)
	return sBuffer;
	}
	richedit.prototype.toolbar = richedit_toolbar;

function richedit_footer()
	{
	var sBuffer = "<table cellspacing='2' cellpadding='2' border='0'><tr>"
	sBuffer += "<td class='toolbutton' onmouseup=\"cancelEdit('" + this.sec + "')\">&nbsp;Cancel&nbsp;</td>"
	sBuffer += "<td class='toolbutton' onmouseup='" + this.handler + "'>&nbsp;<b>Save</b>&nbsp;</td>"
	sBuffer += "</tr></table>"
//	alert(sBuffer)
	return sBuffer;
	}
	richedit.prototype.footer = richedit_footer;



function richedit_toolbutton(action)
	{
	var sBuffer = "<td class='toolbutton'>"; 
	sBuffer += "<img onmouseup=\"applyFormatCmd('" + this.name + "','" + action + "')\"";
	sBuffer += " src='img/" + action + ".gif'></td>"
	return sBuffer
	}
	richedit.prototype.toolbutton = richedit_toolbutton;
	
	
function richedit_fontDropdown()
	{
	var sBuffer = "<td class='toolbutton'>"; 
	sBuffer += "<select onchange=\"applyFont(this,'" + this.name + "')\">";
		
		sBuffer += "<option value=''>-- Font --</option>"
		sBuffer += this.fontOption("geneva,arial,sans-serif","Arial")
		sBuffer += this.fontOption("verdana,geneva,arial,sans-serif","Verdana")
		sBuffer += this.fontOption("times,serif","Times")
		sBuffer += this.fontOption("courier,monospace","Courier")
	
	sBuffer += "</select></td>"
	return sBuffer
	}
	richedit.prototype.fontDropdown = richedit_fontDropdown;
	
	
function richedit_fontOption(val,txt)
	{
	var sBuffer = "<option style='font-family:" + val + ";' value='" + val + "'>" + txt + "</option>"
	return sBuffer
	}
	richedit.prototype.fontOption = richedit_fontOption;
	

function richedit_sizeDropdown()
	{
	var sBuffer = "<td class='toolbutton'>"; 
	sBuffer += "<select onchange=\"applySize(this,'" + this.name + "')\">";
		
		sBuffer += "<option value=''>-- Size --</option>"
		sBuffer += this.sizeOption("1","7.5pt")
		sBuffer += this.sizeOption("2","10pt")
		sBuffer += this.sizeOption("3","12pt")
		sBuffer += this.sizeOption("4","13.5pt")
		sBuffer += this.sizeOption("5","18pt")
		sBuffer += this.sizeOption("6","24pt")
		sBuffer += this.sizeOption("7","36pt")
	
	sBuffer += "</select></td>"
	return sBuffer
	}
	richedit.prototype.sizeDropdown = richedit_sizeDropdown;
	

function richedit_sizeOption(val,txt)
	{
	var sBuffer = "<option value='" + val + "'>" + txt + "</option>"
	return sBuffer
	}
	richedit.prototype.sizeOption = richedit_sizeOption;


function richedit_colorDropdown()
	{
	var sBuffer = "<td class='toolbutton'>"; 
	sBuffer += "<select onchange=\"applyColor(this,'" + this.name + "')\">";
		
		sBuffer += "<option value=''>-- Color --</option>"
		sBuffer += "<option style='color: aqua'>Aqua</option>"
		sBuffer += "<option style='color: black'>Black</option>"
		sBuffer += "<option style='color: blue'>Blue</option>"
		sBuffer += "<option style='color: darkred'>Dark Red</option>"
		sBuffer += "<option style='color: darkgreen'>Dark Green</option>"
		sBuffer += "<option style='color: gray'>Gray</option>"
		sBuffer += "<option style='color: green'>Green</option>"
		sBuffer += "<option style='color: maroon'>Maroon</option>"
		sBuffer += "<option style='color: navy'>Navy Blue</option>"
		sBuffer += "<option style='color: olive'>Olive</option>"
		sBuffer += "<option style='color: purple'>Purple</option>"
		sBuffer += "<option style='color: red'>Red</option>"
		sBuffer += "<option style='color: silver'>Silver</option>"
		sBuffer += "<option style='color: teal'>Teal</option>"
		sBuffer += "<option style='color: yellow'>Yellow</option>"
	
	sBuffer += "</select></td>"
	return sBuffer
	}
	richedit.prototype.colorDropdown = richedit_colorDropdown;

// =================================
// H A N D L E R S
// =================================

function applyFormatCmd(id, act)
	{
	document.details.target = "_new"
	eval(id + ".document.execCommand('" + act + "')")
	eval(id + ".focus()")
	}
	
function applyFont(obj,id)
	{
	if (obj.value == "") return;
	eval(id + ".document.execCommand('fontname','','" + obj.value + "')")
	eval(id + ".focus()")
	obj.selectedIndex = 0;
	}
	
function applySize(obj,id)
	{
	if (obj.value == "") return;
	eval(id + ".document.execCommand('fontSize','','" + obj.value + "')")
	eval(id + ".focus()")
	obj.selectedIndex = 0;
	}
	
function applyColor(obj,id)
	{
	if (obj.selectedIndex == 0) return;
	eval(id + ".document.execCommand('forecolor','','" + obj[obj.selectedIndex].style.color + "')")
	eval(id + ".focus()")
	obj.selectedIndex = 0;
	}
	
function cancelEdit(id)
	{
	self.close();
	}
	
function stripExcess(s)
	{
	var sMain
	sMain = s.split(" EBB>")
	sMain = sMain[1].split("</BODY>")
	return sMain[0];
	}