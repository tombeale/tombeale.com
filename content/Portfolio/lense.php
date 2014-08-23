<script language="JavaScript" src="../../lib/innerhtml.js"></script>
<script language="JavaScript" src="../../lib/contextmenu.js"></script>
<link rel="stylesheet" href="../../config/style.css" type="text/css" media="screen">
<body>
<?
$image1 = $_REQUEST["image1"];
$image2 = $_REQUEST["image2"];
$options = $_REQUEST["options"];
$img1 = GetImageSize("images/$image1");
$img2 = GetImageSize("images/$image2");

$w1 = $img1[0];
$h1 = $img1[1];

$w2 = $img2[0];
$h2 = $img2[1];

$notesY = $h1 + 30;


function dualImage($x,$y) {
	global $lenseheight1;
	global $lenseheight2;
	global $lenseimage1;
	global $lenseimage2;
	global $lenseleft;
	global $lenselense;
	global $lenselenseheight;
	global $lenselensewidth;
	global $lensetop;
	global $lensewidth1;
	global $lensewidth2;

	$lensetop = $y;
	$lenseleft = $x;
	
	$lenseimage1 = "";
	$lenseheight1 = 0;
	$lensewidth1 = 0;
	
	$lenseimage2 = "";
	$lenseheight2 = 0;
	$lensewidth2 = 0;
	
	$lenselense = "";
	$lenselensewidth = 0;
	$lenselenseheight = 0;
}

function AddImage1($name, $width, $height) {
	global $lenseimage1;
	global $lenseheight1;
	global $lensewidth1;

	$lenseimage1 = $name;
	$lenseheight1 = $width;
	$lensewidth1 = $height;
}

function AddImage2($name, $width, $height) {
	global $lenseimage2;
	global $lenseheight2;
	global $lensewidth2;

	$lenseimage2 = $name;
	$lenseheight2 = $width;
	$lensewidth2 = $height;
}

function AddLense($name, $width, $height) {
	global $lenselense;
	global $lenselensewidth;
	global $lenselenseheight;

	$lenselense = $name;
	$lenselensewidth = $width;
	$lenselenseheight = $height;
}


function lensesetup() {
	global $lenseheight1;
	global $lenseheight2;
	global $lenseimage1;
	global $lenseimage2;
	global $lenseleft;
	global $lenselense;
	global $lenselenseheight;
	global $lenselensewidth;
	global $lensetop;
	global $lensewidth1;
	global $lensewidth2;
	global $options;
	?>
<!--
-->
	<div id="baseimage" onmouseup="showLense()" oncontextmenu="lenscontext()" style="{position:absolute;top:<? echo $lensetop ?>px;left:<? echo $lenseleft ?>px;}"><img src="<? echo $lenseimage1 ?>"></div>
	<div id="picture" style="{position:absolute;top:<? echo $lensetop ?>px;left:<? echo $lenseleft ?>px;clip:rect(0px,100px,100px,0px);z-index:2}"><img src="<? echo $lenseimage2 ?>" alt="" border="0"></div>
	<div id="lense" onmouseup="hideLense()" oncontextmenu="lenscontext()" style="{position:absolute;top:<? echo $lensetop ?>px;left:<? echo $lenseleft ?>px;z-index:3;}"><img src="<? echo $lenselense ?>" alt="" border="0"></div>
	<div id="cmenusec" style="position:absolute"></div>

	<script language="JavaScript">
	
		function ePrint(sCap, sValue) {
			parent.ePrint(sCap, sValue);
		}
		var bNoMenus = false;
		var bTesting = true;
		var bTesting = true;
		var mozilla=document.getElementById && !document.all;
		var ie=document.all;
		var di_top = <? echo $lensetop ?>; 
		var di_left = <? echo $lenseleft ?>; 
		
		var xfactor = <? echo $lensewidth2 ?> / <? echo $lensewidth1 ?>;
		var yfactor = <? echo $lenseheight2 ?> / <? echo $lenseheight1 ?>;
		
		var xMin = <? echo $lenseleft ?>;
		var yMin = <? echo $lensetop ?>;
		var xMax = <? echo $lenseleft ?> + <? echo $lensewidth1 ?>;
		var yMax = <? echo $lensetop ?> + <? echo $lenseheight1 ?>;
		
		var lensewidth = <? echo $lenselensewidth ?>;
		var lenseheight = <? echo $lenselenseheight ?>;
	</script>
	<?	
}


