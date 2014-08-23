<?
	$showmenu = false;
	require "../config/globals.php";
	require "../inc/dbfunctions.php";
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title> New Document </title>
		<meta name="Generator" content="EditPlus">
		<meta name="Author" content="">
		<meta name="Keywords" content="">
		<meta name="Description" content="">
	</head>
	<body>

		<textarea style='width:100%;height:100%'><?
		connect();
		$Raw = "DELETE FROM Images;\n" . exportQuery($db, "SELECT id, Title, Category, Application, Description, url1, url2, Thumbnail, MenuOptions FROM Images");
		echo $Raw;
		?></textarea>
	</body>
</html>
