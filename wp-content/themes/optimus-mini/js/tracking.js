// Kick off the process
document.addEventListener("DOMContentLoaded", logVisit);

links = document.querySelectorAll('a')

links.forEach(function(elem) {
  elem.addEventListener("click", function() {
   var type = 'click';
   var element = this.getAttribute('tracking-name');

   logEvent(type, element);
  });
});



buttons = document.querySelectorAll('button')



buttons.forEach(function(elem) {
  elem.addEventListener("click", function() {
   var type = 'click';
   var element = this.getAttribute('tracking-name');
   logEvent(type, element);
  });
});



function logEvent(type, element){

	var data = {
		type: type,
		element: element,
        location: window.location.href,
        page: window.location.pathname,
        local_time: new Date(),
        cookie_id: getCookie()
	};

	console.log(data);

	postLog(data);

}


function logVisit(){

	var data = {
		type: 'visit',
        location: window.location.href,
        referer: document.referrer,
        language: window.navigator.userLanguage || window.navigator.language,
        width: screen.width,
        height: screen.height,
        local_time: new Date(),
        cookie_id: getCookie(),
        domain: window.location.host,
		port: window.location.port,
		page: window.location.pathname,
		origin: window.location.origin,
		title: document.title,
		userAgent: window.navigator.userAgent,
		browser: getBrowser(window.navigator.userAgent),
		platform: window.navigator.platform
	};


	console.log(data);

	postLog(data);

}


function getCookie(){
	//check if cookie exists and return the cookie_id else create a new cookie and return its id
	cookieExist = checkCookie();

	if(cookieExist){
		cookie_id = getCookieID();

	} else {
		createCookie();
		cookie_id = getCookieID();
	}
	
	return cookie_id;
}


function checkCookie(){

	var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)GobyTrackingCookie\s*\=\s*([^;]*).*$)|^.*$/, "$1");
	if(cookieValue){
		return true;
	} else {
		return false;
	}
}

function getCookieID(){
	var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)GobyTrackingCookie\s*\=\s*([^;]*).*$)|^.*$/, "$1");
	return cookieValue;
}


function createCookie(){
	var cookieID = uuidv4();
	var cname = "GobyTrackingCookie";

	var exdays = 30;

	var d = new Date();
  	d.setTime(d.getTime() + (exdays*24*60*60*1000));
  	var expires = "expires="+ d.toUTCString();
	document.cookie = cname + "=" + cookieID + ";" + expires + ";path=/";
	console.log(document.cookie);
}


function uuidv4() {
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
    return v.toString(16);
  });
}


function getBrowser(userAgent) {

    if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 )
    {
        return "Opera";
    }
    else if(navigator.userAgent.indexOf("Chrome") != -1 )
    {
        return "Chrome";
    }
    else if(navigator.userAgent.indexOf("Safari") != -1)
    {
        return "Safari";
    }
    else if(navigator.userAgent.indexOf("Firefox") != -1 )
    {
         return "Firefox";
    }
    else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
    {
      return "IE";
    }
    else
    {
       return "unknown";
    }
}


function postLog(data){

    var url = "https://collection.optimus.site/metrics";
    var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader('Content-Type', 'application/json');
	xhr.send(JSON.stringify(data));

}

