<script language="JavaScript" src="<?echo $basepath?>lib/menu.js"></script>
<script language="JavaScript">
	var mflags = new Array();
	<?
	if ($admin == "Y") {
		echo "mflags['admin'] = true\n";
	}
	?>
	var menu = new menuSet(60,15,-9);
	<?
	for ($a=0;$a<count($menuitems);$a++) {
		if (strlen($menuitems[$a]) > 10) {
			if (substr($menuitems[$a],0,2) != "//") {
				echo "\n	menu.add(\"" . chop($menuitems[$a]) . "\");\n";
			}
		}
	}
	?>
</script>
<div id="menusec"></div>