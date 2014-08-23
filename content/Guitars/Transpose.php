<script language="JavaScript">
	var defs = new Array(1,1);
	var chords = new Array()
	var useSharps = false;
	bDoFormLoad = true;
	
function init() {
	if (useSharps) {
		chords[1]  = "A"
		chords[2]  = "A#"
		chords[3]  = "B"
		chords[4]  = "C"
		chords[5]  = "C#"
		chords[6]  = "D"
		chords[7]  = "D#"
		chords[8]  = "E"
		chords[9]  = "F"
		chords[10] = "F#"
		chords[11] = "G"
		chords[12] = "G#"
	}
	else {
		chords[1]  = "A"
		chords[2]  = "Bb"
		chords[3]  = "B"
		chords[4]  = "C"
		chords[5]  = "Db"
		chords[6]  = "D"
		chords[7]  = "Eb"
		chords[8]  = "E"
		chords[9]  = "F"
		chords[10] = "Gb"
		chords[11] = "G"
		chords[12] = "Ab"
	}
}


	function header() {
		
		var sBuffer = "<b>TRANSPOSER</b><br>";
		
		sBuffer += genDropdown(1) + "&nbsp;to&nbsp;" + genDropdown(2)
		sBuffer += "<br><span style='font-size: 8pt;'>"
		if (useSharps) {
			sBuffer += "<a href='JavaScript:setSharps(false)'>Show half-steps as <i>b</i></a>"
		}
		else {
			sBuffer += "<a href='JavaScript:setSharps(true)'>Show half-steps as #</a>"
		}
		sBuffer += "</span>"
		obj = document.getElementById("dissec1");
		obj.innerHTML = sBuffer;
	}


	function regen(steps) {
		var sBuffer = "<table cellspacing='0' border='0' width='110'>";
		var sSel = "";
		var cls;
		var b = 1 + steps;
		if (b < 1) b = b + 12;
		
		
		for (var a=1;a<=12;a++) {
			cls = ""
			if (a%2 == 0) cls = " class='row0'"
			sBuffer += "<tr" + cls + "><td width='90'><b>" + chords[a] + "</b></td><td style='padding-right: 8;'><b>" + chords[b] + "</b></td></tr>";
			b++;
			if (b > 12) b = b - 12;
		}
			
		sBuffer += "</table>";
		
		obj = document.getElementById("dissec2");
		obj.innerHTML = sBuffer;
	}

	function transpose() {
		var i = parseInt(document.details.scale2.value, 10);
		i = i - parseInt(document.details.scale1.value, 10);
		regen(i);
	}

	function setDef(obj, n) {
		defs[n] = parseInt(obj.value,10);
		transpose();
	}

	function setSharps(b) {
		useSharps = b
		init()
		header()
		transpose()
	}	

	function genDropdown(n) {
		var sBuffer = "<select name='scale" + n + "' onchange='setDef(this, " + n + ")'>"
		var sSel
		for (var a=1;a<13;a++){
			sSel = ""
			if (a == defs[n]) sSel = " selected";
			sBuffer += "<option value='" + a + "'" + sSel + ">" + chords[a] + "</option>";
		}
		sBuffer += "</select>"
		return sBuffer;
	}


	init();


	$(document).ready(function(){
		header();
	});

</script>
<style>
	body {
		font-family: Arial;
		font-size: 12pt;
		}
	
	.row0 {
		background-color: #f0f0f0;
		}	
</style>
<div style='padding-left: 50px;'>
	<div id="dissec1"></div>
	<div id="dissec2"></div>
</div>




