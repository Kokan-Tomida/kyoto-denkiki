// JavaScript Document

// Google Analytics
/*var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
var header = document.getElementsByTagName("head")[0];
var scriptTag = document.createElement("script");
scriptTag.setAttribute("src", gaJsHost + "google-analytics.com/ga.js");
scriptTag.setAttribute("type", "text/javascript");
header.appendChild(scriptTag);
function analytics() {
try {
var pageTracker = _gat._getTracker("XX-XXXXXX-XX");
pageTracker._trackPageview();
} catch(err) {
// alert("Google Analytics:" + err);
}
}
if (window.attachEvent) {
window.attachEvent("onload", analytics);
} else {
window.addEventListener("load", analytics, false);
}
*/

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58618341-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');
