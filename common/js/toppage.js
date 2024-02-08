// http://goo.gl/7iiapD
var mv = function (){
	mv.$slider = $( '#topMainimg' ).sliderPro({
		width: 960,
		height: 300,
		responsive: false,
		// aspectRatio: 1.5,
		slideDistance:0,
		visibleSize: '100%',
		forceSize: 'fullWidth',
		touchSwipe: false,
		keyboard: false,
		autoHeight: false,
		thumbnailTouchSwipe:false,
		slideAnimationDuration: 400,
		autoplayDelay: 5000,
		arrows:true
	});
	
};


var videoLoaded=[false,false];


var movie = function(){

	var videoElm=$('.topMainMovie video');
	videoElm.fadeOut(0);
	var video=videoElm[0];
	video.autoplay=false;

	$(".topMainMovie").append('<div class="video_loader"></div>');
	$(".video_loader").css({
		'background-image':'url(/images/icon_loader.gif)',
		'width':'100%',
		'height':'100%',
		'background-repeat':'no-repeat',
		'background-position':'center',
		'opacity':0.5
	});


	
	video.onloadeddata=function(){
		videoLoaded[0]=true;
		playVideo();
	}
}

var movieOverlayImg=function(){
	var img = new Image();
	img.onload = function(){

		videoLoaded[1]=true;
		playVideo();

	}
	img.src="/images/movie_overlay.png";
}



var playVideo=function(){
	var videoElm=$('.topMainMovie video');
	var video=videoElm[0];
	if(chkVideoLoaded()){
		$(".video_loader").fadeOut(250)
		videoElm.fadeIn(500);
		video.play();
	}
}

var chkVideoLoaded=function(){

	for(var i=0;i<videoLoaded.length;i++){
		if(!videoLoaded[i]){
			return false;
		}
	}
	return true;
}


var pickup = function (){
	var $ele = $("#topSlider02");
	
	var maximum1 = 0;
	var maximum2 = 0;
	
	for(var i=0; i<$ele.find("li").size(); i++)
	{
		var h1 = parseInt($ele.find("li").eq(i).find(".topSlider02Txt01").height());
		maximum1 = ( maximum1 < h1)? h1:maximum1; 
		
		var h2 = parseInt($ele.find("li").eq(i).find(".topSlider02Txt03").height());
		maximum2 = ( maximum2 < h2)? h2:maximum2; 
	}
	$ele.find(".topSlider02Txt01").height(maximum1);
	$ele.find(".topSlider02Txt03").height(maximum2);


	var $slider = $('#topSlider02 ul').bxSlider({
		minSlides: 4,
		maxSlides: 4,
		moveSlides: 4,
		slideWidth: 225,
		slideMargin: 20,
		responsive: false,
		useCSS: false,
		pager: true,
		controls: false
	});
	

	$prev = $ele.find(".prev a").click( function (){ $slider.goToPrevSlide(); return false;} );
	$next = $ele.find(".next a").click( function (){ $slider.goToNextSlide(); return false;} );

};

var newProduct = function(){
	var $ele = $("#topProductsWrap");
	var $slider = $('#topProductsWrap ul').bxSlider({
		minSlides: 4,
		maxSlides: 4,
		moveSlides: 1,
		slideWidth: 245,
		slideMargin: 0,
		responsive: false,
		useCSS: true,
		pager: false,
		controls: false,
		hideControlOnEnd:true,
		infiniteLoop:false
	});
	$prev = $ele.find(".prev a").click( function (){ $slider.goToPrevSlide(); return false;} );
	$next = $ele.find(".next a").click( function (){ $slider.goToNextSlide(); return false;} );

	if($ele.find('li').size()<=4){

		$ele.find(".prev a").hide();
		$ele.find(".next a").hide();

	}
}

var movieResize=function(){
	var container = $('.topMainMovie');
	var movie = $('.topMainMovie video');
	movie.css({'margin-top':-(movie.height()/2)})

}

jQuery(document).ready(function($) {
	mv();
	//pickup();
	newProduct();
	//movieResize();
	movieOverlayImg();
	movie();

	$(window).resize(function(){
		//movieResize();

	})
});



