<?php
require_once "vendor/autoload.php";
if(!file_exists("datastore.json")){
  include "cronjob.php";
}
if(!file_exists("datastore.json")){
  die("still not here");
}
$dataStore = json_decode(file_get_contents("datastore.json"));
if($dataStore == NULL){
  var_dump(shell_exec("php cronjob.php"));
}
?>
<!doctype html>
<html style="height:100%">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>FTF Redirector</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style type="text/css">
  html, body{
    height:100%,
  }
  body{
    background-color: #6a9de6
  }
  h1, h2, h3, h4, h5, h6{
    font-family:"Tahoma"
  }
  .footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    /* Set the fixed height of the footer here */
    background-color: #f5f5f5;
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
        <img id="header-img" src="//b.thumbs.redditmedia.com/AQ_47wQPWDOEuP0LohFeFYpoa3fdLcqWrgIxDYvU_PI.png" width="148" height="180" alt="anime">
        <h1 style="font-family:tangerine;font-size:5rem">Free Talk Fridays</h1>
        <h6 style="font-family:courier">Automatic Redirector</h6>
        <br>
        <h2><?php echo substr ($dataStore->title,strpos($dataStore->title,"-")+1); ?></h2>
        <h6><?php echo $dataStore->comments;?></h6>
        <h6>Last fetched <?php echo Carbon\Carbon::parse($dataStore->lastFetched)->diffForHumans();?></h6>
        <h5>Redirecting you in <span id="timer">3</span>...</h5>
      </div>
    </div>
    <div class="footer">
      <div class="container">
        <div class="row align-items-center">
        <div class="col-sm-2" style="text-align:left;font-size:16px;border-bottom: 1px solid rgba(86,61,124,.2)">
          Made by chesnutcase
        </div>
        <div class="col-sm" style="text-align:center;font-size:16px;border-bottom: 1px solid rgba(86,61,124,.2)">
          Add /s to the end of the url for auto-redirect without loading any HTML
        </div>
        <div class="col-sm-2" style="text-align:right;font-size:16px;">
          Sauce here
        </div>
        </div>
      </div>
    </div>
</body>
</html>
