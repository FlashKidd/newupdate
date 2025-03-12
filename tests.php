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

"XSRF-TOKEN=eyJpdiI6InlUS1RZekY1SHlkTjMzbThTSGNWNmc9PSIsInZhbHVlIjoiTUswYWdlQ2k4UUR2ZzNTYm9iYjRaa3dYb2JPT1FTNFY0RE54bm9nQzltVW1jR1ltcFR2U3V6cHhaRUdmemdicXhldHo2cGRmZTFQYWdCNWp5RmJnSlRjU2RzSXRBcUFVUzRhazZ5S0hmM2dTUHNWZTdqcURaTnhBSXZiZWFibHEiLCJtYWMiOiI0MmExOGJiYmVlYTQwMWM0OTBhYWNmOWYxYjQ0MjlmOTI5ZTBkNmZmMmMxZmZjODg5ZGZmMTg1Mjk1NzgzZTEwIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IkR0dkdvR3dOMjBuZktwMk9XTEdyckE9PSIsInZhbHVlIjoiWVRNQ0dwR3pRMDR0VklPdms3ODVGTjhhRDlBUXdwTGtUZzRLeEh1OUlBekxidUl2TE1UKzRGcGZhRmdUdVpCUHpsNHR3TWs1S2lIdGgxWnZ4SDFLajEwa1lEVWdVWllrektLcHRURVlhN29MdnNuYjJmWkhQaVFRSGt0VmRNMlciLCJtYWMiOiIwZWMxZTgwZGRkNTY5YTAxMThjNWRkYzU1ZWJhNjkwYzUxMzVjYTY0NDA2Y2RiNGY2M2E3OTI3Mzk1N2NlNTcyIiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6IndWNjJSd04vQ2R2Y3RyYnFQcFRPMXc9PSIsInZhbHVlIjoieXpmZVJwaFhFaWhsdzQ5aFdmVDhKaHRLcm5jODRRTzIxcGFVaTQ3RTRDbVFDczBiRzA2NTVsQTI0NmYyQjNobGV3VTRjZDVERE9XL3BrdDNqc25yTUY1SXR0TnBUaEE3UXJMaHh6enlrYWt3THFGcUpQbk1JVVllZHd1SkhUdW4iLCJtYWMiOiI4N2RhYjI4YzZiODNjZGZkNzk3N2NmMjAwODk2MDMyMzczMDRjMjkzZWRkODkyMTliNzRiMjljNWVhM2JiYWY0IiwidGFnIjoiIn0%3D;yello_rush_session=eyJpdiI6Imk1SldzVyswU21WUFlkbzVGRG05V2c9PSIsInZhbHVlIjoiaUxlRFdOU0FVemd6aGJRQ1hsNmxNZmtUU2xFT2NRTXlaQXRKTDlLVERHT3VYYWI4eTlkL0RKWVJoeExVaE9NT0pqR0xlaUhRb09SREJGWlk1WS9ZZ0JpYnNRZ2tsNVNDbmthSEVoU1hvU2YvMlg5TnpoK3k5YnZFeUc3NGN1a0ciLCJtYWMiOiI2YjAyZjQ2MzA5YjdkMmUzYjU2NTI0YmRlMTYxNDg4Y2I0Mjg2Zjc0NzcwMzgxODQ2N2FjNDI2ZGY3YzIwZDk2IiwidGFnIjoiIn0%3D",


"XSRF-TOKEN=eyJpdiI6ImN3cjhHNktUS0d0TEZmZFhmK3FKMVE9PSIsInZhbHVlIjoiT1BZWHpKRklqdm5aeVBJVktYS2RSYytKVHZmV0F6WXNwdkFyeGp4WWdNUXhlUDVCdjY5clJLMENaYTlRcTdWOTZpY2RBZnNpOHBFRGlyN25EdHBMdmN3VVdxT1B0L1l6R0ZsczFUTTE5UWZ2ZVdsUS9uNEtjMDF6dUpRV2pMS3oiLCJtYWMiOiI5NTJlOWE0YzllZDA4NGIxYTk2ZDhlNmFhYjdiZjZlMjhkYmRjNGY4YzdiMjAwNzY4ZDM4MjdmNTk1YmQ5NzRjIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IjIwamZYS3dRUmN2RjhxRHI4a1lqMnc9PSIsInZhbHVlIjoiWTljTTBvRUt5aWNOelMrQ3Y5VWg2TFBTMEMwUmU1V0hxcWFidFJqTVg0QVhObXJUZnQybytqREFlYXJ5cEc5S3Q5Um92ek8xdzUvcTV2VGZRSnZEc25PZDA5TFdvYytjZjZ1L1FiRW1FeFBPTTYyQWlzdGtEdTFXaFNWdHBFS2MiLCJtYWMiOiIxY2M3Mjc3ZTU4ZTI2ODQ5ZDA3MTkzMzQxMWViYTRmYTg0ODcyY2M3NWE0NGJkNGNjNDE3Y2M3YzZjNzA3MDQ5IiwidGFnIjoiIn0%3D",




    ];

$urls_ar = array();

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

