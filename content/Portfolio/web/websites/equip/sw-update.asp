<%
facility = request.querystring("facility")
category = request.querystring("category")

ucat = replace(category," ","+")

if facility <> "" then
	uf = "&facility=" & facility
else 
	uf = ""
end if

if category = "" then category = "CPU Speed"

wh = " WHERE Category='" & category & "'"

dim cat, hed
set cat = CreateObject("Scripting.Dictionary")
set hed = CreateObject("Scripting.Dictionary")

cat.add "CPU Speed", "MHz"
cat.add "Memory", "MB"
cat.add "Hard Disk Capacity", "GB"
cat.add "Monitor Size", " in."
cat.add "External Storage", ""

hed.add "Anaheim",			"Anaheim"         
hed.add "Canoga Park",		"CanogaPark"     
hed.add "Downey",			"Downey"          
hed.add "Huntington Beach",	"HuntingtonBeach"
hed.add "Long Beach",		"LongBeach"      
hed.add "Mesa",				"Mesa"            
hed.add "Philadelphia",		"Philadelphia"    
hed.add "Seal Beach",		"SealBeach"      
hed.add "Seattle",			"Seattle"         
hed.add "St. Louis",		"StLouis"       
hed.add "Wichita",			"Wichita"       

dim color(2)
color(0) = " BGCOLOR='9999FF'"
color(1) = " BGCOLOR='FF9999'"

dim PC(2)
PC(0) = "PC"
PC(1) = "Mac"

dim heads(11)
heads(0)  = "Anaheim"
heads(1)  = "Canoga Park"
heads(2)  = "Downey"
heads(3)  = "Huntington Beach"
heads(4)  = "Long Beach"
heads(5)  = "Mesa"
heads(6)  = "Philadelphia"
heads(7)  = "Seal Beach"
heads(8)  = "Seattle"
heads(9)  = "St. Louis"
heads(10) = "Wichita"

font = "<FONT FACE='Arial, Helvetica' SIZE=-1>"

Set Conn = Server.CreateObject("ADODB.Connection")
cnpath="DBQ=" & server.mappath("esm.mdb")
Conn.Open "DRIVER={Microsoft Access Driver (*.mdb)}; " & cnpath

sql = 	"SELECT * FROM Hardware" & wh & " ORDER BY PC DESC, Val"
'response.write sql
set rs=conn.execute(sql)

%>
<HTML>
<HEAD>
    <TITLE>
    
    </TITLE>
<SCRIPT LANGUAGE="JavaScript">
<!----------------------------------------------
function newcat()
	{
	alert("OK");
	}
