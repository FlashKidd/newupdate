<?php

//echo "cool down";return;
system('sudo rm -rf cache');
require_once '/var/www/html/newupdate/Zebra_cURL.php';
$curl = new Zebra_cURL();
$curl->cache('/var/www/html/newupdate/cache', 59);
$curl->ssl(true, 2, '/var/www/html/newupdate/cacert.pem');
$curl->threads = 10;
$curl->option(CURLOPT_TIMEOUT, 2400);
@unlink('cache');

$starttime = microtime(true);

$c_values = [

"XSRF-TOKEN=eyJpdiI6IjVKWXFDSTQ1R3RGamhNUzYyVzNtcVE9PSIsInZhbHVlIjoiM0RyTlY4M1dWTGJYMUNGcmJFalVWcWtobExmbTltdzIrM3NvOEhEQjNiT25yRnV1amFLSlhuNnlkMkNHWHA2Q1RFRllJWUtRMWI3UWJ1R1BxRHk2Q1ByUFB2cEJzdlIxWnU1WTJpWUZZd3lRejBMNWtvUTN5MFhEMVgzTG4rN0YiLCJtYWMiOiI1NmMzZDE5MzQ2NTk4NzdiY2ZmMTQ5NGQwZDdmYzJmNzY2ZGVlMTM1YjNhNDA3NGI3ZWNhYjI5YjZjNTQ4NTZiIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IjMvSWZlT0dyUVdVdVN4aXhLeGt4enc9PSIsInZhbHVlIjoicmZmYVFYUzhOMEwvT1dnTm1OSDhVS2gyaEtsVnJvVmsxd3hqVzBxWGlZZmVMZTVtOFd6b0V5UnlUV0o4dE53cFZBZDhyS2VMZ3B0QkhNMzFCelRqYkttMnBXaWNvRlRMNmFYK2N1Tk1tUndIMTYyK2NkS0FzbjlIS1gwYThDRGkiLCJtYWMiOiI3NDNhMzliY2Q0OTIyYTEyMmQ4ZDQ2MjJjZjhlNjBmZjhjMTNjNzhmMTg3NGRmZjVkNzFjYzcyNjQwNDllODk1IiwidGFnIjoiIn0%3D"

    ];

$urls_ar = array();
shuffle($c_values); 
$randomItems = array_slice($c_values, 0, 3); 
foreach ($c_values as $c) {

    
  $url = 'http://102.209.117.85/newupdate/xavi-test.php?c=' . urlencode($c);


array_push($urls_ar, $url);

}



$curl->get($urls_ar, function($result) {
    if ($result->response[1] == CURLE_OK) {
        echo 'Success: ', $result->body;
    } else {
        echo 'Error: ', $result->response[0], PHP_EOL;
    }
});

$endtime = microtime(true);
$duration = $endtime - $starttime;
echo "Execution time: " . $duration . " seconds";

