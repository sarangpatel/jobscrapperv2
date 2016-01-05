<?php
header('Content-Type: application/xml; charset=utf-8');
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><jobs><url><![CDATA[$url]]></url>";
foreach($output as $out) { 
	$out[0] = str_replace('&','&amp;',$out[0]);
	$out[1] = str_replace('&','&amp;',$out[1]);
	echo "<job>";
	echo "<title><![CDATA[{$out[0]}]]></title>";
	echo "<joburl><![CDATA[{$out[1]}]]></joburl>";
	echo "</job>";
}
echo '</jobs>';
?>
