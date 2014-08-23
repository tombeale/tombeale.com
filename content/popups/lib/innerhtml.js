
var QBuffer = "";

function iPrint(id,s)
	{
	var obj = document.getElementById(id);
	obj.innerHTML = s;
	}

function Q(s)
	{
	QBuffer += s;
	}

function QPrint(id)
	{
	if (arguments.length < 1) return;
	iPrint(id,QBuffer)
	QBuffer = "";
	}
	