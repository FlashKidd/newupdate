 <?php
sleep(rand(30,60));

date_default_timezone_set('Africa/Johannesburg');
$current_time = new DateTime();
$check_time = new DateTime('04:00'); 
$check_tim = new DateTime('12:00');


//Business of the day

require_once('Tools-mtn-v2.php');
// while(true){
system('clear');
$scoreTarget = TargetScore();
$number3 = GetTargetScore(1);

// if ($number3>=400){
//  sleep(rand(10,90));
// }



    




$cookie = isset($_GET['c']) ? trim($_GET['c']) : '';
// $cookie = "XSRF-TOKEN=eyJpdiI6ImY2Z1N2NHJ4UmIvSWlxaWxCOHlyd1E9PSIsInZhbHVlIjoiWTU3S0krLzIrNUpVOXR4VGVxeW53WnJPUlJQNTgvV2M3T0J5RzJCZEZtekNtb3Q0YnQ0Zm10UXFBOXFyTVcxeU0xZmFpTTNWWVl3bWdPUWc3TGtJR0FVZ2pKcHhqS1c3UnAvTitZOSthYkhHZlNqT0JMMWo5ODdLRVNVTkRJUGUiLCJtYWMiOiJmMGEzY2UzZDM5YjJjMDZkNWQxNWJmNGYxOThjNTk4ZDliNDFjNDYyNjA2ZjVjYzcyZjcxN2VjYjQwMzc5NzcwIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IlRkRGFGTDdhYWRmL3ZseTE0bWF2a3c9PSIsInZhbHVlIjoiMkFpTXVRUXI4ckdMT0VOSU4ySFdFNlBEYW9RaEZGa3FodUJRYWxCcTdGQWkrUW5ienFLaldyU0pSNG11cW5ka2J2Yi9BMzFmaDJMd09DWExYZUIySmpOQWRFRFoxTVFaVlpNOFFwL21ZQVEzM0pKUFdJZ3R3L1Y4cVRJSnh5UW8iLCJtYWMiOiI0NWJlZDY1M2RiNjRjOGFkM2MyZmVjZWY5MGI4NzYyYmI3NzU1OWRiZmRkYmFjOWYwZjFmZDZlNDVhNzMyNzNkIiwidGFnIjoiIn0%3D";
//   foreach ($cookiez as $cookie){ 
$pos = GetPosition ($cookie);
echo "\nOur target score is: $number3 at pos $pos";
$scoreBefore = GetTargetScore($pos);

        //while($scoreBefore == $scoreAfter){
       // $scoreAfter = GetTargetScore($pos);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://yellorush.co.za/play-now');
        // curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
        // curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'ofzhbdla-rotate:5hgqeorbbfwm');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array(
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
            'Accept-Language: en-US,en;q=0.9',
            'Cache-Control: no-cache',
            'Connection: keep-alive',
            'Cookie: '.$cookie,
            'Pragma: no-cache',
            'Referer: https://yellorush.co.za/',
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

            // if (empty($unique_id)){
            //     // return;
            // }

       // echo "<br>Uniquie_id: $unique_id<hr>";
        //echo "<br>Game_id: $game_id<hr>";
     $limit = 100;

      if ($number3  >= 150 && $number3 <= 200){
      $limit = 150;
      }else if ($number3  >= 201 && $number3 <= 300){
      $limit = 250;
      }
     else if ($number3  >= 301 && $number3 <= 400){
      $limit = 350;
      }
     else if ($number3  >= 401 && $number3 <= 500){
      $limit = 450;
      }else{
      $limit = 450;
      }
        ###################
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://yellorush.co.za/new-game-check-user-status/'.$unique_id.'/'.$sigv1.'');
        // curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
        // curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'ofzhbdla-rotate:5hgqeorbbfwm');
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

       

if ($pos <= 1) {
    $score = rand(50,100);

} else {
    $testSom = GetTargetScore($pos);
    $score = $number3 + rand(0, 100);
   echo "\n Our score = $score";
    if ($number3 - $testSom > 100) {
        $score = $testSom + rand(0, 100);
    }

        }

      while ($score >= 300) {
        $score -= rand(10, 30);
     }


 if (in_array($current_time->format('i'), ['51','52','53','54','55','56','57', '58', '59'])) {

            $score = $number3 + rand(50, 100);

     while ($score >= ($limit+100)) {
        $score -= rand(10, 30);
     }

             }
if ($current_time >= $check_time && $current_time <= $check_tim) {

     while ($score >= 90) {
        $score -= rand(10, 30);
     }

}

while(($score-$testSom)>100){
    $score-=rand(1,10);
}

echo "\n Our score = $score";
 
if($score>201){

 sleep(rand(15,45));
 
}
$increment = 1;

$uA = RandomUa();
$memory = validate_request($x_power, $score);
$OnePieceIsReal = generateRandomDivisionData($score, $redirectedUrl, $x_power, $memory, $increment, $uA);
// }
