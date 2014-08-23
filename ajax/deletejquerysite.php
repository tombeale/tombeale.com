<?PHP
	$showmenu = "";
	require "../config/globals.php";
	require "../inc/dbfunctions.php";
	
	$id = $_REQUEST["id"];
	
	if ($id != "") {
		echo "DELETE FROM jquerysites WHERE id = $id\nResult: " . SQL("DELETE FROM jquerysites WHERE id = $id");
	}
	else {
		echo "No ID";
	}
?>
