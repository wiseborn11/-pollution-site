<?php
require_once 'auth.php';
require_login();

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    header('Content-Type: application/json');
    verify_csrf_token($_POST['csrf_token'] ?? '');
    
    $action = $_POST['action'] ?? '';
    $user_id = $_SESSION['user_id'];
    
    try {
        if ($action === 'update_profile') {
            $fname = htmlspecialchars($_POST['first_name']);
            $lname = htmlspecialchars($_POST['last_name']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'message' => 'Invalid email format.']); exit;
            }
            
            // check email unique
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND user_id != ?");
            $stmt->execute([$email, $user_id]);
            if ($stmt->fetchColumn() > 0) {
                echo json_encode(['success' => false, 'message' => 'Email already in use.']); exit;
            }
            
            $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE user_id = ?");
            $stmt->execute([$fname, $lname, $email, $user_id]);
            
            $_SESSION['first_name'] = $fname; // update session
            echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']); exit;
            
        } elseif ($action === 'change_password') {
            $current_pw = $_POST['current_password'];
            $new_pw = $_POST['new_password'];
            
            if (strlen($new_pw) < 8) {
                echo json_encode(['success' => false, 'message' => 'New password must be at least 8 characters.']); exit;
            }
            
            $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $hash = $stmt->fetchColumn();
            
            if (password_verify($current_pw, $hash)) {
                $new_hash = password_hash($new_pw, PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
                $stmt->execute([$new_hash, $user_id]);
                echo json_encode(['success' => true, 'message' => 'Password changed successfully.']); exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'Incorrect current password.']); exit;
            }
            
        } elseif ($action === 'make_donation') {
            $amount = floatval($_POST['amount']);
            $message = htmlspecialchars($_POST['message'] ?? '');
            
            if ($amount < 1 || $amount > 10000) {
                echo json_encode(['success' => false, 'message' => 'Amount must be between $1 and $10,000.']); exit;
            }
            
            $stmt = $pdo->prepare("INSERT INTO donations (user_id, amount, message) VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $amount, $message]);
            
            echo json_encode(['success' => true, 'message' => 'Thank you for your donation!']); exit;
            
        } elseif ($action === 'delete_account') {
            $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
            $stmt->execute([$user_id]);
            session_destroy();
            echo json_encode(['success' => true, 'redirect' => 'index.php']); exit;
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Server error occurred.']); exit;
    }
    exit;
}

