<?php
sleep(rand(60,240));
date_default_timezone_set('Africa/Johannesburg');
$current_time = new DateTime();
$check_time = new DateTime('04:00');
$check_tim = new DateTime('12:00');




require_once('Tools-new.php');

system('cls');
$uA = RandomUa();
$scoreTarget = TargetScore();
$number3 = GetTargetScore(1);










$cookie = isset($_GET['c']) ? trim($_GET['c']) : '';


$pos = GetPosition($cookie);
echo "\nOur target score is: $number3 at pos $pos";
$scoreBefore = GetTargetScore($pos);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://rush-games-telkom.yellorush.co.za/play-now');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array(
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
    'Accept-Language: en-US,en;q=0.9',
    'Cache-Control: no-cache',
    'Connection: keep-alive',
    'Cookie: ' . $cookie,
    'Pragma: no-cache',
    'Host: rush-games-telkom.yellorush.co.za',
    'Referer: https://rush-games-telkom.yellorush.co.za/',
    'Sec-CH-UA: \"Safari\";v=\"15\", \"AppleWebKit\";v=\"605\"',
    'Sec-CH-UA-Mobile: ?1',
    'Sec-CH-UA-Platform: \"iOS\"',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: navigate',
    'Sec-Fetch-Site: same-origin',
    'Upgrade-Insecure-Requests: 1',
    'User-Agent: ' . $uA
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




###################
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://rush-games-telkom.yellorush.co.za/new-game-check-user-status/' . $unique_id . '/' . $sigv1 . '');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array(
    'Host: rush-games-telkom.yellorush.co.za',
    'Referer:' . $redirectedUrl,
    'Sec-CH-UA: \"Safari\";v=\"15\", \"AppleWebKit\";v=\"605\"',
    'Sec-CH-UA-Mobile: ?1',
    'Sec-CH-UA-Platform: \"iOS\"',
    'Sec-Fetch-Dest: empty',
    'Sec-Fetch-Mode: navigate',
    'Sec-Fetch-Site: same-origin',
    'Upgrade-Insecure-Requests: 1',
    'User-Agent: ' . $uA,
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


$MAX_SCORE = 500;
$range = 500;
$multiplier = ($pos <= 10 || $pos == 0) ? 0 : floor($number3 / $range);
$attemptLimit = 2;
if ($pos >= 1 && $pos <= 10) {
    echo die("\nStill within top 10 exiting...");
}
while (true) {
    if ($multiplier <= 0) {
        $score = rand(100, 500);
        $min = 100;
        $max = 500;
    } else {
        $min = $range * $multiplier + 1;
        $max = $range * ($multiplier + 1);
        $score = rand($min, $max);
        while ($score < $number3) {
            $score += rand(1, 10);

        }
    }

    while ($score > 500) {
        $score -= 1;
    }

    echo "\nTrying score $score in range $min - $max";
    if ($score > ($MAX_SCORE * 2 + 1)) {
        sleep(rand(15, 45));
    }

    $increment = 1;

    $tries = 0;
    $success = false;
    do {
        $uA = RandomUa();
        $memory = validate_request($x_power, $score);
        $x_power = generateRandomDivisionData($score, $redirectedUrl, $x_power, $memory, $increment, $uA);
        sleep(rand(60, 120));
        $pos = GetPosition($cookie);
        $currentScore = GetTargetScore($pos);
        echo "\nLeaderboard value: $currentScore (expected $score)";
        if ($currentScore == $score) {
            $success = true;
        }
        $tries++;
    } while (!$success && $tries < $attemptLimit);

    if ($success) {
        echo "\nLeaderboard updated with score: $currentScore";
        $multiplier++;
        break;
    } else {
        echo "\nFailed for range $min - $max, stepping down";
        $multiplier = max(0, $multiplier - 1);
    }
}
