<?php
//echo "cool down";return;
system("rm -rf cache");
require_once '/var/www/html/newupdate/Zebra_cURL.php';
$curl = new Zebra_cURL();
$curl->cache('/var/www/html/newupdate/cache', 59);
$curl->ssl(true, 2, '/var/www/html/newupdate/cacert.pem');
$curl->threads = 10;
$curl->option(CURLOPT_TIMEOUT, 300);
@unlink('cache');


$starttime = microtime(true);

$c_values =[
   '_ga=GA1.1.1490512954.1733123762; _ga_47GFPLWSMZ=GS1.1.1733123761.1.1.1733124006.0.0.0; XSRF-TOKEN=eyJpdiI6Ii9aQzF5eTEzVkdrWTVBZktlbmI5UWc9PSIsInZhbHVlIjoiL29lYXVQMG80aUxVbVNkNGh4Z0lkQkxBVkdBcldWR1FUSWdHZDBBL1RWYW9lbEFVaWdOWC9iVGhDWHo2WDdlVW16Y1c1NTc2bUkzbzVuYUxaQmt1dkt0bnczOXVtZzhEWlBPNTc0MWozbFpmMzZSK1cweW5aRTJPZGs3c1lidHoiLCJtYWMiOiI4NTZhM2EzODBhMGM3MTEzNDBjYTFiZWUxMjJjYWQwZDc2YTlmMGZiNGJiMTA1MjYyNGNiMTM5YTQ4NjNiYjIwIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IitNakdJT2lLOUkvMWhQVU5KL1lnbFE9PSIsInZhbHVlIjoiS1cxYnRWQ0NKT1k3bkI2YWFMdTNzbjFyVjd2NTNEZk9Kb3FrTzNyKzV0UmlRazI1UjhYaEErZ2pKdUYxSjBoZlc3Z3p6NmhXdW1pQWNNQ25BUWtEaXYrS3pvZnViYzV6UktMd05EMmNJRmlFanc4VnhMVkxlYTR0SmJpblAyb00iLCJtYWMiOiI4ZjBlN2Y1YjAzY2ViYzU4NGQ3OGQ0NGUzY2I3YzdjYTlhMTBhMDhiZTdkOGYwNjAzMGNlMzRkZTQxZjAxYmYwIiwidGFnIjoiIn0%3D',
    
    
    '_ga=GA1.1.1373511831.1731512318; _ga_47GFPLWSMZ=GS1.1.1731512318.1.1.1731512500.0.0.0; XSRF-TOKEN=eyJpdiI6ImozamUxUENoL0lrdGRaSEJFOHpxZEE9PSIsInZhbHVlIjoiTDlONVc2QlBjZnFYQkFhSTY5UTAzbVcxRmJmcDU1VHVIU0pyK1p0UVNnSkxKN3kxMjRoZ1ZCVTJ2YnFzVERrTDlDdDZGWEZKdDBwWDhxTmVqMlprc250N3JlRVRjSEc1N3haZ0s1ZGEvdXR6bWFiM1JXcnhCRXFkSDRya21SbHgiLCJtYWMiOiIwYjgyNGJiYTEzNTQ5N2M4ZWQ5YmZiOTExNGE1MDBiYWM2NTA4MjU2YmE2ZTBlYjNmNjgzZDQ4N2UzNzM0ZDNjIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IllmcDlpV0ZuZldtSktTL0pUeFFZVEE9PSIsInZhbHVlIjoiNVFUWWtCbDBmcmh2ODBrMHZxRFQvWGZ5ZmE2aDVCOTdiaEVsKy9EOWZNd3dtOHRJZXI2azNKWWF4QndmNmhVSHRLVVY5MENieTRvdUFxMDNCc3VCTkxKOWhCTVN6cVhEZG9DdEd5NWlnUFNZM0IvRkdNOHVlUzlOdzdxRUUraWgiLCJtYWMiOiI0YTA4Y2ZlMGUyYmU0ODNkZTZlMjExNWExMzY0NGJkMGM2MmFlOTE1YWFlYjJmODA5MTA2MzY1YjE0NzllNjNjIiwidGFnIjoiIn0%3D',
    
     
    'XSRF-TOKEN=eyJpdiI6Ik1MYXV0UTY4ay9uWGZqeGdQSWdpYVE9PSIsInZhbHVlIjoiWDkxc2NjdHk5K2FNays4RDZGVEhIb2JIY3RJZ1FxeVVQVE5Tb3gzaXM5QjV1NGNVbG9KYmtBVkExTXRsbE1LaUJnVXRucTZiWjEvZG54SUIxaytDMU1haW1vdk4vK0kwQ3diTFc1ODRTOHd4NGNYZkFqSm9RSzJvTzdvWGxTeFMiLCJtYWMiOiJkMWQ0YjIwNTdlOGVmMzczYmQwYTJhMjExNTNlMGYyODdjODBhOWM1Y2M4MjQ3ZjMzNDAxYTVmNWQ1MTViZGQwIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6ImRpQTBwSEkxZ3kvQnI5Y2hUbjVTbnc9PSIsInZhbHVlIjoiVzdxMEwrbFVJNndFdGdvY2NWeU9XQW9VVXoyTmJkTjIwMGlXeXJNYTQxK2ZmK1JVNUZvNGc1Sm53TUtMS25CQ1p3MTk4ZzAyUkVpOHpBYXFPb1pJTDJzZFBLSUVkWE5nSHliSE42eXB6cWdhRm0zWDZiY0xCT3JYT1NaVHB5UXYiLCJtYWMiOiI5YmYzZTM1OWZjM2ZmNzQwZjhlZjIxYzYwMWJiNTAyM2JmZTMzZTY0ZGVmMmFjMjgzNThmMmQ5ZTRmYzRjOWUxIiwidGFnIjoiIn0%3D',
];
shuffle($c_values); 
$randomItems = array_slice($c_values, 0, rand(1,3)); 

$urls_ar = array();

foreach ($c_values as $c) {
//sleep(rand(0,30));
    
    $url = 'http://102.209.117.85/newupdate/xavi.php?c=' . urlencode($c);



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
