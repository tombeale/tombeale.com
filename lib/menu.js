	var iMenuCount = 0;
	var iSubmenuLeft = 60;
	var subMenus = new Array();
	var iMenuCount = 0
	var bNoMenus = false;

	//====================================================================
	//  M E N U L I S T   O B J E C T
	//====================================================================
	function menuSet(iWidth, iHeight, iOffset)
		{
		if (arguments.length < 1) iWidth = "";
		if (arguments.length < 2) iHeight = 12;
		if (arguments.length < 3) iOffset = 0;
		
		this.width = iWidth
		this.height = iHeight
		this.offset = iOffset
		this.list = new Array();
		this.lineheight = 14;
		this.padding = 5;
		this.shadowheight = 7;
		this.maincount = 0;
		}
		
	function _addMenu(s)
		{
		this.list[this.list.length] = new menuItem(this,s);
		}
		menuSet.prototype.add = _addMenu;

	function _drawMenu(m,s,id)
		{
		var sBuffer = "";
		if (arguments.length < 3) id = "menusec";
		var w = this.width
		if (w != "") w = " width='" + w + "px'" 
		
		Q("<div id='mainmenu'><div class='menuarea'>");
		Q("<table cellspacing='0' cellpadding='0' border='0'" + w + ">");
		Q("<tr height='2' onmouseover='closeOpenMenus()'><td onmouseover='closeOpenMenus()'></td></tr>");
		for (var a=0;a<this.list.length;a++)
			{
			Q(this.list[a].draw(a,m,s));
			}
		
		Q("<tr height='2' onmouseover='closeOpenMenus()'><td onmouseover='closeOpenMenus()'></td></tr>");
		Q("</table></div></div>");

		for (var b=0; b<this.list.length; b++)
			{
			for (var a=0;a<this.list.length;a++)
				{
				if ((this.list[a].main == b) && (this.list[a].sub == 1))
					{
					Q(this.drawsub(this.list[a].main,s, this.list[a].top + this.offset));
					iMenuCount++
					}
				}
			}

		QPrint(id);
		}
		menuSet.prototype.draw = _drawMenu;

	function _drawSubMenu(m,s,iTop)
		{
		var iCount = 0;
		var sBuffer = "";
		if (arguments.length < 3) id = "menusec";
		sBuffer += "<div id='sm" + m + "' style='position: absolute; top:" +  iTop + "px; left:" +  iSubmenuLeft + "px; display: none;'>"
		sBuffer += "<table cellspacing='0' cellpadding='0' border='0'>";
		sBuffer += "<tr height='5'>";
		sBuffer += "	<td><div class='submenu'>";
		sBuffer += "	<table cellspacing='0' cellpadding='0' border='0'>";
		for (var a=0;a<this.list.length;a++)
			{
			if (this.list[a].main == m)
				{
				if (this.list[a].type == "S") 
					{
					iCount++;
					sBuffer += this.list[a].drawsub(m,s);
					}
				}
			}
		sBuffer += "	</table></td>";
		sBuffer += "	<td class='mshadow' width='5' background='img/shadow-side.gif'><img src='img/spacer.gif' width='5px' height='5px'></td>";
		sBuffer += "</tr>";
		sBuffer += "<tr>"
		sBuffer += "	<td class='mshadow' background='img/shadow-bottom.gif' colspan='2'><img src='img/spacer.gif' width='5px' height='5px'><br></td>";
		sBuffer += "</tr>";
		sBuffer += "</table>";
		sBuffer += "</div>";
		if (iCount == 0) sBuffer = "";
		return sBuffer;
		}
		menuSet.prototype.drawsub = _drawSubMenu;

	function _countSubs(m)
		{
		var iCount = 0;
		for (var a=0;a<this.list.length;a++)
			{
			if ((this.list[a].type == "S") && (this.list[a].main == m)) iCount++;
			}
		return iCount;
		}
		menuSet.prototype.count = _countSubs;
	

	function _closeAllMenus()
		{
		for (var a=0;a<this.list.length;a++)
			{
			this.list[a].open = false;
			}
		}
		menuSet.prototype.close = _closeAllMenus;

	function _dumpMenuSet()
		{
		if (this.list.length < 1) return;
		var sBuffer = "<table cellspacing='0'>";
		
		for (var a in this.list[0])
			{
			if (String(this.list[0][a]).substr(0,8) != "function")
				{
				sBuffer += "<td class='dump'>&nbsp;<b>" + a + "&nbsp;</b></td>";
				}
			}
		
		for (var a in this.list)
			{
			sBuffer += this.list[a].dump();
			}		
		
		sBuffer += "</table>"
		return sBuffer;
		}
		menuSet.prototype.dump = _dumpMenuSet;

	//====================================================================
	//  M E N U I T E M   O B J E C T
	//====================================================================

	function menuItem(obj,s)
		{
		s = s.split("~");
		var temp;

		this.lineheight = obj.lineheight;
		this.padding = obj.padding;
		this.shadowheight = obj.shadowheight;

		
		this.parent = obj;
		this.type 	= s[0];
		if (this.type == "M")
			{
			iMenuCount++;
			this.top = iMenuCount * obj.height;
			this.parent.currenttop = this.top;
			subMenus[s[3]] = false;
			}
		else
			{
			subMenus[s[3]] = true;
			this.top = this.parent.currenttop;
			}
		
		if (s[1].search(/\{/) > -1)
			{
			temp = s[1].split("{");
			this.caption = temp[0];
			this.tip = temp[0].replace(/\}/g,"");
			}
		else
			{
			this.caption 	= s[1];
			this.tip 		= "";
			}
		this.page 	= s[2];
		this.main 	= s[3];
		this.sub 	= s[4];
		if (this.main == main)
			{
			this.open	= true;
			}
		else
			{
			this.open	= false;
			}
		}
	
	function _drawMenuItem(i,m,s)
		{
		var sBuffer = ""
		var sStyle = ""
		var iPadding
		if (this.type != "M") return "";
		var iCount = this.parent.count(this.main)
		if (iCount > 0)
			if (this.open) sStyle = "style='padding: 0 0 " + iPadding + " 0';"
		sBuffer += "<tr><td class='menu'"
		sBuffer += " onmouseover=\"hiliteMenuItem(this,'" + this.parent.list[i].main + "','" + s + "')\""
		sBuffer += " onmouseout=\"normMenuItem(this,'" + this.parent.list[i].main + "','" + s + "')\""
		sBuffer += " onmouseup='menuSelect(" + i + "," + this.main + "," + this.sub + ")' " + sStyle + ">"
		sBuffer += this.caption;
		sBuffer += "</td></tr>"
		
		return sBuffer;
		}
		menuItem.prototype.draw = _drawMenuItem;

	function _drawSubMenuItem(m,s)
		{
		var sBuffer = ""
		var sStyle = ""
		var iCount = this.parent.count(this.main)
		if (this.type != "S") return "";
		sBuffer += "<tr><td class='submenuitem' width='130px'"
		sBuffer += " onmouseover=\"hiliteSubMenuItem(this,'" + this.main + "','" + s + "')\""
		sBuffer += " onmouseout=\"normMenuItem(this,'" + this.main + "','" + s + "')\""
		sBuffer += " onmouseup='getPage(\"" + this.page + "\"," + this.main + "," + this.sub + ")'><nobr>"
		sBuffer += this.caption;
		sBuffer += "</nobr></td></tr>"
		return sBuffer;
		}
		menuItem.prototype.drawsub = _drawSubMenuItem;


	function _dumpMenuItem()
		{
		var sBuffer = "<tr>"
		for (var a in this)
			{
			if (String(this[a]).substr(0,8) != "function")
				{
				sBuffer += "<td class='dump'>&nbsp;" + this[a] + "&nbsp;</td>";
				}
			}
		sBuffer += "</tr>"
		return sBuffer;
		}
		menuItem.prototype.dump = _dumpMenuItem;

	//====================================================================
	//  H A N D L E R S
	//====================================================================
	function menuSelect(i,m,s)
		{
		ePrint("menuSelect", i,m,s)
		menu.close();
		if (menu.list[i].page != "") 
			{
			getPage(menu.list[i].page, menu.list[i].main, menu.list[i].sub)
			}
		menu.draw(m,s);
		}
	
	function hiliteMenuItem(obj,m,s)
		{
		obj.style.backgroundColor = "#FFDAB5";
		closeOpenMenus();
		if (subMenus[m])
			{
			var smobj = document.getElementById("sm" + m)
			smobj.style.display = ""
			}
		}

	function hiliteSubMenuItem(obj,m,s)
		{
		obj.style.backgroundColor = "#FFDAB5";
		}

	function normMenuItem(obj)
		{
		obj.style.backgroundColor = "#FFFFFF";
		}


	function closeOpenMenus()
		{
		if (bNoMenus) return;
		try {
			for (a in subMenus)
				{
				if (subMenus[a])
					{
					var smobj = document.getElementById("sm" + a)
					smobj.style.display = "none"
					
					}
				}
			}
		catch(e)
			{
			window.status = e.description;
			}
		}		