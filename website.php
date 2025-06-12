<?php
session_start();

$password = 'flashkidd';
$message  = '';
$success  = '';

function fetchInfo($cookie, $url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    $headers = [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
        'Accept-Language: en-US,en;q=0.9',
        'Cache-Control: no-cache',
        'Connection: keep-alive',
        'Cookie: ' . $cookie,
        'Pragma: no-cache',
        'Referer: ' . strtok($url, '?'),
        'Sec-Ch-Ua: "Not/A)Brand";v="8", "Chromium";v="126", "Google Chrome";v="126"',
        'Sec-Ch-Ua-Mobile: ?1',
        'Sec-Ch-Ua-Platform: "Android"',
        'Sec-Fetch-Dest: empty',
        'Sec-Fetch-Mode: navigate',
        'Sec-Fetch-Site: same-origin',
        'Upgrade-Insecure-Requests: 1',
        'User-Agent: Mozilla/5.0 (Linux; Android 13; Pixel 7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36'
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $html = curl_exec($ch);
    curl_close($ch);

    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);

    $phoneNode = $xpath->query("//span[contains(@class,'phone-cont')]");
    $phone = $phoneNode->length > 0 ? trim($phoneNode->item(0)->nodeValue) : '';

    $nameNode = $xpath->query("//div[contains(@class,'user-name-new')]//h6");
    $name = $nameNode->length > 0 ? trim($nameNode->item(0)->nodeValue) : '';

    return ['phone' => $phone, 'name' => $name];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered = $_POST['password'] ?? '';
    $cookie  = trim($_POST['cookie'] ?? '');
    if ($entered === $password) {
        $file = 'cookies.json';
        $url  = 'https://gameplay.mzansigames.club/my-winnings?display=tab3';

        $list = json_decode(file_get_contents($file), true);
        foreach ($list as $entry) {
            if ($entry['value'] === $cookie) {
                $message = 'Cookie already exists';
                break;
            }
        }

        if ($message === '') {
            $info = fetchInfo($cookie, $url);
            if ($info['name'] && $info['phone']) {
                $list[] = ['value' => $cookie, 'isFree' => true];
                file_put_contents($file, json_encode($list, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
                $success = sprintf('%s (%s) has been added.', htmlspecialchars($info['name']), htmlspecialchars($info['phone']));
            } else {
                $message = 'Invalid cookie';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Cookie</title>
<style>
body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
        "Helvetica Neue", Arial, sans-serif;
    background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
    margin: 0;
    padding: 0;
    color: #eee;
}
.container {
    width: 420px;
    margin: 80px auto;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
}
h2 {
    text-align: center;
}
form {
    margin-top: 15px;
}
label {
    display: block;
    margin-top: 10px;
}
input[type="password"], textarea {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border-radius: 6px;
    border: 1px solid #ccc;
    background: #222;
    color: #fff;
}
textarea {
    height: 80px;
    overflow-wrap: break-word;
    resize: vertical;
}
button {
    margin-top: 15px;
    width: 100%;
    padding: 10px;
    background: #00bcd4;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
.message {
    color: #ff6b6b;
    text-align: center;
}
.success {
    color: #4caf50;
    text-align: center;
}
</style>
</head>
<body>
<div class="container">
    <h2>Add Cookie</h2>
    <?php if ($message): ?><p class="message"><?php echo $message; ?></p><?php endif; ?>
    <?php if ($success): ?><p class="success"><?php echo $success; ?></p><?php endif; ?>
    <form method="post">
        <label>Password:</label>
        <input type="password" name="password" placeholder="Password" required>
        <label>Cookie:</label>
        <textarea name="cookie" placeholder="Paste cookie here" required></textarea>
        <button type="submit">Add</button>
    </form>
</div>
</body>
</html>
