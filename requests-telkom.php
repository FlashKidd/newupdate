<?php
//echo "cool down";return;
require_once '/var/www/html/newupdate/Zebra_cURL.php';
$curl = new Zebra_cURL();
$curl->cache('/var/www/html/newupdate/cache', 59);
$curl->ssl(true, 2, '/var/www/html/newupdate/cacert.pem');
$curl->threads = 10;
$curl->option(CURLOPT_TIMEOUT, 900);
@unlink('cache');


$starttime = microtime(true);

$c_values =["XSRF-TOKEN=eyJpdiI6InpyMXYvbVc5VHUvOFhFQm14WHNEdGc9PSIsInZhbHVlIjoiejI1UkpaVnBVL2xBb0owWisxV0xhaUtUMW5UaUlwWFgxNGd6ZTFiRDVGM09NK20yd05aZ1ZnTU1VMDRsejhwQ05PYVJnM1d1VnFuQmhmVERqc0N4Um5NUkpMbnA2NkhNUFhnZmMrTEs0bWVQUEo1WkZaWmhJc3pYN2xLeFNVMmciLCJtYWMiOiIwZTMxYTU1NjVkNzAwZTllYzMzOTYyMzZiZTlmMjNhNzA0NWQwYzRkMmZhOGUyMDYyZTNlMDNjZWNkZDQzYWU2IiwidGFnIjoiIn0%3D; wozagames_mzansi_games_session=eyJpdiI6IkFyUk5Way9TenJ4TVhwL25SWmFaK2c9PSIsInZhbHVlIjoicVQ5WUZBbDREVEIxTmZuUzV1a1FjenBHc2NTTy95SUhHcTB0TXBTdmhvVHozWndLbGd1OWxWaVJCTGhnZDEwZXcwUi9ERXhWdmR1ZDdwK1plMmM2R0VlNWlDMjFibmFWYTlEZFcyR1RPM0RqS090WjNBM2MvZVhFdzZMcVQ2YjAiLCJtYWMiOiJmZjJkNzA2NjUzNDdlY2IwYzRmYWIzNDBiZTIyNjkwZDJmMjk0Y2ZlZmU3NDM3NDY3NDhiODE0N2I2NTc4MmY4IiwidGFnIjoiIn0%3D"

];

$urls_ar = array();

foreach ($c_values as $c) {

    
    $url = 'http://167.71.187.98/newupdate/xavi-telkom.php?c=' . urlencode($c);



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
