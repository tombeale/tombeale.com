<?
# --------------------------------- Connect to MySQL
function connect() {
	global $l, $hostname, $username, $password;
	$l = mysql_connect($hostname, $username, $password);
}

# --------------------------------- Submit SQL Statement to MySQL and trap errors
function SQL($sql) {
	connect();
	global $l, $errmsg, $db;
	$r = mysql_db_query($db, $sql , $l);
	$errmsg = mysql_errno().": ".mysql_error();
	if (mysql_error() != "") {
		errormsg("Database Error", $errmsg);
		$r = 0;
	}
	return $r;
}

# --------------------------------- Submit SQL Statement and return chr 2/3-delim text
function doQuery($db, $sql) {
	connect();
	global $l, $errmsg;
	$c1 = chr(1);
	$c2 = chr(2);
	$c3 = chr(3);
	$sBuffer = "";
	$sRowBuffer = "";
	$r = mysql_db_query($db, $sql , $l);
	$errmsg = mysql_errno().": ".mysql_error();
	if (mysql_error() != "") {
		errormsg("Database Error", $errmsg);
		$r = 0;
		return $r;
	}
	
	while ($obj = mysql_fetch_field($r))  {
	  	if ($sBuffer != "") { $sBuffer = "$sBuffer$c3"; }
		$sBuffer = "$sBuffer$obj->name"; 
	} 

	while ($row = mysql_fetch_row($r)) {
	  	$sRowBuffer = "";
		for ($i=0; $i<mysql_num_fields($r); $i++) { 
			if ($sRowBuffer != "") { $sRowBuffer = "$sRowBuffer$c3"; } 
			$sRowBuffer = "$sRowBuffer" . safeString($row[$i]); 
		}
	  	if ($sBuffer != "") { $sBuffer = "$sBuffer$c2"; }
	  	$sBuffer = "$sBuffer$sRowBuffer";
	} 
	mysql_free_result($r);
	return $sBuffer;
}
	
# ---------------- Submit SQL Statement and return the insert statments for the returned data
function exportQuery($db, $sql) {
	connect();
	global $l, $errmsg;
	$sBuffer = "";
	$tableName = "";
	$columnNames = "";
	$columnTypes = "";
	$arrTypes;
	$sRowBuffer = "";
	$sSQLBuffer = "";
	$fieldValue = "";
	
	$r = mysql_db_query($db, $sql , $l);
	$errmsg = mysql_errno().": ".mysql_error();
	if (mysql_error() != "") {
		errormsg("Database Error", $errmsg);
		$r = 0;
		return $r;
	}
	
	while ($obj = mysql_fetch_field($r)) {
	  	if ($tableName == "") $tableName = $obj->table;
	  	if ($columnNames != "") { $columnNames = "$columnNames,"; }
	  	if ($columnTypes != "") { $columnTypes = "$columnTypes,"; }
		$columnNames = "$columnNames$obj->name"; 
		$columnTypes .= $obj->type; 
	} 
	
	$columnTypes = strtoupper($columnTypes);
	$arrTypes = split(",",$columnTypes);
	// return $columnTypes . "\n\n" . join($arrTypes,",");
	
	while ($row = mysql_fetch_row($r)) {
	  	$sRowBuffer = "";
	  	$sSQLBuffer = "";
		for ($i=0; $i<mysql_num_fields($r); $i++) {
			switch ($arrTypes[$i]) {
				case "TINYINT":
				case "SMALLINT":
				case "MEDIUMINT":
				case "INT":
				case "INTEGER":
				case "BIGINT":
				case "FLOAT(4)":
				case "FLOAT(8)":
				case "FLOAT":
				case "DOUBLE":
				case "DOUBLE PRECISION":
				case "REAL":
					$fieldValue = AddSlashes($row[$i]);
					break;

				default:
					$fieldValue = "'" . AddSlashes($row[$i]) . "'";
			}
			if ($sRowBuffer != "") { $sRowBuffer = "$sRowBuffer,"; } 
			$sRowBuffer = "$sRowBuffer$fieldValue"; 
		}
		$sSQLBuffer = "REPLACE INTO $tableName ($columnNames) VALUES ($sRowBuffer);\n";
	  	$sBuffer = "$sBuffer$sSQLBuffer";
	} 
	mysql_free_result($r);
	return $sBuffer;
}

