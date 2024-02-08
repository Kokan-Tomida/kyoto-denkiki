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
	SocialHide();
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

/*
 Device
 @version 0.0.1
 @copyright KOKAN quzan
*/
var Device={};
(function(){var a=navigator.userAgent;0<=a.indexOf("iPhone")&&(Device.model="IPHONE");0<=a.indexOf("iPod")&&(Device.model="IPOD");0<=a.indexOf("iPad")&&(Device.model="IPAD");0<=a.indexOf("Android")&&(0<=a.indexOf("Mobile")?Device.model="ANDROD":Device.model="ANDROD_TABLET");"IPAD"==Device.model||"ANDROD_TABLET"==Device.model?Device.type="TB":"IPHONE"==Device.model||"IPOD"==Device.model||"ANDROD"==Device.model?Device.type="SP":(Device.type="PC",Device.model=navigator.platform);a.match(/Win(dows )?NT 6\.3/)?Device.os=
"Windows 8.1":a.match(/Win(dows )?NT 6\.2/)?Device.os="Windows 8":a.match(/Win(dows )?NT 6\.1/)?Device.os="Windows 7":a.match(/Win(dows )?NT 6\.0/)?Device.os="Windows Vista":a.match(/Win(dows )?(NT 5\.1|XP)/)?Device.os="Windows XP":a.match(/Win(dows)? (9x 4\.90|ME)/)?Device.os="Windows ME":a.match(/Win(dows )?(NT 5\.0|2000)/)?Device.os="Windows 2000":a.match(/Win(dows )?98/)?Device.os="Windows 98":a.match(/Win(dows )?NT( 4\.0)?/)?Device.os="Windows NT":a.match(/Win(dows )?95/)?Device.os="Windows 95":
a.match(/Mac|PPC/)&&(Device.os="Mac OS");Device.browser="none";a=a.toUpperCase();-1!=a.indexOf("OPERA")?Device.browser="opera":-1!=a.indexOf("MSIE")?Device.browser="ie":-1!=a.indexOf("TRIDENT")?Device.browser="ie11":-1!=a.indexOf("CHROME")?Device.browser="chrome":-1!=a.indexOf("SAFARI")?Device.browser="safari":-1!=a.indexOf("FIREFOX")?Device.browser="firefox":-1!=a.indexOf("GECKO")&&(Device.browser="gecko");"ie"==Device.browser&&(a=navigator.appVersion.toLowerCase(),-1!=a.indexOf("msie 6.")?Device.browser=
"ie6":-1!=a.indexOf("msie 7.")?Device.browser="ie7":-1!=a.indexOf("msie 8.")?Device.browser="ie8":-1!=a.indexOf("msie 9.")?Device.browser="ie9":-1!=a.indexOf("msie 10.")&&(Device.browser="ie10"))})();

/* tabs --------------------------------------------------- */
var tabSwicther=function(){var a=$(".productTabTitle"),b=$(".productTabContents"),c=!1;a[0]||(a=$(".optTabTitle"),b=$(".optTabContents"));a[0]||(a=$(".downloadTabTitle"),b=$(".downloadTabContents"),c=!0);a[0]&&(b.children("div").css("display","none"),$(a.find("li a.active").attr("href")).css("display","block"),a.find("li a").click(function(){a.find("li a.active").removeClass("active");
b.children("div").css("display","none");$(this).addClass("active");$($(this).attr("href")).css("display","block");subFixer.update();c&&$(".lineUpH01").lineUp();return!1}))};


/* right cat nav acc --------------------------------------------------- */
var sideNavAcc=function(){var a=$("#sub");if(0!=a.children("nav").size()){var a=a.children("nav"),b=$("body").attr("class");if(b)for(var b="lNav"+b.split("l")[1],b=a.children("div").index(a.find("a."+b).parent("li").parent("ul").parent("div")),c=0;c<a.children("div").size();c++)sideNavAcc.setupBox(a.children("div").eq(c),c==b?!0:!1)}};
sideNavAcc.setupBox=function(a,b){var c=a.children("p").find("a"),d=a.children("ul");c.click(function(){d.stop().slideToggle("fast",subFixer.update);d.parent().toggleClass("active")});b?d.parent().toggleClass("active"):d.slideToggle(0)};


