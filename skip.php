<?php
if(!file_exists("datastore.json")){
  include "cronjob.php";
}

$dataStore = json_decode(file_get_contents("datastore.json"));

header("Location: " . $dataStore->url);

die();
?>
