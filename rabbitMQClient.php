<?php
   require_once('path.inc');
   require_once('get_host_info.inc');
   require_once('rabbitMQLib.inc');
  function clientDB($request){
   $client = new rabbitMQClient("testRabbitMQDB.ini","testServer");
   if (isset($argv[1]))
   {
    $msg = $argv[1];
  }
  else
  {
    $msg = "Hello!";
  }
 
   $respone = $client->send_request($rquest);
   return $respone;
