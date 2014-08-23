<style>
	.measure {
		background-color: #ffffff;
		border-color: #000000;
		border-style: solid;
		border-width: 1px;
		}

	table.measure {
		background-color: #ffffff;
		border-color: #000000;
		border-style: solid;
		border-width: 1px;
		}

	td.measure {
		font-size: 5px;
		background-color: #ffffff;
		border-color: #999999;
		border-style: solid;
		border-width: 1px 1px 0px 0px;
		}

	.input {
		font-family: verdana, Arial, Helvetica;
		font-size: 10;
		border-width: 1;
		border-color: black;
		border-style: solid;
		}

	.inputc {
		font-family: verdana, Arial, Helvetica;
		font-size: 11;
		font-weight: bold;
		text-align: center;
		border-width: 1;
		border-color: black;
		border-style: solid;
		}

	.button {
		font-family: verdana, Arial, Helvetica;
		font-size: 10;
		border-width: 1;
		border-color: black;
		border-style: solid;
		padding: 0;
		}

	.controls {
		font-family: Arial, Helvetica;
		font-size: 8pt;
		}

	.controldiv {
		width: 100%;
		background-image: url(img/metro/controlback.jpg);
		border-color: #666666;
		border-width: 1px;
		border-style: solid;
		font-family: Arial, Helvetica;
		font-size: 8pt;
		}

</style>

