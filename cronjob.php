<?php

require_once "vendor/autoload.php";

$client = new GuzzleHttp\Client([
  "headers" => [
    "referer"=>"https://www.reddit.com/r/anime/",
    "upgrade-insecure-requests"=>"1",
    "user-agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36",
  ]
]);
$body = $client->get("https://www.reddit.com/r/anime/search?q=subreddit%3Aanime+author%3AAutoModerator+Free-talk+Fridays&restrict_sr=on&sort=new&t=week")->getBody();

$dom = Sunra\PhpSimple\HtmlDomParser::str_get_html($body);
$dataStore = new stdClass();
try{
  $dataStore->title = $dom->find(".search-result-header")[0]->first_child()->plaintext;
  $dataStore->url = $dom->find(".search-result-header")[0]->first_child()->href;
  $dataStore->comments = $dom->find(".search-result-meta")[0]->find("a")[0]->plaintext;
}catch(Exception $ex){
  handleErrors();
}
if(is_null($dataStore->title) || is_null($dataStore->url) || is_null($dataStore->comments)){
  handleErrors();
}else{
  $dataStore->errorOccurred = "false";
  $dataStore->lastFetched = Carbon\Carbon::now()->toDateTimeString();
  checkFileWritable();
  file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . "datastore.json",json_encode($dataStore));
}
function handleErrors(){
  if(file_exists(__DIR__ . DIRECTORY_SEPARATOR . "datastore.json")){
    checkFileReadable();
    $dataStore = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "datastore.json"));
  }else{
    $dataStore = new stdClass();
    $dataStore->title = "Something broke";
  }
  $dataStore->errorOccurred = "true";
  checkFileWritable();
  file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . "datastore.json",json_encode($dataStore));
  die("One of the fields are empty. HNNNGGG!!!");
}
function checkFileWritable(){
  if(!is_writable(__DIR__ . DIRECTORY_SEPARATOR . "datastore.json")){
    die("datastore.json is not writable. Check your privilege! By the way, I'm running as " . shell_exec("whoami") . " in " . shell_exec("pwd"));
  }
}
function checkFileReadable(){
  if(!is_readable(__DIR__ . DIRECTORY_SEPARATOR . "datastore.json")){
    die("datastore.json is not writable. Check your privilege! By the way, I'm running as " . shell_exec("whoami") . " in " . shell_exec("pwd"));
  }
}
 ?>
