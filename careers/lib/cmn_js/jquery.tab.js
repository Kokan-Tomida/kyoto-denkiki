$(document).ready(function(){
	
	// 初期設定
		
		// #nav直下の全li要素の中から最初のli要素に.selectを追加
		$("#nav > li:first").addClass("current");
		// #nav直下の全li要素にマウスオーバーしたらリンク要素に偽装
		$("#nav > li").hover(function(){
			$(this).css("cursor","pointer");
		},function(){
			$(this).css("cursor","default");
		});
		
		// #tab直下の全div要素を非表示
		$("#tab > div").hide();
		// #tab直下の全div要素の中から最初のdiv要素を表示
		$("#tab > div:first").show();
	
	// タブ切替処理
	$("#nav > li").click(function () {
		// #nav直下の全li要素のclass属性を削除
		$("#nav > li").removeClass("current");
		// クリックしたli要素に.selectを追加
		$(this).addClass("current");
		// #tab直下の全div要素を非表示
		$("#tab > div").hide();
		// クリックしたタブのインデックス番号と同じdiv要素をフェード表示
		//$("#tab > div").eq($("#nav > li").index(this)).fadeIn();
		$("#tab > div").eq($(this).index()).fadeIn();
	});
	
	
});