dualImage(0,0);
	AddImage1("images/$image1",$w1, $h1);
	AddImage2("images/$image2",$w2, $h2);
	AddLense("images/lense.gif",100,100);
	lensesetup();

 ?>

<script language="JavaScript">
	
	var sMenuOpts = "<? echo $options ?>"
	
	function doClip(e) {
		if (parent.bInfoWindowActive) return;
		if (bContextMenuActive) return;
		
		if (ie) {
			if ((event.y > <?echo $h1?>) || (event.x > <?echo $w1?>)) return;
			var x = event.x - di_left;
			var y = event.y - di_top;
		}
		else {
			if ((e.clientY > <?echo $h1?>) || (e.clientX > <?echo $w1?>)) return;
			var x = e.clientX
			var y = e.clientY
		}
		
		var vx = x * xfactor;
		var vy = y * yfactor;
		
		var lx = x - (lensewidth / 2);
		var ly = y - (lenseheight / 2);
		
		var lense = document.getElementById("lense").style;
		var obj2 = document.getElementById("picture").style;
		
//		lense.display = "";
//		obj2.display = "";
		
		t = vy - (lenseheight / 2);
		b = vy + (lenseheight / 2);

		
		l = vx - (lensewidth / 2);
		r = vx + (lensewidth / 2);
		
		lense.left = (lx + di_left) + "px";
		lense.top  = (ly + di_top) + "px";
		
		obj2.left = ((di_left) + (((r - (lensewidth / 2)) / xfactor) - (r - (lensewidth / 2)))) + "px";
		obj2.top  = ((di_top) + (((b - (lenseheight / 2)) / yfactor) - (b - (lenseheight / 2)))) + "px";

		ePrint("Lense Metrics", ((di_left - lx) - (lensewidth / 2)) + " : " + ((di_top - ly) - (lenseheight / 2)));

		rect = "rect(" + t + "px," + r + "px," + b + "px," + l + "px)";
		obj2.clip = rect;
	}

	document.onmousemove = doClip;

	function hideLense() {
		var obj = document.getElementById("lense")
		if (obj) obj.style.display = "none"
		var obj = document.getElementById("picture")
		if (obj) obj.style.display = "none"
	}

	function showLense() {
		var obj = document.getElementById("lense")
		if (obj) obj.style.display = ""
		var obj = document.getElementById("picture")
		if (obj) obj.style.display = ""
	}

	
	function lenscontext() {
		var oOpts;
		var obj = document.getElementById("lense")
		obj.style.display = "none"
		var obj = document.getElementById("picture")
		obj.style.display = "none"
		
		AddContextMenu("Back to Listing", "doOptions('PORTFOLIO')", true)
		if (sMenuOpts != "") {
			oOpts = sMenuOpts.split("~");
			AddContextMenu(oOpts[0], "doOptions('" + oOpts[1] + "')", true)
		}
		AddContextMenu("About", "doOptions('ABOUT')", true)
	}
	
	function doOptions(opt) {
		switch (opt) {
			case "717WIRE":
				parent.document.details.id.value = "2"
				parent.document.details.submit();
				break
			case "717MAG":
				parent.document.details.id.value = "3"
				parent.document.details.submit();
				break
			case "PORTFOLIO":
				parent.document.details.page.value = "Portfolio/listing.php"
				parent.document.details.submit();
				break
			case "ABOUT":
				showAbout();
				break
		}
	}

	function closeOpenMenus() {
	}
	
	function showAbout() {
		parent.showAbout("lenseinfo.php","400","230")
	}

	function debugwin() {
		window.open("../../config/debugger.php", "debug", "width=400,height=600,resizable,scrollbars");
	}


</script>

</body>