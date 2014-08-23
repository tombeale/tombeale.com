	var watchList = new Array();
	var oDebugBuffer = new Array;

	function ePrint() {
		if (!bTesting) return;
		var msg = new Array(arguments[0]);
		for (var a=1;a<arguments.length;a++) {
			msg.push(arguments[a]);
		}
		oDebugBuffer.push(msg)
		}

	function debugwin(page) {
		window.open("config/debugger.php", "debug", "width=400,height=600,resizable,scrollbars");
	}


	function addWatchTable(cap, type, option) {
		if (!option) option = false;
		watchList.push([cap, type, option]);
	}	