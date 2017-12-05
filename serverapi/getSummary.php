<head>
  <title>Market Compare</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
</head>
<body>
</body>
<script type="text/javascript">
  $(document).ready(function(){
    var service_url = 'https://bittrex.com/api/v1.1/public/getmarketsummaries';
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
  });
</script>
