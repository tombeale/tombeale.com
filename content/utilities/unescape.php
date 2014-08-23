<textarea name="area51" style="width:600px;height:400px;"></textarea><br>
<a href="JavaScript:doEscape()">escape</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="JavaScript:doUnescape()">unescape</a>


<script language="JavaScript">
	
	function doEscape()
		{
		document.details.area51.value = escape(document.details.area51.value);
		}
	
	function doUnescape()
		{
		document.details.area51.value = unescape(document.details.area51.value);
		}
	
</script>