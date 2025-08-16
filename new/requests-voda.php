<?php
require_once(__DIR__ . '/../Tools.php');
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

$cookieFile = __DIR__ . '/data/cookies.json';

function checkCookieFile($path) {
    $backup = $path . '.bak';
    $fp = fopen($path, 'c+');
    if (!$fp) {
        return;
    }
    if (flock($fp, LOCK_EX)) {
        clearstatcache(true, $path);
        $size = filesize($path);
        $contents = $size > 0 ? stream_get_contents($fp) : '';
        $data = $size > 0 ? json_decode($contents, true) : null;
        if ($size === 0 || !is_array($data)) {
            if (file_exists($backup)) {
                $backupContents = file_get_contents($backup);
                ftruncate($fp, 0);
                rewind($fp);
                fwrite($fp, $backupContents);
                fflush($fp);
                sleep(2);
            }
        }
        if (file_exists($backup)) {
            fflush($fp);
            clearstatcache(true, $path);
            if (hash_file('md5', $path) !== hash_file('md5', $backup)) {
                ftruncate($fp, 0);
                rewind($fp);
                fwrite($fp, file_get_contents($backup));
                fflush($fp);
            }
        }
        flock($fp, LOCK_UN);
    }
    fclose($fp);
}
$maxConcurrent = 3;
$selectedIndexes = [];
$urls_ar = [];
while (true) {
    checkCookieFile($cookieFile);
    $fp = fopen($cookieFile, 'c+');
    if (flock($fp, LOCK_EX)) {
        $cookies = json_decode(stream_get_contents($fp), true);
        foreach ($cookies as $idx => $cookie) {
            if (!empty($cookie['isFree'])) {
                $cookies[$idx]['isFree'] = false;
                $selectedIndexes[] = $idx;
                $urls_ar[] = $cookie['cookie'];
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
    $urls[] = 'http://' . $serverIP . '/newupdate/xavi-voda.php?c=' . urlencode($c);
}

$curl->get($urls, function($result) {
    if ($result->response[1] == CURLE_OK) {
        echo 'Success: ', $result->body;
    } else {
        echo 'Error: ', $result->response[0], PHP_EOL;
    }
});

checkCookieFile($cookieFile);
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
?>
