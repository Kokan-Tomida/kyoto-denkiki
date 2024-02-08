$(function(){
	//IE8以下に対して角丸やシャドウを適用したいクラスを記述
	$('.detail_text01,.list_txt01,.container,.btn_m,.app_download_box').each(function()
      {
        PIE.attach(this);
        $(this).css("position","relative");
    });
});