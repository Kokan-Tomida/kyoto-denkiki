/**
 * common.js
 *
 *  version --- 3.7
 *  updated --- 2012/10/12
 */

/* !stack ------------------------------------------------------------------- */
jQuery(document).ready(function($) {
	pageScroll();
	rollover();
	localNav();
	addCss();
	tabSwicther();
	sideNavAcc();
	subFixer.init();
	megamenu.init();
	pagetop.init();
});

/* !isUA -------------------------------------------------------------------- */
var isUA = (function(){
	var ua = navigator.userAgent.toLowerCase();
	indexOfKey = function(key){ return (ua.indexOf(key) != -1)? true: false;}
	var o = {};
	o.ie      = function(){ return indexOfKey("msie"); }
	o.fx      = function(){ return indexOfKey("firefox"); }
	o.chrome  = function(){ return indexOfKey("chrome"); }
	o.opera   = function(){ return indexOfKey("opera"); }
	o.android = function(){ return indexOfKey("android"); }
	o.ipad    = function(){ return indexOfKey("ipad"); }
	o.ipod    = function(){ return indexOfKey("ipod"); }
	o.iphone  = function(){ return indexOfKey("iphone"); }
	return o;
})();

/* !rollover ---------------------------------------------------------------- */
var rollover = function(){
	var suffix = { normal : '_no.', over   : '_on.'}
	$('a.over, img.over, input.over').each(function(){
		var a = null;
		var img = null;

		var elem = $(this).get(0);
		if( elem.nodeName.toLowerCase() == 'a' ){
			a = $(this);
			img = $('img',this);
		}else if( elem.nodeName.toLowerCase() == 'img' || elem.nodeName.toLowerCase() == 'input' ){
			img = $(this);
		}

		var src_no = img.attr('src');
		var src_on = src_no.replace(suffix.normal, suffix.over);

		if( elem.nodeName.toLowerCase() == 'a' ){
			a.bind("mouseover focus",function(){ img.attr('src',src_on); })
			 .bind("mouseout blur",  function(){ img.attr('src',src_no); });
		}else if( elem.nodeName.toLowerCase() == 'img' ){
			img.bind("mouseover",function(){ img.attr('src',src_on); })
			   .bind("mouseout", function(){ img.attr('src',src_no); });
		}else if( elem.nodeName.toLowerCase() == 'input' ){
			img.bind("mouseover focus",function(){ img.attr('src',src_on); })
			   .bind("mouseout blur",  function(){ img.attr('src',src_no); });
		}

		var cacheimg = document.createElement('img');
		cacheimg.src = src_on;
	});
};
/* !pageScroll -------------------------------------------------------------- */
var pageScroll = function(){
	jQuery.easing.easeInOutCubic = function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	}; 
	$('a.scroll, .scroll a, .pageTop a').each(function(){
		$(this).bind("click keypress",function(e){
			e.preventDefault();
			var target  = $(this).attr('href');
			var targetY = $(target).offset().top;
			var parent  = ( isUA.opera() )? (document.compatMode == 'BackCompat') ? 'body': 'html' : 'html,body';
			$(parent).animate(
				{scrollTop: targetY },
				400,
				'easeInOutCubic'
			);
			return false;
		});
	});
}
/* !localNav ---------------------------------------------------------------- */
var localNav = function(){
	var navClass = document.body.className.toLowerCase(),
		parent = $("#lNavi"),
		prefix = 'lNav',
		current = 'current',
		regex = {
			a  : /l/,
			dp : [
				/l[\d]+_[\d]+_[\d]+_[\d]+/,
				/l[\d]+_[\d]+_[\d]+/,
				/l[\d]+_[\d]+/,
				/l[\d]+/
			]
		},
		route = [],
		i,
		l,
		temp,
		node;

	$("ul ul", parent).hide();

	if( navClass.indexOf("ldef") >= -1 ){
		for(i = 0, l = regex.dp.length; i < l; i++){
			temp = regex.dp[i].exec( navClass );
			if( temp ){
				route[i] = temp[0].replace(regex.a, prefix);
			}
		}
		///console.log(route);
		if( route[0] ){
			// depth 4
			node = $("a."+route[0], parent);
			node.addClass(current);
			node.next().show();
			node.parent().parent().show()
				.parent().parent().show()
				.parent().parent().show();
			node.parent().parent().prev().addClass('parent');
			node.parent().parent()
				.parent().parent().prev().addClass('parent');
			node.parent().parent()
				.parent().parent()
				.parent().parent().prev().addClass('parent');

		}else if( route[1] ){
			// depth 3
			node = $("a."+route[1], parent);
			node.addClass(current);
			node.next().show();
			node.parent().parent().show()
				.parent().parent().show();
			node.parent().parent().prev().addClass('parent');
			node.parent().parent()
				.parent().parent().prev().addClass('parent');


		}else if( route[2] ){
			// depth 2
			node = $("a."+route[2], parent);
			node.addClass(current);
			node.next().show();
			node.parent().parent().show();
			node.parent().parent().prev().addClass('parent');

		}else if( route[3] ){
			// depth 1
			node = $("a."+route[3], parent);
			node.addClass(current);
			node.next().show();

		}else{
		}
	}
}
/* !Addition Fitst & Last --------------------------------------------------- */
var addCss = (function(){
	$('li:first-child:not(:last-child)').addClass('first');
	$('li:last-child').addClass('last');
});