# --------------------------------- Submit SQL Statement and return chr 2/3-delim text
#                                   Return only results for which the user has permission
function doPermQuery($db, $sql, $permcolumn) {
	global $l, $errmsg;
	global $minPerm;
	$c1 = chr(1);
	$c2 = chr(2);
	$c3 = chr(3);
	$sBuffer = "";
	$sRowBuffer = "";
	
	if ($minPerm == "") $minPerm = 1;
	
	$r = mysql_db_query($db, $sql , $l);
	$errmsg = mysql_errno().": ".mysql_error();
	if (mysql_error() != "") {
		errormsg("Database Error", $errmsg);
		$r = 0;
		return $r;
	}

	while ($obj = mysql_fetch_field($r)) {
	  	if ($sBuffer != "") { $sBuffer = "$sBuffer$c3"; }
		$sBuffer = "$sBuffer$obj->name"; 
	} 

	while ($row = mysql_fetch_row($r)) {
		$permlist = $row[$permcolumn];
	  	$sRowBuffer = "";
	  	$bAllow = false;
	  	if (($permlist == "") || ($permlist == "0")) {
	  		$bAllow = true;
	  	}
	  	else {
	  		if (getPerm($permlist) > 0) $bAllow = true;
	  	}
	  	if ($bAllow) {
			for ($i=0; $i<mysql_num_fields($r); $i++) { 
				if ($sRowBuffer != "") { $sRowBuffer = "$sRowBuffer$c3"; } 
				$sRowBuffer = "$sRowBuffer" . safeString($row[$i]); 
			}
		  	if ($sBuffer != "") { $sBuffer = "$sBuffer$c2"; }
		  	$sBuffer = "$sBuffer$sRowBuffer";
		}
	} 
	mysql_free_result($r);
	return $sBuffer;
}

# --------------------------------- Submit SQL Statement and return chr 2/3-delim text
#                                   Return only results for which the user has permission
#                                   Fourth Perameter if "NH" disables header row
function doPermQuery2($db, $sql, $permcolumn, $h) {
	global $l, $errmsg;
	$c1 = chr(1);
	$c2 = chr(2);
	$c3 = chr(3);
	$sBuffer = "";
	$sRowBuffer = "";
	
	$r = mysql_db_query($db, $sql , $l);
	$errmsg = mysql_errno().": ".mysql_error();
	if (mysql_error() != "") {
		errormsg("Database Error", $errmsg);
		$r = 0;
		return $r;
	}
	if ($h != "NH") {
		while ($obj = mysql_fetch_field($r)) {
		  	if ($sBuffer != "") { $sBuffer = "$sBuffer$c3"; }
			$sBuffer = "$sBuffer$obj->name"; 
		} 
	}
	while ($row = mysql_fetch_row($r)) {
		$permlist = $row[$permcolumn];
	  	$sRowBuffer = "";
	  	$bAllow = false;
	  	if ($permlist == "") {
	  		$bAllow = true;
	  	}
	  	else {
	  		if (getPerm($permlist) > 0) $bAllow = true;
	  	}
	  	if ($bAllow) {
			for ($i=0; $i<mysql_num_fields($r); $i++) { 
				if ($sRowBuffer != "") { $sRowBuffer = "$sRowBuffer$c3"; } 
				$sRowBuffer = "$sRowBuffer" . safeString($row[$i]); 
			}
		  	if ($sBuffer != "") { $sBuffer = "$sBuffer$c2"; }
		  	$sBuffer = "$sBuffer$sRowBuffer";
		}
	} 
	mysql_free_result($r);
	return $sBuffer;
}

function safeString($s) {
	$s = ereg_replace("\n"," ",$s);
	$s = ereg_replace("\r","<br>",$s);
	$s = ereg_replace("\'","&#39;",$s);
	$s = ereg_replace("\"","&#34;",$s);
	return $s;
}

