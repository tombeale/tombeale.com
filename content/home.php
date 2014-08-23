<style>
	.lightsec {
		border-style: solid;
		border-width: 1;
		border-color: #999999;
		padding: 10px;
		font-size: 18pt;
		line-height: 24pt;
		color: #999;
		vertical-align: top;
	}
		
	.greysec {
		border-style: solid;
		border-width: 1;
		border-color: #999999;
		background-color: #f0f0f0;
	}

	.darksec {
		border-style: solid;
		border-width: 1;
		border-color: #999999;
		background-color: black;
	}

	.lightbody { 
		font-size: 10pt; 
		color: #999;
		line-height: 14pt;
		padding: 10 0 0 0; 
	}

</style>

<table width="600" cellspacing="4">
	<tr height="301">
		<td class="lightsec" width="70%" colspan="2">
			<div style="line-height: 21pt;" class='link' onmouseover='hilite(this)' onmouseout='norm(this)' onmouseup="goMainPage('WEB')"   id="hsec1ta">&nbsp;</div>
			<div style="line-height: 21pt;" class='link' onmouseoverx='hilite(this)' onmouseout='norm(this)' onmouseup="goMainPage('DB')"    id="hsec1tb">&nbsp;</div>
			<div style="line-height: 21pt;" class='link' onmouseover='hilite(this)' onmouseout='norm(this)' onmouseup="goMainPage('GFX')"   id="hsec1tc">&nbsp;</div>
			<div class="lightbody" style="color:white;padding-top:100px;padding-left:0;" id="hsec1a" align='right'>
				I am a web developer living in the Newberg area,<br> just south-west of Portland Oregon.<br>
				I specialize in <?h("JavaScript")?>, <?h("ASP")?>, <?h("PHP")?>, <?h("database integration")?>
				<nobr>and <?h("dynamic web content")?></nobr>.
			</div>
			<div class="lightbody" style="color:white;" id="hsec1b" align='right'>
				
			</div>
		</td>
		<td width="30%">
			<div style="position:absolute;">
				<img src="img/home/upper-0.gif" id="upper-a" border="0"
					style="position:absolute; top:-152; left: 0;">
				<img src="img/home/upper-0.gif" id="upper-b" border="0"
					style="visibility: hidden; 
						filter: revealTrans(duration=2, transition=12);
						position:absolute; top:-152; left: 0;">
			</div>
		</td>
	</tr>
	<tr height="7">
		<td style="background-image: url(img/logo-stripe.gif);" colspan="3">
		</td>
	</tr>
	<tr height="301">
		<td width="30%">
			<div style="position:absolute;">
				<img src="img/home/lower-0.gif" id="lower-a" border="0"
					style="position:absolute; top:-151; left: 0;">
				<img src="img/home/lower-0.gif" id="lower-b" border="0"
					style="visibility: hidden; 
						filter: revealTrans(duration=2, transition=12);
						position:absolute; top:-151; left: 0;">
			</div>
		</td>
		<td class="lightsec" width="70%" colspan="2">
			<div class="lightbody" style="color:white" id="hsec2">
				I am currently looking for employment as a full-time UI developer in the south-west Portland, Oregon area.
				If you are here looking for a developer, please check out my 
				<span class='link' onmouseup="getPage('Resume/home.php')">resume</span> 
				and <span class='link' onmouseup="menuSelect(5,4,0)">portfolio</span> sections.
			</div>
			<div class="lightbody" style="color:white" id="hsec2a">
				Please feel free to peruse this site. Everything on this site is original. The server-side code is PHP pulling the content from a MySQL database. Client-side I use a lot of JavaScript, a little JQuery and do a lot of AJAX calls. 
			</div>
			<div class="lightbody" style="color:white" id="hsec2b">
				All the artwork on this site is also original. When I was in college, my major was graphic design and programming was a hobby. Early in my career, I moved into digital media and began programming as part of my work. When the internet came onto the scene, web development was a natural direction for me. I have been working as a full-time software engineer since June of 2000.
			</div>
		</td>
	</tr>
</table>

<script language="JavaScript">

	
	function TypeString(s, sDest, iCount, iSpeed, next)
		{
		var obj = document.getElementById(sDest);
		obj.innerHTML = s.substr(0,iCount);
		iCount++;
		if (iCount <= s.length) 
			{
			setTimeout("TypeString('" + s + "','" + sDest + "'," + iCount + "," + iSpeed + ",'" + next + "')", iSpeed);
			}
		else
			{
			if (arguments.length > 4) setTimeout(next, 200);
			}
		}


	
	setTimeout("TypeString('Web App Development',      'hsec1ta',  0, 50)",100);
	setTimeout("TypeString('Database Integration', 'hsec1tb',  0, 50)",100);
	setTimeout("TypeString('Illustration',         'hsec1tc',  0, 50, 'step2()')",50);


	runImageSeq('upper', 'img/home/IMG.gif', 1, 8, 30);
	runImageSeq('lower', 'img/home/IMG.gif', 1, 5, 26);

	function step2() { fadeout('hsec1a', 15, 6, 'step3()') }
	function step3() { fadeout('hsec1b', 15, 6, "step4()") }
	function step4() { fadeout('hsec2',  15, 6, "step5()") }
	function step5() { fadeout('hsec2a', 15, 6, "step6()") }
	function step6() { fadeout('hsec2b', 15, 6) }
	
	function hilite(obj) {
		obj.style.color = "red";
	}
	
	function norm(obj) {
		obj.style.color = "";
	}
	
</script>