// Fetch user data for page rendering
$stmt = $pdo->prepare("SELECT first_name, last_name, email, visitor_id FROM users WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Fetch donations
$stmt = $pdo->prepare("SELECT amount, message, donation_date FROM donations WHERE user_id = ? ORDER BY donation_date DESC");
$stmt->execute([$_SESSION['user_id']]);
$donations = $stmt->fetchAll();

$total_donated = array_reduce($donations, function($carry, $item) {
    return $carry + $item['amount'];
}, 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PlasticPollutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body{font-family:'Inter',sans-serif;background:#0a0f1e;color:#e2e8f0;margin:0;display:flex;flex-direction:column;min-height:100vh;}
        body::before{content:'';position:fixed;top:0;left:0;width:100%;height:100%;background:radial-gradient(ellipse at 20% 40%,rgba(0,212,170,.07) 0%,transparent 60%),radial-gradient(ellipse at 80% 70%,rgba(108,99,255,.07) 0%,transparent 60%),linear-gradient(135deg,#0a0f1e,#0d1b3e,#0a0f1e);z-index:-1;pointer-events:none;}
        .gc{background:rgba(13,27,62,.7);border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:1.5rem;}
        .fi{width:100%;padding:10px 13px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:10px;color:#e2e8f0;font-size:.9rem;box-sizing:border-box;outline:none;transition:all .2s;font-family:'Inter',sans-serif;}
        .fi:focus{border-color:rgba(0,212,170,.5);box-shadow:0 0 0 3px rgba(0,212,170,.1);}
        .fi::placeholder{color:#475569;}
        label{display:block;font-size:.75rem;font-weight:600;color:#94a3b8;margin-bottom:5px;text-transform:uppercase;letter-spacing:.3px;}
        .btn-teal{width:100%;padding:11px;background:linear-gradient(135deg,#00d4aa,#00b894);color:#0a0f1e;font-weight:800;font-size:.9rem;border-radius:10px;border:none;cursor:pointer;transition:all .3s;}
        .btn-teal:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,212,170,.4);}
        .btn-indigo{width:100%;padding:11px;background:linear-gradient(135deg,#6c63ff,#8b5cf6);color:#fff;font-weight:700;font-size:.9rem;border-radius:10px;border:none;cursor:pointer;transition:all .3s;}
        .btn-indigo:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(108,99,255,.4);}
        .btn-danger{width:100%;padding:11px;background:rgba(239,68,68,.12);color:#f87171;font-weight:700;font-size:.9rem;border-radius:10px;border:1px solid rgba(239,68,68,.3);cursor:pointer;transition:all .2s;}
        .btn-danger:hover{background:rgba(239,68,68,.22);color:#fca5a5;}
        table{width:100%;border-collapse:collapse;}
        thead th{padding:10px 14px;text-align:left;font-size:.75rem;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.5px;border-bottom:1px solid rgba(255,255,255,.07);}
        tbody td{padding:12px 14px;font-size:.875rem;color:#cbd5e1;border-bottom:1px solid rgba(255,255,255,.05);}
        tbody tr:hover td{background:rgba(255,255,255,.02);}
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main style="flex:1;max-width:1200px;margin:0 auto;padding:2rem 1.5rem;width:100%;box-sizing:border-box;">
        <div style="margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:1px solid rgba(255,255,255,.07);">
            <h1 style="font-size:2rem;font-weight:900;margin:0 0 6px;letter-spacing:-0.5px;">Welcome back, <span style="color:#00d4aa;"><?php echo htmlspecialchars($user['first_name']); ?></span>! 👋</h1>
            <p style="margin:0;color:#64748b;font-size:.9rem;">Visitor ID: <span style="font-family:monospace;background:rgba(0,212,170,.1);color:#00d4aa;padding:3px 10px;border-radius:6px;border:1px solid rgba(0,212,170,.2);"><?php echo htmlspecialchars($user['visitor_id']); ?></span></p>
        </div>

        <div style="display:grid;grid-template-columns:1fr 2fr;gap:1.5rem;">
            <!-- Left Column: Profile & Settings -->
            <div style="display:flex;flex-direction:column;gap:1.2rem;">
                <!-- Edit Profile -->
                <div class="gc">
                    <h2 style="font-size:1rem;font-weight:800;margin:0 0 1rem;color:#e2e8f0;">✏️ Edit Profile</h2>
                    <form id="profileForm" class="space-y-4">
                        <input type="hidden" name="action" value="update_profile">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        
                        <div style="margin-bottom:.8rem;"><label>First Name</label><input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required class="fi"></div>
                        <div style="margin-bottom:.8rem;"><label>Last Name</label><input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required class="fi"></div>
                        <div style="margin-bottom:.8rem;"><label>Email</label><input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required class="fi"></div>
                        <button type="submit" class="btn-indigo">Update Profile</button>
                    </form>
                </div>

                <!-- Change Password -->
                <div class="gc">
                    <h2 style="font-size:1rem;font-weight:800;margin:0 0 1rem;color:#e2e8f0;">🔑 Change Password</h2>
                    <form id="passwordForm" class="space-y-4">
                        <input type="hidden" name="action" value="change_password">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        
                        <div style="margin-bottom:.8rem;"><label>Current Password</label><input type="password" name="current_password" required class="fi" placeholder="••••••••"></div>
                        <div style="margin-bottom:.8rem;"><label>New Password</label><input type="password" name="new_password" required class="fi" placeholder="Min. 8 characters"></div>
                        <button type="submit" class="btn-teal">Change Password</button>
                    </form>
                </div>

                <!-- Delete Account -->
                <div class="gc" style="border-top:2px solid rgba(239,68,68,.4);">
                    <h2 style="font-size:1rem;font-weight:800;margin:0 0 6px;color:#f87171;">⚠️ Danger Zone</h2>
                    <p style="font-size:.85rem;color:#64748b;margin:0 0 1rem;">Once deleted, your account cannot be recovered.</p>
                    <button onclick="deleteAccount()" class="btn-danger">Delete Account</button>
                </div>
            </div>

            <!-- Right Column: Donations -->
            <div style="display:flex;flex-direction:column;gap:1.2rem;">
                
                <!-- Donation Stats -->
                <div style="background:linear-gradient(135deg,rgba(0,212,170,.15),rgba(108,99,255,.15));border:1px solid rgba(0,212,170,.2);border-radius:16px;padding:1.5rem;display:flex;align-items:center;justify-content:space-between;">
                    <div>
                        <p style="margin:0 0 4px;font-size:.85rem;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Your Total Impact</p>
                        <p style="margin:0;font-size:2.5rem;font-weight:900;color:#00d4aa;">$<?php echo number_format($total_donated, 2); ?></p>
                    </div>
                    <div style="width:60px;height:60px;border-radius:50%;background:rgba(0,212,170,.15);display:flex;align-items:center;justify-content:center;font-size:1.8rem;">💚</div>
                </div>

                <!-- Make a Donation Form -->
                <div class="gc">
                    <h2 style="font-size:1rem;font-weight:800;margin:0 0 1rem;color:#e2e8f0;">💳 Make a Donation</h2>
                    <form id="donationForm" class="space-y-4">
                        <input type="hidden" name="action" value="make_donation">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label>Amount ($)</label>
                                <input type="number" name="amount" min="1" max="10000" step="0.01" required class="fi" placeholder="Enter amount">
                            </div>
                        </div>
                        <div>
                            <label>Message (Optional)</label>
                            <textarea name="message" rows="2" class="fi" placeholder="Why are you donating?"></textarea>
                        </div>
                        <button type="submit" class="btn-teal" style="width:auto;padding:11px 28px;">Donate via Secure Portal 💚</button>
                    </form>
                </div>

                <!-- Donation History -->
                <div class="gc" style="overflow:hidden;">
                    <h2 style="font-size:1rem;font-weight:800;margin:0 0 1rem;color:#e2e8f0;">📋 Donation History</h2>
                    <?php if (count($donations) > 0): ?>
                    <div class="overflow-x-auto">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($donations as $don): ?>
                                <tr>
                                    <td><?php echo date('M d, Y', strtotime($don['donation_date'])); ?></td>
                                    <td style="color:#00d4aa;font-weight:700;">$<?php echo number_format($don['amount'], 2); ?></td>
                                    <td style="color:#64748b;"><?php echo htmlspecialchars($don['message'] ?? '-'); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <p style="color:#475569;font-style:italic;font-size:.9rem;">You haven't made any donations yet. Every dollar helps in the fight against plastic pollution! 🌊</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </main>

    <!-- Toast Notification -->
    <div id="toast" style="position:fixed;bottom:20px;right:20px;z-index:999;transform:translateY(80px);opacity:0;transition:all .3s;background:rgba(13,27,62,.95);border:1px solid rgba(255,255,255,.12);backdrop-filter:blur(20px);color:#e2e8f0;padding:14px 20px;border-radius:12px;box-shadow:0 20px 40px rgba(0,0,0,.4);font-family:'Inter',sans-serif;font-size:.9rem;font-weight:500;">
        <span id="toast-msg"></span>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        function showToast(message, isError = false) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-msg').textContent = message;
            toast.style.transform = 'translateY(0)'; toast.style.opacity = '1';
            toast.style.borderColor = isError ? 'rgba(239,68,68,.4)' : 'rgba(0,212,170,.4)';
            
            setTimeout(() => { toast.style.transform='translateY(80px)'; toast.style.opacity='0'; }, 3000);
        }

        async function submitAjaxForm(formId) {
            const form = document.getElementById(formId);
            const formData = new FormData(form);
            
            try {
                const response = await fetch('dashboard.php', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showToast(result.message);
                    if (formId === 'passwordForm') form.reset();
                    if (formId === 'donationForm') {
                        setTimeout(() => window.location.reload(), 1500); // Reload to show new donation
                    }
                } else {
                    showToast(result.message, true);
                }
            } catch (err) {
                showToast("An error occurred. Please try again.", true);
            }
        }

        document.getElementById('profileForm').addEventListener('submit', (e) => { e.preventDefault(); submitAjaxForm('profileForm'); });
        document.getElementById('passwordForm').addEventListener('submit', (e) => { e.preventDefault(); submitAjaxForm('passwordForm'); });
        document.getElementById('donationForm').addEventListener('submit', (e) => { e.preventDefault(); submitAjaxForm('donationForm'); });

        async function deleteAccount() {
            if (confirm("Are you absolutely sure you want to delete your account? This action cannot be undone.")) {
                const formData = new FormData();
                formData.append('action', 'delete_account');
                formData.append('csrf_token', '<?php echo $_SESSION['csrf_token']; ?>');
                
                try {
                    const response = await fetch('dashboard.php', {
                        method: 'POST',
                        headers: { 'X-Requested-With': 'XMLHttpRequest' },
                        body: formData
                    });
                    const result = await response.json();
                    if (result.success) {
                        window.location.href = result.redirect;
                    }
                } catch (err) {
                    showToast("Error deleting account.", true);
                }
            }
        }
    </script>
</body>
</html>
