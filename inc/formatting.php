<script language="JavaScript">
	
	function normarea(obj)
		{
		obj.style.borderWidth = "2px";
		obj.style.borderColor = "999";
		}

	function hilitearea(obj)
		{
		obj.style.borderWidth = "2px";
		obj.style.borderColor = "red";
		}
	

</script>

<?

$sepCount = 0;
$companycount = 0;


function headLine($s)
	{
	echo('<span class="headline">' . $s . '</span><br><img src="img/line.gif" width="100%" height="1">');
	}


function company($name,$loc)
	{
	global $companycount;
	if ($companycount > 0)
		{
		?>
			</table>
		</td>
	</tr>
		<?
		}
	$companycount++;
	?>
	<tr>
		<td id="<?echo $name?>" class="companyarea" colspan="4">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tr><td class="company"><?echo $name?></td><td align="right" valign="bottom"><?echo $loc?></td></tr>
			</table>
			<table>
	<?
	}

function closecompany()
	{
		?>
			</table>
		</td>
	</tr>
		<?
	
	}

function position($title,$len)
	{
	?>
				<tr>
					<td class="item" colspan="4">
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr><td><b><?echo $title?></b></td><td align="right"><b><?echo $len?></b></td></tr>
						</table>
					</td>
				</tr>
	<?
	}

function sep($text)
	{
	?>
		</td>
	</tr><tr>
		<td class="item" valign="top">
			<nobr><?echo $text?></nobr>
		</td>
		<td class="itemText">
	<?
	}

function sep2($text)
	{
	?>
		</td>
	</tr><tr>
		<td class="item" colspan="2" valign="top" style="text-align: left;">
			<nobr><?echo $text?></nobr>
		</td>
		<td class="itemText">
	<?
	}

function sepLanguages($text, $name)
	{
	global $sepCount;
	$divname = "";
	
	if ($name != "")
		{ 
		$divname = " name='" + $name + "'";
		}
	if ($sepCount > 0)
		{	
		?>
				</div>
			</td>
		</tr>
		<?
		}
	if ($name != "")
		{
		?>
		<tr>
			<td class="item2"><?echo $text?></td>
			<td class="rating">Proficiency: <b><?echo $name?></b></td>
		</tr>
		<?
		}
	?>
		<tr>
			<td class="itemText2" colspan="3">
				<div id="detail"<?echo $divname?>>
	<?
	}

function proficiency($s)
	{
	return;
	?>
				Proficiency: <b><?echo $s?></b>
			</td>
		</tr>
		<tr>
			<td class="itemText2">
		
	<? 
	}

function ePrint($a1,$a2)
	{
		echo("\n\n<!-- ePrint:" + $a1 + "\n" + $a2 + "\n -->\n\n");
	}

?>