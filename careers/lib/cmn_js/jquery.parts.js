



// global navi hi-lite =========================================================================


$(window).load(function () {
	path = location.pathname
	
	if(path.match("/mid/")){
		
	  $("body").addClass("career-body");
	  
	     $(".header-entry:not(.topVer) a").attr("href" , "/careers/mid/#career-entry").attr("target","_self");
	     $(".menu-zone-entry a").attr("href" , "tel:0774-25-7710").attr("target","_self");
         
		 
		 if($(window).width() > 760){   
	        $(".footer-btn.btn01 a").attr("href" , "/careers/mid/#career-entry").attr("target","_self");
		 }
		 	  
	     if($(window).width() < 760){
	        $(".footer-btn.btn01 a").attr("href" , "tel:0774-25-7710").attr("target","_self");
		 }
　　


     }
	
	
	
	if(path.match("/newgraduates/")){
	  $("body").addClass("newgraduates-body");
	  $(".menu-zone .top-li").prependTo(".menu-zone .career-li");
	     
	}

})


// lMenu navi hi-lite =========================================================================

$(function(){
	var url = window.location.pathname;
	$('.categoryMenu li a[href="'+url+'"]').addClass('current');
});




// LinkArea as DivArea =========================================================================

$(function(){
   $("div.sample").click(function(){
       window.open($(this).find("a").attr("href"), '_self');
        return false;
   });

});




// autoHeightPlus =========================================================================


$(document).ready(function () {
	   getHeightPlus();
     $(window).resize(function(){
	    getHeightPlus();
     });
		
 function getHeightPlus(){
	var w = $(window).width();

		
	if(w > 760){	

       $(".about-ul li a p").autoHeight({column:6, clear:1, height:'height',reset:'reset'});

		

	}
	
	if(w < 760){	
	
       /*$(".about-ul li a p").removeAttr("css");*/

       $(".about-ul li a p").autoHeight({column:2, clear:1, height:'height',reset:'reset'});
  
	}
	
	}
	

});



// headerを固定する=========================================================================


/*$(window).on('load resize scroll', function () {
	
	
	  if($(".fixZoneWrapper").length > 0){
			
	  var fixZoneWrapperElem = $(".fixZoneWrapper"),
		     h_fixZoneWrapper = fixZoneWrapperElem.find(".fixZone").outerHeight();
		
		
	   fixZoneWrapperElem.css("height", h_fixZoneWrapper + "px");	
    
	    var scTop = $(document).scrollTop(),
	    	  fixTop = fixZoneWrapperElem.offset().top;
	    if( scTop <= fixTop ){
		      fixZoneWrapperElem.removeClass("goFree");
		  }
	    if( scTop > fixTop ){		
			    fixZoneWrapperElem.addClass("goFree");
      }

  }
    
});
*/



$(window).on('load resize scroll', function () {
		//取得
			 var scrollTop = $(window).scrollTop(),
			      windowHeight = $(window).height(),
				   headerHeight = $("header").height(),
					three_windowHeight = $(window).height()*0.3,
					half_windowHeight = $(window).height()*0.5,
				   full_windowHeight = $(window).height()*0.7,
			       kijun =scrollTop+windowHeight - 100;
				 			 
				 // .head02=========================================================================
					 $('.head02').each(function(){  					 
					   if($(this).hasClass("showTime")){ 
					        false; 
					   }else{
							    if( scrollTop + $(window).height()*0.7 >= $(this).offset().top){ $(this).addClass("showTime"); }
							    else{ false; }
								 }
					 });
				 
				 // .showBox========================================================================
					 
					 $('.showBox').each(function(){  					 
					   if($(this).hasClass("showTime")){ 
					        false; 
					   }else{
							    if( scrollTop + $(window).height()*0.7 >= $(this).offset().top){ $(this).addClass("showTime"); }
							    else{ false; }
								 }
					 }); 
					 
				// .menu-wrapperの高さ========================================================================	
					
					$('.menu-wrapper').css("top" , headerHeight + "px").css("height" , (windowHeight-headerHeight) + "px");
					
					
					
					
					
				// .fixZoneWrapper=========================================================================		
					if($(".fixZoneWrapper").length > 0){
					
					  var fixZoneWrapperElem = $(".fixZoneWrapper"),
						  h_fixZoneWrapper = fixZoneWrapperElem.find(".fixZone").outerHeight();
						  
						  
						  fixZoneWrapperElem.css("height", h_fixZoneWrapper + "px");	
						  
						  var scTop = $(document).scrollTop(),
						  fixTop = fixZoneWrapperElem.offset().top;  
						  if( scTop <= fixTop ){
						  fixZoneWrapperElem.removeClass("goFree");
						  }
						  
						  if( scTop > fixTop ){		
						  if( fixZoneWrapperElem.hasClass("goFree") ){
						  false;
						  }else{
						  fixZoneWrapperElem.addClass("goFree"); 
						  }
					  
					  }
					
					}
				
			
　　　　　　　　// .fixZoneWrapper=========================================================================				
			
			if($(window).width() > 760){
			　　　if($(".header-menu").hasClass("open")){
					 $(".header-menu.open").trigger("click");
				　 }　
			}
					
					
		 });





       $(document).ready(function () {
    
	    // menu-btn=========================================================================

		  
		  
		  
		  $(".header-menu").click( function () { 
		     /*$(this).toggleClass("open");*/
		     $("body").toggleClass("open"); 
		  
		  });	
		  
          $(".menu-wrapper").click( function () { 
		    $("body").removeClass("open");
		   });
		  $(".menu-zone *").click( function () { 
			  $("body").removeClass("open");
		  });
	
	     // top-mv-wrapper=========================================================================
	
              if($(".top-wrapper").length > 0){
		          topHight();
				 
				 
				 $(window).on('resize', function () {
					 topHight();
					 });
				 	
				  function topHight(){
					
					var windowHeight = $(window).height(),
					     headerHeight = $("header").height();
					     footerHeight = $("footer").height();
						 
					
							$(".top-zone").css("height", windowHeight - headerHeight - footerHeight + "px");
					
					}
								 
				  setTimeout(" $('.top-wrapper').addClass('showTime');", 1500 );
					
				if($(window).width() < 760){
					$('.top-wrapper').addClass('showTime');
					}
									  
		}




      
	     // people-zone=========================================================================
	  
	  
 if($(".people-zone").length > 0){
	 
	 //$(".people-contents").hide();
	 
	  
	  
	      $(".people-box").click( function () { 
		     $(this).next(".people-contents").removeClass("disable");
		     $(this).next(".people-contents").stop().slideToggle(300);
		  });
		  
		  
		  $(".people-close").click( function () { 
		     $(this).parents(".people-contents").stop().slideUp(300).addClass("disable");
		  });
		  

     }



});





