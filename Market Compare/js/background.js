/*var api_url = "http://localhost/serverapi/compare_c.php";
var pre_url = "https://bittrex.com/Market/Index?MarketName=BTC-";
chrome.runtime.onInstalled.addListener(function(details){
  if(details.reason == "install"){
      console.log("This is a first install!");
      localStorage.removeItem('urllist');
      var xhr = new XMLHttpRequest();
			xhr.open('GET', chrome.extension.getURL('market.txt'), true);
			xhr.onreadystatechange = function()
			{
			    if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)
			    {
			        saveUrl(xhr.responseText.trim().replace(' ',''));
			    }
			};
			xhr.send();
  }else if(details.reason == "update"){
      var thisVersion = chrome.runtime.getManifest().version;
      console.log("Updated from " + details.previousVersion + " to " + thisVersion + "!");
      localStorage.removeItem('urllist');
      var xhr = new XMLHttpRequest();
			xhr.open('GET', chrome.extension.getURL('market.txt'), true);
			xhr.onreadystatechange = function()
			{
			    if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200)
			    {
			        saveUrl(xhr.responseText.trim().replace(' ',''));
			    }
			};
			xhr.send();
  }
});
function saveUrl(res){
	var urlArray = res.trim().split(',');
	if(urlArray.length)	{
		localStorage.setItem('urllist', JSON.stringify(urlArray));
		for(var i in urlArray){
			if(urlArray[i]!=''){
				chrome.tabs.create({ url: pre_url+urlArray[i] });
			}
		}
	}

}

chrome.runtime.onMessage.addListener(function(request, sender, sendResponse) {
	if(request.from){
		var urldata = JSON.parse(localStorage.getItem('urllist'));
		if(urldata.length){
			for(var j in urldata){
				if(urldata[j]==request.from){
					if(request.buy && request.sell && request.price){
						console.log(request.buy+'   '+request.sell+'   '+request.price);
			    	var omg_buy = request.buy;
			    	var omg_sell = request.sell;
			    	var omg_price = request.price;
			    	var market = request.from;
			    	$.ajax({
							type: "POST",
							url: api_url,
							data: {page:'save', market:market, buy:omg_buy, sell:omg_sell, price:omg_price},
							success: function( response ) {
								if (response){
									console.log(response);
								}
							}
						});			
					}
				}
			}
		}

	}
});*/
var api_url = "http://localhost/serverapi/compare_c.php";
var service_url = 'https://bittrex.com/api/v1.1/public/getmarketsummaries';
function check_status(){
	$.ajax({
	  type: "GET",
	  dataType: "json",
	  url: service_url,
	  success: function( response ) {
	    if (response){
	      console.log(response);
	      if(response['result'].length){
	      	for(var i in response['result']){
	      		if(response['result'][i]['MarketName'].indexOf("BTC-")!=-1){
	      			var marketname = response['result'][i]['MarketName'];
	      			var marketprice = response['result'][i]['Last'];
	      			$.ajax({
								type: "POST",
								url: api_url,
								data: {page:'getMarketData', market:marketname, price:marketprice},
								success: function( response ) {
								}
							});	
	      		}
	      	}
	      }
	    }
	  }
	});
}
check_status();
var start_check_status = setInterval(function(){
		check_status();	
}, 180*1000);
