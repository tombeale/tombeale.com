<?PHP
	$showmenu = "";
	require "../config/globals.php";
	require "../inc/dbfunctions.php";
	
	$types = array(
		"id"       => "N",
		"name"     => "C",
		"url"      => "C",
		"rating"   => "N",
		"category" => "C",
		"notes"    => "C"
	);
	
	$raw = $_REQUEST["raw"];
	
	if ($raw != "") {
		$data = explode("\2", $raw);
		$row = "";
		$buffer = array();
		
		$sql1 = "";
		$sql2 = "";
		
		$len = count($data);
		
		for ($a=0; $a<$len; $a++) {
			$row = explode("\3", $data[$a]);
			addInsert($row[0], $row[1], $types[$row[0]]);
		}
	}
	
	echo SQL("INSERT INTO jquerysites ($sql1) VALUES ($sql2)");
	// echo("INSERT INTO jquerysites ($sql1) VALUES ($sql2)");
?>
