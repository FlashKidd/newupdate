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

"XSRF-TOKEN=eyJpdiI6IlJBbEVnMmdUcSs3MUhHd2txZVFaRnc9PSIsInZhbHVlIjoiTE53QVI5VmNzWHB5cTFLN0huK3IrUXlYZ2ZDNVZYcTIzM1lDQ2VDdnR4VlFzZ3FmaXFldzZLdTZiSUR4ZXAyTFNpZDZYeUZXUG10VDd5T0dXeU41SHB0V0gva0JkVHBmbXVuU1BhTEhBWmppaENLWm1Tb1htbWw0MGNGUGNtM3QiLCJtYWMiOiIwNTQ1MTZhZWVjOWJiMTZlNDkwNWUzZTIwMGQzMDJiNTI5MDM5OTNhMTc2YjEwNGJhZDk4YTZjMDgyM2YxMWIwIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IlhjRkRtbUtJZTBCTTAvMExHVkZRUFE9PSIsInZhbHVlIjoiYTJaZ1JkV2ZIVHY4UDZIMDFZQUFQWTQ3czBUZXZzRDJwZXRSUG04bzVDc2RHTko3QnVOV3BsYVJvVkh0QjF4RnplRWV3d25TRkxpT1lTYnRrQlZDUXhKeWhBMGxERDlHWVZIc0hRalIvekplNFRjT3FPZU9EMmdrZGEveHpESXoiLCJtYWMiOiI2ZmU0NzgyZDI1ZTE2N2M4MTU1NmY2MDA3MzVkNTFlYzJiMjg3Nzg2ZGQwOWY3NzJjYWY0OWFhMzEwNTJhOGNhIiwidGFnIjoiIn0%3D",
    
