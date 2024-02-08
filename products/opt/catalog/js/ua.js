//通知ボックスを定義
    function generate(layout,alerttype,alerttext) {
      var n = noty({
        text: alerttext,
        type: alerttype,
        dismissQueue: true,
        layout: layout,
        theme: 'defaultTheme'
      });
    }

//通知ボックスのテキスト
    function generateNotify() {
      generate('top','warning','お使いのブラウザのFlashplayerが最新ではありません<br /><a target="_blank" href="http://get.adobe.com/jp/flashplayer/">アップデートしてください</a>');
    }

//Flashplayer version判定
    function getFlashPlayerVersion() {

    var flashplayer_ver = 0;
    //IE以外の場合
    if(navigator.plugins && navigator.mimeTypes['application/x-shockwave-flash']){
        var plugin = navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin;
        //Flash Playerがインストールされている場合
        if(plugin){flashplayer_ver = parseInt(plugin.description.match(/\d+\.\d+/));}
    }
    //IEの場合、もしくはFlash Playerがインストールされていない場合
    else{
    //IEでFlash Playerがインストールされている場合
        try{
            var flashOCX = new ActiveXObject("ShockwaveFlash.ShockwaveFlash").GetVariable("$version").match(/([0-9]+)/);
            if(flashOCX){flashplayer_ver = parseInt(flashOCX[0]);}
        }catch(e){}
    }
    //Flash Playerがインストールされていない、もしくはバージョンが6以下の場合
    if(flashplayer_ver <= 6){
        flashplayer_ver = 0; //6以下の場合ブラウザクラッシュ防止の為
    }
    if(flashplayer_ver <= 10){
        generateNotify(); //通知ボックスを実行
    }
}

//ユーザーエージェントごとにクラス分けやFlashplayer version判定を実行

var strUA = "";
  strUA = navigator.userAgent;

  if(strUA.indexOf("Android") != -1){
    document.getElementsByTagName("body")[0].setAttribute("class","android");

  }else if(strUA.indexOf("iPad") != -1){
    document.getElementsByTagName("body")[0].setAttribute("class","ios");
    
  }else if(strUA.indexOf("iPhone") != -1){

    document.getElementsByTagName("body")[0].setAttribute("class","ios");

  }else if(strUA.indexOf("iPod") != -1){
    
    document.getElementsByTagName("body")[0].setAttribute("class","ios");

  }else{
    document.getElementsByTagName("body")[0].setAttribute("class","pc");
    getFlashPlayerVersion();//Flashplayer version判定

  }

