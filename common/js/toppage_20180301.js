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

jQuery(document).ready(function($) {
	mv();
	pickup();
});

