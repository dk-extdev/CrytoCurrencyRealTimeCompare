<head>
  <title>Market Compare</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="default-margin text-center">
</div>
</body>
<?php set_time_limit(0);?>
<!--script>
  var service_url = 'https://bittrex.com/api/v1.1/public/getmarketsummaries';
  var market_url = 'https://bittrex.com/api/v1.1/public/getorderbook?market=';//BTC-1ST&type=both
  $.ajax({
    type: "GET",
    dataType: "json",
    url: service_url,
    success: function( response ) {
      if (response){
        console.log($.parseJSON(response));
      }
    }
  });
</script-->
<?php
  //next example will recieve all messages for specific conversation
  set_time_limit(0);
  $service_url = 'https://bittrex.com/api/v1.1/public/getmarketsummaries';
  $market_url = 'https://bittrex.com/api/v1.1/public/getorderbook?market=';//BTC-1ST&type=both
  $curl = curl_init($service_url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $curl_response = curl_exec($curl);
  $decoded = json_decode($curl_response);
  
  curl_close($curl);
  if($decoded->success){
    foreach ($decoded->result as $key => $value) {
      if (strpos($value->MarketName, 'BTC-') !== false) {
        $curl_both = curl_init($market_url.$value->MarketName.'&type=both');
        curl_setopt($curl_both, CURLOPT_RETURNTRANSFER, true);
        $curl_both_response = curl_exec($curl_both);
        $both_decoded = json_decode($curl_both_response);
        curl_close($curl_both);
        $total_buy = 0;
        //print_r($both_decoded);
        foreach ($both_decoded->result as $both => $both_value) {
          $total_buy+=$total_buy+$both_value->buy['Quantity'];
        }
        echo $total_buy.'   '.$value->MarketName.'   ';
      }
    }
  }
?>
