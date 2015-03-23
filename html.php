<?php
date_default_timezone_set('UTC');
$date = strtotime('05/02/2013');
//echo date('W',strtotime("Sunday this week",$date));

$curlData = get_curl_data("http://wordpress.org/support/view/plugin-reviews/really-simple-facebook-twitter-share-buttons");
echo strtoupper(dechex(crc32($curlData)));

 function get_curl_data($url){
    $ua = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)';
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url); // The URL to fetch. This can also be set when initializing a session with curl_init().
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); // The number of seconds to wait while trying to connect.
    curl_setopt($ch, CURLOPT_USERAGENT, $ua); // The contents of the "User-Agent: " header to be used in a HTTP request.
    curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); // To fail silently if the HTTP code returned is greater than or equal to 400.
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); // To follow any "Location: " header that the server sends as part of the HTTP header.
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE); // To automatically set the Referer: field in requests where it follows a Location: redirect.
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // The maximum number of seconds to allow cURL functions to execute.
    curl_setopt($ch, CURLOPT_MAXREDIRS, 2); // The maximum number of redirects
    
    $result = trim(curl_exec($ch));
	
	
    
    curl_close($ch);
    
    if(empty($result)){
       $url = str_replace(' ','%20',$url);
       $result = trim(file_get_contents($url));
    }
	
	return $result;
	}

?>