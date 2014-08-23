<?PHP
	$showmenu = "";
	require "../config/globals.php";
	require "../inc/dbfunctions.php";
	
	$orderby = $_REQUEST["orderby"];
	
	if ($orderby != "") $orderby = "ORDER BY $orderby";
	
	echo doQuery($db, "SELECT * FROM jquerysites $orderby");

?>
