function set_param(id,contents_name,path){
	document.frm.pid.value = id;
	document.frm.pname.value = contents_name;
	document.frm.ppath.value = path;
	document.frm.submit();
}