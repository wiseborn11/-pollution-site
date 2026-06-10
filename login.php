<?php
require_once 'auth.php';
redirect_if_logged_in();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf_token($_POST['csrf_token'] ?? '');
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    if (empty($email) || empty($password)) {
        $error = 'Email and password are required.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user) {
            if ($user['lockout_until'] && strtotime($user['lockout_until']) > time()) {
                $wait_time = ceil((strtotime($user['lockout_until']) - time()) / 60);
                $error = "Account locked. Try again in $wait_time minute(s).";
            } else {
                if (password_verify($password, $user['password_hash'])) {
                    $stmt = $pdo->prepare("UPDATE users SET login_attempts = 0, lockout_until = NULL WHERE user_id = ?");
                    $stmt->execute([$user['user_id']]);
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['visitor_id'] = $user['visitor_id'];
                    header("Location: dashboard.php"); exit;
                } else {
                    $attempts = $user['login_attempts'] + 1;
                    $lockout_until = null;
                    if ($attempts >= 3) { $lockout_until = date('Y-m-d H:i:s', strtotime('+3 minutes')); $error = "Account locked for 3 minutes due to 3 failed attempts."; }
                    else { $error = "Invalid email or password. Attempt $attempts of 3."; }
                    $stmt = $pdo->prepare("UPDATE users SET login_attempts = ?, lockout_until = ? WHERE user_id = ?");
                    $stmt->execute([$attempts, $lockout_until, $user['user_id']]);
                }
            }
        } else { $error = 'Invalid email or password.'; }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PlasticPollutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0a0f1e; color: #e2e8f0; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        body::before { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(ellipse at 30% 40%, rgba(0,212,170,0.08) 0%, transparent 60%), radial-gradient(ellipse at 75% 70%, rgba(108,99,255,0.08) 0%, transparent 60%), linear-gradient(135deg, #0a0f1e 0%, #0d1b3e 50%, #0a0f1e 100%); z-index: -1; pointer-events: none; }
        .auth-card { background: rgba(13,27,62,0.8); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; backdrop-filter: blur(20px); box-shadow: 0 40px 80px rgba(0,0,0,0.5); padding: 2.5rem; width: 100%; max-width: 440px; }
        .field-input { width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #e2e8f0; font-size: 0.95rem; box-sizing: border-box; outline: none; transition: all 0.2s; font-family: 'Inter', sans-serif; }
        .field-input:focus { border-color: rgba(0,212,170,0.5); background: rgba(0,212,170,0.04); box-shadow: 0 0 0 3px rgba(0,212,170,0.1); }
        .field-input::placeholder { color: #475569; }
        .btn-teal { display: block; width: 100%; padding: 13px; background: linear-gradient(135deg, #00d4aa, #00b894); color: #0a0f1e; font-weight: 800; font-size: 1rem; border-radius: 10px; border: none; cursor: pointer; transition: all 0.3s; text-align: center; box-shadow: 0 4px 20px rgba(0,212,170,0.3); }
        .btn-teal:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,212,170,0.45); }
        label { display: block; font-size: 0.8rem; font-weight: 600; color: #94a3b8; margin-bottom: 6px; letter-spacing: 0.3px; text-transform: uppercase; }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <main style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 3rem 1rem;">
        <div class="auth-card">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, #00d4aa, #6c63ff); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; box-shadow: 0 0 30px rgba(0,212,170,0.3);">
                    <svg width="28" height="28" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <h2 style="margin: 0; font-size: 1.6rem; font-weight: 800; color: #e2e8f0;">Welcome back</h2>
                <p style="margin: 6px 0 0; color: #64748b; font-size: 0.9rem;">Sign in to your account</p>
            </div>

            <?php if ($error): ?>
                <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #f87171; padding: 12px 16px; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.875rem;">
                    ⚠️ <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div style="margin-bottom: 1.2rem;">
                    <label for="email">Email Address</label>
                    <input class="field-input" id="email" name="email" type="email" autocomplete="email" required placeholder="you@example.com">
                </div>
                <div style="margin-bottom: 1.8rem;">
                    <label for="password">Password</label>
                    <input class="field-input" id="password" name="password" type="password" autocomplete="current-password" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn-teal">Sign In</button>
            </form>

            <p style="text-align: center; margin: 1.5rem 0 0; color: #475569; font-size: 0.9rem;">
                Don't have an account? <a href="register.php" style="color: #00d4aa; font-weight: 600; text-decoration: none;">Sign up</a>
            </p>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
