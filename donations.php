<?php
require_once 'auth.php';

// Fetch global donation stats
$stmt = $pdo->query("SELECT COUNT(DISTINCT user_id) as donor_count, SUM(amount) as total_raised, MAX(amount) as largest_donation, COUNT(donation_id) as total_donations FROM donations");
$stats = $stmt->fetch();
$total_raised = $stats['total_raised'] ?? 0;
$donor_count = $stats['donor_count'] ?? 0;
$largest_donation = $stats['largest_donation'] ?? 0;
$goal = 50000;
$progress = min(100, ($total_raised / $goal) * 100);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - PlasticPollutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0a0f1e; color: #e2e8f0; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        body::before { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(ellipse at 20% 40%, rgba(0,212,170,0.07) 0%, transparent 60%), radial-gradient(ellipse at 80% 70%, rgba(108,99,255,0.07) 0%, transparent 60%), linear-gradient(135deg, #0a0f1e, #0d1b3e, #0a0f1e); z-index: -1; pointer-events: none; }
        .glass-card { background: rgba(13,27,62,0.7); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; backdrop-filter: blur(12px); }
        .field-input { width: 100%; padding: 11px 14px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #e2e8f0; font-size: 0.9rem; box-sizing: border-box; outline: none; transition: all 0.2s; font-family: 'Inter', sans-serif; }
        .field-input:focus { border-color: rgba(0,212,170,0.5); background: rgba(0,212,170,0.04); box-shadow: 0 0 0 3px rgba(0,212,170,0.1); }
        .field-input::placeholder { color: #475569; }
        .btn-teal { display: block; width: 100%; padding: 13px; background: linear-gradient(135deg, #00d4aa, #00b894); color: #0a0f1e; font-weight: 800; font-size: 1rem; border-radius: 10px; border: none; cursor: pointer; transition: all 0.3s; text-align: center; box-shadow: 0 4px 20px rgba(0,212,170,0.3); }
        .btn-teal:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,212,170,0.45); }
        .amount-btn { padding: 10px; border: 1px solid rgba(255,255,255,0.12); border-radius: 10px; background: rgba(255,255,255,0.04); color: #94a3b8; font-weight: 700; cursor: pointer; transition: all 0.2s; font-family: 'Inter', sans-serif; font-size: 0.95rem; }
        .amount-btn:hover, .amount-btn.active { border-color: rgba(0,212,170,0.5); background: rgba(0,212,170,0.1); color: #00d4aa; }
        label { display: block; font-size: 0.78rem; font-weight: 600; color: #94a3b8; margin-bottom: 6px; letter-spacing: 0.3px; text-transform: uppercase; }
        .section-label { display: inline-block; padding: 4px 14px; background: rgba(0,212,170,0.1); border: 1px solid rgba(0,212,170,0.3); border-radius: 20px; color: #00d4aa; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.75rem; }
        .stat-mini { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; padding: 1.2rem; text-align: center; }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <main style="flex: 1;">

        <!-- Hero banner -->
        <section style="background: linear-gradient(135deg, rgba(0,212,170,0.12), rgba(108,99,255,0.12)); border-bottom: 1px solid rgba(255,255,255,0.07); padding: 4rem 1.5rem; text-align: center;">
            <div style="max-width: 700px; margin: 0 auto;">
                <div class="section-label">💚 Support the Cause</div>
                <h1 style="font-size: 2.8rem; font-weight: 900; margin: 0 0 1rem; letter-spacing: -1px;">Fund Our Fight Against<br><span style="color:#00d4aa;">Plastic Pollution</span></h1>
                <p style="color: #94a3b8; font-size: 1.05rem; line-height: 1.7; margin: 0;">Your contributions directly fund beach cleanups, educational programs, and advocacy campaigns at Pentecost University.</p>
            </div>
        </section>

        <div style="max-width: 1200px; margin: 0 auto; padding: 3rem 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem;">

            <!-- Left: Impact & Stats -->
            <div>
                <h2 style="font-size: 1.6rem; font-weight: 800; margin: 0 0 1.5rem;">Our Impact So Far</h2>

                <!-- Progress bar -->
                <div class="glass-card" style="padding: 1.8rem; margin-bottom: 1.5rem; border-top: 3px solid #00d4aa;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.85rem; color: #94a3b8; margin-bottom: 10px;">
                        <span>Goal: $<?php echo number_format($goal); ?></span>
                        <span style="color: #00d4aa; font-weight: 700;"><?php echo number_format($progress, 1); ?>%</span>
                    </div>
                    <div style="width: 100%; height: 10px; background: rgba(255,255,255,0.08); border-radius: 999px; overflow: hidden;">
                        <div style="height: 100%; width: <?php echo $progress; ?>%; background: linear-gradient(90deg, #00d4aa, #6c63ff); border-radius: 999px; transition: width 1s;"></div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1.5rem;">
                        <div class="stat-mini">
                            <p style="font-size: 0.75rem; color: #64748b; margin: 0 0 4px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Raised</p>
                            <p style="font-size: 1.8rem; font-weight: 900; color: #00d4aa; margin: 0;">$<?php echo number_format($total_raised, 2); ?></p>
                        </div>
                        <div class="stat-mini">
                            <p style="font-size: 0.75rem; color: #64748b; margin: 0 0 4px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Donors</p>
                            <p style="font-size: 1.8rem; font-weight: 900; color: #6c63ff; margin: 0;"><?php echo number_format($donor_count); ?></p>
                        </div>
                        <div class="stat-mini" style="grid-column: span 2;">
                            <p style="font-size: 0.75rem; color: #64748b; margin: 0 0 4px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Largest Single Donation</p>
                            <p style="font-size: 1.8rem; font-weight: 900; color: #00e5ff; margin: 0;">$<?php echo number_format($largest_donation, 2); ?></p>
                        </div>
                    </div>
                </div>

                <div class="glass-card" style="padding: 1.8rem;">
                    <h3 style="font-size: 1rem; font-weight: 700; color: #e2e8f0; margin: 0 0 1rem;">Where your money goes</h3>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                        <li style="display:flex; align-items:flex-start; gap:12px;"><span style="background: rgba(0,212,170,0.2); color:#00d4aa; font-weight:800; padding:2px 8px; border-radius:6px; font-size:0.85rem; flex-shrink:0;">$10</span><span style="color:#94a3b8; font-size:0.9rem;">Cleanup kit (gloves, bags, grabbers) for one volunteer.</span></li>
                        <li style="display:flex; align-items:flex-start; gap:12px;"><span style="background: rgba(108,99,255,0.2); color:#6c63ff; font-weight:800; padding:2px 8px; border-radius:6px; font-size:0.85rem; flex-shrink:0;">$50</span><span style="color:#94a3b8; font-size:0.9rem;">Educational workshop for local schools on plastic alternatives.</span></li>
                        <li style="display:flex; align-items:flex-start; gap:12px;"><span style="background: rgba(0,229,255,0.15); color:#00e5ff; font-weight:800; padding:2px 8px; border-radius:6px; font-size:0.85rem; flex-shrink:0;">$100</span><span style="color:#94a3b8; font-size:0.9rem;">New sorting recycling bin installed on campus.</span></li>
                        <li style="display:flex; align-items:flex-start; gap:12px;"><span style="background: rgba(251,191,36,0.15); color:#fbbf24; font-weight:800; padding:2px 8px; border-radius:6px; font-size:0.85rem; flex-shrink:0;">$500+</span><span style="color:#94a3b8; font-size:0.9rem;">Major awareness campaigns and policy lobbying efforts.</span></li>
                    </ul>
                </div>
            </div>

            <!-- Right: Donation Form -->
            <div>
                <div class="glass-card" style="overflow: hidden;">
                    <div style="background: linear-gradient(135deg, #00d4aa, #6c63ff); padding: 20px 24px;">
                        <h2 style="margin: 0; font-weight: 800; color: #0a0f1e; font-size: 1.3rem;">💳 Make a Contribution</h2>
                    </div>
                    <div style="padding: 1.8rem;">
                        <?php if (!isset($_SESSION['user_id'])): ?>
                            <div style="text-align: center; padding: 2rem 0;">
                                <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem;">
                                    <svg width="28" height="28" fill="none" stroke="#94a3b8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                                <h3 style="font-size: 1.1rem; font-weight: 700; margin: 0 0 8px;">Login Required</h3>
                                <p style="color: #64748b; font-size: 0.9rem; margin: 0 0 1.5rem;">To track your impact, please log in to donate.</p>
                                <a href="login.php?redirect=donations.php" class="btn-teal" style="text-decoration: none; display: inline-block; padding: 12px 32px; width: auto;">Log In to Donate</a>
                                <p style="margin: 1rem 0 0; color: #475569; font-size: 0.875rem;">No account? <a href="register.php" style="color:#00d4aa; text-decoration:none; font-weight:600;">Create one</a></p>
                            </div>
                        <?php else: ?>
                            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0 0 1.5rem;">Logged in as <strong style="color:#00d4aa;"><?php echo htmlspecialchars($_SESSION['first_name']); ?></strong>. Your donation will be securely processed.</p>
                            <form action="dashboard.php" method="GET">
                                <div style="margin-bottom: 1.2rem;">
                                    <label>Select Amount</label>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-bottom: 12px;">
                                        <button type="button" class="amount-btn" data-amount="10">$10</button>
                                        <button type="button" class="amount-btn" data-amount="50">$50</button>
                                        <button type="button" class="amount-btn" data-amount="100">$100</button>
                                    </div>
                                    <div style="position: relative;">
                                        <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #475569; font-weight: 600;">$</span>
                                        <input type="number" id="custom_amount" name="amount" min="1" max="10000" step="0.01" required class="field-input" style="padding-left: 28px;" placeholder="Custom Amount">
                                    </div>
                                </div>
                                <div style="margin-bottom: 1.2rem;">
                                    <label>Message (Optional)</label>
                                    <textarea name="message" rows="3" class="field-input" placeholder="e.g. Keep up the great work!"></textarea>
                                </div>
                                <div style="background: rgba(108,99,255,0.1); border: 1px solid rgba(108,99,255,0.2); border-radius: 10px; padding: 12px 14px; margin-bottom: 1.2rem; font-size: 0.85rem; color: #a78bfa;">
                                    ℹ️ Clicking proceed will take you to your dashboard to complete the transaction.
                                </div>
                                <button type="submit" class="btn-teal">Proceed to Payment →</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        const buttons = document.querySelectorAll('.amount-btn');
        const input = document.getElementById('custom_amount');
        if (buttons && input) {
            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    buttons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    input.value = btn.getAttribute('data-amount');
                });
            });
            input.addEventListener('input', () => buttons.forEach(b => b.classList.remove('active')));
        }
    </script>
</body>
</html>
