<!--<?require "inc/formatting.php";require "inc/dbfunctions.php";connect();function langSec($name, $proficiency, $tag) {	?>	<tr>		<td class="item2"><?echo $name?></td>		<td class="rating" align='right'>Proficiency: <b><?echo $proficiency?></b></td>	</tr><tr>		<td colspan='2' class='langsec' id='c_<?echo $tag?>'><?CON($tag)?></td>	</tr>	<?}?>--><script language="JavaScript" src="lib/functions.js"></script><script language="JavaScript">		/*	$(document).ready(formLoad);	function formLoad(){		setInnerHTML("main", "OK")	}	*/	</script><style>		.langsec {		padding: 4px 0 0 20px;	}</style><table cellspacing="0" width="95%" border="0">	<tr>		<td class="headline" colspan="2">			Programming Languages		</td>	</tr>	<?	langSec("JavaScript",    "Expert", "langJS");	langSec("ASP (Classic)", "Expert", "langASP");	langSec("PHP",           "Expert", "langPHP");	langSec("AJAX",          "Expert", "langAJAX");	langSec("HTML",          "Expert", "langHTML");	langSec("CSS",           "Expert", "langCSS");	langSec("Visual Basic",  "Expert", "langVB");	langSec("DHTML",         "High",   "langDHTML");	langSec("SQL",           "High Intermediate",   "langSQL");	langSec("ASP (.Net)",    "Intermediate", "langASPNET");	langSec("C#",            "Intermediate", "langCSharp");	langSec("PERL",          "Intermediate", "langPERL");	?></table><p>&nbsp;<input type="hidden" name="odata" value="">