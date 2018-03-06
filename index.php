<?php
if(!file_exists("datastore.json")){
  include "cronjob.php";
}
$dataStore = json_decode(file_get_contents("datastore.json"));
?>
<!doctype html>
<html style="height:100%">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>FTF Redirector</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style type="text/css">
  html, body{
    height:100%
  }
  h1, h2, h3, h4, h5, h6{
    font-family:"Tahoma"
  }
  </style>
  <script type="text/javascript">
    window.onload = function(){
      var intervalId = window.setInterval(function(){
        if(document.getElementById("timer").innerHTML != "0"){
          document.getElementById("timer").innerHTML -= 1;
        }else{
          window.clearInterval(intervalId);
          window.location = "<?php echo $dataStore->url;?>";
        }
      },1000);
    };
  </script>
</head>
<body style="height:100%">
    <div class="h-100 row align-items-center justify-content-center" style="text-align:center">
      <div class="col">
        <h1>Free Talk Fridays</h1>
        <h6>Automatic Redirector</h6>
        <br>
        <h2><?php echo substr ($dataStore->title,strpos($dataStore->title,"-")+1); ?></h2>
        <h6><?php echo $dataStore->comments;?></h6>
        <h5>Redirecting you in <span id="timer">3</span>...</h5>
      </div>
    </div>
</body>
</html>
