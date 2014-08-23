<?
require "config/globals.php";
require "inc/dbfunctions.php";
connect();
$basepath = "http://www.tombeale.com/";
?>
<html>
<head>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
    <title>
    	Tom Beale - Web Development
    </title>
<link rel="stylesheet" href="<?echo $basepath?>config/style.css" type="text/css" media="screen">
</head>

<body background="<?echo $basepath?>img/back.gif">
<form name="details" target="_self" action="index.php" method="post">
<table cellspacing="0" cellpadding="0" border="0" width="100%" height="100%">
	<tr>
		<td style="background-image: url(<?echo $basepath?>img/logo.gif); height: 80px;"><img src="<?echo $basepath?>img/spacer.gif" height="80" width="250"></td>
		<td style="background-image: url(<?echo $basepath?>img/back-top.gif);" width="100%">&nbsp;</td>
	</td>
	<tr>
		<td colspan="2" style="padding: 0 0 0 70" valign="top">
			Web Development <img src="<?echo $basepath?>img/bul.gif" hspace="3" vspace="2">  
			Database Integration <img src="<?echo $basepath?>img/bul.gif" hspace="3" vspace="2">
			Design
		</td>
	</tr>
	<tr>
		<td colspan="2" id="addersssec" style="padding: 0 0 0 70" valign="top">22200 NE Dopp Rd   Newberg, OR 97132</td>
	</tr>
	<tr height="100%">
		<td colspan="2" style="padding: 20 0 0 140" valign="top">
			<?
			$sql = "SELECT * FROM Invoices WHERE id = $id";
			$R =  SQL($sql);
			$r = mysql_fetch_array($R);
			
			$sql = "SELECT * FROM Customers WHERE id = " . $r["customerid"];
			
			$R =  SQL($sql);
			$rc = mysql_fetch_array($R);
			?>
			<table cellpadding="4" width='90%'>
				<tr>
					<td class="headline" style="padding: 0 0 0 0;" colspan="2">
						Invoice
					</td>
					<td align='right' class="invoiceNumber">
						<?echo $r["jobno"] . "-" . $r["id"]?>
					</td>
				</tr>
				<tr>
					<td class="invoiceItem">
						<span class="caption">Client</span><br>
						<?echo $rc["Name"]?>
					<td>
					<td class="invoiceItem" align="right">
						<span class="caption">Billing Date</span><br>
						<?echo $r["billdate"]?>
					<td>
				</tr>
				<tr>
					<td class="invoiceItem">
						<span class="caption">Job Title</span><br>
						<?echo $r["title"]?>
					<td>
				</tr>
				<tr>
					<td colspan='3' class="invoiceItem">
						<span class="caption">Description</span>
						<div class="invoicedescription"><?echo $r["description"]?></div>
					<td>
				</tr>
				<tr>
					<td colspan='3' class="invoiceItem" align='right'>
						<span class="caption">Amount</span><br>
						$<?echo number_format($r["amount"],2,".",",")?><p>
					<td>
				</tr>
			</table>
			
			
		</td>
	</tr>
	<tr>
		<td style="background-image: url(<?echo $basepath?>img/logo-stripe-left.gif); padding: 0 0 0 70;"><img src="<?echo $basepath?>img/spacer.gif" height="30"></td>
		<td style="background-image: url(<?echo $basepath?>img/logo-stripe.gif);">&nbsp;</td>
	</td>
</table>
</body>
</html>
