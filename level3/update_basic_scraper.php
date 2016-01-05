<?php
ini_set('max_execution_time', 0);
error_reporting(-1);
ob_start();
function crawl_page($url, $depth = 5)
{
	echo $depth. '<br />';
    static $seen = array();
    if (isset($seen[$url]) || $depth === 0) {
        return;
    }

    $seen[$url] = true;

    $dom = new DOMDocument();
    //@$dom->loadHTMLFile($url);
	$dt  = get_url($url);
	@$dom->loadHTML($dt);

	$anchors = $dom->getElementsByTagName('a');
	foreach ($anchors as $element) {
		$href = $element->getAttribute('href');
		if(strpos($href,'#') !== FALSE  || $href == "/" )continue; 
		if (0 !== strpos($href, 'http')) {
			echo $href. '<br />SSS';
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
		}else{

			echo 'includehttp : ' . $href . ' <br />';
		}
		$hrefs[$url][]=$href;
	}

	 /*   foreach ($anchors as $element) {
        $href = $element->getAttribute('href');
        if (0 !== strpos($href, 'http')) {
            $path = '/' . ltrim($href, '/');
            if (extension_loaded('http')) {
                $href = http_build_url($url, array('path' => $path));
            } else {
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
        }
		}*/
		echo '<PRE>';  print_r($hrefs);
	
        crawl_page($hrefs[$url][$depth - 1], $depth - 1);

    //echo "URL:",$url,PHP_EOL,"CONTENT:",PHP_EOL,$dom->saveHTML(),PHP_EOL,PHP_EOL;
	//echo "URL:" .$url . '<br />';
	/*foreach($hrefs as $u => $hrfs){
		echo "$u : <br />";
		foreach ($hrfs[0] as $element) {
	        $hrf = $element->getAttribute('href');
			echo $href. '<br />';
		}
		ob_flush();flush();
	
	}*/
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


//crawl_page("http://php.net", 5);
crawl_page("https://www.airbnb.com/careers", 10);


