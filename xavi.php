<?php
sleep(rand(20,60));   
// while(true){
date_default_timezone_set('Africa/Johannesburg');
$current_time = new DateTime();
//Business of the day
require_once('Tools.php');
//system('cls');
$scoreTarget = TargetScore();
$number3 = GetTargetScore(1);


echo "\nOur target at num3 is: $number3";


$cookiez = [

'XSRF-TOKEN=eyJpdiI6InlpT3lIVGt0RXIyR3o0U1JxWmk3a0E9PSIsInZhbHVlIjoiVXJ5dTFPK3RLOGZabHZpaGNDejFoTmM0czhRMEE2cm1tc0pnUks1SThFZDEyN2hzc3QyVktabzNHNlJ4Mm8zTUQyK2h1L2YwN1l0S1hQcFMrdGVUdzJydEZucDNWQlF5ODF0bGZlNkw1eW1yR3U2QzB5MzBSVWJJVW41NnYxTGciLCJtYWMiOiJhZjRjZThlMjhjZTY4ZDE3MzExZmEyMWM5OWE5MmE4OTk0MDMxM2I2MmM5NWY1ODFjYzdjNGQxYTZjNWYwZDU4IiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IkVVMmIrMmNpT1piRUMyNnBWRjFRbUE9PSIsInZhbHVlIjoiTUVGTTR6SllPd3cxcTJsL3MxYVp0OEVxZmxmT1BDU2xQNnZBR0dNamwvcXJ4UVU0Zk8xZ1UwRTlONkFlVnRKNk9oY0x0Nmo0QmZpeVF4K3BRZGViMDRHMGI1QlVRaTU0cHY2UFYyYlhnZEhBUFc1dnVLYStNZU9FSm9QM2I4L3IiLCJtYWMiOiJlM2EzNzM5NzY0ZmZjOGUxM2U3NzVhZmEyYTNkYWNmMDQxMTgzMTAxYmM5YWQ1NTZmNDJhMWMxNmI3OTFlMjhlIiwidGFnIjoiIn0%3D',

'XSRF-TOKEN=eyJpdiI6IlNaclhnYU9MbzEwVGdaUjUzQ3hRUmc9PSIsInZhbHVlIjoiMUdndXRzYmFBRUIrSTRQZ1l6NEZWUVJFUDNHR2hzTC9wYTgxUFFvdEtuMlVQUThvSWhmUjRhVk8vN0VZamgxbFVRQjJiYXNSaWc4VjVFNk1qZkRSZ3FoTWRZb3BDZExlblE5WGVWZTVrcGN0c3Ayd1NJSnhZRHc2T3daMTB0WWQiLCJtYWMiOiIyOWQ4OGIyNDNmMTI0N2U0M2M4ZTg4ZTk4Mjg0ZjgwMmE0ODQwZDhjOWEyYTY2YmQ1ZDAyOWE1MTJkODRjNjVlIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6InlGVFFIc1lUQUVlM0dLYkc2RzBxK0E9PSIsInZhbHVlIjoiRGVMV2hZZkloV1k5NjFDQzRRWWZOQ0t4elR2TnF6UmxPazRMeHM1bTBaajFvY05Yd2FZeHJ6bi9LYys1Y3N0dnVwNUJoMXJpL0JWMEJLZU1Db1FPb1B5ektOYVg4NDN6YkpINnVONi9seC94YmszTjk4d1Q5NWlOZTMvSjB1T3IiLCJtYWMiOiJjODgzYzhiNWY2ZjE1NjI5YzZlOTVlODY3NmVjOTg1YzllMWVhZjdmNDE3OGE3ODI4YTI4M2FjMDJhODYwZjlhIiwidGFnIjoiIn0%3D',

'XSRF-TOKEN=eyJpdiI6IlAyc0xjWlRXbU8ycmJzQ1VvVEJCYkE9PSIsInZhbHVlIjoiWTRvODNkN0JWbk1ueDNjZnN2alRrSlpISzl1b2tHOG5KME4wL3htandZWUNqdERzWTQya3FKYTA1YnJrMG5mTm0vbmtDeFliRFFWTDQ0TkZtVXdmNFpneHZNZCtIa2dQaHRBVzRFaC92aTNrbGY2L0g5c3RPZ3dGai80UVNENU4iLCJtYWMiOiJlZmExN2ZlODQ1YWU4YTMzYzQyYzYyYTdhODY0ZTc0ZWQ1ZWQ1OThkNmViN2QxNzJhMGYxMmQzZmUzZWM5YmQ2IiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IlN2OHg4a0szS2FEa255a1NIUDJZakE9PSIsInZhbHVlIjoiTjJONCtHWmYvd0NFMDUwaGNqUFpiQXlaWTBKamt1NXA1aWVGYVlWbCszd1ZVcXJzelJVTlNVODJ4TXdJOW0zWncrRkxUSmNOUDgrV005RVZZZ0VnYVJUdS8rdEFCc2hlL0cyVGVKTUpEQW5hNFF6ZVBvYzF0ZzBQQVhhcDdNTEMiLCJtYWMiOiI4NjgzOWFiZWQ5MDVmOGFkZmRmMGVmZDFjNWUyYzc3NGFlYjllOGNiNWM2MzBmYzg5NDNmY2NkMjgwNjQ4ZDc1IiwidGFnIjoiIn0%3D',

 foreach ($cookiez as $cookie){

        // $cookie = isset($_GET['c']) ? trim($_GET['c']) : '';
        
        //echo "Cookie; $cookie";
        $pos = GetPosition ($cookie);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://gameplay.mzansigames.club/play-now');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array(
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
            'Accept-Language: en-US,en;q=0.9',
            'Cache-Control: no-cache',
            'Connection: keep-alive',
            'Cookie: '.$cookie,
            'Pragma: no-cache',
            'Referer: https://gameplay.mzansigames.club/',
            'Sec-CH-UA: \"Safari\";v=\"15\", \"AppleWebKit\";v=\"605\"',
            'Sec-CH-UA-Mobile: ?1',
            'Sec-CH-UA-Platform: \"iOS\"',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: navigate',
            'Sec-Fetch-Site: same-origin',
            'Upgrade-Insecure-Requests: 1',
            'User-Agent: Mozilla/5.0 (Linux; Android 8.0.0; SM-G955U Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $curl = curl_exec($ch);
        $redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
                    
        curl_close($ch);
        $query_str = parse_url($redirectedUrl, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        $unique_id = isset($query_params['unique_id']) ? $query_params['unique_id'] : '';
        $game_id = isset($query_params['game_id']) ? $query_params['game_id'] : '';
        $sigv1 = isset($query_params['sigv1']) ? $query_params['sigv1'] : '';

       // echo "<br>Uniquie_id: $unique_id<hr>";
        //echo "<br>Game_id: $game_id<hr>";
        if (empty($unique_id)){
                die();
            }

       
        ###################
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://gameplay.mzansigames.club/new-game-check-user-status/'.$unique_id.'/'.$sigv1.'');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array(
            'Referer:'.$redirectedUrl,
            'Sec-CH-UA: \"Safari\";v=\"15\", \"AppleWebKit\";v=\"605\"',
            'Sec-CH-UA-Mobile: ?1',
            'Sec-CH-UA-Platform: \"iOS\"',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: navigate',
            'Sec-Fetch-Site: same-origin',
            'Upgrade-Insecure-Requests: 1',
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        $curl = curl_exec($ch);

        // Separate headers and body
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($curl, 0, $header_size);
        $body = substr($curl, $header_size);
        curl_close($ch);

        
        
        $x_power = X_Power($header);
          echo "\n<br> X-Powered-Version: $x_power\n";

       
$testSom = GetTargetScore($pos);
if($pos == 0){
    $score = rand(19,rand(20,25));
    // $score =-100;
} else {
  
    $score = $number3+rand(10,25);
    if($number3-$testSom>25){
        $score = $testSom+rand(10,25);
   } 
 // else if (abs($testSom - 25) <= 25 && $number3 == 25) {
 //        $score = 25;
 //    }
}

// Ensure the condition is never broken
while(($score-$testSom)>25){
    $score-=rand(1,10);
}

// Round the score
// $score = round($score, -1); 

$increment = 1;
// while(($score-$testSom)>25){
//     $score-=rand(1,10);
// }

// Round the score
// $score = round($score, -1); 

// Continue with the rest of your code
while($score>200){
    $score = $score - rand(10,30);
}

// $score = round($score, -1); 

$uA = RandomUa();
$memory = validate_request($x_power,$score);
$OnePieceIsReal = generateRandomDivisionData($score,$redirectedUrl,$x_power,$memory,$increment,$uA);
}

