/*$(document).ready(function(){
	if(location.href.indexOf("https://bittrex.com/Market/Index?MarketName=BTC-")!=-1){
		var marketname = '';
		var locationArray = location.href.split('=BTC-');
		if(locationArray[1]){
			marketname = locationArray[1];
		}
		var count_existingstatus = 0;
		function getAllData(){
			var buyorder = $("#buyOrdersTable").parent().next().find('tr').first().children("td").first().text().trim();
			var sellorder = $("#sellOrdersTable").parent().next().find('tr').first().children("td").last().text().trim();
			var price = $.trim($("#rowChart").find(".base-market").first().find("span").text());
			console.log(buyorder.replace(' BTC','') +'   '+ sellorder.replace(' '+marketname,'') +'   '+price );
			chrome.runtime.sendMessage({from: marketname,buy: buyorder.replace(' BTC',''), sell:sellorder.replace(' '+marketname,''), price:price}, function(response){
			});
			count_existingstatus++;
			if(count_existingstatus==3){
				location.reload();
			}
		}
		if(marketname!=''){
			var count_changestatus = 0;
			var check_table_status = setInterval(function(){
				var buyorderstatus = $("#buyOrdersTable").parent().next().find('tr').first().children("td").first().text().trim();
				if(buyorderstatus.indexOf('BTC')!=-1 && buyorderstatus!="0.000 BTC"){
					clearInterval(check_table_status);	
					getAllData();
					setInterval(function(){
						getAllData();
					},300*1000);
				}else{
					if(count_changestatus==60){
						location.reload();
					}
				}
				count_changestatus++;
			}, 3000);	
		}
	}
});*/