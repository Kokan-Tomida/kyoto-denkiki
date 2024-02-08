var counter = 10; //当該電子ブックページに遷移するまでのカウントダウン秒数指定
  document.getElementById("PageJumpCountDown").innerHTML = counter; //初期値の表示
  var IntervalID = setInterval("CountDown()",1000);
  
  function CountDown(){
    counter--;
    document.getElementById("PageJumpCountDown").innerHTML = counter;
    if (counter <= 0){
      clearInterval(IntervalID);
      location.href= "../_SWF_Window.html?pagecode=4";
    }
  }