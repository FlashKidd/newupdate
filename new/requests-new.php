<?php
require_once(__DIR__ . '/../Tools-mtn-v2.php');
$scoreTarget = TargetScore();
system('sudo rm -rf cache');
require_once '/var/www/html/newupdate/Zebra_cURL.php';

$curl = new Zebra_cURL();
$curl->cache('/var/www/html/newupdate/cache', 59);
$curl->ssl(true, 2, '/var/www/html/newupdate/cacert.pem');
$curl->threads = 10;
$curl->option(CURLOPT_TIMEOUT, 2400);
@unlink('cache');

$starttime = microtime(true);

$cookieFile = __DIR__ . '/data/cookies-mtn.json';
$maxConcurrent = rand(2, 4);
$selectedIndexes = [];
$urls_ar = [];

/* Step 1: Safely grab cookies */
while (true) {
    $fp = fopen($cookieFile, 'c+');
    if (!$fp) {
        sleep(1);
        continue;
    }

    if (flock($fp, LOCK_EX)) {
        rewind($fp);
        $contents = stream_get_contents($fp);
        $cookies = json_decode($contents, true);

        if (!is_array($cookies)) $cookies = [];

        foreach ($cookies as $idx => $cookie) {
            if (!empty($cookie['isFree'])) {
                $cookies[$idx]['isFree'] = false;
                $cookies[$idx]['takenAt'] = time(); // mark timestamp
                $selectedIndexes[] = $idx;
                $urls_ar[] = $cookie['cookie'];
                if (count($urls_ar) >= $maxConcurrent) break;
            }
        }

        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($cookies, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);

        if (!empty($urls_ar)) break; // exit only if cookies found
    } else {
        fclose($fp);
    }

    sleep(1);
}

if (empty($urls_ar)) {
    echo "No free cookies found.\n";
    exit;
}

$serverIP = trim(gethostbyname(gethostname()));
echo "\nIP ADDR: $serverIP\n";

$urls = [];
foreach ($urls_ar as $c) {
    $urls[] = 'http://' . $serverIP . '/newupdate/xavi-test.php?c=' . urlencode($c);
}

/* Step 2: Do your main task */
$curl->get($urls, function($result) {
    if ($result->response[1] == CURLE_OK) {
        echo "Success: ", $result->body, PHP_EOL;
    } else {
        echo "Error: ", $result->response[0], PHP_EOL;
    }
});

/* Step 3: Mark cookies as free again */
$fp = fopen($cookieFile, 'c+');
if ($fp && flock($fp, LOCK_EX)) {
    rewind($fp);
    $cookies = json_decode(stream_get_contents($fp), true);
    if (!is_array($cookies)) $cookies = [];

    foreach ($selectedIndexes as $idx) {
        if (isset($cookies[$idx])) {
            $cookies[$idx]['isFree'] = true;
            unset($cookies[$idx]['takenAt']);
        }
    }

    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, json_encode($cookies, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    fflush($fp);
    flock($fp, LOCK_UN);
}
fclose($fp);

/* Step 4: Optional auto-recover stuck cookies (older than 15 min) */
$fp = fopen($cookieFile, 'c+');
if ($fp && flock($fp, LOCK_EX)) {
    rewind($fp);
    $cookies = json_decode(stream_get_contents($fp), true);
    $now = time();
    foreach ($cookies as &$c) {
        if (!empty($c['takenAt']) && ($now - $c['takenAt'] > 900)) {
            $c['isFree'] = true;
            unset($c['takenAt']);
        }
    }
    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, json_encode($cookies, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    fflush($fp);
    flock($fp, LOCK_UN);
}
fclose($fp);

$duration = microtime(true) - $starttime;
echo "Execution time: " . round($duration, 2) . " seconds\n";
?>
