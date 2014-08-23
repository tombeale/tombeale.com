<?PHP
	$showmenu = "";
	require "../config/globals.php";
	require "../inc/dbfunctions.php";
	
	$sRaw = $_REQUEST["raw"];
	
	
	$oRaw   = explode("\2", $sRaw);
	$return = array();
	$fields = explode("\3", $oRaw[0]);
	
	
	$rows = count($oRaw);
	SQL("DELETE FROM jquerysites");
	for ($a=1;$a<$rows;$a++) {
		$return[] = genSQL(split("\3", $oRaw[$a]));
	}
	
	function genSQL($data) {
		global $sql1;
		global $sql2;
		
		$sql1 = "";
		$sql2 = "";
		
		addInsert("name",     $data[1], "c");
		addInsert("url",      $data[2], "c");
		addInsert("rating",   $data[3], "n");
		addInsert("category", $data[4], "c");
		addInsert("notes",    $data[5], "c");
		
		
		return SQL("INSERT INTO jquerysites ($sql1) VALUES ($sql2)");
		
	}
	
	echo join("\n", $return);
	
?>
