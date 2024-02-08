/*var cast={findAllLink:function(){for(var c=document.getElementsByTagName("a"),a=0;a<c.length;a++){var b=c[a];!b.href||-1==b.href.indexOf("#")||b.pathname!=location.pathname&&"/"+b.pathname!=location.pathname||b.search!=location.search||cast.addEvent(b,"click",cast.innerScroll)}},addEvent:function(c,a,b,d){if(c.addEventListener)return c.addEventListener(a,b,d),!0;if(c.attachEvent)return c.attachEvent("on"+a,b)},getNowLocate:function(){return document.body&&document.body.scrollTop?document.body.scrollTop:
document.documentElement&&document.documentElement.scrollTop?document.documentElement.scrollTop:window.pageYOffset?window.pageYOffset:0},actWindow:function(c,a,b,d){chkPoint=cast.getNowLocate();chkFlag=chkPoint<a;slowPoint=a>b?200>a?200:.7*a:200>b?200:.7*b;Math.abs(a-chkPoint)<slowPoint&&(c=(a-chkPoint)/cast.SPEED,1>Math.abs(c)&&(0>c?c=-1:0<c&&(c=1)));window.scrollTo(0,chkPoint+c);nowPoint=cast.getNowLocate();chkFlagNow=nowPoint<a;if(chkFlag!=chkFlagNow||chkPoint==nowPoint)return window.scrollTo(0,
a),clearInterval(cast.INTERVAL),!1},innerScroll:function(c){if(window.event)target=window.event.srcElement;else if(c)target=c.target;else return;"a"!=target.nodeName.toLowerCase()&&(target=target.parentNode);if("a"==target.nodeName.toLowerCase()){anchorPoint=target.hash.substr(1);for(var a=document.getElementsByTagName("a"),b=null,d=0;d<a.length;d++){var e=a[d];if(e.name&&e.name==anchorPoint){b=e;break}}b||(b=document.getElementById(anchorPoint));if(!b)return!0;a=b.offsetTop;if(-1!=navigator.userAgent.indexOf("MSIE"))for(e=
b.childNodes.length,d=0;d<e;d++)3==b.childNodes[d].nodeType&&(a-=5);else b.text&&(a-=5);document.all&&!window.opera?(d=document.documentElement.offsetHeight,e=document.body.scrollHeight):(d=window.innerHeight,e=document.height);for(d>e-a&&(a-=a-(e-d));b.offsetParent&&b.offsetParent!=document.body;)b=b.offsetParent,a+=b.offsetTop;clearInterval(cast.INTERVAL);turnPoint=cast.getNowLocate();movesize=parseInt((a-turnPoint)/cast.SPEED);Math.abs(movesize)<cast.SPEED?0>movesize?movesize=parseInt(0-cast.SPEED):
1<movesize&&(movesize=parseInt(cast.SPEED)):Math.abs(movesize)>cast.LIMIT_SPEED&&(0>movesize?movesize=parseInt(0-cast.LIMIT_SPEED):1<movesize&&(movesize=parseInt(cast.LIMIT_SPEED)));cast.INTERVAL=setInterval("cast.actWindow("+movesize+","+a+","+turnPoint+',"'+anchorPoint+'")',15);window.event&&(window.event.cancelBubble=!0,window.event.returnValue=!1);c&&c.preventDefault&&c.stopPropagation&&(c.preventDefault(),c.stopPropagation())}},SPEED:6,LIMIT_SPEED:1E3};cast.addEvent(window,"load",cast.findAllLink);
*/


// For other page Link =========================================================================

$(window).load(function(){
  if(location.hash){
    scrollAdj(location.hash);
  }
});

function scrollAdj(elm){
      var adj = 0;
      //if($(window).width() > 640){adj = 70;}
      //$("html,body").stop().animate({scrollTop:$(elm).offset().top - adj},50);
			$("html,body").stop().animate({scrollTop:$(elm).offset().top - adj},100);

}





// For smooth Link =========================================================================


$(document).ready(function() {
	
$('a[href*=#]:not(a[href*=#menu],a[class="pageFlyA"])').click(function() { 
if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) { 
var $target = $(this.hash); 
$target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']'); 
if ($target.length) { 

var topBlank = 0;
//if($(window).width() > 640){var topBlank = 70;}
var targetOffset = $target.offset().top - topBlank; 
$('html,body').animate({ 
scrollTop: targetOffset 
}, 
100); 
return false; 
} 
} 
});
  
});