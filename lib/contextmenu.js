//'============================================================
// R I G H T   M O U S E   M E N U
// ============================================================
var mozilla=document.getElementById && !document.all
var ie=document.all

var bDisableContextMenu = false
var bContextMenuActive = false
var sContextBuffer = ""


//'============================================================
// G E N E R A T E   M E N U   ( S P E C I F I C )
// ============================================================

function CONContext(sKey) {
	if (sBrowser == "I") {
		sContextBuffer += AddCMenu("Edit Text","popeditID('" + sKey + "')",true);
	}
	sContextBuffer += AddCMenu("Edit Text Source","popeditIDS('" + sKey + "')",true);
}


//'============================================================
// G E N E R A T E   M E N U   ( G E N E R I C )
// ============================================================

function genContextMenu()
	{
	if (bNoMenus) return "";
	var sBuffer = "<table class='cmenuarea' cellspacing='0' cellpadding='0'><tr><td>";
		sBuffer += "<table cellspacing='0' cellpadding='1' border='0'>";
		sBuffer += sContextBuffer
		sBuffer += AddCMenu("Debug Window","debugwin()",bTesting);
		sBuffer += "</table>";	
		sBuffer += "</td></tr></table>";
	return sBuffer;
	}


function AddContextMenu(sCap,sAction,flag)
	{
	if (!flag) return "";
	sContextBuffer += AddCMenu(sCap,sAction,flag)
	}


function AddCMenu(sCap,sAction,flag)
	{
	if (!flag) return "";
	var sBuffer = "<tr><td class='cmenu' onmouseover='CMHilite(this)' onmouseout='CMNorm(this)' onmouseup=\"hidemenu();" + sAction + "\">";
		sBuffer += sCap;
		sBuffer += "</td></tr>";
	return sBuffer;
	}

function CMHilite(obj)
	{
	obj.style.backgroundColor = "#FFDAB5";
	}

function CMNorm(obj)
	{
	obj.style.backgroundColor = "";
	}



//'============================================================
// M O U S E   H A N D L E R S
// ============================================================
function iebody()
	{
	return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
	}

function displaymenu(e){
	if (bNoMenus) return;
	cmenu=document.getElementById("cmenusec")
	var sBuffer
	if (bDisableContextMenu) return true;
	sBuffer = genContextMenu()
	if (sBuffer != "")
		{
		bContextMenuActive = true
		if (mozilla)
			{
			if (e.clientX < 8) return true
			cmenu.style.left=pageXOffset + e.clientX + "px"
			cmenu.style.top=pageYOffset + e.clientY + "px"
			cmenu.innerHTML = sBuffer
			sContextBuffer = ""
			e.preventDefault()
			return false
			}
		else if (ie)
			{
			if (event.clientX < 8) return true
			cmenu.style.left=iebody().scrollLeft + event.clientX
			cmenu.style.top=iebody().scrollTop + event.clientY
			cmenu.innerHTML = sBuffer
			sContextBuffer = ""
			return false
			}
		}
	}

function hidemenu()
	{
	closeOpenMenus();
	bContextMenuActive = false;
	iPrint("cmenusec","")
	}

if (mozilla)
	{
	document.addEventListener("contextmenu", displaymenu, true)
	document.addEventListener("click", hidemenu, true)
	}
else if (ie)
	{
	document.attachEvent("oncontextmenu", displaymenu)
	document.attachEvent("onclick", hidemenu)
	}



