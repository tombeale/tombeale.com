<script language="JavaScript">

	var	prevmonth;
	var	prevyear;

	var	nextmonth;
	var	nextyear;	
	
	function doSubmit()
		{
		document.details.url.value = "eventcal/events.php";
		document.details.submit();
		}
	
	function lastMonth()
		{
		document.details.url.value = "eventcal/events.php";
		document.details.month.value = prevmonth;
		document.details.year.value = prevyear;
		document.details.submit();
		}
	
	function nextMonth()
		{
		document.details.url.value = "eventcal/events.php";
		document.details.month.value = nextmonth;
		document.details.year.value = nextyear;
		document.details.submit();
		}

	function newMonth(obj)
		{
		document.details.url.value = "eventcal/events.php";
		document.details.month.value = obj.value;
		document.details.year.value = nextyear;
		document.details.submit();
		}

	function EditOff()
		{
		document.details.url.value = "eventcal/events.php";
		document.details.doedits.value = "";
		document.details.submit();
		}

	function EditOn()
		{
		document.details.url.value = "eventcal/events.php";
		document.details.doedits.value = "Y";
		document.details.submit();
		}

	function refresh()
		{
		document.details.url.value = "eventcal/events.php";
		document.details.doedits.value = "Y";
		document.details.submit();
		}

	function goPopup(url, winparams)
		{
		window.open(url,"popup",winparams);
		}


	
</script>
<!--
<?
$day     = $_REQUEST["day"];
$month   = $_REQUEST["month"];
$year    = $_REQUEST["year"];
$doedits = $_REQUEST["doedits"];

?>
-->
<link rel="stylesheet" href="config/eventcalendar.css" type="text/css" media="screen">
<?
require "inc/dbfunctions.php";

//$hasPerm = getPerm("0,9");
$hasPerm = 2;
$MonthDays[1]  = 31;
$MonthDays[2]  = 28;
$MonthDays[3]  = 31;
$MonthDays[4]  = 30;
$MonthDays[5]  = 31;
$MonthDays[6]  = 30;
$MonthDays[7]  = 31;
$MonthDays[8]  = 31;
$MonthDays[9]  = 30;
$MonthDays[10] = 31;
$MonthDays[11] = 30;
$MonthDays[12] = 31;

$today = getdate();
$cyear = $today["year"];
$cmonth = $today["mon"];
$cday = $today["mday"];


if ($day == "")   $day = $today["mday"];
if ($month == "") $month = $today["mon"];
if ($year == "")  $year = $today["year"];

if (($year % 4) == 0) $MonthDays[2]  = 29;

$currentDate = getdate(mktime(0,0,0,$month,1,$year));


$startDay = $currentDate["wday"];

$weeks = (($MonthDays[$month] + $startDay) / 7);

$prevmonth = $month - 1;
$prevyear = $year;

$nextmonth = $month + 1;
$nextyear = $year;

$qStart = "$year-$month-1"; 
$qEnd = "$year-$month-" . $MonthDays[$month]; 

if ($prevmonth < 1)
	{
	$prevmonth = 12;
	$prevyear--;
	}

if ($nextmonth > 12)
	{
	$nextmonth = 1;
	$nextyear++;
	}

function row($Week,$Month,$Year)
	{
	global $startDay;
	?>
	<tr height="100px">
		<?
		for ($a=1;$a<=7;$a++)
			{
			cell($a, (($Week * 7) + $a) - $startDay, $Month, $Year);
			}
		?>
	</tr>
	<?
	}

function cell($DayOfWeek,$Day,$Month,$Year)
	{
	global $eventTitle;
	global $eventText;
	global $MonthDays;
	global $month;
	global $year;
	global $day;
	global $cmonth;
	global $cyear;
	global $cday;
	global $doedits;
	
	$sDay = $Day;
	
	if ($doedits == "Y")
		{
		$sDay = "<img src='img/add.gif' align='right' border='0' class='link' onmouseup=\"editEvent('" .pad($Day) . "','')\">" . $Day;
		}
	
	if (($Day < 1) || ($Day > $MonthDays[$month]))
		{
		$Day = "";
		?>
		<td valign="top" class='nodate'>
			<div class="eventDay">&nbsp;</div>
		</td>
		<?
		}
	else
		{
		$dayClass = "weekday";
		if (($DayOfWeek == 1) || ($DayOfWeek == 7))
			{
			$dayClass = "weekend";
			}
		if (($Month == $cmonth) && ($Year == $cyear) && (pad($Day) == pad($cday)))
			{
			$dayClass = "today";
			}
		?>
		<!-- 
		<?
		$event = $eventText[pad($Day)];
		?>
		-->
		<td valign="top" class="<?echo $dayClass?>">
			<div class="eventDay"><?echo $sDay?></div>
			<div>
				<?echo $event?>
			</div>
		</td>
		<?
		}
	
	}
	
