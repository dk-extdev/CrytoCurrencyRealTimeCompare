<?php
require_once(dirname(__FILE__)."/config.php");
require_once(dirname(__FILE__)."/db.php");
require_once(dirname(__FILE__)."/system.php");
require_once(dirname(__FILE__)."/compare_m.php");
if(isset($_REQUEST) && $_REQUEST){
	if ($_REQUEST['page'] == 'save'){
		reg($_REQUEST);
	}elseif ($_REQUEST['page']=='getAll'){
		getAll($_REQUEST);
	}elseif ($_REQUEST['page']=='getMarketData'){
		getMarketData($_REQUEST);
	}
	
}
function reg($data){
	
	$market = $data['market'];
	$buy = $data['buy'];
	$sell = $data['sell'];
	$price = $data['price'];
	$obj = new Compares;
	$obj->reg($market,$buy, $sell,$price);
	print_r($data);
}
function getAll(){
	$obj = new Compares;
	$result = $obj->getAll();
	echo json_encode($result);
};
function getMarketData($data){
	$market_api_url = 'https://bittrex.com/api/v1.1/public/getorderbook?market=';//BTC-1ST&type=both
	$market = $data['market'];
	$price = $data['price'];
	$curl_both = curl_init($market_api_url.$market.'&type=both');
    curl_setopt($curl_both, CURLOPT_RETURNTRANSFER, true);
    $curl_both_response = curl_exec($curl_both);
    curl_close($curl_both);
    $both_decoded = json_decode($curl_both_response);
    $total_buy = 0;
    $total_sell = 0;
    
    foreach ($both_decoded->result->buy as $buy => $buy_value) {
      $total_buy+=floatval($buy_value->Quantity);
    }
    foreach ($both_decoded->result->sell as $sell => $sell_value) {
      $total_sell+=floatval($sell_value->Quantity);
    }
    $marketname = str_replace('BTC-','',$market);
    $obj = new Compares;
	$obj->reg($marketname,$total_buy, $total_sell,$price);
    //print_r($both_decoded);
    //foreach ($both_decoded->result as $both => $both_value) {
      //$total_buy+=$total_buy+$both_value->buy['Quantity'];
    //}
	//$obj = new Compares;
	//$obj->reg($market,$buy, $sell,$price);
	//print_r($both_decoded);
	
}
?>