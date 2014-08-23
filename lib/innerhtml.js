var imgBuffer = new Array()
var QBuffer = "";
var arrFade = new Array("#000","#111","#222","#333","#444","#555","#666","#777","#888","#999","#aaa","#bbb","#ccc","#ddd","#eee","#fff")

var dofilters = true

function setInnerHTML(sContainer, sContent) {
	var obj = document.getElementById(sContainer);
	if (obj) obj.innerHTML = sContent;
}

function iPrint(id,s)
	{
	var obj = document.getElementById(id);
	obj.innerHTML = s;
	}

function Q(s)
	{
	QBuffer += s;
	}

function QPrint(id)
	{
	if (arguments.length < 1) return;
	iPrint(id,QBuffer)
	QBuffer = "";
	}


function fadeout(id, start, end, next)
	{
	var obj = document.getElementById(id)
	obj.style.color = arrFade[start]
	if (start == end)
		{
		if (arguments.length > 3) setTimeout(next, 50);
		return;
		}
	if (start > end) start--;
	if (start < end) start++;
	setTimeout("fadeout('" + id + "', " + start + ", " + end + ", '" + next + "')", 100)
	
	}



function runImageSeq(id, img, next, max, secs)
	{
	var nimg = img.replace("IMG",id + "-" + next)
	swapImage(id, nimg)
	next++
	if (next > max) next = 1;
	imgBuffer[id + "-" + next] = new Image();
	imgBuffer[id + "-" + next].src = id + "-" + next;	
	setTimeout("runImageSeq('" + id + "','" + img + "'," + next + "," + max + "," + secs + ")", secs * 1000)
	}

function swapImage(id, img)
	{
	var obja = document.getElementById(id + "-a");
	var objb = document.getElementById(id + "-b");
	if (!obja) return;
	if (!objb) return;
	if (img.length < 2) return;
	obja.src = objb.src;
	objb.src = img;
	$(objb).hide();
	$(objb).fadeIn(3000);
	objb.style.visibility = "visible";
	if (false)
		{
		objb.filters[0].Apply();
		objb.style.visibility = "visible";
		objb.filters[0].Play();
		}
	}		