/* followNav side  --------------------------------------------------- */
// http://leafo.net/sticky-kit/
var subFixer={init:function(){if($("#subFixer")[0]&&"ie8"!=Device.browser){$("#subFixer").stick_in_parent({parent:"#contents",offset_top:10,inner_scrolling:!1,bottoming:!0});subFixer.update();for(var a=0;a<$("body").find("img").size();a++){var b=new Image;$(b).load(subFixer.update);$(b).load(function(){subFixer.update()});b.src=$("body").find("img").eq(a).attr("src")}}setTimeout(subFixer.update, 1000);},update:function(){$(document.body).trigger("sticky_kit:recalc")}};


/* megamenu  --------------------------------------------------- */
var MEGA_INTERVAL = 350;

var megamenu={init:function(){megamenu.isshow=!1;megamenu.$ele=$("#megaMenu");megamenu.$ele.mouseover(megamenu.over);$("#gNavi_in li").mouseenter(megamenu.show);$("#gNavi").mouseleave(megamenu.hide);$(".child a").mouseenter(megamenu.cellShow);$(".last_cell").mouseleave(megamenu.cellHide)},over:function(a){var b=$(a.target).attr("class");"parent"!=b&&"child"!=b&&"DT"!=a.target.tagName||megamenu.cellHide()},show:function(a){a=megamenu.isshow?0:MEGA_INTERVAL;megamenu.isshow=!0;var b=$(this);megamenu.interval=
setTimeout(function(){$(".drop_menu").css("display","none");$(".last_cell").css("display","none");megamenu.$drop=$("#"+b.attr("id")+"_Drop");if(megamenu.$drop[0]){megamenu.$drop.css("display","block");var a=megamenu.$drop.height();megamenu.$ele.stop().animate({height:a},240,"easeOutCirc")}else megamenu.hide()},a)},hide:function(a){megamenu.isshow=!1;clearInterval(megamenu.interval);$(".drop_menu").removeAttr("style");$(".last_cell").removeAttr("style");$(".child a").removeClass("on");megamenu.$ele.stop().animate({height:0},
120,"easeOutCirc")},cellShow:function(a){$(".child a").removeClass("on");$(".last_cell").css("display","none");a=$(this).attr("rel");$("."+a)[0]&&($("."+a).css("display","table-cell"),$(this).addClass("on"),a=megamenu.$drop.height(),megamenu.$ele.stop().animate({height:a},150,"easeOutCirc"))},cellHide:function(a){$(".last_cell").removeAttr("style");$(".child a").removeClass("on")}};

jQuery.extend(jQuery.easing,{def:"easeOutQuad",easeOutCirc:function(e,a,b,c,d){return c*Math.sqrt(1-(a=a/d-1)*a)+b}});

var SocialHide = function (){
	var bw = Device.browser;
	if(bw != "ie6" && bw != "ie7" && bw != "ie8") $("#headerIn .headerSNS").css("display", "block");
}

/* pagetop  --------------------------------------------------- */
var pagetop={init:function(){$("body").append('<a id="pagetotop"><img src="/common/images/pagetop_btn.png" alt="\u30da\u30fc\u30b8\u306e\u5148\u982d\u3078\u3082\u3069\u308b" /></a>');pagetop.$ele=$("#pagetotop");pagetop.$ele.click(pagetop.to);pagetop.$ele.hide();pagetop.$win=$(window);pagetop.$win.scroll(function(){100<pagetop.$win.scrollTop()?pagetop.$ele.fadeIn():pagetop.$ele.fadeOut()})},to:function(){$("html,body").animate({scrollTop:0},300);return!1}};

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










  