<?php
// Max Base
// https://github.com/BaseMax/API-Sarrafchi

require "_core.php";
include "bonbast-api/source/bonbast-api.php";

try {
	$api = new BonBast();
	$prices = $api->fetchPrices();
  
	// print_r($prices);
	
	$values = [
		"data" => json_encode($data),
		"date" => date("Y/m/d"),
		"time" => date("H:i:s"),
	];
	
	$db->insert("history", $values);
	// print "Updated.";
} catch (IPAddressBlockedException $e) {
	// die($e->getMessage());
} catch (InvalidHTTPStatusException $e) {
	// die($e->getMessage());
} catch (BadHomepageDataException $e) {
	// die($e->getMessage());
} catch (InvalidApiKeyException $e) {
	// die($e->getMessage());
} catch (Exception $e) {
	// die("Invalid exception: " . $e->getMessage());
}
