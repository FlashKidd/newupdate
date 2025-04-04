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
"XSRF-TOKEN=eyJpdiI6IktmZTg5ZE9JRDd6T0EvK1I0QkpEYUE9PSIsInZhbHVlIjoidStwaWIvTTJ6cm93eGp2N1JyUjlHZ3ZxTGxCa241V3hsNVZxYnFzM0UwRUNmM0VjMDhnaFJsa2Y2ZUVxdDg2VHhwTjhKMmdHWmovV0xkWnhDWVJIaGhIU1h6M09YTTR6dk5WSitPOUdyVDdBVkpyWTQ4MWk4WEt4blBLb2p0SkYiLCJtYWMiOiJhMTZkZDUwNmZkOTVkNmVjNWYzZTZjZGIyMzZiOGI3NDc2OWJkYTMzODk3MGI2NDE4MWQzZjRiOGNiYWZkNWVmIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6Inhzay95SG0wM2kxZjI3RXYxdnNMYmc9PSIsInZhbHVlIjoiSVlBcTg2NzBnR0FkNHlNV3lsbGNmUzBqQWk1WmZkZjVqSU9ZOWdYOW83STVoTjhHWDNMNmtaUzM3YUlxdnFETXVvZjlYYmNJKzYwMVBjbmlqWkQ1bHcxMURuY2FObnpSYWJWNFFvanZ4QlJST0M4QTFubnhRNU9ZeTNXR2tiazgiLCJtYWMiOiJmMDAxZWQwNWU0YmJjZDE5NGYxZWY5ZjVhYWJkODgyZmVlMWNkZjc3NzQzMmY0MjMyNjRhNjQxMjA5NDk0ZjQxIiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6IjE3cnBPN0pSbER3UzBqa3BsRHVTYkE9PSIsInZhbHVlIjoiOTlaazlHa1g2ZjNKZGNRTlFQK091MlhQNnM2QzJvQXU4WmtQSU1DOVBsWVZjS29aenVYSFVTditJVU1TaFdGQm8rQ2VYZlAxZmRuc1BibERnWDl5TjRtSFgrM3dYeWJsc0QzNjUwRUttYWVvZU8zOHkxUjBmYmZyUDE4QlFIaUEiLCJtYWMiOiI2OTIwNzgyMTliNzZlYjhiY2U3Zjg5NTcwYTgyNTljMjExY2I2NjYyMmVlNDJhZTkyYTdhNTFlZDU4YTE3ODc3IiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IlJIWlg0V0oxdDdBRTIrcTBZRjJCcmc9PSIsInZhbHVlIjoiLzIvbVQrQm0wUW5BRjVKTWo3bTJYZy9KV1lVRlppQ0oxMWFVWUgzN21aK1Z6RWNaRjFyZTJZTmwyTmUwU3grMVJrMElIMXpjRytzZ080bEdsZUFWaXNDV0F2YWpudHIzWnV2R3RSajJpU0hMbWJOSTAzSnhCYjNhTkQ0Rnh0S0YiLCJtYWMiOiJjNGNkNDY4MmMwMTc4Zjk3YTUwZjljMWJhYmU0M2UzMTUwZGQxOTY5N2NlNzkxYzAxOGYxOGM0Y2M4MjM5YjZjIiwidGFnIjoiIn0%3D",
    
"XSRF-TOKEN=eyJpdiI6InUzb0ZpWVZGaDJJWTVxSjFlVmhOb1E9PSIsInZhbHVlIjoiaW94b0VtUVEwQkpieHJrenV4RGhQeCtPaU1TelJIMXhkeERNemtYNndCZ1JWRXN2U3hYdzVjSHNpMUV0bDgzdjNnSEJGaWVydmszSTc4eExpZzcrczVhVHd1cVpkRkRRbkc1Q2pMbVBQUmt3UVRNUWR5WTBhdEYzS1o1NnhHVDgiLCJtYWMiOiI2OGE1YzU3NGM2ZTczMzg0MzdmODFmNWE5ZGU0ZjUzOGM0MTQwYjE0YjE5ZmQ5OGMxMzcwZmI5YjZhNDMzODA3IiwidGFnIjoiIn0%3D;yello_rush_session=eyJpdiI6ImowOTFLYUZBTTluaXdWQ3FiMEF1VkE9PSIsInZhbHVlIjoiZHEvYnB6ei9vdkZWZ01tRmpITHlEcktheERKcUtWdktsZzhPUmFGWGFsbTRwTDNvZ3lJcjJsVXdTSlY4RmpmV2xDZ1dMQ1RjdC9WclByUWVLNmxXc0tJZVdwdCtiRnBVZ1piSEhremlmd0FUT3Z5VlBmd3RUbndoQ1ZwbWpqakgiLCJtYWMiOiI0NWMzNjVmODA0MzYzNjcyMWNiN2NiMmIyMmNkMDJkODk2Yjk2MGExODc5MTVjNWFiNTZhZmViZjEwYjYyYzgzIiwidGFnIjoiIn0%3D",   

