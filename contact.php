<?php
require_once 'auth.php';

$status = '';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf_token($_POST['csrf_token'] ?? '');
    
    $name = trim(htmlspecialchars($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = trim(htmlspecialchars($_POST['subject']));
    $message = trim(htmlspecialchars($_POST['message']));
    
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $status = 'error';
        $msg = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status = 'error';
        $msg = 'Invalid email format.';
    } else {
        $status = 'success';
        $msg = 'Thank you for your message! We will get back to you shortly.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - PlasticPollutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0a0f1e; color: #e2e8f0; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        body::before { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(ellipse at 20% 40%, rgba(0,212,170,0.07) 0%, transparent 60%), radial-gradient(ellipse at 80% 70%, rgba(108,99,255,0.07) 0%, transparent 60%), linear-gradient(135deg, #0a0f1e, #0d1b3e, #0a0f1e); z-index: -1; pointer-events: none; }
        .glass-card { background: rgba(13,27,62,0.7); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; backdrop-filter: blur(12px); overflow: hidden; display: flex; }
        .fi { width: 100%; padding: 11px 14px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #e2e8f0; font-size: 0.9rem; box-sizing: border-box; outline: none; transition: all 0.2s; font-family: 'Inter', sans-serif; }
        .fi:focus { border-color: rgba(0,212,170,0.5); background: rgba(0,212,170,0.04); box-shadow: 0 0 0 3px rgba(0,212,170,0.1); }
        .fi::placeholder { color: #475569; }
        label { display: block; font-size: 0.75rem; font-weight: 600; color: #94a3b8; margin-bottom: 6px; letter-spacing: 0.3px; text-transform: uppercase; }
        .btn-teal { display: block; width: 100%; padding: 13px; background: linear-gradient(135deg, #00d4aa, #00b894); color: #0a0f1e; font-weight: 800; font-size: 1rem; border-radius: 10px; border: none; cursor: pointer; transition: all 0.3s; text-align: center; box-shadow: 0 4px 20px rgba(0,212,170,0.3); text-decoration: none; }
        .btn-teal:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,212,170,0.45); }
        .section-label { display: inline-block; padding: 4px 14px; background: rgba(0,212,170,0.1); border: 1px solid rgba(0,212,170,0.3); border-radius: 20px; color: #00d4aa; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.75rem; }
        @media (max-width: 768px) {
            .glass-card { flex-direction: column; }
            .info-col { width: 100% !important; }
            .form-col { width: 100% !important; }
        }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main style="flex: 1; padding: 4rem 1.5rem; display: flex; align-items: center; justify-content: center;">
        <div style="max-width: 900px; width: 100%;">
            <div style="text-align: center; margin-bottom: 3rem;">
                <div class="section-label">📞 Contact Us</div>
                <h1 style="font-size: 2.8rem; font-weight: 900; margin: 0 0 10px; letter-spacing: -1px;">Get in Touch</h1>
                <p style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; max-width: 600px; margin: 0 auto;">Have questions, want to partner with us, or looking to volunteer? We'd love to hear from you.</p>
            </div>

            <div class="glass-card">
                <!-- Contact Info -->
                <div class="info-col" style="background: linear-gradient(135deg, rgba(0,212,170,0.15), rgba(108,99,255,0.15)); border-right: 1px solid rgba(255,255,255,0.08); padding: 2.5rem; width: 35%; display: flex; flex-direction: column; justify-content: space-between; box-sizing: border-box;">
                    <div>
                        <h3 style="font-size: 1.3rem; font-weight: 800; margin: 0 0 2rem; color: #e2e8f0;">Contact Info</h3>
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            <div style="display: flex; align-items: flex-start; gap: 12px;">
                                <span style="font-size: 1.3rem; line-height: 1;">📍</span>
                                <p style="margin: 0; font-size: 0.9rem; color: #cbd5e1; line-height: 1.5;">Pentecost University<br>Sowutuom, Accra, Ghana</p>
                            </div>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <span style="font-size: 1.3rem; line-height: 1;">📞</span>
                                <p style="margin: 0; font-size: 0.9rem; color: #cbd5e1;">+233 24 123 4567</p>
                            </div>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <span style="font-size: 1.3rem; line-height: 1;">✉️</span>
                                <p style="margin: 0; font-size: 0.9rem; color: #cbd5e1; word-break: break-all;">info@plasticpollutions.org</p>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 3rem; font-size: 0.8rem; color: #64748b;">
                        Office Hours:<br>Mon-Fri, 9am - 5pm
                    </div>
                </div>

                <!-- Form -->
                <div class="form-col" style="padding: 2.5rem; width: 65%; box-sizing: border-box;">
                    <?php if ($msg): ?>
                        <div style="margin-bottom: 1.5rem; padding: 12px 16px; border-radius: 10px; font-size: 0.875rem; <?php 
                            echo $status === 'success' ? 'background:rgba(0,212,170,0.1); border:1px solid rgba(0,212,170,0.3); color:#00d4aa;' : 'background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.3); color:#f87171;'; 
                        ?>">
                            <?php echo htmlspecialchars($msg); ?>
                        </div>
                    <?php endif; ?>

                    <form id="contactForm" action="contact.php" method="POST" style="display: flex; flex-direction: column; gap: 1.2rem;">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div>
                                <label for="name">Full Name</label>
                                <input type="text" name="name" id="name" required class="fi" placeholder="Jane Doe">
                            </div>
                            <div>
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" required class="fi" placeholder="jane@example.com">
                            </div>
                        </div>
                        
                        <div>
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" required class="fi" placeholder="How can we help?">
                        </div>
                        
                        <div>
                            <label for="message">Message</label>
                            <textarea name="message" id="message" rows="4" required class="fi" placeholder="Your message here..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn-teal" style="margin-top: 0.5rem;">
                            Send Message →
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert("Please enter a valid email address.");
            }
        });
    </script>
</body>
</html>