?>




<table width='95%' border="0">
<?
if ($hasPerm > 1)
	{
	if ($doedits == "Y")
		{
		?>
		<tr style="padding:0;">
			<td colspan="7" id="editbarsec" align='right' style='font-size:8pt;' bgcolor="ffffcc">
				<a href="JavaScript:EditOff()"><b>Toggle Edit Off</b></a>
			</td>
		</tr>
		<?
		}
	else
		{
		?>
		<tr style="padding:0;">
			<td colspan="7" id="editbarsec" align='right' style='font-size:8pt'>
				<a href="JavaScript:EditOn()">Toggle Edit On</a>
			</td>
		</tr>
		<?
		}
	}
?>
	<tr>
		<td colspan="7" class="titleBar">
			<table width="100%">
				<tr>
					<td>
						<a href="JavaScript:lastMonth()">Prev</a>
					</td>
					<td>
						<td class="titleBar" style='font-size: 13pt;' align="center">Event Calendar — <?echo $currentDate["month"]?>, <?echo $currentDate["year"]?>
						&nbsp;&nbsp;
						<select onchange="newMonth(this)">
							<option value="">-Select Month-</option>
							<option value="1">January</option>
							<option value="2">February</option>
							<option value="3">March</option>
							<option value="4">April</option>
							<option value="5">May</option>
							<option value="6">June</option>
							<option value="7">July</option>
							<option value="8">August</option>
							<option value="9">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
						</select>
						</td>
					</td>
					<td align="right">
						<a href="JavaScript:nextMonth()">Next</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="dayHeader" width="14.3%">Sunday</td>
		<td class="dayHeader" width="14.3%">Monday</td>
		<td class="dayHeader" width="14.3%">Tuesday</td>
		<td class="dayHeader" width="14.3%">Wednesday</td>
		<td class="dayHeader" width="14.3%">Thursday</td>
		<td class="dayHeader" width="14.3%">Friday</td>
		<td class="dayHeader" width="14.3%">Saturday</td>
	</tr>
	<?
	function checkDateRange($Date, $start, $end)
		{
		if ($Date < $start) return false;
		if (($end != "") && ($end != "0000-00-00"))
			{
			if ($Date > $end) return false;
			}
		return true;
		}
	
	function populateWeekly($row)
		{
		// $title, $subtitle, $start, $id, $desc, $linktype, $url, $winparams
		// $row["title"],$row["subtitle"],$row["repeatday"],$row["id"],$row["description"], $row["linktype"], $row["url"],$row["winparams"]
		global $startDay;
		global $doedits;
		global $MonthDays, $month, $year;
		global $eventText;
		
		$start = $row["repeatday"];
		
		if ($startDay > $start)
			{
			$start = ((7-$startDay) + $start + 1);
			}
		else
			{
			$start = ($start - ($startDay-1));
			}
		
		
		for ($a=$start; $a<=$MonthDays[$month]; $a+=7)
			{
			if (checkDateRange("$year-" . pad($month) . "-" . pad($a), $row["startDate"], $row["endDate"]))
				{
				if (hasOverride( $a, $row["id"] ) != true)
					{
					AddEvent($a, $row["title"], $row["subtitle"], $row["id"], $row["description"], $row["linktype"], $row["url"],$row["winparams"]);
					}
				}
			}
		}

	function populateDaily($row)
		{
		global $eventText;
		global $doedits;
		global $MonthDays, $month;
		$oDate = split("-", $row["startDate"]);
		AddEvent($oDate[2], $row["title"], $row["subtitle"], $row["id"], $row["description"], $row["linktype"], $row["url"], $row["winparams"]);
		}
		
	function AddEvent($d, $title, $subtitle, $id, $desc, $linktype, $url, $winparams)
		{
		global $eventText;
		global $doedits;
		global $year, $month;
		global $sermonPath;
		global $key;
		
		$d = pad("$d");
		$eventText[$d] = "";
		
		if ($title != "")
			{
			if (!strpos($title,"<b>")) $title = "<b>$title</b>";
			if ($subtitle != "") $title = "$title<br>$subtitle";
			}
		else
			{
			$title = "$subtitle";
			if (($doedits == "Y") && ($title =="")) $title = "[BLANK]"; 
			}
		
		if ($title == "") return;
		
		if ($doedits == "Y")
			{
			$eventText[$d] .= "<div class='eventText' title=\"$desc\"><a class='editlink' href=\"JavaScript:editEvent('$d'," . $id . ",'$year-$month-$d')\">" . $title . "</a></div>";
			}
		else
			{
			if (($url == "") && ($linktype != 4))
				{
				$eventText[$d] .= "<div class='eventText' title=\"$desc\"><!a class='elink' href=\"JavaScript:editEvent('$d'," . $id . ")\">" . $title . "</!a></div>";
				}
			else
				{
				switch ($linktype)
					{
					case 1: // Show in Page
						$eventText[$d] .= "<div class='eventText' title=\"$desc\"><a class='elink' href=\"JavaScript:GetURL('$url')\">$title</a></div>";
						break;
					case 2: // Show in Popup
						$eventText[$d] .= "<div class='eventText' title=\"$desc\"><a class='elink' href=\"JavaScript:goPopup('$url','$winparams')\">$title</a></div>";
						break;
					case 3: // Play SoundFile
						$eventText[$d] .= "<div class='eventText' title=\"$desc\"><a class='elink' href=\"audio/sermon.php?url=" . $sermonPath . "$url\">$title</a></div>";
						break;
					case 4: // Open Notes Page
						$url = "content/note.php?tag=$year$month$d$id&key=$key";
						$eventText[$d] .= "<div class='eventText' title=\"$desc\"><a class='elink' href=\"JavaScript:goPopup('$url','$winparams')\">$title</a></div>";
						break;
					default: // Open in new Browser
						$eventText[$d] .= "<div class='eventText' title=\"$desc\"><a class='elink' href=\"$url\" target='_new'>$title</a></div>";
						break;
					}
				
				}
			}
		
		}


	function addOverride($d,$rid)
		{
		global $overrides;
		$overrides[$d] = "";
		$dTemp = split("-",$d);
		$d = pad($dTemp[2]);
		if ($overrides[$d] == "") $overrides[$d] = "--";
		$overrides[pad($dTemp[2])] .= $rid . "-";
		}
	
	function hasOverride($d,$id)
		{
		global $overrides;
		$d = pad($d);
		$s = $overrides[$d];
		if ($s == "") return false;
		if (strpos($s, "-$id-") > 0) return true;
		return false;
		}
	
	
	$dt1 = $year . "-" . $month . "-1";
	$dt2 = $year . "-" . $month . $MonthDays[$month];
	
