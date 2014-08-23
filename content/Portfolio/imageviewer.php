<!--
<?
$id = $_REQUEST["id"];
$thumb = $_REQUEST["thumb"]
?>
-->
<?
if ($id == "") $id = 1;

require("inc/dbfunctions.php");
$ret = SQL("SELECT * FROM Images WHERE id = " . $id);
$rs = mysql_fetch_object($ret);


$image1 = $rs->url1;
$image2 = $rs->url2;
$opts = $rs->MenuOptions;

$img1 = GetImageSize("content/Portfolio/images/$image1");

if ($image2 != "")
	{
	?>
	<iframe 
		width="<?echo $img1[0]?>" 
		height="<?echo $img1[1]?>" 
		src="content/Portfolio/lense.php?image1=<?echo $image1?>&image2=<?echo $image2?>&options=<?echo $opts?>")
		frameborder='0'
		scrolling="no">
	</iframe><br>
	<a href="JavaScript:showLargeImage('<?echo $image2?>')">View full-size image</a> 
	<?
	}
else
	{
	?>
	<img src="content/Portfolio/images/<?echo $image1?>">
	<?
	}
?>
	<br>
<div id="bodytext" width='<?echo $img1[0]?>px'>
	<table cellspacing="8" width="<?echo $img1[0]?>px" border="0">
		<tr><td>
			<? 
			if ($thumb != "") {
				CON($thumb);
			}
			?>
		</td></tr>
	</table>
</div>
<input type="hidden" name="odata" value="">
<script language="JavaScript">

	function showLargeImage(sImage) {
		window.open("content/Portfolio/images/" + sImage, "img", "width=800,height=800,scrollbars,resizable");
	}
	
</script>