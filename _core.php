<?php
// Max Base
// https://github.com/BaseMax/API-Sarrafchi

require "phpedb.php";

date_default_timezone_set('Asia/Tehran');
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

$db=new database();
$config = require "_config.php";
$db->db=$config["db_name"];
$db->connect($config["db_host"], $config["db_user"], $config["db_pass"]);

function strWordCut($string, $length) {
   $str_len = mb_strlen($string);
   $string = strip_tags($string);
   if($str_len > $length) {
      $stringCut = mb_substr($string, 0, $length-15);
      $string = $stringCut.'.....' . mb_substr($string, $str_len-10, $str_len-1);
   }
   return $string;
}

function convert2english($string) {
    $newNumbers = range(0, 9);
    // 1. Persian HTML decimal
    $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
    // 2. Arabic HTML decimal
    $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
    // 3. Arabic Numeric
    $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    // 4. Persian Numeric
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

    $string =  str_replace($persianDecimal, $newNumbers, $string);
    $string =  str_replace($arabicDecimal, $newNumbers, $string);
    $string =  str_replace($arabic, $newNumbers, $string);
    return str_replace($persian, $newNumbers, $string);
}
