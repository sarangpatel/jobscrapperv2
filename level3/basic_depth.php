<?php
ini_set('max_execution_time', 0);
error_reporting(0);
require_once('../db.php');

if($_POST['action'] == 'scrape'){
	$sql = "TRUNCATE temp_url_level3 ";
	$result = mysql_query($sql);
	$url = trim($_POST['url']);
	crawl_page($url,2);
	$cnt = countURlsToCrawl();
	echo '<b>URLs to crawl : </b>' . $cnt['cnt'] ;
	exit;
}else if($_POST['action'] == 'proceed'){
	$output = getJobs();
	//$time_start = microtime(true);
	require_once('html/output.php');
	exit;
	//$time_end = microtime(true);
	//$time = $time_end - $time_start;
	//echo $time . ' secs';
}else{
	require_once('html/home.php');
}

function countURlsToCrawl(){
	$sql = "SELECT count(1) as cnt from temp_url_level3 order by id asc";
	$result = mysql_query($sql);
	return mysql_fetch_assoc($result);
}

function crawl_page($url, $depth = 5)
{
	//echo  $url ."     :  level :  ".$depth. '<br />';
    static $seen = array();
	static $final_urls = array() ;
    if (isset($seen[$url]) || $depth === 0) {
        return;
    }

    $seen[$url] = true;

    $dom = new DOMDocument();
    //@$dom->loadHTMLFile($url);
	$dt  = get_url($url);
	libxml_use_internal_errors(true);
	$dom->loadHTML($dt);
	libxml_use_internal_errors(false);

	$anchors = $dom->getElementsByTagName('a');
	foreach ($anchors as $element) {
		$href = $element->getAttribute('href');
		//echo 'parsed  ' . $href. '<br />'; 
		if(strpos($href,'#') !== FALSE  || $href == "/" )continue; 
		if (0 !== strpos($href, 'http')) {
			if(strpos($href,'://') !== FALSE)continue;
			//echo $href. '<br />SSS';
			$path = '/' . ltrim($href, '/');
			$parts = parse_url($url);
			$href = $parts['scheme'] . '://';
			if (isset($parts['user']) && isset($parts['pass'])) {
				$href .= $parts['user'] . ':' . $parts['pass'] . '@';
			}
			$href .= $parts['host'];
			if (isset($parts['port'])) {
				$href .= ':' . $parts['port'];
			}
			$href .= $path;
		}
		$original_domain = parse_url($url);
		$extracted_domain = parse_url($href);
		if(strtolower($original_domain['host']) != strtolower($extracted_domain['host']))continue;
		$nodes = $element->childNodes;
		foreach ($nodes as $node) 
		{
			if(!empty($node->nodeValue) && trim($node->nodeValue) != '' && $node->nodeName != 'img'  ){
				$title = strip_tags(trim($node->nodeValue.''));
			}
		}
		$hrefs[$url][$href]=$title;
        crawl_page($href, $depth - 1);
	}
	//echo '<PRE>';  print_r($hrefs);
	saveUrls($hrefs);
}


function get_url($url)
{
	$curl = curl_init();
	$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

	$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml, text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5"; 
	$header[] = "Cache-Control: max-age=0"; 
	$header[] = "Connection: keep-alive"; 
	$header[] = "Keep-Alive: 300"; 
	$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
	$header[] = "Accept-Language: en-us,en;q=0.5"; 

	curl_setopt($curl, CURLOPT_URL, $url); 
	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; U; Linux x86_64; en-US) AppleWebKit/534.3 (KHTML, like Gecko) Ubuntu/10.04 Chromium/6.0.472.53 Chrome/6.0.472.53 Safari/534.3'); 
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
	curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate'); 
	curl_setopt($curl, CURLOPT_VERBOSE, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
	$data = curl_exec($curl);
	$info = curl_getinfo($curl);
	//print_r($info);exit;
	//$logfile = fopen("crawler.log","a");
	//echo fwrite($logfile,'Page ' . $info['url'] . ' fetched in ' . $info['total_time'] . ' seconds. Http status code: ' . $info['http_code'] . "\n");
	//fclose($logfile);
	curl_close($curl);
	return $data;
}

//test case
//https://apsalar.com/careers/
//crawl_page("http://php.net", 2);
//crawl_page("https://www.airbnb.com/careers",2);
//echo '<PRE>';
//print_r(getJobs());





function saveUrls($data){
	foreach($data as $mainUrl => $d){
		foreach($d as $durl => $dlabel) {
			$sql = "INSERT IGNORE INTO temp_url_level3 (url) VALUES ('{$durl}');";
			mysql_query($sql);
		}
	}
}

function getJobs(){
	$csv_file = 'job_titles';
	$sql = "SELECT url from temp_url_level3 order by id asc";
	$result = mysql_query($sql);
	$job_urls = array();
	while($row = mysql_fetch_assoc($result)){
		$job_urls[] = $row['url'];
	}
	$dom = new DOMDocument();
	foreach($job_urls as $url){
		$dt  = get_url($url);
		libxml_use_internal_errors(true);
		$dom->loadHTML($dt);
		libxml_use_internal_errors(false);
		$anchors = $dom->getElementsByTagName('a');
		foreach ($anchors as $element){
			$href = $element->getAttribute('href');
			$job_title_file = fopen(dirname(__FILE__).'/'.$csv_file .".csv", 'r');
			$nodes = $element->childNodes;
			//$str .= $href . " : ";
			foreach ($nodes as $node) 
			{
				if(!empty($node->nodeValue) && trim($node->nodeValue) != '' && $node->nodeName != 'img'  ){
					$o_job_title = '';
					while($row = fgetcsv($job_title_file)){
						//echo   $row[0] . '===' . $node->nodeValue . '<br />';
						if(preg_match("/\b". $row[0] . "\b/i", strip_tags(trim($node->nodeValue)))){
							//echo $href . '==='. $node->nodeValue . '===' .  $row[0] . '<br />';
							$o_job_title = strip_tags(trim($node->nodeValue)) .'';
							fclose($job_title_file);
							break;
						}
					}
					if(!empty($o_job_title)){
						$output[] = array($o_job_title,$href);
					}
				}
			}
		}
	}
	return $output;
}