<script language="JavaScript">
	doOnload = true;
	
	function FormLoad()
		{
		render();
		}
	<?
	if ($measures == "") $measures = 4;
	if ($bpm == "") $bpm = 4;
	if ($lines == "") $lines = 3;
	if ($beats == "") $beats = 120;
	
	?>

	var measures = <?echo $measures?>;
	var bpm = <?echo $bpm?>;
	var lines = <?echo $lines?>;
	var beats = <?echo $beats?>;
	var speed = (60 / beats) * 1000;
	var currentbeat = -1
	var currentMeasure = 0;
	var mbase = "m00";
	var bpercent = (100 / bpm) + "%";
	var measeureWidth = 100;
	var measureCount = 0;
	var counterRef = ""
	var bIsPlaying = false;	


	function play()
		{
		var obj = document.getElementById("playbutton"); 
		if (bIsPlaying)
			{
			obj.src = "img/metro/play.gif";
			bIsPlaying = false;
			stopbeat();
			}
		else
			{
			obj.src = "img/metro/pause.gif";
			bIsPlaying = true;
			nextbeat();
			}
		}



	function nextbeat()
		{
		if (currentbeat >= 0)
			{
			clearbeat(mbase + currentbeat);
			}
		currentbeat++;
		if (currentbeat >= bpm) 
			{
			currentbeat = 0;
			currentMeasure++;
			if (currentMeasure >= measureCount) currentMeasure = 0;
			mbase = genM(currentMeasure)
			}
		showbeat(mbase + currentbeat);
		counterRef = setTimeout("nextbeat()",speed);
		}

	function stopbeat()
		{
		clearTimeout(counterRef);
		}

	function showbeat(b)
		{
		for (var a=0;a<5;a++)
			{
			obj = document.getElementById(b + a);
			obj.style.backgroundColor = "#0000ff";
			}
		}

	function clearbeat(b)
		{
		for (var a=0;a<5;a++)
			{
			obj = document.getElementById(b + a);
			obj.style.backgroundColor = "#ffffff";
			}
		}

	function genPage(c,r)
		{
		var sBuffer = "<table cellpadding='0' cellspacing='0' border='0'>";
		for (var a=0;a<r;a++)
			{
			sBuffer += genRow(a,c);
			}
		sBuffer += "</table>"
		return(sBuffer);
		}


	function genRow(s,n)
		{
		var sBuffer = "<tr>"
		for (var a=s;a<s+n;a++)
			{
			sBuffer += "<td>" + genMeasure(genM) + "<td>\n"
			}
		sBuffer += "</tr>"
		sBuffer += "<tr height='10'><td></td></tr>"
		return sBuffer;
		}

	function genMeasure(m)
		{
		var sBuffer = "<table class='measure' width='" + measeureWidth + "' cellspacing='0' cellpadding='0'>\n"
		for (var a=0;a<5;a++)
			{
			sBuffer += "<tr>\n"
			sBuffer += genBeat(genM(measureCount),a)
			sBuffer += "</tr>\n"
			}
		sBuffer += "</table>\n"
		measureCount++;
		return sBuffer;
		}


	function genBeat(m,b)
		{
		var sBuffer = "";
		for (var a=0;a<bpm;a++)
			{
			sBuffer += "<td class='measure' width='" + bpercent + "' id='" + m + a + b + "'>&nbsp;</td>\n"
			}
		return sBuffer;
		}
		
	function genM(n)
		{
		n = "000" + n;
		n = "m" + n.substr(n.length-2,2)
		return n;
		}


	function genControls()
		{
		var sBuffer = "<div class='controls' width='500'>"
		sBuffer += "<img src='img/spacer.gif' height='0' width='400'>"
		sBuffer += "<table width='400'>"
		sBuffer += "<tr><td class='controls'>"
		sBuffer += "Beats per Measure: <input type='text' class='input' name='bpm' value='" + bpm + "' size='2'>&nbsp;&nbsp;&nbsp;"
		sBuffer += "Measures per Line: <input type='text' class='input' name='measures' value='" + measures + "' size='2'>&nbsp;&nbsp;&nbsp;"
		sBuffer += "Lines: <input type='text' class='input' name='lines' value='" + lines + "' size='2'>&nbsp;&nbsp;&nbsp;"

		sBuffer += "</td><td align='right' rowspan='2'>"
		sBuffer += "<a href='JavaScript:play()'><img src='img/metro/play.gif' id='playbutton' border='0'></a>"

		sBuffer += "</td></tr><tr><td>" + genSpeedGizmo() + "&nbsp;&nbsp;&nbsp;"
		sBuffer += "</table></div>"
		
		return sBuffer;
		}


	function genSpeedGizmo()
		{
		var sBuffer = "<nobr>"
		sBuffer += "<input type='button' class='button' onmouseup='slow(5)' value=' << '>"
		sBuffer += "<input type='button' class='button' onmouseup='slow(1)' value=' < '>"
		sBuffer += "<input type='text' class='inputc' name='beats' value='" + beats + "' size='2' onchange='setbeats(this)'>"
		sBuffer += "<input type='button' class='button' onmouseup='fast(1)' value=' > '>"
		sBuffer += "<input type='button' class='button' onmouseup='fast(5)' value=' >> '>"
		sBuffer += "</nobr>"
		return sBuffer;
		}

	function render()
		{
		iPrint("mainsec",genPage(measures,lines));
		iPrint("controlsec",genControls());
		}


	function slow(n)
		{
		beats -= n
		if (beats < 10) beats = 10;
		speed = (60 / beats) * 1000;
		document.details.beats.value = beats;
		}

	function fast(n)
		{
		beats += n
		if (beats > 300) beats = 300;
		speed = (60 / beats) * 1000;
		document.details.beats.value = beats;
		}

	function setbeats(obj)
		{
		beats = parseFloat(obj.value)
		if (beats > 300) beats = 300;
		if (beats < 10) beats = 10;
		speed = (60 / beats) * 1000;
		document.details.beats.value = beats;
		}


</script>
<div style='width:400px; background-color: #ffffff; border-color: #000; border-style: solid; padding: 10px;'>
	<div  id='mainsec'></div>
	<div  id='controlsec' class="controldiv"></div>
</div> 
                         
<a href="JavaScript:document.details.submit()">Regen</a>&nbsp;&nbsp;
<a href="JavaScript:nextbeat()">Start</a>&nbsp;&nbsp;
<a href="JavaScript:stopbeat()">Stop</a>                                      
                                                     
             
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     