"XSRF-TOKEN=eyJpdiI6ImR0RDgvR29vdm5WYjY0RFlteDlCZEE9PSIsInZhbHVlIjoiZ3lUemtoMUN0NGlBc1VMUm9adjhBRjdsZStncHlsOEpuT0hVNzZMQ3loV2MvOXVoMFNFaWlORjBVNlFWR2Nhd0E4S0JFUUtaSDIxVXpGQVJmMVl4a0FMZlQydzF0bWM0R1pxL1pFZ3lpaFVyVW5EZW5ZR1BaTWU5N2E4L3ZmQVMiLCJtYWMiOiJlYTBlMGYzYmMxZWM1YzllYTYyMDkwM2QyM2YxYWEzMjMxN2MzNDI1MTYyYWQ5NjgyYTM1OTAwMGI4OGVlYTczIiwidGFnIjoiIn0%3D;yello_rush_session=eyJpdiI6IjUwdHVVb3ZFNmRJWXZEOXczcU1STWc9PSIsInZhbHVlIjoiV1BXQnV1NzB4S1lpN0c1aG9XWDhMQ3VUdEw1My8vcFByRTlMU2E1ZHNpYi9kTFNoaDFYZG82UW9pNUJTRlFXTmhianY5UTRuSE10c1BOUGduNVJlUWlWdDluaXNXd2JPSjVxOE5ZSXlWcVcvOEFKeUtQM2w5cC91Sks0Q29mVUgiLCJtYWMiOiIyM2JlYWFlMDI3OGRmMTEyYTVhMWNiNjkwMGZjMGMxZjA3MmIzMTk5ODAwNGRhN2UwNTJiYjgzMWQwOTQzMDM4IiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6InZNYThxUFRjeHU1YTRKd2p3TjhhNFE9PSIsInZhbHVlIjoiOEo5bFJSSFVpam1pZ0czTDJHSW5seU9qS3BZNGxiWm9URG1PV3Mvb2Y3cmtEUVFXNHB6Q1BySkYzN1YweTVaUUNMYjUxNWVodVhlSE9KSUJsRVQ1ZVFZTkttWnh6U3BodFdNdEdpR1Z3bElvd2s5cXZnMXZaQlhHOFlGcjNtWFEiLCJtYWMiOiIwNGQ4ZGJjMTQ3MGU3ZGNiNGZkZGZmOTIxYTY4MjcwY2ZjM2FmOTMwM2I2ODMxODdhODMzMTNiNzlkMDE1NjAwIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6InNKekdxY1lpNWd4aG5lZ1hyZUx0RWc9PSIsInZhbHVlIjoiMEtVWGpuWHlncHVwQUhCNnlzd1daUTVhNUxZL1hmSnYrRFcyTmVURlRqQ1JNaHNJRTVvSWJrOXNrb3lWWjJlT3l4NTRuQU9SVEIzb2pSb0gxNGxreTBiV09hU0pXc0lSZ3RiZ2lYeENCWllvUjVSa1MvSDV3MEI2VklhVXUyTWEiLCJtYWMiOiIzOWRhZjkwNGQyMTQ1NTU0NWMyYmUyN2NlMjQxOGZkMjdmNDZiNDVmYzE1NGYyMTQzZTI4Yjc3Y2JiYjY1Y2Q2IiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6ImhKR1hSL1RzSzdHUXNXM0JPQ2tOOGc9PSIsInZhbHVlIjoiUUswY2lkR29XOVZQV3BpY3pyRDdoM0tHdUc0bFhKVVZrQW96dVBYekZrenZmTU1VUTFZWmlRd3ZlWlNIMEJDZUxPRU5ZeGFTcmgvcnAwL09vbmRHSDZ1U1ovbno1ZHNReFpFM3dBcWU4UUtPNjlORFpVazdMelhsZGFLRlRMei8iLCJtYWMiOiJhNWU3ZTEzNDhkZmI4M2EzZmNmZGM2NjUyYWM1ZTE3MjE2MGEzYzIzZjcxOGE4NGE4MGM0ZjhjN2VjZmI5N2MxIiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IlVTbm5jUWZlSldUckhaNWxoVDYvNWc9PSIsInZhbHVlIjoiNEhjT3RQMXp0ajhBUDk5ZklpSnZBb1FOYWxMUnBEcmdoN0hKMlhPNjZ0S01aRzFmRm8wNm5RU0s2cWtGM3kyb2RSazFOcnhMazY4bXo3b01Xb2dselJWYUd1S25LbzZNOXVLRDFkYTB3c09OUjRlWVdMbkI4ZzdwVW5OeHNmRm8iLCJtYWMiOiIzOWY2ODk5YzdjMGRmM2YwOWIyOTE3YWFlNTEwNDk1ZTM3NTJhNTY0NmQ1YTc0MTFhMzE1YTE5ZmJhMWI1ODQ1IiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6IjNwQkdWcEc2RjVwblh6Y3lpYmdqVUE9PSIsInZhbHVlIjoicGVSTGUzd0svWnMzenpLbmZxZWR3TXVaQ2RQSFNHWnBtTkFzWkVwcnN2N3ZIRmlMZitTeWVxWGxGTlphYlFkWHArNS84TlRVYjFkTFp6T3lMaFBhbllhZklKVVJjWXp1Z3ZQc2hLbks3UUkwOGx4SGFLcDhsZlg3UkVSU1VRN0ciLCJtYWMiOiI3YTFkMjcyMTg5NzIyOTY1ZWQyYTI4N2IyZmJiOTFhM2VjZjQxMDRjZmEyOTliN2IwMjA4YTgxOGYwNjE3ZjA3IiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6Im44Q2szZWRoMTFLTWw5M0plc0JIVWc9PSIsInZhbHVlIjoiNjlKaXpMTk9GM3ZNS20vZlI3d0lCVkloOGhHWUgrN08xZjdSemxJbUxHUHZGMnlHcGZDbHFRV3JqaWQyMVNyNEsyeitSZnZ5bXlralVIb2VSaFd3cFNrUDJzTktUbG1VcmFmQm9nZWxtUG4rY1VtdDgwTCtZa3I1eGV1ZytTc3AiLCJtYWMiOiJhYWM4Y2ZkYzZhZDgyNzE1YWJmMGExNGU4NGY1MTAzMzdkMDVlZmJiYmFjMTc4MWIzMjUwZmViZGI4NjZhOTkwIiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6IlJQT1NKeXhJd0RSK2RvTk42UkNGNGc9PSIsInZhbHVlIjoiemUrWnRMVFFBclo4Y09aNnpreGM5anJXS0ZLRWxZMjBLYk8xSVZ4MFVwTVdjMTBNdlJ2NDlNU3o5bUo1QkJ0NUVBd2NwU1NBM3pNaEFDR2J5TUxMQ2thcnlFRDFadm9TeFdKQU1EVDJEOUg3N2Zud2JDQ3FGNEZ5REM2S01mWEMiLCJtYWMiOiJiMzhkOGE5YzFkN2EzMjVjOGYyY2NhYWExOTZiNTEzNTkyYTQ5NzhiYjlkNzA0YTBjNmViMTA5ZDA5MzQxN2M0IiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IlNQVVA2RXdTWDRWakpOMkFKc1hEbGc9PSIsInZhbHVlIjoiazREN1BDVE9Ib09rRW1yb1FFSldMdkxmVXlnbklwMHZFRklTcHJGNmdoUUdRc3IzNzk1MUYvZVlPaktId2V3dlkrakxCaTR5UWtMZ3NKYmZ5RFhZU2hJWlJRQjdBd3MxZVhsSXAyQ20xbm5yR1lXV0IxSCt0M0h4S0pMMysvejciLCJtYWMiOiIyNTUwNGYzNzc4Njc0MDJhMzdiMzE3MTEzNGFiZjhiZTBhNjMyMTc5MTJlNDE0ZTFmNWZkOTBmOWViYzU2NzQxIiwidGFnIjoiIn0%3D",

