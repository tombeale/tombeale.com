<!--
<?
require "inc/formatting.php";
require "inc/dbfunctions.php";

?>
-->
<style>

	#title {
		position: absolute;
		top:  120px;
		left: 120px;
	}

	#float1 {
		position: absolute;
		top:  150px;
		left: 132px;
	}

	#float2 {
		position: absolute;
		top:  430px;
		width: 400px;
		left: 260px;
		text-align: right;
	}
	
</style>
<div style='padding-left:25px;padding-top:20px;'><img src="img/guitars/mustangstrat.jpg"></div>
<div id="title"><?headLine("Personal")?></div>
<div id="float1"><?CON("guitartext1")?></div>
<div id="float2"><img class='link' onmouseup='viewImage()' src='img/guitars/Mustang Strat_Thumb.jpg' border='1'></div>
<input type="hidden" name="odata" value="">

<script language="JavaScript">
	function viewImage() {
		document.details.page.value = "Portfolio/imageviewer.php";
		document.details.id.value = "11";
		document.details.submit();
	}

//-->
</script>
