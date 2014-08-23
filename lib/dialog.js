var iDialogOffestX = 0;
var iDialogOffestY = 0;
var bDialogDragActive = false;

function Dialog(sRoot, sTitle, iWidth) {
	this.root   = sRoot;
	this.title  = sTitle;
	this.width  = iWidth;
	this.images = new Array();
	this.imageNames = [
		"img/dialogs/" + sRoot + "-tl.png",
		"img/dialogs/" + sRoot + "-t.png",
		"img/dialogs/" + sRoot + "-tr.png",
		"img/dialogs/" + sRoot + "-l.png",
		false,
		"img/dialogs/" + sRoot + "-r.png",
		"img/dialogs/" + sRoot + "-bl.png",
		"img/dialogs/" + sRoot + "-b.png",
		"img/dialogs/" + sRoot + "-br.png"
	];
	for (var a=0;a<this.imageNames.length;a++) {
		if (this.imageNames[a]) {
			this.images[a] = new Image();
			this.images[a].src = this.imageNames[a];
		}
	}
	
}

Dialog.prototype.draw = function(sContent, sButtons) {
	
	var iLeftWidth    = this.images[0].width;
	var iRightWidth   = this.images[2].width;
	var iTopHeight    = this.images[0].height;
	var iBottomHeight = this.images[6].height;
	
	iLeftWidth    = 32;
	iRightWidth   = 32;
	iTopHeight    = 56;
	iBottomHeight = 36;
	
	
	var iCenterWidth  = this.width - (iLeftWidth + iRightWidth);
	
	var oBuffer = [
		"<table cellspacing='0' cellpadding='0' border='0' width='" + this.width + "px'>",
			"<tr height='" + iTopHeight + "px'>",
				"<td width='" + iLeftWidth + "px' style='background-image: url(" +  this.imageNames[0] + ");'>",
					"<img src='lib/spacer.gif' width='0' height='0' />",
				"</td>",
				"<td",
					" style='cursor:move;width:" + iCenterWidth + "px;background-image: url(" +  this.imageNames[1] + ");'",
					" onmousedown='startDialogDrag(event)'",
				">",
					this.genTitle(),
				"</td>",
				"<td width='" + iRightWidth + "px' style='background-image: url(" +  this.imageNames[2] + ");'><img src='lib/spacer.gif' width='0' height='0' /></td>",
			"</tr><tr>",
				"<td class='dialog-left' style='background-image: url(" +  this.imageNames[3] + ");'></td>",
				"<td style='background-color: white;'>" + sContent + "</td>",
				"<td class='dialog-right' style='background-image: url(" +  this.imageNames[5] + ");'></td>",
			"</tr><tr height='" + iBottomHeight + "px'>",
				"<td><img src='" +  this.imageNames[6] + "' /></td>",
				"<td style='background-image: url(" +  this.imageNames[7] + ");'>",
					"<img src='lib/spacer.gif' width='0' height='0' />",
				"</td>",
				"<td><img src='" +  this.imageNames[8] + "' /></td>",
			"</tr>",
		"</table>"
	];
	//return oBuffer.join("~").replace(/\</g, "&lt;");
	return oBuffer.join("");
}

Dialog.prototype.genTitle = function() {
	var oBuffer = [
		"<table cellspacing='0' cellpadding='0' border='0' width='100%'>",
			"<tr>",
				"<td style='padding-top:11px;'><b>" + this.title + "</b></td>",
				"<td style='padding-top:13px;' align='right'>",
					"<img src='img/dialogs/close-0.png'",
						" style='cursor: pointer;'",
						" onmouseover=\"setImage(this, 'img/dialogs/close-1.png')\"",
						" onmouseout=\"setImage(this, 'img/dialogs/close-0.png')\"",
						" onmouseup='clearDialog()'",
					">",
				"</td>",
			"</tr>",
		"</table>"
	]
	return oBuffer.join("");
}

// ================================================
// Supporting Functions
// ================================================
function startDialogDrag(e) {
	if (!e) {
		e = window.event;
	}
	var o = $(oDialogSec).offset();
	iDialogOffestX = e.pageX - o.left;
	iDialogOffestY = e.pageY - o.top;
	bDialogDragActive = true;
}


