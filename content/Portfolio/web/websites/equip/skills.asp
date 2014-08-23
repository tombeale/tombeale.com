<%
action = "Skills.asp"
Category = request.querystring("Category")
Facility = request.querystring("Facility")

ucat = replace(Category," ","+")

dim heads(11)
heads(0)  = "Anaheim"
heads(1)  = "CanogaPark"
heads(2)  = "Downey"
heads(3)  = "HuntingtonBeach"
heads(4)  = "LongBeach"
heads(5)  = "Mesa"
heads(6)  = "Philadelphia"
heads(7)  = "SealBeach"
heads(8)  = "Seattle"
heads(9)  = "StLouis"
heads(10) = "Wichita"

if Facility <> "" then
	beg = "?"
	if Category <> "" then beg = "&"
	fac = beg & "Facility=" & Facility
else
	fac = ""
end if

font = "<FONT FACE='Arial, Helvetica' SIZE=-1>"

Set Conn = Server.CreateObject("ADODB.Connection")
cnpath="DBQ=" & server.mappath("esm.mdb")
Conn.Open "DRIVER={Microsoft Access Driver (*.mdb)}; " & cnpath
%>
<HTML>
<HEAD>
    <TITLE>
    	Graphics Council -- Skills Matrix
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

<TABLE CELLSPACING=1 BORDER=1 CELLPADDING=4 BGCOLOR="FFFFFF">
	<TR>
		<TD COLSPAN=2 BGCOLOR="FFFFFF">
			<TABLE WIDTH=100%><TR>
				<TD ALIGN=LEFT>
					<FONT FACE="Arial, Helvetica" SIZE=+1>
					<A HREF="hw-update.asp?category=CPU+Speed">Hardware</A>
				</TD><TD ALIGN=CENTER>
					<FONT FACE="Arial, Helvetica" SIZE=+1>
					<A HREF="Categories.asp?Category=3D">Software</A>
				</TD><TD ALIGN=RIGHT>
					<FONT FACE="Arial, Helvetica" SIZE=+2>
					<b>Skills Matrix</b>
			</TR></TABLE>
		</TD>
	</TR>
	<!-- ----------------------------------------------------------- Category Menu -->
	<TR>
		<TD VALIGN=TOP ALIGN=RIGHT>
			<FONT FACE="Arial, Helvetica" SIZE=-2>
			<%
			if Facility <> "" then
				%>
				<DIV ALIGN=LEFT>
					<A HREF="<%=action%>?Category=<%=replace(Category," ","+")%>"><b>Show All Facilities</b></A><br>
				</DIV>
				<HR>
				<%
			end if
			sql = 	"SELECT Category FROM Skills GROUP BY Category ORDER BY Category"
			set rs=conn.execute(sql)
			
			do while not rs.eof
				if Category = rs.fields("Category") then
					l = "<FONT SIZE=+1><b>" & rs.fields("Category") & "</b></FONT><br>"
				else
					l = "<A HREF='" & action & "?Category=" & replace(rs.fields("Category")," ","+") & fac & "'>" & rs.fields("Category") & "</A><br>"
				end if	
				response.write l
				rs.movenext
			loop
			%>
		</TD>
		<TD VALIGN=TOP>
			<FORM METHOD=POST ACTIO="http://129.200.52.28/cgi-bin/echo.pl" ACTION="skills-submit.asp">
			<TABLE CELLSPACING=1 BORDER=0 CELLPADDING=2>
			<!-- ----------------------------------------------------- Matrix Main -->
			<%
			if Category <> "" then
				sql = 	"SELECT * FROM Skills WHERE Category='" & Category & "' ORDER BY Category, skill"
				set rs=conn.execute(sql)
				headers Facility
				
				dim ccl(2)
				ccl(0) = "FFFFCC"
				ccl(1) = "FFDDAA"
				
				do while not rs.eof
					c = c + 1
					if c > 1 then c = 0
					l = rs.fields("Skill")
					%>
					<TR>
						<TD BGCOLOR=<%=ccl(c)%>>
							<FONT FACE='Arial, Helvetica' SIZE=-1>
							<%=l%>
						</TD>
					<%
					if Facility <> "" then 
						single_fac facility
					else
						all_fac
					end if
					rs.movenext
					response.write "</TR>"
				loop
				if Facility <> "" then
					%>
					<TR>
						<TD ALIGN=RIGHT COLSPAN=2>
							<INPUT TYPE=SUBMIT VALUE="Enter">
						</TD>
					</TR>
					<%
				end if
			end if
			%>
			</TABLE>
			<INPUT TYPE=HIDDEN NAME="category" VALUE="<%=Category%>">
			<INPUT TYPE=HIDDEN NAME="facility" VALUE="<%=Facility%>">
			</FORM>
		</TD>
	</TR>
