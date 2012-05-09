<?php

/** configuration */
$url_prefix="http://w1.sndcdn.com/";
$url_suffix=".png";

$image_pattern="/^[A-z0-9\-_]+$/";
/** end configuration */

if(!array_key_exists("token", $_GET)
|| !preg_match($image_pattern, $_GET["token"])) {
	header("HTTP/1.0 400 Bad Request");
	exit();
}

$image_token = $_GET["token"];
$image_url = $url_prefix.$image_token.$url_suffix;

if($image_content = file_get_contents($image_url)) {
	$image_data = base64_encode($image_content);

	echo 'data:image/png;base64,'.$image_data;
} else {
	header("HTTP/1.0 404 Not Found");
	exit();
}

?>