/* ●▲ >> --------------------------------------------------- */



/* tabs --------------------------------------------------- */
var tabSwicther = function (){

	var $tabTitle = $(".productTabTitle");
	var $tabContents = $(".productTabContents");
	var hasLineUp = false;

	if(!$tabTitle[0])
	{
		$tabTitle = $(".optTabTitle");
		$tabContents = $(".optTabContents");
	}

	if(!$tabTitle[0])
	{
		$tabTitle = $(".technicalTabTitle");
		$tabContents = $(".technicalTabContents");
	}

	if(!$tabTitle[0])
	{
		$tabTitle = $(".technicalTabTitle02");
		$tabContents = $(".technicalTabContents");
	}

	if(!$tabTitle[0])
	{
		$tabTitle = $(".downloadTabTitle");
		$tabContents = $(".downloadTabContents");
		hasLineUp = true;
	}

	// キャンセリング
	if(!$tabTitle[0]) return;
	
	// for first view
	$tabContents.children("div").css("display","none")
	$($tabTitle.find("li a.active").attr("href")).css("display","block");

	$tabTitle.find("li a").click(function (){
		// hidden
		$tabTitle.find("li a.active").removeClass("active");
		$tabContents.children("div").css("display","none")
		// shown
		$(this).addClass("active");
		$($(this).attr("href")).css("display","block");
		subFixer.update();
		if(hasLineUp) $('.lineUpH01').lineUp();
		return false;
	});
};

/* right cat nav acc --------------------------------------------------- */
var sideNavAcc = function (){
	var $sub = $("#sub");


	if($sub.children("nav").size() == 0) return;


	var $wrap = $sub.children("nav");


	// get current page
	var current = $("body").attr("class");

	if(!current) return;

	current = "lNav" + current.split("l")[1];
	var index = $wrap.children("div").index($wrap.find("a."+current).parent("li").parent("ul").parent("div"));
	
	// acc trigger & first view 
	for(var i=0;i<$wrap.children("div").size(); i++)
	{
		sideNavAcc.setupBox( $wrap.children("div").eq(i), (i == index)? true: false );
	}
};

