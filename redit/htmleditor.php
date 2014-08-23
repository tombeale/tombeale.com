<!--
<?
$showmenu = false;
$key     = $_REQUEST["key"];
require "../config/globals.php";
?>
H:  <? echo $hostname ?> 
E: <? echo $bEditable ?>


-->
<html>
<head>
    <title>
    
    </title>
<script language="JavaScript">
	
	function init()
		{
		self.focus();
		document.details.outdata.value = opener.document.details.odata.value;
		}

	function doSave()
		{
		opener.editObj.innerHTML = document.details.outdata.value;
		<?
		if ($bEditable)
			{
			?>
			document.details.action = "save.php";
			document.details.submit();
			<?
			}
		else
			{
			?>
			self.close();
			<?
			}
		?>
		}
		
</script>
<link rel="stylesheet" href="../config/style.css" type="text/css" media="screen">
<style>
	textarea {
		border-style: solid;
		border-width: 1;
		border-color: #999999;
		}
</style>
</head>

<body bgcolor="ffffff" onload="init()">
<form name="details" action="">
<table width="100%" height="100%" border="0">
	<tr height="100%">
		<td>
			<textarea name="outdata" style="height:100%;width:100%;"></textarea>
		</td>
	</tr>
	<tr>
		<td align='right'>
			<input class="button" type="button" onmouseup="doSave()" value=" Save ">
		</td>
	</tr>
</table>
<input type="hidden" name="key" value="<?echo $key?>">
</form>
</body>
</html>
