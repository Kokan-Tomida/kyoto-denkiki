	function sendpage(p){
		document.frm.pageno.value = p;
		document.frm.submit();
	}

	function sendpage_location(p){
		document.frm.pageno.value = p;
		var url = location.protocol + '//' + location.hostname + location.pathname;
		location.href = url + '?pageno=' + p + '#listview';
	}

	function OnloadFunc(){
		obj = document.getElementById('listview');
	    		
		if(obj != null){
		    y = obj.offsetTop;
		    scrollTo(0,y);
		}
	}	
	
	function onCheckChangeColor(ctl,frm){
		if(ctl.checked){
			ctl.style.background='red';
		}else{
			ctl.style.background='';
		}
	}

	function changeMode(param){
		document.frm.mode.value=param;
		document.frm.submit();
	}
	
	function changeModeMsg(param,msg){
		var ret;
		if(msg == ''){
			ret = true;
		}else{
			ret = confirm(msg);
		}
		if(ret == true){
			document.frm.mode.value=param;
			//document.frm.submit();
		}
	}

	function detail_summary(j,n,u){
		var j = document.getElementById(j);
		j.innerHTML = u*n;
		return false;
	}
	
	function changeDate(frm, ctl){
		var dt=new Date();
		var dy=dt.getYear();
		var dm=dt.getMonth()+1;
		var dd=dt.getDate();
		
		if(dy < 1900){
			dy = 1900+dy;
		}
		if(dm>0&&dm<10){
			dm="0"+dm;
		}
		if(dd>0&&dd<10){
			dd="0"+dd;
		}
		
		var vYMD=dy+"/"+dm+"/"+dd;
	
		frm.date_issue.value = vYMD;
		frm.mode.value = ctl;
		//frm.submit();
	}
	
	function list_print(flg){
		if(flg == 1){
			window.print();
		}
		return false;
	}
	
	function getTopCategory(obj){
         var type;
         var txt;
         var len;
         var name = '';
         txt = obj.options[obj.selectedIndex].text;
         len = txt.length;
         if(len > 2){
         	type = txt.substring(0,1);
         	if(type == 'P'){
	         	name = 'パワーエレクトロニクス';
	        }else if(type == 'O'){ 	
	         	name = 'オプトエレクトロニクス';
			}
         	document.getElementById("top_category").innerHTML = name;
         }
		 
	}

	function getTopCategory2(obj){
         var type;
         var txt;
         var len;
         var name = '';
         txt = obj.options[obj.selectedIndex].text;
         len = txt.length;
         if(len > 2){
         	type = txt.substring(0,1);
         	if(type == 'P'){
	         	name = 'パワーエレクトロニクス';
	        }else if(type == 'O'){ 	
	         	name = 'オプトエレクトロニクス';
			}
         	document.getElementById("top_category").innerHTML = name;
         }
		 
	}

	function chk_category2(){
		var lv;
		var mv;

		lv = document.forms["frm"].elements["large_category_id"].value;
		mv = document.forms["frm"].elements["middle_category_id"].value;
		if((lv == "") || (mv == "")){
		 	alert('大カテゴリ、中カテゴリの両方を選択してください.');
		 	return false;
		 }
		 return true;
	}
	
	function change_large(){
		document.forms["frm"].elements["middle_category_id"].value = "";
		frm.submit();
	
	}
	
	function setOnEnterClickButton(targetButtonId,formName){
		var form = (formName == null) ? document.forms[0] : document.forms[formName];
		var targetButton = document.getElementById(targetButtonId);
		document.onkeypress=function(e){
			e = e ? e : event; 
			var keyCode= e.charCode ? e.charCode : ((e.which) ? e.which : e.keyCode);
			var elem = e.target ? e.target : e.srcElement;
			if(Number(keyCode) == 13) { //13=EnterKey
				if(!isIgnoreEnterKeySubmitElement(elem)){
					targetButton.click();
				}
				return isInputElement(elem) ? false : true;
			}
		}
	}

	function isIgnoreEnterKeySubmitElement(elem){
		var tag = elem.tagName;
		if(tag.toLowerCase() == "textarea"){
			return true;
		}
		switch(elem.type){
			case "button":
			case "submit":
			case "reset":
			case "image":
			case "file":
			return true;
		}
		return false;
	}

	function isInputElement(elem){
		switch(elem.type){
			case "text":
			case "radio":
			case "checkbox":
			case "password":
			return true;
		}
		return false;
	}
	
	function getScrollPosition() {
		document.forms["frm"].elements["y"].value = document.documentElement.scrollTop || document.body.scrollTop;
		document.forms["frm"].elements["x"].value = document.documentElement.scrollLeft || document.body.scrollLeft;
	}
	
	function selectPosition(){
		var iSelectPosition;
		if(document.getElementById('y') != null){ 
			iSelectPosition = document.getElementById('y').value;
		}else{
			iSelectPosition = 0;
		}  
		document.getElementById('numbering').scrollTop = iSelectPosition;
	}

	function ClickSubmitBtn(){  
		document.getElementById('y').value =   
		document.getElementById('numbering').scrollTop;  
	}
	