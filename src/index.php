<?php
// https://github.com/BaseMax/API-Sarrafchi
header("Access-Control-Allow-Origin: *");
require 'flight/Flight.php';
include "bonbast-api/source/bonbast-api.php";
require "phpedb.php";

date_default_timezone_set('Asia/Tehran');
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
Flight::set('flight.log_errors', true);

$db=new database();
$db->db="db_sarrafchi";
$db->connect("localhost", "root", "dfgdfgdfgdfgfgfghfgh");

// $backup=[];
Flight::route('/', function(){
   global $db;
   echo 'hello world!';
   $posts=$db->selects("news");
   // foreach($posts as $i=>$post) {
   //    // $db->update("news", ["id"=>$post["id"]], ["date"=>trim($post["date"])]);
   //    $date=$post["date"];
   //    $backup[]=$date;
   //    $split=explode(" - ", $date);
   //    $date=$split[0];
   //    $time=$split[1];
   //    $db->update("news", ["id"=>$post["id"]], ["date"=>$date, "time"=>$time]);
   //    // $db->update("news", ["id"=>$post["id"]], ["slug"=>urldecode($post["slug"])]);
   // }
   // print json_encode($backup);
});

Flight::route('/rate', function(){
   global $db;
   $prices=bonbast();
   Flight::json([
      "status"=>"success",
      "currencies"=>$prices,
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
         // print $posts[$i]["excerpt"]."\n";
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

// Flight::route('/blog/@slug-@id', function($slug, $id){
Flight::route('/blog/@slug', function($slug){
   global $db;
   $post=$db->select("news", ["slug"=>$slug]);
   if($post == null || $post == []) {
      Flight::json([
         "status"=>"failed",
      ]);
   }
   else {
      Flight::json([
         "status"=>"success",
         "post"=>$post,
      ]);
   }
});

Flight::start();

function strWordCut($string, $length) {
   $str_len = mb_strlen($string);
   $string = strip_tags($string);
   if($str_len > $length) {
      $stringCut = mb_substr($string, 0, $length-15);
      $string = $stringCut.'.....' . mb_substr($string, $str_len-10, $str_len-1);
   }
   return $string;
}
