<?php

require_once "libs/aCurl/aCurl.php";

$a = new aCurl("http://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=en-US");

$a->createCurl();

$j = json_decode($a);

try {
	$img = new aCurl("https://bing.com/".$j->images[0]->url);
	$img->includeHeader(false);
	$img->createCurl();
	if ($img->getHttpStatus() !=200) {
		throw new Exception;
	}
	header("Content-Type: image/jpeg"); // assumes images are always jpgs  TODO: get from curl header?
	echo $img;
} catch (Exception $e) {
	header("Content-Type: image/jpeg");
	readfile("down.jpg");
}
