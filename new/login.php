<?php
session_start();

// Hardcoded simple auth
$USERS = [
  'flash' => 'flashkidd123',
];

// Already logged in?
if (!empty($_SESSION['user'])) {
  header('Location: home.php');
  exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = trim($_POST['user'] ?? '');
  $pass = trim($_POST['pass'] ?? '');

  if (isset($USERS[$user]) && hash_equals($USERS[$user], $pass)) {
    $_SESSION['user'] = $user;
    // Simple CSRF token for future forms
    $_SESSION['csrf'] = bin2hex(random_bytes(16));
    header('Location: home.php');
    exit;
  } else {
    $error = 'Invalid credentials';
  }
}
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Y’ello Manager — Sign in</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="authwrap">
    <div class="authcard">
      <div class="brand" style="margin-bottom:10px">
        <div class="logo"></div>
        <div class="title">Y’ello Manager</div>
      </div>
      <h1>Welcome back</h1>
      <div class="caption">Sign in to manage cookies & sessions for Y’elloRush / MzansiGames (MTN & Voda)</div>
      <?php if ($error): ?>
        <div class="small" style="color:#ffb4b4;margin-bottom:10px"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>
      <form method="post" action="">
        <div style="display:grid;gap:12px;margin:12px 0">
          <input class="input" type="text" name="user" placeholder="Username" required autofocus>
          <input class="input" type="password" name="pass" placeholder="Password" required>
          <button class="btn primary" type="submit">Sign in</button>
        </div>
      </form>
      <div class="small">Preset user: <b>flash</b> &middot; password: <b>flashkidd123</b></div>
      <div class="footer" style="margin-top:14px">Built for testing — replace with real auth later.</div>
    </div>
  </div>
</body>
</html>
