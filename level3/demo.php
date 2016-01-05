<?php
ini_set('max_execution_time', 0);
ob_start();
$site_scrap_time_start = microtime(true);

function crawl_page($url, $depth = 5)
{
	//echo $url . ' = ' .  $depth. '<br />';
    static $seen = array();
    if (isset($seen[$url]) || $depth === 0) {
        return;
    }

    $seen[$url] = true;

    $dom = new DOMDocument('1.0');
    @$dom->loadHTMLFile($url);

    $anchors = $dom->getElementsByTagName('a');
    
	foreach ($anchors as $element) {
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
		        //crawl_page($href, $depth - 1);
			}
        }
		crawl_page($href, $depth - 1);

    }

	  /* foreach ($anchors as $element) {
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
			$hrefs[$url][]=$href;
        }
		}*/
		echo $url . '<br />';
		//echo '<PRE>';  print_r($hrefs);
	

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
crawl_page("http://php.net", 2);
$site_scrap_time_end = microtime(true);
$site_scrap_time = $site_scrap_time_end - $site_scrap_time_start;
echo  $site_scrap_time	  . ' secs'. '(site scrap time)<br />';
