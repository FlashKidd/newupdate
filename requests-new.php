<?php
//echo "cool down";return;
system("rm -rf cache");
require_once '/var/www/html/newupdate/Zebra_cURL.php';
require_once '/var/www/html/newupdate/round_guard.php';
require_once(__DIR__ . '/round_guard.php');
$curl = new Zebra_cURL();
$curl->cache('/var/www/html/newupdate/cache', 59);
$curl->ssl(true, 2, '/var/www/html/newupdate/cacert.pem');
$curl->threads = 10;
$curl->option(CURLOPT_TIMEOUT, 600);
@unlink('cache');


$starttime = microtime(true);

// Maintenance window: stop scheduling and reset round
if (rg_is_maintenance_window()) {
    echo "\n[Maintenance] Minute 58-59: resetting state and skipping run.";
    rg_round_reset();
    return;
}

$cookieFile = __DIR__ . '/cookies-mtn.json';

$currentMinute = intval(date('i'));
$fp = fopen($cookieFile, 'c+');
if (flock($fp, LOCK_EX)) {
    $cookies = json_decode(stream_get_contents($fp), true);
    $allLocked = true;
    foreach ($cookies as $cookie) {
        if (!empty($cookie['isFree'])) {
            $allLocked = false;
            break;
        }
    }
    if ($allLocked && $currentMinute < 10) {
        foreach ($cookies as &$cookie) {
            $cookie['isFree'] = true;
        }
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($cookies, JSON_PRETTY_PRINT));
    }
    flock($fp, LOCK_UN);
}
fclose($fp);

$maxConcurrent = 1;
$selectedIndexes = [];
$urls_ar = [];
while (true) {
    if (rg_is_maintenance_window()) {
        echo "\n[Maintenance] Minute 58-59 detected during selection. Exiting.";
        rg_round_reset();
        return;
    }
    $fp = fopen($cookieFile, 'c+');
    if (flock($fp, LOCK_EX)) {
        $cookies = json_decode(stream_get_contents($fp), true);
        foreach ($cookies as $idx => $cookie) {
            if (!empty($cookie['isFree'])) {
                $cookies[$idx]['isFree'] = false;
                $selectedIndexes[] = $idx;
                $urls_ar[] = $cookie['value'];
                if (count($urls_ar) >= $maxConcurrent) break;
            }
        }
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($cookies, JSON_PRETTY_PRINT));
        flock($fp, LOCK_UN);
        fclose($fp);
        if (!empty($urls_ar)) break;
    } else {
        fclose($fp);
    }
    sleep(1);
}


$serverIP = trim(gethostbyname(gethostname()));
echo "\nIP ADDR: $serverIP";
$urls = [];
foreach ($urls_ar as $c) {
    $urls[] = 'http://'.$serverIP.'/newupdate/xavi-test.php?c=' . urlencode($c);
}



$curl->get($urls, function($result) {
    if ($result->response[1] == CURLE_OK) {
        echo 'Success: ', $result->body;
    } else {
        echo 'Error: ', $result->response[0], PHP_EOL;
    }
});

$fp = fopen($cookieFile, 'c+');
flock($fp, LOCK_EX);
$cookies = json_decode(stream_get_contents($fp), true);
foreach ($selectedIndexes as $idx) {
    $cookies[$idx]['isFree'] = true;
}
ftruncate($fp, 0);
rewind($fp);
fwrite($fp, json_encode($cookies, JSON_PRETTY_PRINT));
flock($fp, LOCK_UN);
fclose($fp);

$endtime = microtime(true);
$duration = $endtime - $starttime;
echo "Execution time: " . $duration . " seconds";
