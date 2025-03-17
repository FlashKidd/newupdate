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

"XSRF-TOKEN=eyJpdiI6ImhidFpIM01ZeTUrMnFaVENUS1dKb2c9PSIsInZhbHVlIjoiWmVoOTFTbHgzR2tEUjBHbkhLMVJjYlFJZ0lhNU5YNCt5dHJzSW4vbWxLa2ZxL2t2OUN5MXRkOURqQnhWa0EvZkRibWVodXlpOVVKRldoS3RtMFdqMDJVbWxtWjUyZDNzWEFUUFViaWMrT0dHWlVMVE0zOW9JTHVvN29vWjg4dk4iLCJtYWMiOiI3NWFiNTYwZGM3YThiZGQyODY0ZTM1NjMwNTA0NjIxMDExNjU4ZjczYjc1Yjk0ZGM1NzY1ZWRlMDBlZDM1YzY5IiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6Ilc1NUs1TjZTbEJiNW91WDlReDZEQkE9PSIsInZhbHVlIjoidjNlZ1VxSStQZGhEcUxYRWtyUnRhUU9FN2l6VStNNXNJUnJsRGc4R0pocXlNejg0a2xUOUJLSENWVHFCeXRCemNKU3pZNUw5Vk5OMUpUVGZETXdXV09uSjd4T1FOa3dJMGQvRE44N3M2QkFEVTk4MkZCMklNMC9oaVQ5RTdzQnciLCJtYWMiOiI3Y2E2YjcxMjNjOWE3M2I2ZDJhN2M0MzEyYmI3NjBhNzQzNzFjODU0MDBhY2IzMTQzNTVhMTAwMjJiNDMzYmY0IiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6IndMTHluMVZHVWo0aU9sTHZNQ2VEQkE9PSIsInZhbHVlIjoiQVhYSm5uenN6WVIrUGFFQWtQcHVjdDRlc3U4VWVEb0xwd3B2VFgvd1FRUGl4TEp0Z0Q3TWh5bmlWeEVZZlRjMzZGWVZOeWcxK2tDUXVEUU9acWVMcjBneFY1aTFFcmVYbG5tQVZCRjhZZDkxMkQ5MC9sVWJkZUdQaU9WYTVBZVMiLCJtYWMiOiIzMWQ4NGNmN2ZjMjg4ODZiZGZjZWU4ZTViMDU2YTkxNDUzZDA4YWI0MGY3MjIwNjMwYTljZDEzNDRlODhmZWRlIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6InBsTDYzQ3NSTlYxV0t5b3BUbVo5QkE9PSIsInZhbHVlIjoiNktzem1VZEg2NCtJMFdqVFp0VmZVMjlEeGNOMVA5OXphcHdPVEdtMW5aQTJWVUhPWXpBNjVTQVlCVUw4SFFrUE5yZWJvcjNyYkUvMjV5cXJsUHVlM2hoNXFIL3lXaStwSExOSVZhYkZIaCtXaFV5OTdhcFFPNjluZ0tCbTdsMDUiLCJtYWMiOiI2ZTRkMGU2NDQyYzk1NmVlNzE4OTRiOGIwMTliYzIxYjZlNTUwNTRmNWFhMDYzZTVlY2U4ZjU1ZjFiN2U4OTAzIiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6ImY2Z1N2NHJ4UmIvSWlxaWxCOHlyd1E9PSIsInZhbHVlIjoiWTU3S0krLzIrNUpVOXR4VGVxeW53WnJPUlJQNTgvV2M3T0J5RzJCZEZtekNtb3Q0YnQ0Zm10UXFBOXFyTVcxeU0xZmFpTTNWWVl3bWdPUWc3TGtJR0FVZ2pKcHhqS1c3UnAvTitZOSthYkhHZlNqT0JMMWo5ODdLRVNVTkRJUGUiLCJtYWMiOiJmMGEzY2UzZDM5YjJjMDZkNWQxNWJmNGYxOThjNTk4ZDliNDFjNDYyNjA2ZjVjYzcyZjcxN2VjYjQwMzc5NzcwIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IlRkRGFGTDdhYWRmL3ZseTE0bWF2a3c9PSIsInZhbHVlIjoiMkFpTXVRUXI4ckdMT0VOSU4ySFdFNlBEYW9RaEZGa3FodUJRYWxCcTdGQWkrUW5ienFLaldyU0pSNG11cW5ka2J2Yi9BMzFmaDJMd09DWExYZUIySmpOQWRFRFoxTVFaVlpNOFFwL21ZQVEzM0pKUFdJZ3R3L1Y4cVRJSnh5UW8iLCJtYWMiOiI0NWJlZDY1M2RiNjRjOGFkM2MyZmVjZWY5MGI4NzYyYmI3NzU1OWRiZmRkYmFjOWYwZjFmZDZlNDVhNzMyNzNkIiwidGFnIjoiIn0%3D"



    ];

$urls_ar = array();
shuffle($c_values); 
$randomItems = array_slice($c_values, 0, 3); 
foreach ($c_values as $c) {

    
  $url = 'http://102.210.146.144/newupdate/xavi-test.php?c=' . urlencode($c);


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

