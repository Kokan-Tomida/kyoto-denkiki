function html5_load(){
 var hrefValue = "";	
	if(navigator.userAgent.indexOf("iPhone") != -1 || navigator.userAgent.indexOf("iPod") != -1||navigator.userAgent.indexOf("iPad") != -1){
		if(navigator.userAgent.indexOf("iPad") != -1){
			hrefValue = document.getElementById("ipad_applink"); 
		}else{
			hrefValue = document.getElementById("applink02"); 
		}		
		window.open("../HTML5/Main.html?id="+hrefValue );
	}else if(navigator.userAgent.indexOf("Android") != -1){ 
		hrefValue = document.getElementById("applink02");
		window.open("../HTML5/android/Main.html?id="+hrefValue );
	}else{
		window.open("../HTML5/PC/Main.html");
	}   
}