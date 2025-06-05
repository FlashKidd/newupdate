<?php


while (true) {
    date_default_timezone_set('Africa/Johannesburg');
    $current_time = new DateTime();
    //Business of the day
    require_once('Tools.php');
    system('clear');
    $scoreTarget = TargetScore();
    $number3 = GetTargetScore(1);


    echo "\nOur target at num3 is: $number3";
    $ii = 0;

    $c_values =[
  
        //    i never changed lel lel weee clipboard uses you but aight
        "XSRF-TOKEN=eyJpdiI6Ilh4Skw3K044blVrbEdqUHh2cVJXeUE9PSIsInZhbHVlIjoiSDZGd1IyWkNGVkd2RVBqZ05xOTE1QzlPZUMvQWF2V2NGRUlIVUlQdnNkY3hsV0FSQysvYmtZNXdOWE5lK2FCSGg3bitxdGFkSnBXY2x5S1Y0eXFCbDZRVGY1RVVHenBMU2pxRGgydVpaVlZFK0ltYjBEb2xzWnBGV3krbHJ3am0iLCJtYWMiOiI4OTQ4N2EwY2NhODI0ODc5NTdlYTgzNDA1Y2Q2ODM3NjNmYmRkZTZlNTQ2NTVmZDRiYWI2MWU4ZmMxNjJlN2RhIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6Ik5pUlJWNFhoSllmWGlOZHZtcXBQb2c9PSIsInZhbHVlIjoidW9vYXFHczdoeE9KNmVNaWR4WFBHaGdWMW5jSjFKU0pMUnZORjdBalNOZHFUQVE0azRxUkdrTTNlMyt6YnJBOWFVdkZHTHRyczNReEJKck5DSHgxTllVVXorSkFpZHBQVFN0WU9SVkxLVGFtKzI3QjhaQTd1UFhSZHJRMWtxOTgiLCJtYWMiOiIyMTgxMTNiNzcwOWYyMmQ2MTQxZDU5ZTQwMmY1OTljOGY0ZTdkYzI5Y2EwYjlmYTMwMjNiYjMxMTczZmIzZGU5IiwidGFnIjoiIn0%3D",
        
        "XSRF-TOKEN=eyJpdiI6IkN6cjhaUDExaTNWY0V6YVBQVFVYR1E9PSIsInZhbHVlIjoiR0NhKzJmVDdXVnJucDBPUkVvM0NYVGVyNXN0S01GaTc2ZCtWdnAxZTZZaEV5T28wbzl0VHZBSEtQQ1JQbTBKTjQwaFJqNzNHdFhNdW5WOGJHVlBNZ2ZqUkNkNFdSZlplVDQ3bVZ4QWFUbm5BbTJkRmcvdzhBaXZUNG1RL0pzZEMiLCJtYWMiOiJiZmVmMzU3OWVkNTY0NTBjZDVlN2U2NjAzMGU4Y2M5MjQwMTg0MzkyNjA4ZmMwNGI4NDJjNGViYzRlMzExY2IwIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6ImFZNDl4dkN1YXFQUmVUNWkwaUNqc3c9PSIsInZhbHVlIjoiRnQ0dDM4L1labno5TzYvbE9ncnN3Tkt5cXR2WEsyRG9vbGthZ09kWm8zdzJIM3ZrNWo4STNUaVQ0c2MvaW1obGVWMzRkYnVhZHJzdXZnZ2oyTEtpV3Y1MWFxQ1BsQVZTZms3V0c5aW9idFlUdDFvZmxhRmZITWUrT1pBNUFuai8iLCJtYWMiOiJhMzA2NWNkNjVkMGNlM2QyMGU5OWFlMGMwMjI3ZjhlMGEzZTYxMWExNTJjOTQ4ZTY2MTY2ZWY2MjZjN2NiMDdhIiwidGFnIjoiIn0%3D",
        
        '_gcl_au=1.1.634627808.1748969476; _ga=GA1.1.827229217.1748969477; _ga_47GFPLWSMZ=GS2.1.s1748969476$o1$g1$t1748969504$j32$l0$h0; _ga_JV5MK09THB=GS2.1.s1748969476$o1$g1$t1748969504$j32$l0$h0; XSRF-TOKEN=eyJpdiI6IlA3K2tBeEZqRDA0b3ZWd01NUWVvK2c9PSIsInZhbHVlIjoib0MyU3RNZFZSNDBkR3dHYlA2bGhQWWZBalhLL055eFRKOU5JQzBEV3hBanFjN2QvcmFOQUxTSzl4ajVFajhhV3J4ZWVQY1JuaXpkbVVXc05jSFVLVkptQ2J6aHoyNXA4UHBDZ3ZFQVFvRUpDcGEya0RyZkMzS0JqcE5MNXlveG4iLCJtYWMiOiI2OTNkOWZhY2IxMTA1N2UyZGJhNDQ0NGRmMGNlM2RmOTc3MmMxYzhhMTY5OGEzN2EyNGFjYWI5ZDc1MmUyZTEzIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6ImVxd0RpcUtDdWFZSU96TjdLdE90RFE9PSIsInZhbHVlIjoiZlluaEt1UGV6RWI1ek9FWXUwZG9mR3h0R20zcDlMcTZ2cjhzd2NXQmt2T1Z4bXR6VUZxNmx0SHdmSDNoenJxRi9PV2R6YldOTy9JdUJCdERtT0lIT1FuRDNMa2VWVVZqU3h2ZnZPTFIrdndjNHBwT3hYRXM3Nk5mbkFBcm1vYmQiLCJtYWMiOiIzNWJkNmU2NGQyOGQ3YWYwZGMzN2JkNmIzNTYxZDRjMzYyOTY3ODExYmNlZjRhYWY1ODFjYjFmNmRjMjRjMzc0IiwidGFnIjoiIn0%3D',
        
         "XSRF-TOKEN=eyJpdiI6Ik5Bc2FsVHpja2VMbUxEVk8vTXpsSWc9PSIsInZhbHVlIjoiRWNxcU9wMGFVRWt0RjZGV2VVUUwwcFhsQndTdFFYK2MrMER4VmlwY1F0RjA2MThjcnZaTjIvZlBua2lHcEpoaUNFN0VqUGxpb3hNMnFRaXNHVXVOanR5RWJ6VU5OVjNlTFVTMTgxZ0pJN3ZwRWNHN1NWVXNaWElNb1NiSkFDR1MiLCJtYWMiOiJjYTgzOTZjZDcyNTY1MDk0OGJiZmIzMTAyMmY0OThiMGQ1ODE4ZjE0YWRmYmRmMWZhNGE3ZjE3Y2VlZjBjZDc4IiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6Inp5VURQUGdxRHJHL2pMRUZvWFNHUUE9PSIsInZhbHVlIjoidFlDRGo4TlRDbWN0d3k1U1RETjRCcnZieVRxd0tGVHRWTlpNbDhrR0tkUDhtdnlpS3FmZzN5OWZGeDhyYVNyOW12MldmcWV1TU1hL0JBZ2Zhb1JTdEhEc2JEdVZSVjl0K2dSYTdHSFBraFkvaGhVakVCTDdDK09LcXZsVUpZOVQiLCJtYWMiOiIzZjA2MDA5YzQ3OTlhYmMyOGZjOWRkMGExYzliOWRiOGMwNDcwNjQ3N2E5ZmRiMDcyZDVmMmExODY4ZWQ5NjEyIiwidGFnIjoiIn0%3D",
        
        "XSRF-TOKEN=eyJpdiI6IkRlWUhDaGhEb2hxUitubnE4WWh6Qnc9PSIsInZhbHVlIjoiR0kzWE9CbnhOajdKbDVqQlpFOU9Hc1grZ0JjUFlaSm9mM2w1dHN5bXpoMTllNS9SYlhFMzhOK3dYNXVVR1FhMzhTcGRhZFdiUUVRM2dRQkc2WGViTk0wSDgwaDFuZnRSd3lKcld5WWh2QWVFY3B6THF5azlnVTlIVmJ2dFd4a0siLCJtYWMiOiI4NmQ3MDE4YjhlNjQyNGU0NjliM2YzNThkZDRiNTkzZTJhNmQ0ZjgyNTgwNzM0MzQ0ODE3MGMzN2QxNjJlNWY0IiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IkwzaXlHQzBjUXQxQ0pRNkFFS0pyZFE9PSIsInZhbHVlIjoiSThyT3dKNFVHRldOR0NOTUxtVVpEblpmZ0UrbkRmeW8xWTQ5ZlY1dTlKRWk4bitFeWw3NTBmSUNTUGo5NmRGeUVpdWRhb09HZGpsZUN3dTc0S3F0ZGlpWjFpRTFtWnAydmtheUZsZWpiVTYxVktxRUczT3MyeC9aWEQ5ZEJuSHQiLCJtYWMiOiI2N2E0YmVlZGI2MGEyMmY0YWQzNjVjZGRiNzc3OThhNmIyMzU3ZTQ0NzNhMGFmNDVhOTlkOTM4NGU0NDdlZTU5IiwidGFnIjoiIn0%3D",

        "XSRF-TOKEN=eyJpdiI6IlhJRnFzZnFRMkpwSG1OWlNtNzk0TVE9PSIsInZhbHVlIjoiWXhIaWNYWlFFU3VNcHlCUWdPZW5oMEZaMFErREFVUFZLMEV2ZTZ6VUtpWVR0WlRHL0d5T2pvdTdMWHhsK0E3UVk3UW1rUHY5Q28zR3Z4bmk0Q2dZeWhROUg5Y3IwZEhKZlQ5NkJkSjZYbEtWT1VvSnRydlRoUzY4TVNUM1paOCsiLCJtYWMiOiJhZWZmODQ5NTYwYjUwZTZjMTJkNGFmMjVmZTI0MWM1YjczZTQzOTQ4NWZmYmM0MGFmZGJhYmQ2ZTI0ZTU0NmZjIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6ImR6eEdqYU4yUE5EaWJkUXhDYVJZRmc9PSIsInZhbHVlIjoieDZCb0IyWm8yUEpObUJSNlVDc3lNUEJmaGJJRFM5Q3dySlRKNU56M1lGamFmblFwY3ZWN2xMaXUyMXRFWFRjL0xMSEJIU3V3bzZEdlVvWVBhRHU1ZUI0S2N2RzE3eXU4OVBlbmlRZWZRNzZQaUFZQVpaZFRDMWRUZDA2a2pBZkwiLCJtYWMiOiJmM2E3MWJjZGEzNzM4Y2VjM2Q0OWM0NzUyZmU4YzZjOTk1M2E4MDg3ZTA3MzgwYWNmNzU4NTJiZmIyZjBkZWZkIiwidGFnIjoiIn0%3D",


        "XSRF-TOKEN=eyJpdiI6IjBCeEk2SytWci92RUFBZ2NneGhyR0E9PSIsInZhbHVlIjoid1NjTDlheGFnblhqdHV3NkJoSTIxY01BSlNleHFTNmV3VWY3dVYzd0NmcHZCYTZBcHEvVktGcFZMY2t3V1VTcEFzdG0vMzdtWi9tbHkwZG9zOVBiVGlNQXhlbDljd2F0KzhiOVlsclh4blpyaWY2VVA4d1dhcGNpcWVseUNhcWYiLCJtYWMiOiIwNDE3YzA5NWQ2YWIwZDJmNWIxZjY3MmUzMmFlMjM3MTJjNmQyMTlhNmFmOWU2YjcyMzA5ZjQxNGI2M2IzMDJlIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6ImMzcFcyUzJodzBuSDRPekEzdTJPK2c9PSIsInZhbHVlIjoiQ0prTHFKMWhZY1JjYy9CaHpFVm5zTFAwTmhTSXhMaFNOZ1FpNytybXdBcndHOVNFS2x0UGczTWU1Yk53N2pHRC9mZTJEU3pHUHpBalFoakJMcEVGa3daTDZ1dkx1elNLVlR6UzJXZjJVbk1qamVWK0VnSUU2aURxVk5qSUsrWnIiLCJtYWMiOiIwODI1YmVlMjRhNDI2ZWFiYzM2NTIyYTU4YmY5ZWEwMTkxNmU0Y2NjNzgzNTQyYTFjNWMyNmRhMzUwODQ4NThiIiwidGFnIjoiIn0%3D",


        "XSRF-TOKEN=eyJpdiI6Ilp1SjNaeWoyLzJNVzk0TGMyU0pOVHc9PSIsInZhbHVlIjoid1FmNFRsd2wrUitZS0VlNXYzb29SRkduSVJnMjFpeVR6emRPbU1RNlNRbWxVdTduRGVJd2Q2R0ZMS1ZHMk9MQUNkMy9WL1ZwbHV4RUxQc0NhVURhRUVFVnB6NWVoTUNqbWNOSjJrTVd1d1BTK1NoalFpY29LZTVqRkppcS8yNzIiLCJtYWMiOiJkMjg1NzMyMmI2ZThhZTc5YjUyYjFkNzhlOGU5OWVlODcxZGI3ODg5MDY4NzEyOTE3NTU0OWNiNDliYmMwN2Q1IiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6Im9Kb0xhOUZ3Y05SWVNYT0JNYVk4OGc9PSIsInZhbHVlIjoiVHF5cm5JdDZmSVBYekdQSUlNR3NzTzkvRjQydWYvTmVqTjNHZG5BWitwWXF5a0Z1eWpwNWJjWTFucExsZ0cyWjJUZ0lONFRvMktMZ3RYSXNMVXBSdThkbGdzUjdCMlVMWmM4NHZqWEJqNW0xRzVvRzdpdmZMRXlNQmNpMDNZL2IiLCJtYWMiOiJjZjdjY2JkMGIxMTRhYTJlMmM0ZjgxMjI4NmZlMDZiNmI4ZGExZTM5NTUzY2U5OGJiMjRjZTg4OTYzOTNjYWVjIiwidGFnIjoiIn0%3D",

        "XSRF-TOKEN=eyJpdiI6IlQ2NS9adGVvbjdXcTJWVUE1Z1FzZ2c9PSIsInZhbHVlIjoiMVdnSWljQkR6QjBMejVyajh2V09hN0tZKzAxSGVMOWZtZlNpM3lwQllWUnEyenZ2NlZhaVRCOWo4OTBXbFN2cVRHV2J6L0tvaTRLZGZJckJhamJhOWNRS3o2c2lyMFpWSE9XRG1Rdm1KUXlCRUZTTVA1N3FhbjR4a1BxK3N0dlciLCJtYWMiOiJkMzMyMGY2OWM5MjdmMTQwZDI2ZGE1ZDljMzE2MmI2Zjg1NDU2MzBkNGExMDBhMjE2YTY1MzFkOGY2MzIwMTBkIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6ImpablRyUGM5d05ZVWR3Y08zbHVZZkE9PSIsInZhbHVlIjoia2RTRmpmQjd3ay82aVRVTVA0bHNJWTFzYncycHdhanhvVkRoajdlTm9yK09lWGRvL1RVQktxdHNuRjNrUERKbkYzelpiSDZkOW5LUUVZb05PeTZQVm1mdmNtNEtMWXpZOWdqSEpwSjMwd1BUV1BiTEFEakJwZTdidml4YWpVWGQiLCJtYWMiOiI1ZGY0NTJmNDAzY2FlOGEzYjdkMWJjYTI0ZDc1MjcxNTRjOTk4MGI3ODVhZGQyNjk3ZmE0NGMwYjQzYzYyYmQzIiwidGFnIjoiIn0%3D",

        "XSRF-TOKEN=eyJpdiI6ImVsWUFOcUNNSExVZDhnK0ZobFB2SWc9PSIsInZhbHVlIjoiRUEvMzY2a1UyTW43ejhCVUNhS01IangwWmVYN0l4YlN3R3B2KzhqdWl6dXl6SXN4MHJhSEFDMHBPK09lRGZodC9vaVRHNU5TQUVkUUhBMmZkNktOSUFvV2Z4WFpwUUV5VEMwajlGZ04yS1I1Q0tFRGRFTkdqNnN4RTA2aDIwZlMiLCJtYWMiOiIyNzIxZjg4MjEwYmEzZjQyMGQzMDczMmE5YWIxMDRmOTcxMWFhYWEwNTI4Mzc5MDdjZDBiZDBlZjQ1ZTU0ZjI2IiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6InJ2WGJscXE3alA2bnRwRXdnSzYrM2c9PSIsInZhbHVlIjoiRS9oU3JIVlVhc0FUNXU1dnlmYmhrUk1ScWs4aVpJZ3ZUYzJEOXNWRDhLN1N4T3FNU0NlZFJxYys3b1VrQmJvZzRhdVZaVDVXcDlBRm4zRC91UkV2eEFERXU5VGczOWxnYU1HQWcrYWI3WWlmTkdpd1dzKzViV1d4d2twZU80dVkiLCJtYWMiOiJmNmVlM2FiYzAwZTc2ZjljMDI2NmE1N2UxMzA5YzcxYWY4ZDA4YTBjOGMwZjI5NzU5Y2VlY2ExMGZiZGM1NGI5IiwidGFnIjoiIn0%3D",

        "XSRF-TOKEN=eyJpdiI6IlNRbGdYT1pXMC9zTkJRU1IyRzRvL1E9PSIsInZhbHVlIjoiUm5hZXpFN2xiYmtJNHI4V08reE1YcVN1NnNQdnpVZjR4c0o1K1JmdG4rV0Y4djRBVlVEZ0R3YnlXQnpnOU1XMHlzQkgwTXpuRERIOXhLTWpUS3JaZDAzM29VTkVCQ1B4RDRkRlYxWGNScUtMKzduRlJKRjFFVnFFNUNTNGFPT0YiLCJtYWMiOiJjODM0ODQ0MTVhMTEwODNlNTQxZGJhNDVmMWMzYTI5NjQ1MzAwNTc1ZTFkNzIyYzVhMTZhN2EzMWZhMDBjZjdmIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IjcwSkJSTVJPMXVudEVJeUtneGJ2ZXc9PSIsInZhbHVlIjoicCszdGJSeGxCY1owRnRYeXRxQ2xoV1hmMUMwOWhjWlRaOFl5eVdpTm8xOWdqN2xjdmxpb2NZKzc3dElzZGFqSVcvM3h6ZHFHUGZ0NFI1YVc3TFBqQnBLZXZGMStWdDkzOHhyYnVuWk5md3RUZmpmWDdoa2FBZ0JIL3dXVkNkUEciLCJtYWMiOiJlYWU4MTM5YWQ4YmM3ZGVlNjVmOWNjNmJkYmQ2OTgxOGUxY2U0NmZkNGM5ZDZhOWQ5MmI5YzEzM2ZmOTczOTMxIiwidGFnIjoiIn0%3D",

        "XSRF-TOKEN=eyJpdiI6IjVpMXdvZ3Rrb0g1ZUg0MzI1ZENJY3c9PSIsInZhbHVlIjoib28zV1VTWHRDRlZnNm83Y0t5c1o1NDAwL2VPTUVPMUdXVENsMFh6M09ZVkNMMGNCL2h0cjR0akJNMGdRN0Zka3hjRHhNeGZqWE1jYm5sd3NOWGZUUzVaYTE2aVlJQnc1MVE3cHZ3SWpQbzNDWlJZN1FFbE5ZWnVnNWpDdmJJcFYiLCJtYWMiOiIyMTYyOWM1NGNhZWZmOTIzOWNkZDIzNDA5ZTljODkyNTUyNTc3MTBlODZjNmEyNjg1Mzk2NGIyOGY1ZGMzZjIwIiwidGFnIjoiIn0%3D; vodacom_mzansi_games_session=eyJpdiI6IlduWVJycG43a3dra05VKzRESmhVN2c9PSIsInZhbHVlIjoidDUxSDNxTW9SQmNLNVFuR0ZreFpNVmN3N3JkNUJqZXN0Uys2TTh6a3oxdTlOR1oyV2JWMFV2dFFGOXM5MzNnVmdwWEdReGt1dHJlNGhxWUQyU3lBM0RGb3R3UWV5TWxXczF4K0FLLzYyS2ZVenpwVmFsenE5dWZNcnl6TVlMT0EiLCJtYWMiOiJkMTBlMTUyNzBjMjEzYjQwMzU3Nzc3NWQwNTc5MTE0N2YxYzA3OGYzY2EyZmM2OWExNmJmYzMwZThjMjI0NWQ5IiwidGFnIjoiIn0%3D"


        ];
    foreach ($cookiez as $cookie) {
        $ii++;

        if ($ii > 1) {
            sleep(rand(0, 30));
        }
        system('clear');
        echo "\n$ii cookie sent \n";
        //  $cookie = isset($_GET['c']) ? trim($_GET['c']) : '';

        //echo "Cookie; $cookie";
        $pos = GetPosition($cookie);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://gameplay.mzansigames.club/play-now');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array(
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
            'Accept-Language: en-US,en;q=0.9',
            'Cache-Control: no-cache',
            'Connection: keep-alive',
            'Cookie: ' . $cookie,
            'Pragma: no-cache',
            'Referer: https://gameplay.mzansigames.club/',
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
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $curl = curl_exec($ch);
        $redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

        curl_close($ch);
        $query_str = parse_url($redirectedUrl, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        $unique_id = isset($query_params['unique_id']) ? $query_params['unique_id'] : '';
        $game_id = isset($query_params['game_id']) ? $query_params['game_id'] : '';
        $sigv1 = isset($query_params['sigv1']) ? $query_params['sigv1'] : '';

        // echo "<br>Uniquie_id: $unique_id<hr>";
        //echo "<br>Game_id: $game_id<hr>";
        if (empty($unique_id)) {
            die();
        }


        ###################
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://gameplay.mzansigames.club/new-game-check-user-status/' . $unique_id . '/' . $sigv1 . '');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array(
            'Referer:' . $redirectedUrl,
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
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $curl = curl_exec($ch);

        // Separate headers and body
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($curl, 0, $header_size);
        $body = substr($curl, $header_size);
        curl_close($ch);



        $x_power = X_Power($header);
        echo "\n<br> X-Powered-Version: $x_power\n";

        $testSom = GetTargetScore($pos);
        $MAX_SCORE = 6000;
        $range = 10000;
        if ($pos <= 3 || $pos == 0) {
            $score = rand(7000, 10000);

        } else {

            $multiplier = floor($number3 / $range);

            $min = $range * $multiplier + 1;
            $max = $range * ($multiplier + 1);

            $score = rand($min, $max);

            echo "\n Our score and range $min - $max := $score";

            while ($score < $number3) {
                $score += rand(1, 10);
            }

        }

        while ($score > 50000) {
            $score -= 1;
        }



        echo "\n Our score = $score";


        $increment = 1;

        $uA = RandomUa();
        $score = round($score, -1);
        $memory = validate_request($x_power, $score);
        $OnePieceIsReal = generateRandomDivisionData($score, $redirectedUrl, $x_power, $memory, $increment, $uA);
        sleep(rand(30,50));
    }
}
