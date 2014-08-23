<?
require "inc/formatting.php";
require "inc/dbfunctions.php";
connect();

function addImage($image) {
	$r = "
		<div style='padding-bottom: 5px;'>
			<img src='img/websites/$image'>
		</div>
	";
	echo $r;
}


?>
<style>

	.para {
		padding: 3px 15px 0 30px;
		text-align: justify;
	}

	.lightsec {
		border-style: solid;
		border-width: 1;
		border-color: #999999;
		padding: 10px;
		vertical-align: top;
	}

</style>
<table cellspacing='0' cellpadding='0' border='0' width='100%'>
	<tr>
		<td valign='top'>
			<table cellspacing='0' cellpadding='0' border='0' width='100%'>
				<tr>
					<td class="headline">
						Web Development
					</td>
				</tr><tr>
					<td class="item2">
						My Strengths
					</td>
				</tr><tr&nbsp;	>
					<td class='para'>
						<? CON("editable01") ?>
					</td>
				</tr><tr>
					<td class="item2" colspan='1'>
						Where I fit In
					</td>
				</tr><tr>
					<td class='para' colspan='1'>
						<? CON("fitin") ?>
					</td>
				</tr>
			</table>
		</td>
		<td rowspan='20' class='lightsec' style='padding:5px 5px 0 5px;'>
			<?php
				addImage("bva.png");
				addImage("balance.png");
				addImage("wazira.png");
				addImage("wasserzeigen.png");
			?>
		</td>
		<td style='width:1em;'></td>
	</tr>
</table>
<br>&nbsp;
<input type="hidden" name="odata" value="">