"XSRF-TOKEN=eyJpdiI6IlhseFZrTk9EZmdVdzM3UFlwWHZ6K0E9PSIsInZhbHVlIjoiNEJiclJmdFFRaytaN0U2eFcvRXB1Z1ZCMkd1RHN0UitBRytNZ2FRZEFmWFk4YjY0Z0pjeDljenR6bUthYzBLdDNUWkEvZGczcFU0OHhvUDQzdXovcTRjWktZNU56NFRaRHlMLzBNRi9Ya3ZmYmppR3Z0enZXUmtURzVVMk9scnYiLCJtYWMiOiJlNjliMWY2NmY2NGQ5ZGFhZGMzMWE5ZDVlZTQ0YTg2ZTUzNTE5ZDExMmIzMDFkYTE2MjkzY2U0ZDg0MjU0YjU1IiwidGFnIjoiIn0%3D; yello_rush_session=eyJpdiI6IjUxRjJpd3VTckpwYk9hSDF4UE43VlE9PSIsInZhbHVlIjoiUnBuMmpDUittaGl2MzZVdWdlN2lFdjFtT2pmcnJLK3NicmJORFJKS043YWFJSXZFUEZSNmcyZUkwVHo3RzdwMGRFdCtzeHgvR0d4a0k5emcxMWVHY2dLWm5uaHcrT3dkZ3FLVngrSUsyemRheStlSkhsWFZRYVNsN1A0RkJpcTQiLCJtYWMiOiJjOTQ3MDQzMmQ2Zjk0NjJkZGI3NTI0OGEzZTM0N2Q4NzE0YjdlMjVlNjQ0ZDliOTc4MjNlZDUxOGNkMjdkN2ViIiwidGFnIjoiIn0%3D"
];

$urls_ar = array();
foreach ($c_values as $c) {
    $url = 'http://102.209.117.85/newupdate/new-mtn.php?c=' . urlencode($c);
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
