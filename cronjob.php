<?php

include "vendor/autoload.php";

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
$dataStore->title = $dom->find(".search-result-header")[0]->first_child()->plaintext;
$dataStore->url = $dom->find(".search-result-header")[0]->first_child()->href;
$dataStore->comments = $dom->find(".search-result-meta")[0]->find("a")[0]->plaintext;
if(is_null($dataStore->title) || is_null($dataStore->url) || is_null($dataStore->comments)){
  die();
}
file_put_contents("datastore.json",json_encode($dataStore));
 ?>
