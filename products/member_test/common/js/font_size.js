$(function(){
	$("#styleFontsize").attr({href:$.cookie('font-medium')});//初期値をCookieに入れる
});
function switchFontsize(cssname){
	var cssurl= 'https://kdn-products.com/member_test/common/css/'+cssname+'.css';//差し替え部分の値を変数化
	$('#styleFontsize').attr({href:cssurl});//値を差し替え
	$.cookie('font-medium',cssurl,{expires:30,path:'/member_test/'});//差し替えた値をcookieに保存。保存期限等は第三引数で設定。
}