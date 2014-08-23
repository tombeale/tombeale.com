	function getAbsoluteX(obj)
		{
		var x = 0
		for (var a=0;a<10;a++)
			{
			x = x + obj.offsetLeft
			if (String(obj.offsetParent) != "null")
				{
				obj = obj.offsetParent;
				}
			else
				{
				break;
				}
			}
		return x;
		}

	function getAbsoluteY(obj)
		{
		var x = 0
		for (var a=0;a<10;a++)
			{
			x = x + obj.offsetTop
			if (String(obj.offsetParent) != "null")
				{
				obj = obj.offsetParent;
				}
			else
				{
				break;
				}
			}
		return x;
		}

	function getAbsoluteScrollTop(obj)
		{
		var x = 0
		for (var a=0;a<10;a++)
			{
			x = x + obj.scrollTop
			if (String(obj.offsetParent) != "null")
				{
				obj = obj.offsetParent;
				}
			else
				{
				break;
				}
			}
		return x;
		}
