<%
dim r

val = request.form("val")
PC  = request.form("PC")
cat = request.form("category")
fac = request.form("facility")

if val <> "" then

	Set Conn = Server.CreateObject("ADODB.Connection")
	cnpath="DBQ=" & server.mappath("esm.mdb")
	Conn.Open "DRIVER={Microsoft Access Driver (*.mdb)}; " & cnpath
	
	sql = "INSERT INTO Hardware (Category,Val,PC) VALUES ('" & cat & "','" & val & "'," & PC & ")"
	
	set rs=conn.execute(sql)

end if




cat = replace(cat, " ", "+")

r = "hw-update.asp?category=" & cat & "&facility=" & fac

response.redirect r
%>