"XSRF-TOKEN=eyJpdiI6ImxCbmlXM2tQR1FpQ1hPQUVIRnJYTVE9PSIsInZhbHVlIjoieXUvZ2NGZzhJbGtFTndyL0RUMGRIYnNTbDA1T0tVM3FQQlVHcnJydncweWdXT0hkS3lvejVMZGc5enFUZTRQcnRZa2dUNDFrVlNoYUcrV0xiMWhCaWRHUTZXWWcyRHZGbEczTHNRM1Y0L2Q5L2U1bVZZZWdONFlrdzBDUmlaRnMiLCJtYWMiOiJmOGM5MDI4ZDc3MDczN2E4YTc0ZDNjY2RkMjUwYzVjMGRhZTdkMjlkM2E5NGFhZTc5YTg0YjIxODQ0N2VhMzNmIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IkRsM05kQXZPaDlxdkZHcVRYNUoza1E9PSIsInZhbHVlIjoiUUdlNXMzbHMzVWlDTThVTFJVTktHUkVIZVFWeUEyRjlwcGFDUmNOSUlJQS82L3phRGh3cTFWcHNCUlY2U1EwTitNcGphNkRadXE5Vi9ocXV5ZUFDNXFmdklqdGRDZXBLUzcxb0hYclppU1RHcVp2c25KUDFpR29TZzZ2MFlPcGQiLCJtYWMiOiIxYTYxYmU5NWUyMjRiM2I0ODAzMjcxZDNkZTJiNmM4ZjhkMmY3YWYwNTI3NzQ3MzY4ZGQyNTU3N2NkMmE2NGRlIiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6InpkaDdQc1NJNGRSZUM3SjhqR3YyQ0E9PSIsInZhbHVlIjoiRkd2bTdQSW9uamJSS0IvcVgzRjFsMkE2VGtwbWtRWVBwbDRhemVmd043RDNlNHExeGdDQi9XQlNiWjRoSkw0TXRmb0k1V05sWWZHUFdDS0RMN0IzdXhIZEJidWFqV3k1eUNTaDVDb2tvR3JuK3hDcnlBK1FqdU8yMXpXQzk2cHoiLCJtYWMiOiI1Zjg0OTAyZTJhMjE0NjdkZTM1M2ZiMWNmZmIzYTNhOGVlZWQ3NzY1NjIwZDY3OGY1MjZhMDg2NzA0ZTkyODBhIiwidGFnIjoiIn0%3D;yello_rush_session=eyJpdiI6IllsUEUreE1aTzBtNWVScDRNNGRBWmc9PSIsInZhbHVlIjoiT1lKZDR4NmlWRFA4ME5ESE5ReWdVeXhHNk1QTVRqaXBPcy9iSWZZYTFRMXlrU0o0REs1c0hXRGUrKzllVll0emc3SFNBaU03OFN0U0lCWTVKUy9TUGs4dndhUy9tckR0L2RjbStZRnAxU0c4QzBMUktQQkQyUjd5M0s3UDRKdm8iLCJtYWMiOiJmMmYzNDFhOTM2M2Q4MTNkODE1ZGY4ZmM2ZTRjYjQ1M2EzODFlNjVlMTA0ZGExNzIzY2RmNmEzMTY4YTZjMDk4IiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6InFScjVNNEtTOXZKWUdFeTBHc3lHbFE9PSIsInZhbHVlIjoieDU5blNHamZDUE1YY0RQNEZoZk00dFdBMXZYcXFQT290SHFTNjNjLzJOZVQ1dGdmcTN6RUFmMWhEVW9LdVY2WE9zL1hnSzhZQVFkc3F0UWZhVnVzb1V1VWpMVTNITTBRVldDYVJQNjkxS2k4ejJpUVlCTnpKS3ZDQVpvdktHdmQiLCJtYWMiOiIyMDZiNGVjMzM4NWQyZGI2OWQ4NjViMDkyNTJkYjY3NGI4MmI4NWZiNGU3YjA3MGQ2NmQ1NjVjZWY0YWU5YTJiIiwidGFnIjoiIn0%3D;yello_rush_session=eyJpdiI6IlFxbkxMNUFVQ284Nlh5OVo1WS9NN2c9PSIsInZhbHVlIjoiUElJaG55ZFJXOWc1emVaaWl4S1B4KzMrZGk4UVo5dzZVN0Q3d2ViVFdyOUM3MXNrazY1MlpSZHJhL1ljSkxYSlFHdWdmZUI2c2V6TVNnZkNhNkUyK29VVkFNK01yU0syVTA1VG0zcmh3L1dwTzB4OTdLOHhKZHdNWEJFTlpOZGgiLCJtYWMiOiI4OTAyNjcyNDhhMTRkZTNiM2UxMGZlMzYyM2ViMmI2MDE0ZmIzYjI1YjE4OGYzNmRiMjRkMjI5MTJiYWVkMTA1IiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6InlUS1RZekY1SHlkTjMzbThTSGNWNmc9PSIsInZhbHVlIjoiTUswYWdlQ2k4UUR2ZzNTYm9iYjRaa3dYb2JPT1FTNFY0RE54bm9nQzltVW1jR1ltcFR2U3V6cHhaRUdmemdicXhldHo2cGRmZTFQYWdCNWp5RmJnSlRjU2RzSXRBcUFVUzRhazZ5S0hmM2dTUHNWZTdqcURaTnhBSXZiZWFibHEiLCJtYWMiOiI0MmExOGJiYmVlYTQwMWM0OTBhYWNmOWYxYjQ0MjlmOTI5ZTBkNmZmMmMxZmZjODg5ZGZmMTg1Mjk1NzgzZTEwIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IkR0dkdvR3dOMjBuZktwMk9XTEdyckE9PSIsInZhbHVlIjoiWVRNQ0dwR3pRMDR0VklPdms3ODVGTjhhRDlBUXdwTGtUZzRLeEh1OUlBekxidUl2TE1UKzRGcGZhRmdUdVpCUHpsNHR3TWs1S2lIdGgxWnZ4SDFLajEwa1lEVWdVWllrektLcHRURVlhN29MdnNuYjJmWkhQaVFRSGt0VmRNMlciLCJtYWMiOiIwZWMxZTgwZGRkNTY5YTAxMThjNWRkYzU1ZWJhNjkwYzUxMzVjYTY0NDA2Y2RiNGY2M2E3OTI3Mzk1N2NlNTcyIiwidGFnIjoiIn0%3D",

