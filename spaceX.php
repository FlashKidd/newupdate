<?php
//echo "cool down";return;
system("rm -rf cache");

require_once '/var/www/html/newupdate/Zebra_cURL.php';
$curl = new Zebra_cURL();
$curl->cache('/var/www/html/newupdate/cache', 59);
$curl->ssl(true, 2, '/var/www/html/newupdate/cacert.pem');
$curl->threads = 10;
$curl->option(CURLOPT_TIMEOUT, 3600);
@unlink('cache');

$starttime = microtime(true);


$c_values = [
     '_ga=GA1.1.1490512954.1733123762; _ga_47GFPLWSMZ=GS1.1.1733123761.1.1.1733124006.0.0.0; XSRF-TOKEN=eyJpdiI6Ii9aQzF5eTEzVkdrWTVBZktlbmI5UWc9PSIsInZhbHVlIjoiL29lYXVQMG80aUxVbVNkNGh4Z0lkQkxBVkdBcldWR1FUSWdHZDBBL1RWYW9lbEFVaWdOWC9iVGhDWHo2WDdlVW16Y1c1NTc2bUkzbzVuYUxaQmt1dkt0bnczOXVtZzhEWlBPNTc0MWozbFpmMzZSK1cweW5aRTJPZGs3c1lidHoiLCJtYWMiOiI4NTZhM2EzODBhMGM3MTEzNDBjYTFiZWUxMjJjYWQwZDc2YTlmMGZiNGJiMTA1MjYyNGNiMTM5YTQ4NjNiYjIwIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IitNakdJT2lLOUkvMWhQVU5KL1lnbFE9PSIsInZhbHVlIjoiS1cxYnRWQ0NKT1k3bkI2YWFMdTNzbjFyVjd2NTNEZk9Kb3FrTzNyKzV0UmlRazI1UjhYaEErZ2pKdUYxSjBoZlc3Z3p6NmhXdW1pQWNNQ25BUWtEaXYrS3pvZnViYzV6UktMd05EMmNJRmlFanc4VnhMVkxlYTR0SmJpblAyb00iLCJtYWMiOiI4ZjBlN2Y1YjAzY2ViYzU4NGQ3OGQ0NGUzY2I3YzdjYTlhMTBhMDhiZTdkOGYwNjAzMGNlMzRkZTQxZjAxYmYwIiwidGFnIjoiIn0%3D',
    
    
    '_ga=GA1.1.1373511831.1731512318; _ga_47GFPLWSMZ=GS1.1.1731512318.1.1.1731512500.0.0.0; XSRF-TOKEN=eyJpdiI6ImozamUxUENoL0lrdGRaSEJFOHpxZEE9PSIsInZhbHVlIjoiTDlONVc2QlBjZnFYQkFhSTY5UTAzbVcxRmJmcDU1VHVIU0pyK1p0UVNnSkxKN3kxMjRoZ1ZCVTJ2YnFzVERrTDlDdDZGWEZKdDBwWDhxTmVqMlprc250N3JlRVRjSEc1N3haZ0s1ZGEvdXR6bWFiM1JXcnhCRXFkSDRya21SbHgiLCJtYWMiOiIwYjgyNGJiYTEzNTQ5N2M4ZWQ5YmZiOTExNGE1MDBiYWM2NTA4MjU2YmE2ZTBlYjNmNjgzZDQ4N2UzNzM0ZDNjIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IllmcDlpV0ZuZldtSktTL0pUeFFZVEE9PSIsInZhbHVlIjoiNVFUWWtCbDBmcmh2ODBrMHZxRFQvWGZ5ZmE2aDVCOTdiaEVsKy9EOWZNd3dtOHRJZXI2azNKWWF4QndmNmhVSHRLVVY5MENieTRvdUFxMDNCc3VCTkxKOWhCTVN6cVhEZG9DdEd5NWlnUFNZM0IvRkdNOHVlUzlOdzdxRUUraWgiLCJtYWMiOiI0YTA4Y2ZlMGUyYmU0ODNkZTZlMjExNWExMzY0NGJkMGM2MmFlOTE1YWFlYjJmODA5MTA2MzY1YjE0NzllNjNjIiwidGFnIjoiIn0%3D',
    
     
    'XSRF-TOKEN=eyJpdiI6Ik1MYXV0UTY4ay9uWGZqeGdQSWdpYVE9PSIsInZhbHVlIjoiWDkxc2NjdHk5K2FNays4RDZGVEhIb2JIY3RJZ1FxeVVQVE5Tb3gzaXM5QjV1NGNVbG9KYmtBVkExTXRsbE1LaUJnVXRucTZiWjEvZG54SUIxaytDMU1haW1vdk4vK0kwQ3diTFc1ODRTOHd4NGNYZkFqSm9RSzJvTzdvWGxTeFMiLCJtYWMiOiJkMWQ0YjIwNTdlOGVmMzczYmQwYTJhMjExNTNlMGYyODdjODBhOWM1Y2M4MjQ3ZjMzNDAxYTVmNWQ1MTViZGQwIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6ImRpQTBwSEkxZ3kvQnI5Y2hUbjVTbnc9PSIsInZhbHVlIjoiVzdxMEwrbFVJNndFdGdvY2NWeU9XQW9VVXoyTmJkTjIwMGlXeXJNYTQxK2ZmK1JVNUZvNGc1Sm53TUtMS25CQ1p3MTk4ZzAyUkVpOHpBYXFPb1pJTDJzZFBLSUVkWE5nSHliSE42eXB6cWdhRm0zWDZiY0xCT3JYT1NaVHB5UXYiLCJtYWMiOiI5YmYzZTM1OWZjM2ZmNzQwZjhlZjIxYzYwMWJiNTAyM2JmZTMzZTY0ZGVmMmFjMjgzNThmMmQ5ZTRmYzRjOWUxIiwidGFnIjoiIn0%3D',


'XSRF-TOKEN=eyJpdiI6Ii9CaUJoekwvMjRjNmdKUWFva3R3SlE9PSIsInZhbHVlIjoiOU91djlVMS82R0YvVWo3SUxRTVk5SUloU2I3dkNNS0dJUzhTNXVwdjJkcDllWG84dURYM3RVcC91QXQ4UTdNTERjZUErWE1Xd1Y0b0c4VUwvZWZSMnU0OUN2UjFCYUVlZWdDWUhkN1JsQkx3NWZWOHppczd5Z2pEbkN2bFJINWciLCJtYWMiOiJkNDE2MzYxMmU5NTU3YmEzMzczODFjMTUxMWM3MTJiNjA0MWI0OWM1YWQwMWYxNmU4ZWZmMTUzNGU2YjE5YjI4IiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IlpKNGhEMGgwNy9VOEhpTzVXZDN0aFE9PSIsInZhbHVlIjoibjc5ZlRZWllmRGNBM3hCTnBFSWY1Vy9kenlWQnZQNWZBZXhGVStNbm9pa25xMGxQbmIrcTlNaDd3bTJBeit3Y0NjVC9IMjJYNnZReVBrYis4S212cGR5R1lsL3dpREF0RTQ3d2N2aFE4WnlOM3l3anlheEcrTy9FcnA5OXVQZVgiLCJtYWMiOiI0ZGQ0YzU3YzE1NmU5NzA4NTZmMDY3ZGVhNjEwM2RkMTI4OTA4ZjJjNDcxNDgzMDhhOWNkYzA4MjMxMTkyYjU2IiwidGFnIjoiIn0%3D',


'_ga=GA1.1.1739939425.1731436752; _ga_47GFPLWSMZ=GS1.1.1731436752.1.0.1731436758.0.0.0; XSRF-TOKEN=eyJpdiI6InlscWlIaWdtckRuQUNyMFJzRGNGcFE9PSIsInZhbHVlIjoiSTRTc3crT2Uxb0FGQmdFb0pnVngrVjkxeTRmMy9QeWpsWlFqWVV4dVpsSlhoT1pPRFJnb3FmblluQ0s3WVd5MEw0MndFSysrQ0ZqRmg5NTI2cUJQSTFxdGpOR0JGZ2VEL1BJVHF6RkE2ZkFBMnFvQnlRSVdyWFlBbWFIWCtSTXoiLCJtYWMiOiJjOTE0NDMxYTY2NzYzZmIyNDU4NDMzMGNjNGZiMDhiODE3OWQyOGNlNDRmMDBhZDgwY2Y1MzJlOTVlNjdjZGY0IiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6InF0YmRkZCtPZXRnd2x5UUtkdGNCOEE9PSIsInZhbHVlIjoieER6WXQvQnNOa0xmalNkNTlaY1pHZ2k1NkhGQ1BLWndiTE5wWWY0NWV0b1BjaUt1RENuOC91YkZpUlRndTVJNWJ0d0NhejVhbGlFSUlkTDdlcGRnekpxb0tBZytEaFV6SHlHc0ZUSzJ0amdoeWdwbi93T2lOaUVrYUNTRldQeE4iLCJtYWMiOiI2ZTQ5YzYwZjdhZmY0MjJjZWQ5YjRjNzg3NWY3ZGYzYzE0YTNmZDVkYzRjYjljNmQ2YTQyOTdmYzA1NGRhZjY4IiwidGFnIjoiIn0%3D',

"XSRF-TOKEN=eyJpdiI6Im13T3JBNUo1RGoxT203eW04UkRsaUE9PSIsInZhbHVlIjoiMHJiVDNlV2V6QXVoQllYNlhRZUZ0ajlYTW1CR3dHUUVGU2p6QWhFSm15bkNUdnQwcnlnSDJPc0RYTUtWT0daM2UrMStObTIrWi9oME5rUy9KcStGc3pzQWVwZWVNSW50V0dPaDN2aU1wY0swMTNpUTEzVUZxMmNTNXczOXMwaGsiLCJtYWMiOiJlOTc4OGQ2NDc3ZjM5YzUyNTg4OTcwODMxNjExNDBiNDlkODdmMTM5ZGU3MmQ0MTcxNmQxMGRhOGM4ZTIxYzM5IiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6InNYbVNHZW5TMmxpemVHekNYU3NZZHc9PSIsInZhbHVlIjoiREpzS001eWFnbVMwY2RJUVEvQlFsQVA3eTVCTVFsbEZmK0pkZ2p3N0ZFY2VvckE5Z1NMNXhaOVVFL1N1cFZkU2xianc2UHNpaTB5clZFd0N0MjNrNXo5dlpxT2c0dW9JY0dWUjJna1hmNHlxZDMvRnI4NkM2RkNzTElWb0dxSkQiLCJtYWMiOiIyMjAyNGI0ZTczZmRkYmQ1NDM0OGE0NjU3NzNiZjA2NDViNzI3YmEzMzdmZTMxZjhiZjE2OWQ1YzdjMmJjODY2IiwidGFnIjoiIn0%3D",

'XSRF-TOKEN=eyJpdiI6InlpT3lIVGt0RXIyR3o0U1JxWmk3a0E9PSIsInZhbHVlIjoiVXJ5dTFPK3RLOGZabHZpaGNDejFoTmM0czhRMEE2cm1tc0pnUks1SThFZDEyN2hzc3QyVktabzNHNlJ4Mm8zTUQyK2h1L2YwN1l0S1hQcFMrdGVUdzJydEZucDNWQlF5ODF0bGZlNkw1eW1yR3U2QzB5MzBSVWJJVW41NnYxTGciLCJtYWMiOiJhZjRjZThlMjhjZTY4ZDE3MzExZmEyMWM5OWE5MmE4OTk0MDMxM2I2MmM5NWY1ODFjYzdjNGQxYTZjNWYwZDU4IiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IkVVMmIrMmNpT1piRUMyNnBWRjFRbUE9PSIsInZhbHVlIjoiTUVGTTR6SllPd3cxcTJsL3MxYVp0OEVxZmxmT1BDU2xQNnZBR0dNamwvcXJ4UVU0Zk8xZ1UwRTlONkFlVnRKNk9oY0x0Nmo0QmZpeVF4K3BRZGViMDRHMGI1QlVRaTU0cHY2UFYyYlhnZEhBUFc1dnVLYStNZU9FSm9QM2I4L3IiLCJtYWMiOiJlM2EzNzM5NzY0ZmZjOGUxM2U3NzVhZmEyYTNkYWNmMDQxMTgzMTAxYmM5YWQ1NTZmNDJhMWMxNmI3OTFlMjhlIiwidGFnIjoiIn0%3D',

'XSRF-TOKEN=eyJpdiI6IlNaclhnYU9MbzEwVGdaUjUzQ3hRUmc9PSIsInZhbHVlIjoiMUdndXRzYmFBRUIrSTRQZ1l6NEZWUVJFUDNHR2hzTC9wYTgxUFFvdEtuMlVQUThvSWhmUjRhVk8vN0VZamgxbFVRQjJiYXNSaWc4VjVFNk1qZkRSZ3FoTWRZb3BDZExlblE5WGVWZTVrcGN0c3Ayd1NJSnhZRHc2T3daMTB0WWQiLCJtYWMiOiIyOWQ4OGIyNDNmMTI0N2U0M2M4ZTg4ZTk4Mjg0ZjgwMmE0ODQwZDhjOWEyYTY2YmQ1ZDAyOWE1MTJkODRjNjVlIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6InlGVFFIc1lUQUVlM0dLYkc2RzBxK0E9PSIsInZhbHVlIjoiRGVMV2hZZkloV1k5NjFDQzRRWWZOQ0t4elR2TnF6UmxPazRMeHM1bTBaajFvY05Yd2FZeHJ6bi9LYys1Y3N0dnVwNUJoMXJpL0JWMEJLZU1Db1FPb1B5ektOYVg4NDN6YkpINnVONi9seC94YmszTjk4d1Q5NWlOZTMvSjB1T3IiLCJtYWMiOiJjODgzYzhiNWY2ZjE1NjI5YzZlOTVlODY3NmVjOTg1YzllMWVhZjdmNDE3OGE3ODI4YTI4M2FjMDJhODYwZjlhIiwidGFnIjoiIn0%3D',

'XSRF-TOKEN=eyJpdiI6IlAyc0xjWlRXbU8ycmJzQ1VvVEJCYkE9PSIsInZhbHVlIjoiWTRvODNkN0JWbk1ueDNjZnN2alRrSlpISzl1b2tHOG5KME4wL3htandZWUNqdERzWTQya3FKYTA1YnJrMG5mTm0vbmtDeFliRFFWTDQ0TkZtVXdmNFpneHZNZCtIa2dQaHRBVzRFaC92aTNrbGY2L0g5c3RPZ3dGai80UVNENU4iLCJtYWMiOiJlZmExN2ZlODQ1YWU4YTMzYzQyYzYyYTdhODY0ZTc0ZWQ1ZWQ1OThkNmViN2QxNzJhMGYxMmQzZmUzZWM5YmQ2IiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IlN2OHg4a0szS2FEa255a1NIUDJZakE9PSIsInZhbHVlIjoiTjJONCtHWmYvd0NFMDUwaGNqUFpiQXlaWTBKamt1NXA1aWVGYVlWbCszd1ZVcXJzelJVTlNVODJ4TXdJOW0zWncrRkxUSmNOUDgrV005RVZZZ0VnYVJUdS8rdEFCc2hlL0cyVGVKTUpEQW5hNFF6ZVBvYzF0ZzBQQVhhcDdNTEMiLCJtYWMiOiI4NjgzOWFiZWQ5MDVmOGFkZmRmMGVmZDFjNWUyYzc3NGFlYjllOGNiNWM2MzBmYzg5NDNmY2NkMjgwNjQ4ZDc1IiwidGFnIjoiIn0%3D',
];

