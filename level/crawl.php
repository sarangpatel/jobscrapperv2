<?php
ini_set('max_execution_time',0);
require 'vendor/autoload.php';

// Initiate crawl
$crawler = new \Arachnid\Crawler('http://www.php.net/', 2);
$crawler->traverse();

// Get link data
$links = $crawler->getLinks();
print_r($links);

//http://zrashwani.com/simple-web-spider-php-goutte/#.VkDX0bcrLZ4
//https://github.com/FriendsOfPHP/Goutte
//https://github.com/codeguy/arachnid
//https://subinsb.com/how-to-create-a-simple-web-crawler-in-php

?>
