// ---- Used for generating panel IDs
var PanelCount = 0;
var oPanels = new Array();
var oMenuPanels = new Array();
var oMainPanels = new Array();

// Panel Object
//    state is true (open), false (closed) of "" (no toggle)
//    obj parameter is an object that has a "draw" method
function Panel(cap,width,state)
	{
	if (arguments.length < 2) width = "100%";
	if (arguments.length < 3) state = true;
	if (arguments.length < 4) obj = "";
	this.id = "Panel" + PanelCount++;
	oPanels[this.id] = this;
	this.caption = cap;
	this.cls = "panel_bar"
	
	this.state = state;
	this.width = width;
	this.obj = obj;
	this.content = "";
	}

function _PanelDraw(content)
	{
	var sBuffer = "<table border='0' cellspacing='0' cellpadding='0' width='" + this.width + "'><tr>";
	if (arguments.length > 0) this.content = content;
	if (this.state != "N")
		{
		sBuffer += "<td class='" + this.cls + "' style='cursor: hand' onmouseup=\"togglePanel('" + this.id + "')\">"
		if (this.state) 
			sBuffer += "<img id='" + this.id + "' src='img/arrow-down.gif' border='0' align='right'>"
		else
			sBuffer += "<img id='" + this.id + "' src='img/arrow-right.gif' border='0' align='right'>"
		}
	else
		{
		sBuffer += "<td class='" + this.cls + "'>"
		}
	sBuffer += this.caption
	sBuffer += "</td></tr><tr><td class='panel_body'>"
	if (this.state) sBuffer += this.content;
	sBuffer += "</td></tr><tr height='5px'><td></td></tr></table>"
	return sBuffer;
	}
	Panel.prototype.draw = _PanelDraw;
	

function mainPanel(cap,width)
	{
	var iIndex = oMainPanels.length
	oMainPanels[iIndex] = new Panel(cap,width,true);
	oMainPanels[iIndex].cls = "main_panel_bar";
	return iIndex;
	}


	