<?PHP
	$showmenu = "";
	require "../config/globals.php";
	require "../inc/dbfunctions.php";
	
	echo doQuery($db, "SELECT * FROM jquerysites");

?>