sideNavAcc.setupBox = function ($box, flg){
	var $trg = $box.children("p").find("a");
	var $acc = $box.children("ul");
	$trg.click(function (){
		$acc.stop().slideToggle("fast", subFixer.update);
		$acc.parent().toggleClass("active");
	});
	if(!flg)
	{
		$acc.slideToggle(0);
	}
	else
	{
		$acc.parent().toggleClass("active");
	}
};
/* followNav side  --------------------------------------------------- */
// http://leafo.net/sticky-kit/
var subFixer = {};
subFixer.init = function (){
	if(!$('#subFixer')[0]) return;
	$('#subFixer').stick_in_parent( {
		parent:'#contents'
		,offset_top:10
		,inner_scrolling:false
		,bottoming:true
	} );
	subFixer.update();
	for(var i=0; i<$("body").find("img").size(); i++)
	{
		var img = new Image();
		$(img).load(subFixer.update);
		$(img).load(function (){ subFixer.update(); });
		

		img.src = $("body").find("img").eq(i).attr("src");
	}
};
subFixer.update = function (){
	$(document.body).trigger('sticky_kit:recalc');
};



/* megamenu  --------------------------------------------------- */
var megamenu = {};
megamenu.init = function (){
	megamenu.isshow = false;
	megamenu.$ele = $("#megaMenu");
	megamenu.$ele.mouseover(megamenu.over);
	$("#gNavi_in li").mouseenter(megamenu.show);
	$("#gNavi").mouseleave(megamenu.hide);
	$(".child a").mouseenter(megamenu.cellShow);
	$(".last_cell").mouseleave(megamenu.cellHide);
};


megamenu.over = function (e){
	var tgt = $(e.target).attr("class");
	if(tgt == "parent" || tgt == "child" || e.target.tagName == "DT") megamenu.cellHide();
};
megamenu.show = function (e){
	var t = (megamenu.isshow)? 0: 200;
	megamenu.isshow = true;
	var $on = $(this);
	megamenu.interval = setTimeout(function (){
		$(".drop_menu").css("display","none");
		$(".last_cell").css("display","none");
		megamenu.$drop = $("#" + $on.attr("id") + "_Drop");
		if(!megamenu.$drop[0]) { megamenu.hide(); return; }

		//
		megamenu.$drop.css("display","block");
		var tgtH = megamenu.$drop.height();
		megamenu.$ele.stop().animate({"height":tgtH}, 240, "easeOutCirc");
	}, t);	
};

megamenu.hide = function (e){
	
	megamenu.isshow = false;
	clearInterval(megamenu.interval);
	
	$(".drop_menu").removeAttr("style");
	$(".last_cell").removeAttr("style");
	$(".child a").removeClass("on");
	megamenu.$ele.stop().animate({"height":0}, 120, "easeOutCirc");
};

megamenu.cellShow = function (e){
	$(".child a").removeClass("on");
	$(".last_cell").css("display","none");
	var cellname = $(this).attr("rel");
	if($( "." + cellname )[0])
	{
		$( "." + cellname ).css("display","table-cell");
		$(this).addClass("on");
		var tgtH = megamenu.$drop.height();
		megamenu.$ele.stop().animate({"height":tgtH}, 150, "easeOutCirc");
	}
};

megamenu.cellHide = function (e){
	$(".last_cell").removeAttr("style");
	$(".child a").removeClass("on");
};

jQuery.extend( jQuery.easing,{
	def: 'easeOutQuad',
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	}
});



/* pagetop  --------------------------------------------------- */
var pagetop = {};
pagetop.init = function (){
	$("body").append('<a id="pagetotop"><img src="/common/images/pagetop_btn.png" alt="ページの先頭へもどる" /></a>');
	pagetop.$ele = $("#pagetotop");
	pagetop.$ele.click(pagetop.to);
	pagetop.$ele.hide();
	pagetop.$win = $(window);
	pagetop.$win.scroll(function(){
		if (pagetop.$win.scrollTop() > 100)	pagetop.$ele.fadeIn();
		else								pagetop.$ele.fadeOut();
	});
};
pagetop.to = function (){
	$('html,body').animate({scrollTop:0}, 300);
	return false;
};





/* ggp  --------------------------------------------------- */
document.open();
document.write('<script src="https://apis.google.com/js/platform.js" async defer>');
document.write("{lang: 'ja'}");
document.write('</script>');
document.close();


/* ga  --------------------------------------------------- */
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58618341-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');
  