// ================== Populate Recurring Overrides Events

	$sql = "SELECT * FROM Events WHERE (startDate >= '$qStart') and (startDate <= '$qEnd') and (recurring = 2) order by startdate";
	$r = SQL($sql);
	while($row = mysql_fetch_array($r))
		{
		addOverride($row["startDate"],$row["recurringid"]);
		populateDaily($row);
		}	

// ================== Populate Recurring (Weekly) Events
	$sql = "SELECT * FROM Events WHERE (startDate <= '$qEnd') and ((endDate >= '$qStart') or (endDate = '0000-00-00')) and (recurring = 1) order by repeattype, repeatday";
	$r = SQL($sql);
	while($row = mysql_fetch_array($r))
		{
		if ($row["repeattype"] == "W")
			{
			populateWeekly($row);
			}
		}
	
// ================== Populate One-Time Events

	$sql = "SELECT * FROM Events WHERE (startDate >= '$qStart') and (startDate <= '$qEnd') and (recurring = 0) order by startdate";
	$r = SQL($sql);
	while($row = mysql_fetch_array($r))
		{
		populateDaily($row);
		}	

// ================== Generate Calendar
	
	for ($a=0;$a<$weeks;$a++)
		{
		row($a,$month,$year);
		}
	?>
</table>
<script language="JavaScript">
	prevmonth = parseInt("<?echo $prevmonth?>",10);
	prevyear = parseInt("<?echo $prevyear?>",10);

	nextmonth = parseInt("<?echo $nextmonth?>",10);
	nextyear = parseInt("<?echo $nextyear?>",10);	
	
<?
if ($hasPerm > 1)
	{
	?>
	function editEvent(dt,id,cdate)
		{
		dt = "<?echo $year?>-<?echo $month?>-" + dt
		window.open("content/events/eventedit.php?dt=" + dt + "&id=" + id + "&cdate=" + cdate + "&key=<?echo $key?>","eventedit" + id ,"width=400,height=400,resizable");
		}
	
	<?
	}
?>

</script>
<input type="hidden" name="day" value="<?echo $day?>">
<input type="hidden" name="month" value="<?echo $month?>">
<input type="hidden" name="year" value="<?echo $year?>">
<input type="hidden" name="doedits">
<input type="hidden" name="url">
<!--

<?
if (true)
	{
	while ( list( $k, $v ) = each( $eventText ) ) 
		{
		echo "\$eventText[$k] = " . $v . "\n";
		}
	echo "\n";
	while ( list( $k, $v ) = each( $overrides ) ) 
		{
		echo "\$overrides[$k] = " . $v . "\n";
		}
	}
?>	
-->

