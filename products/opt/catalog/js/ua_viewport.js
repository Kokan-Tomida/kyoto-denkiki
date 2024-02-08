var strUA = "";
  strUA = navigator.userAgent;

  if(strUA.indexOf("Android") != -1){
    window.document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0?">');

  }else if(strUA.indexOf("iPad") != -1){
    
  }else if(strUA.indexOf("iPhone") != -1){
    window.document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0?">');

  }else if(strUA.indexOf("iPod") != -1){
    window.document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0?">');

  }else if(strUA.indexOf("MSIE") != -1){
      if(strUA.indexOf("10") != -1){

    }

  }else{

  }