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


"XSRF-TOKEN=eyJpdiI6ImR0RDgvR29vdm5WYjY0RFlteDlCZEE9PSIsInZhbHVlIjoiZ3lUemtoMUN0NGlBc1VMUm9adjhBRjdsZStncHlsOEpuT0hVNzZMQ3loV2MvOXVoMFNFaWlORjBVNlFWR2Nhd0E4S0JFUUtaSDIxVXpGQVJmMVl4a0FMZlQydzF0bWM0R1pxL1pFZ3lpaFVyVW5EZW5ZR1BaTWU5N2E4L3ZmQVMiLCJtYWMiOiJlYTBlMGYzYmMxZWM1YzllYTYyMDkwM2QyM2YxYWEzMjMxN2MzNDI1MTYyYWQ5NjgyYTM1OTAwMGI4OGVlYTczIiwidGFnIjoiIn0%3D;yello_rush_session=eyJpdiI6IjUwdHVVb3ZFNmRJWXZEOXczcU1STWc9PSIsInZhbHVlIjoiV1BXQnV1NzB4S1lpN0c1aG9XWDhMQ3VUdEw1My8vcFByRTlMU2E1ZHNpYi9kTFNoaDFYZG82UW9pNUJTRlFXTmhianY5UTRuSE10c1BOUGduNVJlUWlWdDluaXNXd2JPSjVxOE5ZSXlWcVcvOEFKeUtQM2w5cC91Sks0Q29mVUgiLCJtYWMiOiIyM2JlYWFlMDI3OGRmMTEyYTVhMWNiNjkwMGZjMGMxZjA3MmIzMTk5ODAwNGRhN2UwNTJiYjgzMWQwOTQzMDM4IiwidGFnIjoiIn0%3D",


// "XSRF-TOKEN=eyJpdiI6IjNwQkdWcEc2RjVwblh6Y3lpYmdqVUE9PSIsInZhbHVlIjoicGVSTGUzd0svWnMzenpLbmZxZWR3TXVaQ2RQSFNHWnBtTkFzWkVwcnN2N3ZIRmlMZitTeWVxWGxGTlphYlFkWHArNS84TlRVYjFkTFp6T3lMaFBhbllhZklKVVJjWXp1Z3ZQc2hLbks3UUkwOGx4SGFLcDhsZlg3UkVSU1VRN0ciLCJtYWMiOiI3YTFkMjcyMTg5NzIyOTY1ZWQyYTI4N2IyZmJiOTFhM2VjZjQxMDRjZmEyOTliN2IwMjA4YTgxOGYwNjE3ZjA3IiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6Im44Q2szZWRoMTFLTWw5M0plc0JIVWc9PSIsInZhbHVlIjoiNjlKaXpMTk9GM3ZNS20vZlI3d0lCVkloOGhHWUgrN08xZjdSemxJbUxHUHZGMnlHcGZDbHFRV3JqaWQyMVNyNEsyeitSZnZ5bXlralVIb2VSaFd3cFNrUDJzTktUbG1VcmFmQm9nZWxtUG4rY1VtdDgwTCtZa3I1eGV1ZytTc3AiLCJtYWMiOiJhYWM4Y2ZkYzZhZDgyNzE1YWJmMGExNGU4NGY1MTAzMzdkMDVlZmJiYmFjMTc4MWIzMjUwZmViZGI4NjZhOTkwIiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6IlhseFZrTk9EZmdVdzM3UFlwWHZ6K0E9PSIsInZhbHVlIjoiNEJiclJmdFFRaytaN0U2eFcvRXB1Z1ZCMkd1RHN0UitBRytNZ2FRZEFmWFk4YjY0Z0pjeDljenR6bUthYzBLdDNUWkEvZGczcFU0OHhvUDQzdXovcTRjWktZNU56NFRaRHlMLzBNRi9Ya3ZmYmppR3Z0enZXUmtURzVVMk9scnYiLCJtYWMiOiJlNjliMWY2NmY2NGQ5ZGFhZGMzMWE5ZDVlZTQ0YTg2ZTUzNTE5ZDExMmIzMDFkYTE2MjkzY2U0ZDg0MjU0YjU1IiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IjUxRjJpd3VTckpwYk9hSDF4UE43VlE9PSIsInZhbHVlIjoiUnBuMmpDUittaGl2MzZVdWdlN2lFdjFtT2pmcnJLK3NicmJORFJKS043YWFJSXZFUEZSNmcyZUkwVHo3RzdwMGRFdCtzeHgvR0d4a0k5emcxMWVHY2dLWm5uaHcrT3dkZ3FLVngrSUsyemRheStlSkhsWFZRYVNsN1A0RkJpcTQiLCJtYWMiOiJjOTQ3MDQzMmQ2Zjk0NjJkZGI3NTI0OGEzZTM0N2Q4NzE0YjdlMjVlNjQ0ZDliOTc4MjNlZDUxOGNkMjdkN2ViIiwidGFnIjoiIn0%3D"




    ];

$urls_ar = array();
shuffle($c_values); 
$randomItems = array_slice($c_values, 0, 3); 
foreach ($c_values as $c) {

    
  $url = 'http://102.209.117.85/newupdate/xavi-mtn.php?c=' . urlencode($c);


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

