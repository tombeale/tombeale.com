<script language="JavaScript" src="lib/cal.js"></script>
<script language="JavaScript" src="lib/calfunctions.js"></script>
<script language="JavaScript" src="lib/richedit.js"></script>
<script language="JavaScript" src="lib/tables.js"></script>
<script language="JavaScript" src="lib/showtime.js"></script>
<script language="JavaScript">
	bDoFormLoad = true;
	var editor = new richedit("edt",605,300,"doHandle()")
	var editflag = false
	var currentKey = ""
	var displayKey = ""
	
	function formload()
		{
		this_month("calsec");
		showTime();
		}

<?
//require "inc/dbfunctions.php";
//$raw = doQuery("tombeale", "SELECT id, caption, action, atype, tip FROM menu");
?>
//var oMenu = genDBTable("<?echo $raw?>","C");
//addWatch("oMenu","TABLE");
		
</script>
<?
$wincount = 0;

function showTLink($link,$text,$target)
	{
	if ($target != "") $target = "target='" . $target . "'";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;<a $target class='inline' href='$link'>$text</a><br>";
	}

function showLink($link,$text)
	{
	echo "&nbsp;&nbsp;&nbsp;&nbsp;<a class='inline' href='$link'>$text</a><br>";
	}

function showILink($link,$text)
	{
	echo "&nbsp;&nbsp;&nbsp;&nbsp;<a class='inline' href=\"JavaScript:getPage('$link',1,1)\">$text</a><br>";
	}

function showPopLink($link,$text,$opts)
	{
	global $wincount;
	$wincount++;
	echo "&nbsp;&nbsp;&nbsp;&nbsp;<a class='inline' href=\"JavaScript:getPopup('$link','win$wincount','$opts')\">$text</a><br>";
	}

function listSep($s)
	{
	?>
	<div style="padding: 8 0 0 0; color: #ff0000;">
		<b><?echo $s?></b>
	</div>
	<?
	}


?>

<br>
<table border='0'>
	<tr>
		<td style="line-height: 11pt" valign='top' style="padding: 0 25 0 0;" rowspan="3">
			<?
			if ($host == "10.10.11.13")
				{
				listSep("Blood Pressure");
				showLink("http://picard/bloodpressure/","Enter Blood Pressure");
				showLink("http://picard/bloodpressure/display.asp","Chart Blood Pressure");
	
				listSep("My Site");
				showLink("http://10.10.11.13/mysite/","Dev Site");
				
				listSep("Client Dev Sites");
				showLink("http://picard/clients/BVA/default.asp?administrator=3VA","BVA Dev (Admin)");
				showLink("http://picard/clients/BVA/default.asp","BVA Dev");
				showLink("http://picard/clients/BVA/cart/dbutil.asp","BVA DB Utility");
				showPopLink("File://Picard/WebSites/wwwroot/clients/BVA","BVA Folder","width=260,height=550,toolbar,location,menubar");
				showLink("http://10.10.11.13/clients/shcc/","Singing Hills Christian Church");
				showLink("http://picard/clients/supergen/admin.asp","SuperGen Dev");
				showLink("http://picard/clients/supergen/sgadmin/signon.asp","SuperGen Admin Site");
				showLink("http://picard/clients/supergen05/home/main.asp","SuperGen Dev (Old)");
				showLink("http://picard/clients/FaithAndBusiness/subtemplate.asp","Faith and Business");
				showLink("http://picard/clients/FaithAndBusiness/admin","Faith and Business (admin)");
				showLink("/clients/","Clients (Warf)");
				showLink("http://picard/clients/","Clients (Picard)");
				}
				
			listSep("Production Sites");
			showLink("http://www.bvamotorsports.com/default.asp?administrator=3VA","BVA (Staging / admin)");
			showLink("http://www.bvamotorsports.com/cart/dbutil.asp","BVA DB Utility");
			showLink("http://www.singinghills.org","Singing Hills Christian Church");
			showLink("http://www.supergen.com","SuperGen");
			showLink("http://www.supergen.com/sgadmin","SuperGen (admin)");
			showLink("http://www.centerforfaithandbusiness.com","Faith and Business");
			showLink("http://www.centerforfaithandbusiness.com/admin","Faith and Business (admin)");
		
			if ($host == "10.10.11.13")
				{
				listSep("Misc Dev Sites");
				showLink("http//10.10.11.13/dev/","Development (Warf)");
				showLink("http://picard/dev/","Dev (Picard)");
			
				listSep("My Business Sites");
				showLink("javascript:getPage(\"jobs/listjobs.php\")","Time Tracking / Billing");
				showLink("javascript:getPage(\"jobs/timecard.php\")","Time Card");
				showLink("/portfolio/","Portfolio/Job Search (Warf)");
				showLink("http://picard/","Picard");
				showLink("http://mail.innovation-asset.com:3000","IAG Web Mail");
				}
			
			listSep("Utilities");
			showILink("/utilities/Transpose.php","Transpose");
			showILink("/utilities/unescape.php","Escape / Unescape");
			showILink("/utilities/classes.php","Class Lister");
			showILink("/utilities/docProps.php","Document Properties");
			?>
		</td>
		<td valign='top'>
			<div id="calsec"></div>
		</td>
		<td valign='top'>
			<div style="font-size: 12pt;font-weight: bold;" id="datesec"></div>
			<div style="font-size: 16pt;font-weight: bold;" id="timesec"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2" id="caleditsec" valign='top'></td>
	</tr>
</table>
<input type="hidden" name="odata" value="">
<input type="hidden" name="datedata" value="">