// -->
</SCRIPT>
<STYLE>
	A:hover { color: #6666FF; }	
	A:link,
	A:Visited,
	A:Active
	{text-decoration : none}
</STYLE>
</HEAD>

<BODY BGCOLOR="FFFFCC">
<CENTER>
<TABLE CELLSPACING=1 BORDER=1 CELLPADDING=4>
	<TR>
		<TD VALIGN=TOP BGCOLOR="FFFFFF" ALIGN=RIGHT>
			<FONT FACE="Arial, Helvetica" SIZE=-1>
			<%
			if uf <> "" then
				%>
				<A HREF="hw-update.asp?category=<%=ucat%>">View All</A>
				<HR>
				<%
			end if
			%>
			<A HREF="hw-update.asp?category=CPU+Speed<%=uf%>">CPU Speed</A><p>
			<A HREF="hw-update.asp?category=Memory<%=uf%>">Memory</A><p>
			<A HREF="hw-update.asp?category=Hard+Drive+Capacity<%=uf%>">Hard Drive Capacity</A><p>
			<A HREF="hw-update.asp?category=Monitor+Size<%=uf%>">Monitor Size</A><p>
			<A HREF="hw-update.asp?category=External+Storage<%=uf%>">External Storage</A><br>
			<HR>
			<DIV ALIGN=LEFT>
				<FONT FACE="Arial, Helvetica" SIZE=-2>
				Use this to add values
				<p>
				<u>Note:</u> Do this <i>before</i> <br>
				entering any values...<br> 
				any values in fields that<br>
				has not been<br>
				submitted will be lost!
				
			</DIV>
			<CENTER>
			<FORM METHOD=POST ACTIO="http://129.200.52.28/cgi-bin/echo.pl" ACTION="hw-add.asp">
				<INPUT TYPE=HIDDEN NAME="category" VALUE="<%=category%>">
				<INPUT TYPE=HIDDEN NAME="facility" VALUE="<%=facility%>">
				<INPUT TYPE=TEXT NAME="val" SIZE=10><br>
				<INPUT TYPE=RADIO NAME='PC' VALUE="0"> Mac
				<INPUT TYPE=RADIO NAME='PC' VALUE="1" CHECKED> PC<br>
				<INPUT TYPE=SUBMIT VALUE="Add Item">
			</FORM>
			</CENTER>
		
		</TD>
		<TD BGCOLOR="FFFFFF" VALIGN=TOP>
<FORM METHOD=POST ACTIO="http://129.200.52.28/cgi-bin/echo.pl" ACTION="hw-submit.asp">
<INPUT TYPE=HIDDEN NAME="category" VALUE="<%=category%>">
<INPUT TYPE=HIDDEN NAME="facility" VALUE="<%=facility%>">
<TABLE CELLSPACING=1 BORDER=0 CELLPADDING=2>
<%
headers facility
do while not rs.eof
	if rs.fields("PC") = True then
		c = 0
	else
		c = 1
	end if
	%>
	<TR>
		<TD>
			&nbsp;&nbsp;&nbsp;
		</TD>
		<TD <%=color(c)%> ALIGN=CENTER>
			<%
			response.write Font
			
			Line = rs.fields("Val") & cat.item(Category)
			response.write Line
			
			%>
		</TD>
		<TD <%=color(c)%>>
			<%
			response.write Font
			
			response.write PC(c)
			
			%>
		</TD>
		<%
		
		if facility <> "" then 
			single_fac facility
		else
			all_fac
		end if
		
	rs.movenext
loop
submit_button
%>
</TABLE>
</TABLE>
</FORM>
</TABLE>
</BODY>
</HTML>


<%
sub headers (name)
	%>
	<TD COLSPAN=3>
		<FONT FACE="Arial Narrow, Arial, Helvetica" SIZE=+2><b>
		<%=Category%>
	</TD>
	<%
	if name <> "" then
		%>
		<TD ALIGN=CENTER>
			<FONT FACE="Arial Narrow, Arial, Helvetica" SIZE=-1>
			<b><%=name%>
		</TD>
		<%
	else 
		for a = 0 to 10
			%>
			<TD ALIGN=CENTER>
				<FONT FACE="Arial Narrow, Arial, Helvetica" SIZE=-1>
				<b><A HREF="hw-update.asp?category=<%=ucat%>&facility=<%=hed.item(heads(a))%>"><%=heads(a)%></A>
			</TD>
			<%
		next
	end if
end sub

sub single_fac (name)
		i = rs.fields("index")
		v = rs.fields(name)
		if v = 0 then v = ""
		%>
		<TD <%=color(c)%> ALIGN=CENTER>
			<%=font%>
			<INPUT TYPE=TEXT NAME="<%=name%>-<%=i%>" VALUE="<%=v%>" SIZE=4>
		</TD>
		<%
end sub

sub all_fac
		i = rs.fields("index")
		for a = 0 to 10
			h = hed.item(heads(a))
			'v = h
			v = rs.fields(h)
			if v = 0 then v = ""
			%>
			<TD <%=color(c)%> ALIGN=CENTER>
				<%=font%>
				&nbsp;<%=v%>&nbsp;
			</TD>
			<%
		next
end sub

sub submit_button
	if facility = "" then exit sub
	%>
	<TR>
		<TD COLSPAN=20 ALIGN=RIGHT>
			<FONT FACE="Arial, Helvetica" SIZE=-1>
			<INPUT TYPE=SUBMIT VALUE="Submit Changes">
		</TD>
	</TR>
	<%		
end sub

%>