// "XSRF-TOKEN=eyJpdiI6IndWNjJSd04vQ2R2Y3RyYnFQcFRPMXc9PSIsInZhbHVlIjoieXpmZVJwaFhFaWhsdzQ5aFdmVDhKaHRLcm5jODRRTzIxcGFVaTQ3RTRDbVFDczBiRzA2NTVsQTI0NmYyQjNobGV3VTRjZDVERE9XL3BrdDNqc25yTUY1SXR0TnBUaEE3UXJMaHh6enlrYWt3THFGcUpQbk1JVVllZHd1SkhUdW4iLCJtYWMiOiI4N2RhYjI4YzZiODNjZGZkNzk3N2NmMjAwODk2MDMyMzczMDRjMjkzZWRkODkyMTliNzRiMjljNWVhM2JiYWY0IiwidGFnIjoiIn0%3D;yello_rush_session=eyJpdiI6Imk1SldzVyswU21WUFlkbzVGRG05V2c9PSIsInZhbHVlIjoiaUxlRFdOU0FVemd6aGJRQ1hsNmxNZmtUU2xFT2NRTXlaQXRKTDlLVERHT3VYYWI4eTlkL0RKWVJoeExVaE9NT0pqR0xlaUhRb09SREJGWlk1WS9ZZ0JpYnNRZ2tsNVNDbmthSEVoU1hvU2YvMlg5TnpoK3k5YnZFeUc3NGN1a0ciLCJtYWMiOiI2YjAyZjQ2MzA5YjdkMmUzYjU2NTI0YmRlMTYxNDg4Y2I0Mjg2Zjc0NzcwMzgxODQ2N2FjNDI2ZGY3YzIwZDk2IiwidGFnIjoiIn0%3D",


// "XSRF-TOKEN=eyJpdiI6ImN3cjhHNktUS0d0TEZmZFhmK3FKMVE9PSIsInZhbHVlIjoiT1BZWHpKRklqdm5aeVBJVktYS2RSYytKVHZmV0F6WXNwdkFyeGp4WWdNUXhlUDVCdjY5clJLMENaYTlRcTdWOTZpY2RBZnNpOHBFRGlyN25EdHBMdmN3VVdxT1B0L1l6R0ZsczFUTTE5UWZ2ZVdsUS9uNEtjMDF6dUpRV2pMS3oiLCJtYWMiOiI5NTJlOWE0YzllZDA4NGIxYTk2ZDhlNmFhYjdiZjZlMjhkYmRjNGY4YzdiMjAwNzY4ZDM4MjdmNTk1YmQ5NzRjIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IjIwamZYS3dRUmN2RjhxRHI4a1lqMnc9PSIsInZhbHVlIjoiWTljTTBvRUt5aWNOelMrQ3Y5VWg2TFBTMEMwUmU1V0hxcWFidFJqTVg0QVhObXJUZnQybytqREFlYXJ5cEc5S3Q5Um92ek8xdzUvcTV2VGZRSnZEc25PZDA5TFdvYytjZjZ1L1FiRW1FeFBPTTYyQWlzdGtEdTFXaFNWdHBFS2MiLCJtYWMiOiIxY2M3Mjc3ZTU4ZTI2ODQ5ZDA3MTkzMzQxMWViYTRmYTg0ODcyY2M3NWE0NGJkNGNjNDE3Y2M3YzZjNzA3MDQ5IiwidGFnIjoiIn0%3D",

// "XSRF-TOKEN=eyJpdiI6ImJsSFJQckhPMk5rWTV4ZmNXUG1LT2c9PSIsInZhbHVlIjoiWDJ3M3FPWE5DWWZzRFpFbG9MWjVpemsvRnI5eUlnOEVOZ2g0d0hncTJkMzBpOVl2K2hVL1l6YXFzVy9CN1pnN3ZWVGdwVklKbUlVQVFRYkNhZ213ZVgrZjBHZWhDYW80a2tuNEJXSW1XVzVTd3hQak8rajZxTnlxVjlHQWk1S0wiLCJtYWMiOiJkMjdkZGM0OGI2YzIwNWE3YzA3MmVkOGY0YWE1OGE1MTE2NTM5Yjg2ZDQ1N2JmYzg0NGM1NzM0OTUxNmRhMWQ2IiwidGFnIjoiIn0%3D;yello_rush_session=eyJpdiI6IkgrTkhlQXRFYjY0dE5tQWkvVGVzU1E9PSIsInZhbHVlIjoiOTV0Z0FjRmRCMHhqQTUvejBidjRkZXJ2QXJOVGp5SWRqTE1lajN4ZXhiczJqcC92Y1BtSk1Jc0MyQTRRS25JcEo3ZENpaFpEem5MaWd6cXRLOXgyaWpjVXBYYVFnYzlETzYyNGlHVVM0blNLak9odzZRL3FQdHVMWWFET0VKNmwiLCJtYWMiOiI1ZGMxZjFjMzE2NjQzNjA1NzQzYjlmOTM1NTU1ZjMwNDZlNTA2N2I2OWQzOGViOGE1MzdlMjE4OTQyOTc5MmE4IiwidGFnIjoiIn0%3D",



    ];

$urls_ar = array();
shuffle($c_values); 
$randomItems = array_slice($c_values, 0, 3); 
foreach ($randomItems as $c) {

    
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

