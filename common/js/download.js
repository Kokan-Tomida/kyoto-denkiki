// ダウンロード実行
function set_param(id,contents_name,path){
	document.frm.pid.value = id;
	document.frm.pname.value = contents_name;
	document.frm.ppath.value = path;
	document.frm.submit();
}
var DownloadlPage = {};
DownloadlPage.init = function (){$(".itemcell > a").click(DownloadlPage.toggle);};
DownloadlPage.toggle = function (){var $tgt = $(this).next();var th = (parseInt($tgt.height()))? 0: $tgt.find(".downloadTable01").height();if(th){$(this).addClass("on");}else{$(this).removeAttr("class");}$tgt.stop().animate({"height":th}, 200);return false;};
$(document).ready(DownloadlPage.init);