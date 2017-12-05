$(document).ready(function(){
	var table = document.getElementById('marketCompareTable');
	var sort = new Tablesort(table);
	console.log(sort);
	function startCheck(){
		$.ajax({
			type: "POST",
			url: "compare_c.php",
			data: {page:'getAll'},
			success: function( response ) {
				if (response){
					var alldata = $.parseJSON(response.trim());
					console.log(Object.keys(alldata).length);
					$("table tbody").html('');
					if(Object.keys(alldata).length){
						for (var k in alldata){
						    if (alldata.hasOwnProperty(k)) {
						    	$("table tbody").append('<tr class="subbody market-'+k+'"><td><div class="market-title">'+k.toUpperCase()+'</div></td></tr>');
						         //console.log("Key is " + k + ", value is" + alldata[k]);
								for(var i in alldata[k]){
									if(alldata[k][i]>0){
										$('.market-'+k).append('<td><div class="market-percent price-color-pluse">+'+alldata[k][i]+'%</div></td>');
									}else if(alldata[k][i]<0){
										$('.market-'+k).append('<td><div class="market-percent price-color-minuse">'+alldata[k][i]+'%</div></td>');
									}else $('.market-'+k).append('<td><div class="market-percent">'+alldata[k][i]+'%</div></td>');
									if(i!=alldata[k].length-1 && k!=Object.keys(alldata).length-1){
										$('.market-'+k).append('<td>&nbsp;</td>');
									}
								}
						    }
						}	
					}

					// Make some Ajax request to fetch new data and on success:
					console.log(sort);
					sort.refresh();
				}
			}
		});
	}
	startCheck();
	setInterval(function(){
		startCheck();	
	},180*1000);
});
