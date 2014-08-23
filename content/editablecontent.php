<?
require "inc/formatting.php";
require "inc/dbfunctions.php";
connect();
?>
<style>

	.para {
		padding: 3px 15px 0 30px;
	}

</style>
<table cellspacing='0' cellpadding='0' border='0' width='100%'>
	<tr>
		<td class="headline">
			Editable Content
		</td>
	</tr><tr>
		<td class="item2">
			OK, so what are we talking about here?
		</td>
	</tr><tr>
		<td class='para'>
			<? CON("editable01") ?>
		</td>
	</tr><tr>
		<td class="item2">
			Why editable content?
		</td>
	</tr><tr>
		<td class='para'>
			<? CON("editable02") ?>
		</td>
	</tr><tr>
		<td class="item2">
			How does it work?
		</td>
	</tr><tr>
		<td class='para'>
			<? CON("editable03") ?>
		</td>
	</tr>


</table>
<input type="hidden" name="odata" value="">

