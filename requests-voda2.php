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
"XSRF-TOKEN=eyJpdiI6IjBvNXltMC8yeERtS3I4bERmQngydVE9PSIsInZhbHVlIjoiekk1N1hDcmdIK1JkVnptdjVjaHBlaDZsdW5sSVR3OENWZTk3Tmt1SUxOL05nNEhJZjRCb0I3QkNBekkxQmVRUTZRYXpPRjZaY0FlYUhXYkx3S0tCbmw1alg0REczeG54dTA4ZG9kZUlnNUdGK1kxdWVNZDNQaWhVak53bTZ5cm8iLCJtYWMiOiJjOWQ4N2NkYThmNzI5MjljZGE1OThhOWRhNzMxYjg1MTIzMGNlZDViYWFmMzc4NzFlZGRiZjRkMWVhYmZkNWE3IiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IjkwVXErUWhVWGlRS1JKL0Y3TVloV2c9PSIsInZhbHVlIjoiUjVzZlNOalkxZ201VnJ6OHBDeUVNZ0NtU0tsZlJNR3ZDdUdIdzUwcUU5R0ZGQzVnNDZ1Z05EelYyNEpabC9scWNGRnhtK1F4K0JhMXIvaFNtMUFIbnNuN3hwNFRBUlo2RHZtdEJyTkJmendndTFxQzhTTEh6Yktka1gwS3V4T2IiLCJtYWMiOiI1YTg0MjFhMjQxNmQ1NzcwM2JmMTY0YjJhNjkwY2NkMzI0YWZhNDljOWY5ZmM0MzhkYzZhNzU2NTFlZTllNWI5IiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6Ik95VStiUUJjRVRSNUZpcnFGdjBibkE9PSIsInZhbHVlIjoieTdHb0dZY3lPV2dlcHgvVGNGMmpLNlRXa2Erajk0RFRWd3NKT2t5QzdzbW5oL2FEcWUyWHFCUjZkZ1hwMTJCbHp3Y2RIck9CMFBjWDdHSXcwZkR6Z08yTUhLdW9DeE1PV0VWaFRZellLa1Z0bnNrZUhQaGNlOWlUcmtnK01FRE8iLCJtYWMiOiI1Njg3YTM5MmNlZjgyMzQyMzA5NzJhZDJjMWViMjIwY2EzMzY0NDM5NmQzZDlhNzI3MmE4ZTI2MmY5OGJiMzJhIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6InBBTzU3RXl2S1lGQk1jU2U2d0kxZEE9PSIsInZhbHVlIjoiK3VaRGVkWXVWSjVTanU4amM4eEx6MUMwNTQ4Y214N29GUnlnMjlFSi9RZkhrUllFUHpqdGRudFdiSmttRWErRDhMdDdNYTUwSTQyeHp1ck0xRG5mbGtFVWg1ZEh2Tm9kRUpCY2Ficm5wVGhaVUtheURZTUZuVUYweTZONjNXVDciLCJtYWMiOiI3ZWE5YTI1NWIxZmZiNDIzYTFiN2EwOTJhODVlMDZiOWI5OGZlODczOWQ4OTI1NTc2YTI0NDM4M2YxYTUyOTg5IiwidGFnIjoiIn0%3D",

    "XSRF-TOKEN=eyJpdiI6ImxRdDh6NkxTQUtUbEc4WHAvMUM3Nmc9PSIsInZhbHVlIjoiQjE0NnVGKzdKOWQrV2QzL2NHcnlzZ25LRXBDK3hTODl1TWI3aUQrZmpndjk2YTF6YlY0c0Z1WEk4R0s5SENqZWNoUkJUS01RUzVualFwV2MwRGtHOEtmM0JVc2hpbUF3NFFTZ0lQQzBMZmpLUlhmMXpYT0MzWDNxcGw0T0tNbEsiLCJtYWMiOiJjMmRmNjRkZDY2Y2Q4MTliN2QzMTE3ZjZhOTY2Y2Q2MWU3MTJmNDVjYzBlNzhlMTM5ZTVlYjE0MzBhZDk2NTUyIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6Ikc5RGtvY2VWdlRXZkFmR0tUd2xGOWc9PSIsInZhbHVlIjoiRXk0YTRoYlVwV1lhay9icmcwV3lFRlRUbFlxR2lpKytxK3lPM1Vwem5xYTZCZHNZQjBBTHRHUitCZDhsNlNoeHVmQ1JLZnh1K3RmWjVGZTBOelpKSHFsaktwZ3NsZ2NYRlhOc1ZPS0lwK1lqT2VKM0ZQbDFsMUlwS1pEVHlqamkiLCJtYWMiOiJiM2VmNWM5NGVkNmY5OWVhNDUzNTY1OWMyYmIwMTViZjQzNmQ3MTAxNDA0YTg1MTA2ZDdhYmE1ZTBmNWI3YmRiIiwidGFnIjoiIn0%3D"
];

$urls_ar = array();
shuffle($c_values); 
$randomItems = array_slice($c_values, 0, 2); 

$serverIP = trim(gethostbyname(gethostname()));
echo "\nIP ADDR: $serverIP";
foreach ($randomItems as $c) {

    
  $url = 'http://'.$serverIP.'/newupdate/xavi.php?c=' . urlencode($c);


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
