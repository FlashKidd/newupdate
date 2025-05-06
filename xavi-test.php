 <?php
//sleep(rand(30,60));

date_default_timezone_set('Africa/Johannesburg');
$current_time = new DateTime();
$check_time = new DateTime('04:00'); 
$check_tim = new DateTime('12:00');


//Business of the day

require_once('Tools-mtn-v2.php');
// while(true){
system('cls');
$scoreTarget = TargetScore();
$number3 = GetTargetScore(1);

// if ($number3>=400){
//  sleep(rand(10,90));
// }



    




$cookie = isset($_GET['c']) ? trim($_GET['c']) : '';
$MAX_SCORE = 3000;

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
            'Host: www.yellorush.co.za',
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

        echo "<br>Uniquie_id: $unique_id<hr>";
        echo "<br>Game_id: $game_id<hr>";


        ###################
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://yellorush.co.za/new-game-check-user-status/'.$unique_id.'/'.$sigv1.'');
        // curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
        // curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'ofzhbdla-rotate:5hgqeorbbfwm');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array(
            'Host: www.yellorush.co.za',
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
    $score = rand(($MAX_SCORE/5),($MAX_SCORE/3));

} else {
    $testSom = GetTargetScore($pos);
    $score = $number3 + $MAX_SCORE;
   //  if ($number3>=2001 && $number3<=3000 && $testSom>=2001){  
   //   $score = rand(2800,3000);
   // }
   echo "\n Our score = $score";
    if ($number3 - $testSom > $MAX_SCORE) {
        $score = $testSom + $MAX_SCORE;
    }

   
        }

      while ($score >= $MAX_SCORE*6) {
        $score -= rand(1, 10);
     }


 // if (in_array($current_time->format('i'), ['51','52','53','54','55','56','57', '58', '59'])) {

 //            $score = $number3 + rand(50, 100);

 //     while ($score >= ($limit+100)) {
 //        $score -= rand(10, 30);
 //     }

 //             }
if ($current_time >= $check_time && $current_time <= $check_tim) {

     while ($score >= rand(100, 300)) {
        $score -= rand(10, 30);
     }

}

while(($score-$testSom)>$MAX_SCORE){
    $score-=rand(1,10);
}

echo "\n Our score = $score";
 
if($score>($MAX_SCORE*2+1)){

 sleep(rand(15,45));
 
}
$increment = 1;

$uA = RandomUa();
$score = round($score,-1);
$memory = validate_request($x_power, $score);
$OnePieceIsReal = generateRandomDivisionData($score, $redirectedUrl, $x_power, $memory, $increment, $uA);
// }