# --------------------------------- Process raw-formatted data from POST and build queries
function process($raw) {
	global $sql1, $sql2;
	global $db0, $key;

	ePrint("\n-------------------------\n$raw\n-------------------------\n");
	$raw = split("\2",$raw);
	
	for ($a=0;$a<count($raw);$a++) {
		ePrint("Processing: $a");
		$s = split("\3",$raw[$a]);
		$query = "";
		$db = "";
			switch ($s[0]) {
				case "I":
					$query = "insert into " . $s[2] . " (" . $s[3] . ") values (" . $s[4] . ")";
					$db = $s[1];
					break;
				
				case "UGEN":
					$sql1 = "";
					$fields = split("\~",$s[3]);
					$values = split("\~",$s[4]);
					if (count($fields) == count($values)) {
						for ($b=0;$b<count($fields);$b++) {
							addUpdate($fields[$b],$values[$b],"N");
						}
					}
					else{
						echo "\n\nprocess_UGEN: Count Mismatch\n\n";
					}
					$query = "update " . $s[2] . " set " . $sql1 . "where " . $s[5];
					$db = $s[1];
					break;
					
				case "IGEN":
					$sql1 = "";
					$sql2 = "";
					$fields = split("\~",$s[3]);
					$values = split("\~",$s[4]);
					if (count($fields) == count($values)) {
						for ($b=0;$b<count($fields);$b++) {
							addInsert($fields[$b],$values[$b],"N");
						}
					}
					else {
						echo "\n\nprocess_UGEN: Count Mismatch\n\n";
					}
						
					ePrint($s[3] . "\n\n" . $s[4] . "\n\n" . $sql1 . "\n\n");
					$query = "insert into " . $s[2] . " (" . $sql1 . ") VALUES (" . $sql2 . ")";
					$db = $s[1];
					break;

				case "U":
					$query = "update " . $s[2] . " set Name='" . $s[3] . "', Description='" . $s[3] . "' where " . $s[4];
					$db = $s[1];
					break;
				
				case "U2":
					$query = "update " . $s[2] . " set Level='" . $s[3] . "' where " . $s[4];
					$db = $s[1];
					break;
				
				case "D":
					$query = "delete from " . $s[2] . " where " . $s[3];
					$db = $s[1];
					break;
			}
		if ($query != "") {
			$r = SQL($db,$query);
			$errmsg = mysql_errno().": ".mysql_error();
			$sql1 = "";
			$sql2 = "";
			addInsert("efftable",$s[2],"C");
			addInsert("action",$s[0],"C");
			addInsert("result",$errmsg,"C");
			addInsert("session",$key,"C");
			$s = "insert into writelog ($sql1) values ($sql2)";
			SQL($db0,$s);
		}

		echo "\n----------------------------------\nSQL($db,$query)\n----------------------------------\n";
	}
}


function SignOn($userid,$password) {
	global $db1, $user_index, $user_id;
	$sql = "select * from people where userid = '$userid'";
	$rs = SQL($db1,$sql);
	$r = mysql_fetch_array($rs);
	mysql_free_result($rs);
	$password = crypt($password, $r["password"]);
	if ($password == $r["password"]) {
		$user_index = $r["id"];
		$user_id = $r["userid"];
		return true;
	}
	return false;
}

function errormsg($tag, $msg) {
	echo "<p>$tag<br><b>$msg;</b>";
}


# -------------- Query Builder Functions

function addInsert($n,$v,$c) {
	global $sql1;
	global $sql2;
	
	if ($sql1 != "") {
		$sql1 .= ",";
		$sql2 .= ",";
	}

	if ($c == "N") {
		$sql1 .= $n;
		$sql2 .= $v;
	}
	
	else if ($c == "D") {
		if ($v == "") {
			$sql1 .= $n;
			$sql2 .= "'0000-00-00'";
		}
		else{
			$sql1 .= $n;
			$sql2 .= "'" . formatDate($v) . "'";
		}
	}
	else {
		$sql1 .= $n;
		$sql2 .= "'" . mysql_clean($v) . "'";
	}
}

function addUpdate($n,$v,$c) {
	global $sql1;
	
	if ($sql1 != "") {
		$sql1 .= ",";
	}

	if ($c == "N") {
		$sql1 .= "$n = $v";
	}
	else if ($c == "D") {
		if ($v == "") {
			$sql1 .= "$n = '0000-00-00'";
		}
		else {
			$sql1 .= "$n = '" . formatDate($v) . "'";
		}
	}
	else {
		$sql1 .= "$n = '" . mysql_clean($v) . "'";
	}
}

function mysql_clean($s) {
	$s = ereg_replace("'","&#39;",$s);
	$s = ereg_replace("\"","&#34;",$s);
	return $s;
}
?>
