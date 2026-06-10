<?php
require_once 'auth.php';
redirect_if_logged_in();
$error = ''; $success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf_token($_POST['csrf_token'] ?? '');
    $first_name = trim(htmlspecialchars($_POST['first_name']));
    $last_name = trim(htmlspecialchars($_POST['last_name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) { $error = 'All fields are required.'; }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $error = 'Invalid email format.'; }
    elseif ($password !== $confirm_password) { $error = 'Passwords do not match.'; }
    elseif (strlen($password) < 8) { $error = 'Password must be at least 8 characters long.'; }
    else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) { $error = 'Email is already registered.'; }
        else {
            do {
                $visitor_id = 'PU' . sprintf('%06d', mt_rand(0, 999999));
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE visitor_id = ?");
                $stmt->execute([$visitor_id]);
            } while ($stmt->fetchColumn() > 0);
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password_hash, visitor_id) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$first_name, $last_name, $email, $password_hash, $visitor_id]))
                $success = 'Registration successful! You can now <a href="login.php" style="color:#00d4aa;font-weight:600;">login</a>.';
            else $error = 'An error occurred. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PlasticPollutions</title>
    <meta name="description" content="Join PlasticPollutions today and help us save the environment.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0a0f1e; color: #e2e8f0; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        body::before { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(ellipse at 30% 40%, rgba(0,212,170,0.08) 0%, transparent 60%), radial-gradient(ellipse at 75% 70%, rgba(108,99,255,0.08) 0%, transparent 60%), linear-gradient(135deg, #0a0f1e 0%, #0d1b3e 50%, #0a0f1e 100%); z-index: -1; pointer-events: none; }
        .auth-card { background: rgba(13,27,62,0.8); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; backdrop-filter: blur(20px); box-shadow: 0 40px 80px rgba(0,0,0,0.5); padding: 2.5rem; width: 100%; max-width: 460px; }
        .field-input { width: 100%; padding: 11px 14px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #e2e8f0; font-size: 0.9rem; box-sizing: border-box; outline: none; transition: all 0.2s; font-family: 'Inter', sans-serif; }
        .field-input:focus { border-color: rgba(0,212,170,0.5); background: rgba(0,212,170,0.04); box-shadow: 0 0 0 3px rgba(0,212,170,0.1); }
        .field-input::placeholder { color: #475569; }
        .btn-teal { display: block; width: 100%; padding: 13px; background: linear-gradient(135deg, #00d4aa, #00b894); color: #0a0f1e; font-weight: 800; font-size: 1rem; border-radius: 10px; border: none; cursor: pointer; transition: all 0.3s; text-align: center; box-shadow: 0 4px 20px rgba(0,212,170,0.3); }
        .btn-teal:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,212,170,0.45); }
        label { display: block; font-size: 0.78rem; font-weight: 600; color: #94a3b8; margin-bottom: 5px; letter-spacing: 0.3px; text-transform: uppercase; }
        .strength-weak { background: #ef4444; width: 33%; }
        .strength-medium { background: #eab308; width: 66%; }
        .strength-strong { background: #00d4aa; width: 100%; }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <main style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 3rem 1rem;">
        <div class="auth-card">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, #00d4aa, #6c63ff); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; box-shadow: 0 0 30px rgba(0,212,170,0.3);">
                    <svg width="28" height="28" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </div>
                <h2 style="margin: 0; font-size: 1.6rem; font-weight: 800; color: #e2e8f0;">Create your account</h2>
                <p style="margin: 6px 0 0; color: #64748b; font-size: 0.9rem;">Join the fight against plastic pollution.</p>
            </div>

            <?php if ($error): ?>
                <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #f87171; padding: 12px 16px; border-radius: 10px; margin-bottom: 1.2rem; font-size: 0.875rem;">⚠️ <?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div style="background: rgba(0,212,170,0.1); border: 1px solid rgba(0,212,170,0.3); color: #00d4aa; padding: 12px 16px; border-radius: 10px; margin-bottom: 1.2rem; font-size: 0.875rem;">✅ <?php echo $success; ?></div>
            <?php else: ?>

            <form class="space-y-4" action="register.php" method="POST" id="registerForm">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                    <div>
                        <label for="first_name">First Name</label>
                        <input class="field-input" id="first_name" name="first_name" type="text" required placeholder="First">
                    </div>
                    <div>
                        <label for="last_name">Last Name</label>
                        <input class="field-input" id="last_name" name="last_name" type="text" required placeholder="Last">
                    </div>
                </div>
                <div>
                    <label for="email">Email Address</label>
                    <input class="field-input" id="email" name="email" type="email" required placeholder="you@example.com">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input class="field-input" id="password" name="password" type="password" required placeholder="Min. 8 characters">
                    <div style="margin-top: 8px; height: 4px; background: rgba(255,255,255,0.08); border-radius: 4px; overflow: hidden;">
                        <div id="strength-bar" style="height: 100%; width: 0; transition: all 0.3s; border-radius: 4px;"></div>
                    </div>
                    <p style="margin: 4px 0 0; font-size: 0.75rem; color: #475569;">Strength: <span id="strength-text" style="font-weight: 600;">Too weak</span></p>
                </div>
                <div>
                    <label for="confirm_password">Confirm Password</label>
                    <input class="field-input" id="confirm_password" name="confirm_password" type="password" required placeholder="Repeat password">
                </div>
                <button type="submit" class="btn-teal" style="margin-top: 8px;">Create Account →</button>
            </form>
            <?php endif; ?>

            <p style="text-align: center; margin: 1.5rem 0 0; color: #475569; font-size: 0.9rem;">
                Already have an account? <a href="login.php" style="color: #00d4aa; font-weight: 600; text-decoration: none;">Sign in</a>
            </p>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script>
        const passwordInput = document.getElementById('password');
        const bar = document.getElementById('strength-bar');
        const txt = document.getElementById('strength-text');
        if (passwordInput) {
            passwordInput.addEventListener('input', () => {
                const v = passwordInput.value; let s = 0;
                if (v.length >= 8) s++; if (/[a-z]/.test(v)) s++; if (/[A-Z]/.test(v)) s++; if (/[0-9]/.test(v)) s++; if (/[$@#&!]/.test(v)) s++;
                bar.className = '';
                if (!v.length) { bar.style.width='0'; txt.textContent='Too weak'; txt.style.color='#475569'; }
                else if (s <= 2) { bar.classList.add('strength-weak'); txt.textContent='Weak'; txt.style.color='#ef4444'; }
                else if (s <= 4) { bar.classList.add('strength-medium'); txt.textContent='Medium'; txt.style.color='#eab308'; }
                else { bar.classList.add('strength-strong'); txt.textContent='Strong'; txt.style.color='#00d4aa'; }
            });
        }
        document.getElementById('registerForm')?.addEventListener('submit', e => {
            const pw = document.getElementById('password').value;
            const cpw = document.getElementById('confirm_password').value;
            if (pw !== cpw) { e.preventDefault(); alert('Passwords do not match!'); }
            else if (pw.length < 8) { e.preventDefault(); alert('Password must be at least 8 characters.'); }
        });
    </script>
</body>
</html>
