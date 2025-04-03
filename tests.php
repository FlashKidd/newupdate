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

"XSRF-TOKEN=eyJpdiI6InZNYThxUFRjeHU1YTRKd2p3TjhhNFE9PSIsInZhbHVlIjoiOEo5bFJSSFVpam1pZ0czTDJHSW5seU9qS3BZNGxiWm9URG1PV3Mvb2Y3cmtEUVFXNHB6Q1BySkYzN1YweTVaUUNMYjUxNWVodVhlSE9KSUJsRVQ1ZVFZTkttWnh6U3BodFdNdEdpR1Z3bElvd2s5cXZnMXZaQlhHOFlGcjNtWFEiLCJtYWMiOiIwNGQ4ZGJjMTQ3MGU3ZGNiNGZkZGZmOTIxYTY4MjcwY2ZjM2FmOTMwM2I2ODMxODdhODMzMTNiNzlkMDE1NjAwIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6InNKekdxY1lpNWd4aG5lZ1hyZUx0RWc9PSIsInZhbHVlIjoiMEtVWGpuWHlncHVwQUhCNnlzd1daUTVhNUxZL1hmSnYrRFcyTmVURlRqQ1JNaHNJRTVvSWJrOXNrb3lWWjJlT3l4NTRuQU9SVEIzb2pSb0gxNGxreTBiV09hU0pXc0lSZ3RiZ2lYeENCWllvUjVSa1MvSDV3MEI2VklhVXUyTWEiLCJtYWMiOiIzOWRhZjkwNGQyMTQ1NTU0NWMyYmUyN2NlMjQxOGZkMjdmNDZiNDVmYzE1NGYyMTQzZTI4Yjc3Y2JiYjY1Y2Q2IiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6ImhKR1hSL1RzSzdHUXNXM0JPQ2tOOGc9PSIsInZhbHVlIjoiUUswY2lkR29XOVZQV3BpY3pyRDdoM0tHdUc0bFhKVVZrQW96dVBYekZrenZmTU1VUTFZWmlRd3ZlWlNIMEJDZUxPRU5ZeGFTcmgvcnAwL09vbmRHSDZ1U1ovbno1ZHNReFpFM3dBcWU4UUtPNjlORFpVazdMelhsZGFLRlRMei8iLCJtYWMiOiJhNWU3ZTEzNDhkZmI4M2EzZmNmZGM2NjUyYWM1ZTE3MjE2MGEzYzIzZjcxOGE4NGE4MGM0ZjhjN2VjZmI5N2MxIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IlVTbm5jUWZlSldUckhaNWxoVDYvNWc9PSIsInZhbHVlIjoiNEhjT3RQMXp0ajhBUDk5ZklpSnZBb1FOYWxMUnBEcmdoN0hKMlhPNjZ0S01aRzFmRm8wNm5RU0s2cWtGM3kyb2RSazFOcnhMazY4bXo3b01Xb2dselJWYUd1S25LbzZNOXVLRDFkYTB3c09OUjRlWVdMbkI4ZzdwVW5OeHNmRm8iLCJtYWMiOiIzOWY2ODk5YzdjMGRmM2YwOWIyOTE3YWFlNTEwNDk1ZTM3NTJhNTY0NmQ1YTc0MTFhMzE1YTE5ZmJhMWI1ODQ1IiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6IjNwQkdWcEc2RjVwblh6Y3lpYmdqVUE9PSIsInZhbHVlIjoicGVSTGUzd0svWnMzenpLbmZxZWR3TXVaQ2RQSFNHWnBtTkFzWkVwcnN2N3ZIRmlMZitTeWVxWGxGTlphYlFkWHArNS84TlRVYjFkTFp6T3lMaFBhbllhZklKVVJjWXp1Z3ZQc2hLbks3UUkwOGx4SGFLcDhsZlg3UkVSU1VRN0ciLCJtYWMiOiI3YTFkMjcyMTg5NzIyOTY1ZWQyYTI4N2IyZmJiOTFhM2VjZjQxMDRjZmEyOTliN2IwMjA4YTgxOGYwNjE3ZjA3IiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6Im44Q2szZWRoMTFLTWw5M0plc0JIVWc9PSIsInZhbHVlIjoiNjlKaXpMTk9GM3ZNS20vZlI3d0lCVkloOGhHWUgrN08xZjdSemxJbUxHUHZGMnlHcGZDbHFRV3JqaWQyMVNyNEsyeitSZnZ5bXlralVIb2VSaFd3cFNrUDJzTktUbG1VcmFmQm9nZWxtUG4rY1VtdDgwTCtZa3I1eGV1ZytTc3AiLCJtYWMiOiJhYWM4Y2ZkYzZhZDgyNzE1YWJmMGExNGU4NGY1MTAzMzdkMDVlZmJiYmFjMTc4MWIzMjUwZmViZGI4NjZhOTkwIiwidGFnIjoiIn0%3D"


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

