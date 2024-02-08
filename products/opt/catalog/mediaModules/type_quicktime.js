var url = opener.mediaWindow.url;
var width = opener.mediaWindow.width;
var height = opener.mediaWindow.height;
if(is_ie){
	document.write("<object classid='clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B' ");
	document.write("codebase='http://www.apple.com/qtactivex/qtplugin.cab' width='" + width + "' height='" + height + "'>");
	document.write("<param name='src' value='" + url + "'>");
	document.write("<param name='scale' value='TOFIT' />");
	document.write("<param name='controller' value='true' />");
	document.write("<param name='autoplay' value='true'>");
	document.write("</object>");
}else{
	document.write ("<embed type='video/quicktime'");
	document.write ("    pluginspage='http://www.apple.com/quicktime/download/'");
	document.write ("    src='" + url + "'");
	document.write ("    scale='TOFIT'");
	document.write ("    autoplay='true'");
	document.write ("    controller='true'");
	document.write ("    width='100%'");
	document.write ("    height='100%'");
	document.write (">");

	document.write ("</embed>");
}