</TABLE>

<%

' ----------------------------------------------------- Matrix for Single Location
sub single_fac (name)
		i = rs.fields("index")
		v = rs.fields(name)
		if v = 0 then v = ""
		%>
		<TD BGCOLOR=<%=ccl(c)%> ALIGN=CENTER>
			<%=font%>
			<INPUT TYPE=TEXT NAME="<%=name%>-<%=i%>" VALUE="<%=v%>" SIZE=4>
		</TD>
		<%
end sub

' ----------------------------------------------------- Matrix for All Locations
sub all_fac
		i = rs.fields("index")
		for a = 0 to 10
			h = heads(a)
			'v = h
			v = rs.fields(h)
			if v = 0 then v = ""
			%>
			<TD BGCOLOR=<%=ccl(c)%> ALIGN=CENTER>
				<%=font%>
				&nbsp;<%=v%>&nbsp;
			</TD>
			<%
		next
end sub

' ----------------------------------------------------- Location Headers
sub headers (name)
	%>
	<TR>
	<TD VALIGN=BOTTOM>
		<FONT FACE="Arial Narrow, Arial, Helvetica" SIZE=+2><b>
		&nbsp;
		
	</TD>
	<%
	if name <> "" then
		cc = name
		%>
		<TD VALIGN=BOTTOM ALIGN=CENTER>
			<IMG SRC="lib/<%=name%>.gif" HSPACE=5>		
		</TD>
		<%
	else 
		for a = 0 to 10
			cc = heads(a)
			%>
			<TD ALIGN=CENTER VALIGN=BOTTOM>
				<FONT FACE="Arial Narrow, Arial, Helvetica" SIZE=-1>
				<b><A HREF="<%=action%>?category=<%=ucat%>&Facility=<%=cc%>"><IMG SRC="lib/<%=cc%>.gif" HSPACE=5 BORDER=0></A><br>
			</TD>
			<%
		next
	end if
	response.write "</TR>"
end sub

' ------------------------------------------------------ Platform Legend
sub legend
	pcc   = getColor("PC")
	macc  = getColor("Mac")
	unixc = getColor("Unix")
	%>
	<TABLE CELLSPACING=3 CELLPADDING=0 BORDER=0>
		<TR>
			<TD BGCOLOR="<%=pcc%>">
				<FONT FACE="Arial, Helvetica" SIZE=-1>
				&nbsp;&nbsp;&nbsp;&nbsp;
			</TD>
			<TD>
				<FONT FACE="Arial, Helvetica" SIZE=-1>
				<b>PC</b><br>
			</TD>
		</TR>
		<TR>
			<TD BGCOLOR="<%=Macc%>">
				<FONT FACE="Arial, Helvetica" SIZE=-1>
				&nbsp;&nbsp;&nbsp;&nbsp;
			</TD>
			<TD>
				<FONT FACE="Arial, Helvetica" SIZE=-1>
				<b>Mac</b><br>
			</TD>
		</TR>
		<TR>
			<TD BGCOLOR="<%=Unixc%>">
				<FONT FACE="Arial, Helvetica" SIZE=-1>
				&nbsp;&nbsp;&nbsp;&nbsp;
			</TD>
			<TD>
				<FONT FACE="Arial, Helvetica" SIZE=-1>
				<b>Unix</b><br>
			</TD>
		</TR>
	</TABLE>
	<%
end sub
%>