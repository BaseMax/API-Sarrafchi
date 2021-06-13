<?php
// Max Base
// https://github.com/BaseMax/API-Sarrafchi

require "_core.php";
include "bonbast-api/source/bonbast-api.php";

$prices=bonbast();
$data = json_encode($prices);

if($data == "" || $data == null || $prices == [] || $prices == null || $data == "{}" || count($prices) == 0) {
	exit();
}

$values = [
	"data"=>$data,
	"date"=>date("Y/m/d"),
	"time"=>date("H:i:s"),
];

$db->insert("history", $values);
// print "Updated.";