$urls_ar = array();
foreach ($c_values as $c) {
    $url = 'http://102.209.117.85/newupdate/xavi.php?c=' . urlencode($c);
    array_push($urls_ar, $url);
}

// Define batch size and delay
$batch_size = 3;
$delay = 30; // 1 minute 20 seconds in seconds

// Calculate the number of batches
$num_batches = ceil(count($urls_ar) / $batch_size);

echo "Starting to process " . count($urls_ar) . " requests in $num_batches batches...\n";

// Process each batch
for ($i = 0; $i < $num_batches; $i++) {
    $start = $i * $batch_size;
    $batch_urls = array_slice($urls_ar, $start, $batch_size);
    $completed = 0;

    echo "Processing batch " . ($i + 1) . " with " . count($batch_urls) . " requests...\n";

    // Send requests for the current batch
    $curl->get($batch_urls, function($result) use (&$completed) {
        if ($result->response[1] == CURLE_OK) {
            echo 'Success: ', $result->body;
        } else {
            echo 'Error: ', $result->response[0], PHP_EOL;
        }
        $completed++;
    });

    // Wait for all requests in this batch to complete
    while ($completed < count($batch_urls)) {
        usleep(100000); // Sleep for 0.1 seconds to avoid busy-waiting
    }

    echo "Batch " . ($i + 1) . " completed.\n";

    // Wait 80 seconds before the next batch, except after the last batch
    if ($i < $num_batches - 1) {
        echo "Waiting $delay seconds before the next batch...\n";
        sleep($delay);
    }
}

$endtime = microtime(true);
$duration = $endtime - $starttime;
echo "All batches processed. Total execution time: " . $duration . " seconds\n";


