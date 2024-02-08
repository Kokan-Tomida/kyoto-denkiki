//ページ指定クエリ付きのアクセスが有った時にアプリを開くボタンにクエリを適用を定義
var prmStr = window.location.search;
var pagecode = -1;
var sid = -1;
var encrypted = 0;

if(prmStr != ""){
    prmStr = prmStr.substring(1);
    var prmArr  = prmStr.split("&");
    for(var i=0; i < prmArr.length; i++){
        var prmKey = prmArr[i].split("=")[0];
        switch(prmKey){
            case "pagecode":
                pagecode = prmArr[i].split("=")[1];
                break;
            case "sid":
                sid = prmArr[i].split("=")[1];
                break;              
        }
    }
    var hrefStr = "";
    if(pagecode != -1){
        hrefStr += "&pageno="+pagecode;
    }
    if(sid != -1){
        hrefStr += "&sid="+sid;
    }

    var objAppLink = document.getElementById("applink");
    var objAppLink02 = document.getElementById("applink02");
    if(objAppLink != null && objAppLink.href.indexOf('actibook:///') != -1){
        objAppLink.href += hrefStr;

    }
    if(objAppLink02 != null && objAppLink02.href.indexOf('actibook:///') != -1){
        objAppLink02.href += hrefStr;

    }
}  


function preOpenMain(){
	if(pagecode != -1 && sid != -1){
		WindowOpenMain(1000,670,'_blank',{'resizable':'yes','pagecode':pagecode,'sid':sid});
	}else if(pagecode == -1 && sid != -1){
		WindowOpenMain(1000,670,'_blank',{'resizable':'yes','sid':sid});
	}else if(pagecode != -1 && sid == -1){
		WindowOpenMain(1000,670,'_blank',{'resizable':'yes','pagecode':pagecode});
	}else{
		WindowOpenMain(1000,670,'_blank',{'resizable':'yes'});
	}	
}
