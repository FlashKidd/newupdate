 <?php
// sleep(rand(30,150));
// while(true){
date_default_timezone_set('Africa/Johannesburg');
$current_time = new DateTime();
//Business of the day

require_once('Tools-mtn-v2.php');
system('clear');
$scoreTarget = TargetScore();
$number3 = GetTargetScore(1);



    




$cookie = isset($_GET['c']) ? trim($_GET['c']) : '';
//   foreach ($cookiez as $cookie){ 
$pos = GetPosition ($cookie);
echo "\nOur target score is: $number3 at pos $pos";
$scoreBefore = GetTargetScore($pos);

        //while($scoreBefore == $scoreAfter){
       // $scoreAfter = GetTargetScore($pos);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://yellorush.co.za/play-now');
        curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'ofzhbdla-rotate:5hgqeorbbfwm');
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

        ###################
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://yellorush.co.za/new-game-check-user-status/'.$unique_id.'/'.$sigv1.'');
        curl_setopt($ch, CURLOPT_PROXY, 'http://p.webshare.io:80');
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'ofzhbdla-rotate:5hgqeorbbfwm');
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

       

        if($pos == 0){
            $score = rand(17,rand(40,100));
            $score =-100;
     }
        else{
           $testSom = GetTargetScore($pos);

            $score = $number3+rand(50,100);
         
    while(($score-$testSom)>100){
    $score-=rand(1,10);
 
   }
             if($number3-$testSom>100){
                $score = $testSom+rand(50,100);
         }
            
           
             
            
        }
        
        $increment = 1;
        
//              if (in_array($current_time->format('i'), ['17','34','45'])) {
            
//             if($score<$number3){
                        
//             $score = rand($number3,($number3+rand(35,10)));
                        
//             }

//             }
//  if (in_array($current_time->format('i'), ['34','45'])) {
//             if($score<300){
// $score = rand(300,350);
//             }
//  }    

            // if (in_array($current_time->format('i'), ['50','54','55','57', '58', '59'])) {
                
            //    // if ($pos>=6 || $pos ==0){
            //  // $score =  rand(500,1000)+$number3;
           
            //     $score = rand($number3,($number3+rand(10,5)));
           
            // //  if (in_array($current_time->format('i'), ['55','57', '58', '59'])) {

            // //  if ($number3 >= 45000){
            // // return;
            // //  }

            // }
               /// }
               
            //if($score <40000){
              //  $score+= rand(10000,20000);
           // }
            // sleep(5);
       // }
// $score += rand(100,500);
//$score = rand($number3,($number3+rand(10,50)));
if($score>400){
$score = rand(398,400);
}
 while($score>400){
        
        $score = $score - rand(10,30);
    }
// $score = round($score, -1);

// $score = rand(1,50);
//$score =-$score;
   
        ///////////////////////////
        $uA = RandomUa();
        
        //echo "\n<br>UA used => $uA\n";
        $memory = validate_request($x_power,$score);
        $OnePieceIsReal = generateRandomDivisionData($score,$redirectedUrl,$x_power,$memory,$increment,$uA);

//     sleep(rand(40,80));
// }
        


//}


