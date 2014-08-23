<?
require "inc/formatting.php";
require "inc/dbfunctions.php";
connect();
function hsep($title) {
	?>
	<tr>
		<td class="headline" colspan="2">
			<?echo $title?>
		</td>
	</tr>
	<?
}

function thumbRow($thumb,$id) {
	?>
	<tr>
		<td class="headline" align="center">
			<?
			if ($id != "") {
				?>
			<a href="JavaScript:viewImage('<?echo $id?>', '<?echo $thumb?>')"><img src="content/Portfolio/thumbs/<?echo $thumb?>" border='0'></a>
				<?
			}
			else {
				?>
			<img src="content/Portfolio/thumbs/<?echo $thumb?>">
				<?
			}
			?>
		</td>
		<td class="lightsec" onmouseover="hilite(this)" onmouseout="norm(this)">
			<? CON($thumb) ?>
		</td>
	</tr>
	<?
}
?>
<script language="JavaScript" src="lib/admin.js"></script>
<script language="JavaScript">
	
ePrint("viewImage", "VALUE")
	
	function viewImage(id, sThumb) {
		document.details.page.value = "Portfolio/imageviewer.php";
		document.details.id.value = id;
		document.details.thumb.value = sThumb;
		document.details.submit();
	}
	
	function hilite(obj) {
		obj.style.borderColor = "#ff0000";
	}
	
	function norm(obj) {
		obj.style.borderColor = "";
	}
	
</script>
<table>
	<?
	hsep("Illustration");
	thumbRow("corsairStrat.jpg","12");
	thumbRow("DecipherU_Thumb.jpg","10");
	thumbRow("sg_t.jpg","1");
	thumbRow("speedbrake.jpg","3");
	thumbRow("Decipher.jpg","9");
	thumbRow("l-gear.gif","4");
	thumbRow("dragon.jpg","13");
	?>
</table>
<input type="hidden" name="odata" value="">
<input type="hidden" name="thumb" value="">
