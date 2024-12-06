<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://mtnarena.co.za/tournaments/jelly-collapse');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array();
$headers[] = 'cookie: _ga=GA1.1.648184182.1727083390; _user_1pmY09CHz0AvIH6mEHvk=rEzUr52kooOk1bzvcnyN; _user_1pmY09CHz0AvIH6mEHvk_data=eyJtc2lzZG4iOiIyNzczNzk0Mzg4MCIsImNvdW50cnlfY29kZSI6IlpBIiwidXNlcm5hbWUiOiJMYXB0b3Bjb29rZXIiLCJpZCI6Ijk2MjAyZWFkLTZhM2EtNGY4Ny04N2FjLTQ5ZGI2ZWQ2ZjEyZiIsInByb2dyZXNzaWVyX2lkIjoickV6VXI1Mmtvb09rMWJ6dmNueU4iLCJkb21haW5fbmFtZSI6Im10bmFyZW5hLmNvLnphIn0=; _ga_3EFYL5RL3W=GS1.1.1727083389.1.1.1727087846.0.0.0';
$headers[] = 'user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
$curl = curl_exec($ch);
curl_close($ch);
echo $curl;

