<?php
// Max Base
// https://github.com/BaseMax/API-Sarrafchi

header("Access-Control-Allow-Origin: *");

require 'flight/Flight.php';
include "bonbast-api/source/bonbast-api.php";

require "_core.php";

Flight::set('flight.log_errors', true);

Flight::route('/', function(){
   global $db;

   echo 'hello world!';
});

Flight::route('/log', function() {
    	date_default_timezone_set('Asia/Tehran');
	$car=$_GET["car"];
	$latitude=$_GET["latitude"];
	$longitude=$_GET["longitude"];
	file_put_contents("log.txt", date("Y/m/d h:i:s"). " => ". $car.",".$latitude.",".$longitude."\n", FILE_APPEND);
	Flight::json([]);
});
Flight::route('/rate', function(){
   global $db;

   // $prices=bonbast();
   $data = $db->select("history", [], "ORDER BY `id` DESC LIMIT 1", "data");

   if(!isset($data["data"])) { $data=["data"=>"{}", "date" => "-", "time" => "-"]; }
   $prices = json_decode($data["data"], true);

   if($prices == [] || $prices == null) {
      Flight::json([
         "status" => "failed",
         "currencies" => [],
      ]);
      return;
   }
   Flight::json([
      "status" => "success",
      "date" => $data["date"],
      "time" => $data["time"],
      "currencies" => $prices,
   ]);
});

Flight::route('/blog', function(){
   global $db;

   $page=1;
   $post_per_page=20;
   if(isset($_GET["page"])) {
      $page=(int)$_GET["page"];
   }
   if($page<=0) {
      $page=1;
   }
   $posts=$db->selects("news", [], "LIMIT $post_per_page OFFSET ".(($page-1)*$post_per_page), "id,title,image,slug,subtext,text");
   if(count($posts)==0) {
      Flight::json([
         "status"=>"failed",
      ]);
   }
   else {
      foreach($posts as $i=>$post) {
         $posts[$i]["excerpt"]=$posts[$i]["subtext"] ." ". $posts[$i]["text"];
         $posts[$i]["excerpt"]=strWordCut($posts[$i]["excerpt"], 240);
         unset($posts[$i]["text"]);
         unset($posts[$i]["subtext"]);
      }
      Flight::json([
         "status"=>"success",
         "posts"=>$posts,
      ]);
   }
});

Flight::route('/blog/@slug', function($slug){
   global $db;

   $post=$db->select("news", ["slug"=>$slug]);
   if($post == null || $post == []) {
      Flight::json([
         "status"=>"failed",
      ]);
   }
   else {
      $db->update("news", ["id"=>$post["id"]], ["view"=>$post["view"]+1]);
      Flight::json([
         "status"=>"success",
         "post"=>$post,
      ]);
   }
});

Flight::start();
