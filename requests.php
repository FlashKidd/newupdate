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

"XSRF-TOKEN=eyJpdiI6IlJQT1NKeXhJd0RSK2RvTk42UkNGNGc9PSIsInZhbHVlIjoiemUrWnRMVFFBclo4Y09aNnpreGM5anJXS0ZLRWxZMjBLYk8xSVZ4MFVwTVdjMTBNdlJ2NDlNU3o5bUo1QkJ0NUVBd2NwU1NBM3pNaEFDR2J5TUxMQ2thcnlFRDFadm9TeFdKQU1EVDJEOUg3N2Zud2JDQ3FGNEZ5REM2S01mWEMiLCJtYWMiOiJiMzhkOGE5YzFkN2EzMjVjOGYyY2NhYWExOTZiNTEzNTkyYTQ5NzhiYjlkNzA0YTBjNmViMTA5ZDA5MzQxN2M0IiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IlNQVVA2RXdTWDRWakpOMkFKc1hEbGc9PSIsInZhbHVlIjoiazREN1BDVE9Ib09rRW1yb1FFSldMdkxmVXlnbklwMHZFRklTcHJGNmdoUUdRc3IzNzk1MUYvZVlPaktId2V3dlkrakxCaTR5UWtMZ3NKYmZ5RFhZU2hJWlJRQjdBd3MxZVhsSXAyQ20xbm5yR1lXV0IxSCt0M0h4S0pMMysvejciLCJtYWMiOiIyNTUwNGYzNzc4Njc0MDJhMzdiMzE3MTEzNGFiZjhiZTBhNjMyMTc5MTJlNDE0ZTFmNWZkOTBmOWViYzU2NzQxIiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6IjNwQkdWcEc2RjVwblh6Y3lpYmdqVUE9PSIsInZhbHVlIjoicGVSTGUzd0svWnMzenpLbmZxZWR3TXVaQ2RQSFNHWnBtTkFzWkVwcnN2N3ZIRmlMZitTeWVxWGxGTlphYlFkWHArNS84TlRVYjFkTFp6T3lMaFBhbllhZklKVVJjWXp1Z3ZQc2hLbks3UUkwOGx4SGFLcDhsZlg3UkVSU1VRN0ciLCJtYWMiOiI3YTFkMjcyMTg5NzIyOTY1ZWQyYTI4N2IyZmJiOTFhM2VjZjQxMDRjZmEyOTliN2IwMjA4YTgxOGYwNjE3ZjA3IiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6Im44Q2szZWRoMTFLTWw5M0plc0JIVWc9PSIsInZhbHVlIjoiNjlKaXpMTk9GM3ZNS20vZlI3d0lCVkloOGhHWUgrN08xZjdSemxJbUxHUHZGMnlHcGZDbHFRV3JqaWQyMVNyNEsyeitSZnZ5bXlralVIb2VSaFd3cFNrUDJzTktUbG1VcmFmQm9nZWxtUG4rY1VtdDgwTCtZa3I1eGV1ZytTc3AiLCJtYWMiOiJhYWM4Y2ZkYzZhZDgyNzE1YWJmMGExNGU4NGY1MTAzMzdkMDVlZmJiYmFjMTc4MWIzMjUwZmViZGI4NjZhOTkwIiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6IlJQT1NKeXhJd0RSK2RvTk42UkNGNGc9PSIsInZhbHVlIjoiemUrWnRMVFFBclo4Y09aNnpreGM5anJXS0ZLRWxZMjBLYk8xSVZ4MFVwTVdjMTBNdlJ2NDlNU3o5bUo1QkJ0NUVBd2NwU1NBM3pNaEFDR2J5TUxMQ2thcnlFRDFadm9TeFdKQU1EVDJEOUg3N2Zud2JDQ3FGNEZ5REM2S01mWEMiLCJtYWMiOiJiMzhkOGE5YzFkN2EzMjVjOGYyY2NhYWExOTZiNTEzNTkyYTQ5NzhiYjlkNzA0YTBjNmViMTA5ZDA5MzQxN2M0IiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IlNQVVA2RXdTWDRWakpOMkFKc1hEbGc9PSIsInZhbHVlIjoiazREN1BDVE9Ib09rRW1yb1FFSldMdkxmVXlnbklwMHZFRklTcHJGNmdoUUdRc3IzNzk1MUYvZVlPaktId2V3dlkrakxCaTR5UWtMZ3NKYmZ5RFhZU2hJWlJRQjdBd3MxZVhsSXAyQ20xbm5yR1lXV0IxSCt0M0h4S0pMMysvejciLCJtYWMiOiIyNTUwNGYzNzc4Njc0MDJhMzdiMzE3MTEzNGFiZjhiZTBhNjMyMTc5MTJlNDE0ZTFmNWZkOTBmOWViYzU2NzQxIiwidGFnIjoiIn0%3D"




    ];

$urls_ar = array();
shuffle($c_values); 
$randomItems = array_slice($c_values, 0, 3); 
foreach ($c_values as $c) {

    
  $url = 'http://102.210.146.144/newupdate/xavi-mtn.php?c=' . urlencode($c);


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

