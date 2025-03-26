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

"XSRF-TOKEN=eyJpdiI6InRBU3VpaDd3VXZxRlgwMStjTnNOTHc9PSIsInZhbHVlIjoiTzQxK0krRmdIbGJGTEFxbmxicGZ4eXM4YndHRXFQOWRUKzNmbkpZS3FyOXprN2VpU25qdFF1NTRrY3NHK3VjYm15MzVER2ZQWW1lSUVnWFpERXVOalFYY1BNYjBwRHdkV1o0YmwrWnkzdVJIOEpIM2lLMVVKRnN6a0hHZjFKZjYiLCJtYWMiOiJiM2U4MjE4YjIzYWQzYjEyYjgwNDRkNjAxMDAyN2E4NTYwZmI3YWMzNTc5MDg5NzhlYmJkOTRkZDZiMTUzYTJiIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IjdrSEZpZFVtTnVzVG9YT3N4RW4xVFE9PSIsInZhbHVlIjoiVTlhQXhaRGlaNjIwaVhrR05qWWNObHFPZlZKWWVicXZyL0laMmxsRnM5TStPMm1CUnZBN3JoZWZoLzhKdXJ5R0VZVWc1V1RHUmZ3QUIxd3JlaTdJajFYek5CbE94SHpEc3FFVjU2WnZBSG9pZE9vY3FxQWZHUnVaZHM0K0VmLzQiLCJtYWMiOiIxOTc2ZWVkY2RiNjk3MWI0ZDkzMTFkZTZmNWEzMzMyNjE3NzQxMDgyMGQ0MjJmODgzZDBlYzFmMThiOTcwNWUxIiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6IndMTHluMVZHVWo0aU9sTHZNQ2VEQkE9PSIsInZhbHVlIjoiQVhYSm5uenN6WVIrUGFFQWtQcHVjdDRlc3U4VWVEb0xwd3B2VFgvd1FRUGl4TEp0Z0Q3TWh5bmlWeEVZZlRjMzZGWVZOeWcxK2tDUXVEUU9acWVMcjBneFY1aTFFcmVYbG5tQVZCRjhZZDkxMkQ5MC9sVWJkZUdQaU9WYTVBZVMiLCJtYWMiOiIzMWQ4NGNmN2ZjMjg4ODZiZGZjZWU4ZTViMDU2YTkxNDUzZDA4YWI0MGY3MjIwNjMwYTljZDEzNDRlODhmZWRlIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6InBsTDYzQ3NSTlYxV0t5b3BUbVo5QkE9PSIsInZhbHVlIjoiNktzem1VZEg2NCtJMFdqVFp0VmZVMjlEeGNOMVA5OXphcHdPVEdtMW5aQTJWVUhPWXpBNjVTQVlCVUw4SFFrUE5yZWJvcjNyYkUvMjV5cXJsUHVlM2hoNXFIL3lXaStwSExOSVZhYkZIaCtXaFV5OTdhcFFPNjluZ0tCbTdsMDUiLCJtYWMiOiI2ZTRkMGU2NDQyYzk1NmVlNzE4OTRiOGIwMTliYzIxYjZlNTUwNTRmNWFhMDYzZTVlY2U4ZjU1ZjFiN2U4OTAzIiwidGFnIjoiIn0%3D",

// "XSRF-TOKEN=eyJpdiI6ImY2Z1N2NHJ4UmIvSWlxaWxCOHlyd1E9PSIsInZhbHVlIjoiWTU3S0krLzIrNUpVOXR4VGVxeW53WnJPUlJQNTgvV2M3T0J5RzJCZEZtekNtb3Q0YnQ0Zm10UXFBOXFyTVcxeU0xZmFpTTNWWVl3bWdPUWc3TGtJR0FVZ2pKcHhqS1c3UnAvTitZOSthYkhHZlNqT0JMMWo5ODdLRVNVTkRJUGUiLCJtYWMiOiJmMGEzY2UzZDM5YjJjMDZkNWQxNWJmNGYxOThjNTk4ZDliNDFjNDYyNjA2ZjVjYzcyZjcxN2VjYjQwMzc5NzcwIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IlRkRGFGTDdhYWRmL3ZseTE0bWF2a3c9PSIsInZhbHVlIjoiMkFpTXVRUXI4ckdMT0VOSU4ySFdFNlBEYW9RaEZGa3FodUJRYWxCcTdGQWkrUW5ienFLaldyU0pSNG11cW5ka2J2Yi9BMzFmaDJMd09DWExYZUIySmpOQWRFRFoxTVFaVlpNOFFwL21ZQVEzM0pKUFdJZ3R3L1Y4cVRJSnh5UW8iLCJtYWMiOiI0NWJlZDY1M2RiNjRjOGFkM2MyZmVjZWY5MGI4NzYyYmI3NzU1OWRiZmRkYmFjOWYwZjFmZDZlNDVhNzMyNzNkIiwidGFnIjoiIn0%3D"



    ];

$urls_ar = array();
shuffle($c_values); 
$randomItems = array_slice($c_values, 0, 3); 
foreach ($c_values as $c) {
sleep(rand(0,30));
    
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

