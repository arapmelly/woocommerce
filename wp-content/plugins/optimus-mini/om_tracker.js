/**
* this tracking code will perform the following:
* - cookie management - check if cookie exists and retrive cookieId and create a new cookie where none exists
* - data collection
* - data submission to tracking server
*/




optimusTracker();

function optimusTracker(){

  $=jQuery.noConflict();

	var exists = getCookie('optimusTrackingCookie');

	//check if optimus tracking cookie exists
	if(exists == 0){

		//collect user data and send to the server return with cookie id
		// create a new cookie with the returned id

		var visitorData = collectData();

    console.log(visitorData);

		var cookieId = 0;

			//post data to server
			$.ajax({
				type: "POST",
				url: "https://collection.optimus.site/track/visit",
				data: visitorData,
				async:false,
				success: function(resp){
					cookieId = resp.cookieId;
				}

			});

		var cname = "optimusTrackingCookie";
		var cvalue = cookieId;
		var exdays = 30;

		setCookie(cname, cvalue, exdays);

	} else {

		//retrieve the cookie id
		var cookieId = getCookie('optimusTrackingCookie');
		//collect visitor data and append the cookie id then send to the server

		var visitorData = collectData();

    console.log(visitorData);

		visitorData.cookieId = cookieId;

		//console.log(visitorData);

		//post data to server
			$.ajax({
				type: "POST",
				url: "https://collection.optimus.site/track/visit",
				data: visitorData,
				async:false,
				success: function(resp){
					console.log(resp);
				}

			});

	}

}


function setCookie(cname, cvalue, exdays) {

  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	console.log('create a cookieId on browser');
	console.log(document.cookie);
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return 0;
}




function collectData(){


	var visitorData = {};


	$.ajax({
	  type: 'GET',
	  async: false,
	  //url: "http://ip-api.com/json",
		url: "https://json.geoiplookup.io",
	  success: function(response) {
				console.log(response)

	  		visitorData = {

				date: getDate(),
				time: getTime(),
				domain: window.location.host,
				href: window.location.href,
				port: window.location.port,
				page: window.location.pathname,
				origin: window.location.origin,
				title: document.title,
				userAgent: window.navigator.userAgent,
				browser: getBrowser(window.navigator.userAgent),
				platform: window.navigator.platform,
				language: window.navigator.language,
				innerHeight : window.innerHeight,
            	innerWidth  : window.innerWidth,
            	outerWidth  : window.outerWidth,
            	outerHeight : window.outerHeight,
				ip: response.ip,
				city: response.city,
				country: response.country_name,
				countryCode: response.country_code,
				lat: response.latitude,
				lon: response.longitude,
				isp: response.asn_org,
				region: response.region,
				regionName: response.region,
				timezone: response.timezone_name,
			};



	  },

	  error: function(status){

	  		visitorData = {

				date: getDate(),
				time: getTime(),
				domain: window.location.host,
				href: window.location.href,
				port: window.location.port,
				page: window.location.pathname,
				origin: window.location.origin,
				title: document.title,
				userAgent: window.navigator.userAgent,
				platform: window.navigator.platform,
				language: window.navigator.language,
				browser: getBrowser(window.navigator.userAgent),
				innerHeight : window.innerHeight,
            	innerWidth  : window.innerWidth,
            	outerWidth  : window.outerWidth,
            	outerHeight : window.outerHeight,
				ip: null,
				city: null,
				country: null,
				countryCode: null,
				lat: null,
				lon: null,
				isp: null,
				region: null,
				regionName: null,
				timezone: null,
			};

	  }

	});



  	return visitorData;


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


function getDate(){


	var date = new Date().toLocaleDateString();

	return date;

}


function getTime(){

	var time = new Date().toLocaleTimeString();

	return time;

}
