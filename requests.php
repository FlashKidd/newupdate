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

"XSRF-TOKEN=eyJpdiI6IjBVZEM5QXI3Y3hjY1J5Q29ab1hKSVE9PSIsInZhbHVlIjoicHBRTHZtbkJTOWpyWDU2TUxwY1dvT2JYZzUwREVwMno2c3NmdTFTRkFKM2JzaVRkSlJ3a0pCc1RIdkErV3lBaWFCdXQ3UVRNdGM5ZWJQU25wTFBtQVNXYy9NTHBvY05VcTFsL3lzbE1Wby9pM0JwclcycTR6T2xQcGRhamkyeEkiLCJtYWMiOiJhY2QxMWQ3NjAzNzUyNjA0NTdiNjBhNjIyMzI4NGU1MDhmZjc0MTZhMzRmYTgyYmIwZjRlOWE5NmY5NGY4MGQzIiwidGFnIjoiIn0%3D;yello_rush_session=eyJpdiI6Ilg5QmJneEI0aGpNMGN2ckJaOG1aMUE9PSIsInZhbHVlIjoiYXNnQWNXUFdybFlxTVZib2FsZW04anVBdVViV0JublVzc2ROZmdPb1dWcXJNeURuQ29SWGVMWEdORUdnb3Z3VWZMc3hwM05odmd3NDFzYkl2d2U5amZoaFNCNzY4TEE0UXBNQ1poQ0ExNFFmZjZNYlZFZU82T0pUMUFQTk1mRVgiLCJtYWMiOiJmNjAyMzUwNmMzYzc2ZDM0YmQwMWU3NTY4MzQ2MDgwMWY3YzI1OWU2YzUzMDk2NmQ4OTg4MDcyNzZhYTk3N2E4IiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6Ii9iem1iU1FTK1gwcFdmMitodmlTcHc9PSIsInZhbHVlIjoiZGkrTlR0MmJIN3V0WndFSHZjc21GK29iUjVLZnZtVHh2d0tVaENBRk94S0pRUEhBT1hKZUR2UlJKZ2Q4ckRjRnZjbVZ0ay9nN0pNbDExQTR3WlRteFBldEp1ZDlha2Y5MXFxWGgvb1gzb3N6aWZUVFF2UW5zem43Q0RtZTB5WkgiLCJtYWMiOiI3NzQwZTMzZmQwZDI4YmM2NGQxOTMzZTI5ODMzM2E3MjI2YzgxZTAzYWNhN2M4ZWQ1YWVjY2NmN2U1ZGJmY2Q0IiwidGFnIjoiIn0%3D;yello_rush_session=eyJpdiI6Ikt4YkFLM3BpaTVvS3hPOE9QSmlrRkE9PSIsInZhbHVlIjoiSFkxOXdtSFFsY0pFQWYvSDBBay9MdTFUNU5WY1hrY1dJLzJscFFPOGo3WFBRN0hLWGpJWDlzWGE2Vis4cGs5Qnl4YlZmVUlIOERxSlR6MmxzZk16Z3NpTkkvcVRYOTY2Z2htYnNyaExQR2VEL2NQZjJRZkR1QzZVbHg2UDY2Y00iLCJtYWMiOiIwM2ExNGE3NTc5ZGZkYTdlYzMwNDE2M2UyOTA2MzNkMWM2N2YxNDA2MTdjNmI5OGI1ZmNlZmU1NjYwOTY3ZWZhIiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6InUzb0ZpWVZGaDJJWTVxSjFlVmhOb1E9PSIsInZhbHVlIjoiaW94b0VtUVEwQkpieHJrenV4RGhQeCtPaU1TelJIMXhkeERNemtYNndCZ1JWRXN2U3hYdzVjSHNpMUV0bDgzdjNnSEJGaWVydmszSTc4eExpZzcrczVhVHd1cVpkRkRRbkc1Q2pMbVBQUmt3UVRNUWR5WTBhdEYzS1o1NnhHVDgiLCJtYWMiOiI2OGE1YzU3NGM2ZTczMzg0MzdmODFmNWE5ZGU0ZjUzOGM0MTQwYjE0YjE5ZmQ5OGMxMzcwZmI5YjZhNDMzODA3IiwidGFnIjoiIn0%3D;yello_rush_session=eyJpdiI6ImowOTFLYUZBTTluaXdWQ3FiMEF1VkE9PSIsInZhbHVlIjoiZHEvYnB6ei9vdkZWZ01tRmpITHlEcktheERKcUtWdktsZzhPUmFGWGFsbTRwTDNvZ3lJcjJsVXdTSlY4RmpmV2xDZ1dMQ1RjdC9WclByUWVLNmxXc0tJZVdwdCtiRnBVZ1piSEhremlmd0FUT3Z5VlBmd3RUbndoQ1ZwbWpqakgiLCJtYWMiOiI0NWMzNjVmODA0MzYzNjcyMWNiN2NiMmIyMmNkMDJkODk2Yjk2MGExODc5MTVjNWFiNTZhZmViZjEwYjYyYzgzIiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6Ii92a05pcDQ2OGVUanNRbGVuQ3BkYUE9PSIsInZhbHVlIjoiMkFqUzBVMzU5QXh0dGpqSGRnR0x0bDVXbjY4WHR1bmVudE9lQzJaSGdMOWxKcm9KYlJ2UVowRFROc0hXdGEydlZqNmRDQjVQRFNtQ2w0Y0VDc3BZcGtLcnN6MDExWm91dGZyeUdWcE9oSDZjSGRiZGRGMGd1S25FN3ZNcUM2eG8iLCJtYWMiOiIwNDk1MTA3MjZhZWJmYTQ4ODNiYjNkMzE2NWQwYmQ1ZTUxM2YzMjBjOTQyNDY2NWMwNzIwMTNhYjNjYzgyMTc1IiwidGFnIjoiIn0%3D;yello_rush_session=eyJpdiI6InBsa3lKLzFycUJsK0RXODVWMGE5eGc9PSIsInZhbHVlIjoiUFE0K3BGWXlyMk9YU2pLNUV1QXpPTnRHOEdQT1d2TUUwYXJpV1hCSENjOTdldGVmWWVrQkNuVDNaU0xqd2ZuUkh4MVZYcWdmUVhWb1VjYVBybFR5VGk4MXVGT2FOTWI1S0pCblN2ZStBdzRJTzZIbFA4K0hENzJ0UjloUTg1Y1ciLCJtYWMiOiJkNjA1NmMxNmM0Yzk5MjQxNDBiNWRmMjcxNzljMjE0ZTZiMmJhN2JjYzk0ZDNlYzNkMjhkYmFkOTMyMGFhYTVlIiwidGFnIjoiIn0%3D",





    ];

$urls_ar = array();

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

