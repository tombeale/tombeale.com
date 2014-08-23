<%
dim r

Set Conn = Server.CreateObject("ADODB.Connection")
cnpath="DBQ=" & server.mappath("esm.mdb")
Conn.Open "DRIVER={Microsoft Access Driver (*.mdb)}; " & cnpath


for each key in request.form
	s = getfield(key,request.form(key))
	if s <> "" then
		set rs=conn.execute(s)	
	end if
next


function getfield(f,v)
	if v = "" then 
		getfield = ""
		exit function
	end if
	r = split(f, "-")
	if ubound(r) < 1 then
		getfield = ""
		exit function
	end if
	s = "UPDATE Software SET " & r(0) & "=" & v & " WHERE index=" & r(1)
	getfield = s
end function


cat = request.form("category")
fac = request.form("facility")
cat = replace(cat, " ", "+")

r = "categories.asp?Category=" & cat & "&Facility=" & fac

response.redirect r
%>