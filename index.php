<?php
require_once 'auth.php';
track_visitor($pdo);
$stmt = $pdo->query("SELECT stat_value FROM site_stats WHERE stat_name = 'visitor_count'");
$visitor_count = $stmt->fetchColumn() ?: 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PlasticPollutions - Join Pentecost University's environmental action group to combat plastic waste.">
    <title>PlasticPollutions | Eradicating Plastic Waste</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0a0f1e; color: #e2e8f0; margin: 0; }
        body::before {
            content: '';
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(0,212,170,0.07) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(108,99,255,0.07) 0%, transparent 60%),
                linear-gradient(135deg, #0a0f1e 0%, #0d1b3e 50%, #0a0f1e 100%);
            z-index: -1; pointer-events: none;
        }

        /* Slider */
        .slider-container { overflow: hidden; position: relative; width: 100%; height: 480px; border-radius: 16px; }
        .slide { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; transition: opacity 1s ease-in-out; }
        .slide.active { opacity: 1; z-index: 10; }
        .slide img { width: 100%; height: 100%; object-fit: cover; }
        .slide-caption {
            position: absolute; bottom: 0; left: 0; width: 100%;
            background: linear-gradient(transparent, rgba(10,15,30,0.9));
            color: white; padding: 30px 24px 20px; font-size: 1rem; font-weight: 500;
        }

        /* Glass card */
        .glass-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .glass-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.3); }

        /* Teal glow button */
        .btn-teal {
            display: inline-block; padding: 14px 36px;
            background: linear-gradient(135deg, #00d4aa, #00b894);
            color: #0a0f1e; font-weight: 800; font-size: 1rem;
            border-radius: 50px; border: none; cursor: pointer;
            box-shadow: 0 4px 24px rgba(0,212,170,0.35);
            transition: all 0.3s; text-decoration: none;
        }
        .btn-teal:hover { transform: translateY(-3px); box-shadow: 0 8px 32px rgba(0,212,170,0.5); }

        /* Tweet cards */
        .tweet-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 20px;
            transition: border-color 0.2s;
        }
        .tweet-card:hover { border-color: rgba(0,212,170,0.3); }

        /* Modal */
        #signupModal { transition: opacity 0.3s; }
        .modal-hidden { opacity: 0; pointer-events: none; }
        .modal-visible { opacity: 1; pointer-events: auto; }

        /* Cookie */
        #cookieBanner { transition: transform 0.3s ease-in-out; }
        .cookie-hidden { transform: translateY(100%); }

        .stat-num { font-size: 3rem; font-weight: 900; line-height: 1; }
        .teal { color: #00d4aa; }
        .indigo { color: #6c63ff; }
        .cyan { color: #00e5ff; }

        .section-label {
            display: inline-block;
            padding: 4px 14px;
            background: rgba(0,212,170,0.1);
            border: 1px solid rgba(0,212,170,0.3);
            border-radius: 20px;
            color: #00d4aa;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">

    <?php include 'navbar.php'; ?>

    <main style="flex: 1;">

        <!-- HERO -->
        <section style="position: relative; padding: 5rem 1.5rem 6rem; text-align: center; overflow: hidden;">
            <div style="position: absolute; top: -100px; left: 50%; transform: translateX(-50%); width: 800px; height: 500px; background: radial-gradient(ellipse, rgba(0,212,170,0.12) 0%, transparent 70%); pointer-events: none;"></div>
            <div style="max-width: 860px; margin: 0 auto; position: relative;">
                <div class="section-label">🌊 Pentecost University</div>
                <h1 style="font-size: clamp(2.4rem,6vw,4rem); font-weight: 900; line-height: 1.1; margin: 0 0 1.5rem; letter-spacing: -1px;">
                    Let's Eradicate <span class="teal">Plastic Pollution</span><br>Together
                </h1>
                <p style="font-size: 1.2rem; color: #94a3b8; max-width: 600px; margin: 0 auto 2.5rem; line-height: 1.7;">
                    Join the movement at Pentecost University. Participate in cleanups, advocate for policy changes, and help build a sustainable future.
                </p>
                <button onclick="openModal()" class="btn-teal">Sign Up Now →</button>
            </div>
        </section>

        <!-- STATS -->
        <section style="padding: 3rem 1.5rem;">
            <div style="max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
                <div class="glass-card" style="padding: 2rem; text-align: center;">
                    <div class="stat-num teal" data-target="10000" id="count1">0</div>
                    <div style="color: #94a3b8; margin-top: 8px; font-weight: 500;">Tonnes of Plastic Removed</div>
                </div>
                <div class="glass-card" style="padding: 2rem; text-align: center;">
                    <div class="stat-num indigo" data-target="500" id="count2">0</div>
                    <div style="color: #94a3b8; margin-top: 8px; font-weight: 500;">Active Members</div>
                </div>
                <div class="glass-card" style="padding: 2rem; text-align: center;">
                    <div class="stat-num cyan" data-target="20" id="count3">0</div>
                    <div style="color: #94a3b8; margin-top: 8px; font-weight: 500;">Successful Campaigns</div>
                </div>
            </div>
        </section>

        <!-- SLIDER -->
        <section style="padding: 4rem 1.5rem;">
            <div style="max-width: 1000px; margin: 0 auto;">
                <div style="text-align: center; margin-bottom: 2.5rem;">
                    <div class="section-label">📸 Gallery</div>
                    <h2 style="font-size: 2rem; font-weight: 800; margin: 0; color: #e2e8f0;">Our Impact in Action</h2>
                </div>
                <div class="slider-container" style="box-shadow: 0 30px 80px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.08);">
                    <div class="slide active">
                        <img src="assets/images/plastic_beach_1778711315322.png" alt="Polluted Beach">
                        <div class="slide-caption">The Reality: Plastic pollution devastating coastlines.</div>
                    </div>
                    <div class="slide">
                        <img src="assets/images/volunteers_cleaning_1778711362059.png" alt="Volunteers Cleaning">
                        <div class="slide-caption">Our Action: Dedicated volunteers restoring our beaches.</div>
                    </div>
                    <div class="slide">
                        <img src="assets/images/clean_ocean_1778711329902.png" alt="Clean Ocean">
                        <div class="slide-caption">The Goal: Pristine oceans free from plastic waste.</div>
                    </div>
                    <div class="slide">
                        <img src="assets/images/marine_life_1778711491513.png" alt="Marine Life">
                        <div class="slide-caption">The Beneficiaries: Thriving marine life in safe habitats.</div>
                    </div>
                    <div class="slide">
                        <img src="assets/images/recycling_bins_1778711382994.png" alt="Recycling Bins">
                        <div class="slide-caption">The Solution: Better waste management and recycling on campus.</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- UPDATES -->
        <section style="padding: 4rem 1.5rem;">
            <div style="max-width: 860px; margin: 0 auto;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <div class="section-label">📢 Social</div>
                        <h2 style="font-size: 2rem; font-weight: 800; margin: 0;">Latest Updates</h2>
                    </div>
                    <svg width="28" height="28" fill="#00e5ff" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                </div>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <?php
                    $tweets = [
                        ['time' => '2 hours ago', 'text' => 'Huge success at today\'s beach cleanup! 🌊 We collected over 200 bags of plastic waste. Thanks to all volunteers from Pentecost University! 💚 #PlasticFree #BeachCleanup'],
                        ['time' => 'Yesterday', 'text' => 'Did you know? A single plastic bottle can take up to 450 years to decompose. Let\'s switch to reusable alternatives today! ♻️🥤 #Sustainability #EcoTips'],
                        ['time' => '3 days ago', 'text' => 'Join us this Friday for our workshop on DIY upcycling! Learn how to turn plastic waste into useful household items. 🛠️🪴 #Upcycling #ZeroWaste'],
                    ];
                    foreach ($tweets as $t):
                    ?>
                    <div class="tweet-card">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            <div style="width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #00d4aa, #6c63ff); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.85rem; color: #0a0f1e; flex-shrink: 0;">PP</div>
                            <div>
                                <p style="margin:0; font-weight: 700; color: #e2e8f0;">PlasticPollutions PU <span style="font-weight: 400; color: #64748b;">@PlasticPollPU</span></p>
                                <p style="margin:0; font-size: 0.8rem; color: #475569;"><?php echo $t['time']; ?></p>
                            </div>
                        </div>
                        <p style="margin: 0; color: #cbd5e1; line-height: 1.6;"><?php echo $t['text']; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- VISITOR COUNTER -->
        <div style="background: rgba(0,212,170,0.05); border-top: 1px solid rgba(0,212,170,0.1); border-bottom: 1px solid rgba(0,212,170,0.1); padding: 1rem; text-align: center;">
            <p style="margin: 0; color: #64748b; font-size: 0.9rem;">
                Total Unique Visitors: <span style="color: #00d4aa; font-weight: 700; font-size: 1.1rem;"><?php echo number_format($visitor_count); ?></span>
            </p>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <!-- MODAL -->
    <div id="signupModal" class="modal-hidden" style="position: fixed; inset: 0; z-index: 200; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.7); padding: 1rem; backdrop-filter: blur(4px);">
        <div style="background: #0d1b3e; border: 1px solid rgba(0,212,170,0.2); border-radius: 20px; width: 100%; max-width: 440px; overflow: hidden; box-shadow: 0 40px 80px rgba(0,0,0,0.6);">
            <div style="background: linear-gradient(135deg, #00d4aa, #00b894); padding: 20px 24px; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; font-weight: 800; color: #0a0f1e; font-size: 1.2rem;">🌊 Join the Movement</h3>
                <button onclick="closeModal()" style="background: none; border: none; cursor: pointer; color: #0a0f1e; opacity: 0.7;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div style="padding: 24px;">
                <form id="modalSignupForm" action="register.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div id="modalError" style="display:none; margin-bottom: 14px; font-size: 0.875rem; color: #f87171; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); border-radius: 8px; padding: 10px;"></div>
                    <?php
                    $fields = [['m_first_name','first_name','First Name','text'],['m_last_name','last_name','Last Name','text'],['m_email','email','Email','email'],['m_password','password','Password','password'],['m_confirm','confirm_password','Confirm Password','password']];
                    foreach ($fields as [$id, $name, $label, $type]):
                    ?>
                    <div style="margin-bottom: 14px;">
                        <label style="display: block; font-size: 0.8rem; font-weight: 600; color: #94a3b8; margin-bottom: 6px;" for="<?php echo $id; ?>"><?php echo $label; ?></label>
                        <input style="width: 100%; padding: 10px 14px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #e2e8f0; font-size: 0.9rem; box-sizing: border-box; outline: none; transition: border-color 0.2s;" id="<?php echo $id; ?>" name="<?php echo $name; ?>" type="<?php echo $type; ?>" required onfocus="this.style.borderColor='rgba(0,212,170,0.5)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                    </div>
                    <?php endforeach; ?>
                    <button class="btn-teal" type="submit" style="width: 100%; margin-top: 8px; text-align: center; border: none; cursor: pointer;">Register Now</button>
                </form>
            </div>
        </div>
    </div>

    <!-- COOKIE BANNER -->
    <div id="cookieBanner" class="cookie-hidden" style="position: fixed; bottom: 0; width: 100%; z-index: 150; background: rgba(10,15,30,0.97); border-top: 1px solid rgba(0,212,170,0.2); padding: 1rem 1.5rem; backdrop-filter: blur(20px);">
        <div style="max-width: 1100px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
            <p style="margin: 0; font-size: 0.875rem; color: #94a3b8;">We use cookies to improve your experience and track website analytics.</p>
            <div style="display: flex; gap: 12px; align-items: center;">
                <a href="#" style="color: #00d4aa; font-size: 0.875rem; text-decoration: none;">Learn More</a>
                <button onclick="acceptCookies()" style="background: linear-gradient(135deg,#00d4aa,#00b894); color: #0a0f1e; border: none; padding: 8px 20px; border-radius: 8px; font-weight: 700; cursor: pointer; font-size: 0.875rem;">Accept</button>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('signupModal');
        function openModal() { modal.classList.remove('modal-hidden'); modal.classList.add('modal-visible'); document.body.style.overflow = 'hidden'; }
        function closeModal() { modal.classList.add('modal-hidden'); modal.classList.remove('modal-visible'); document.body.style.overflow = 'auto'; }

        document.getElementById('modalSignupForm').addEventListener('submit', function(e) {
            const errBox = document.getElementById('modalError');
            const pw = document.getElementById('m_password').value;
            const confirm = document.getElementById('m_confirm').value;
            const email = document.getElementById('m_email').value;
            errBox.style.display = 'none';
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { e.preventDefault(); errBox.textContent = 'Please enter a valid email address.'; errBox.style.display = 'block'; return; }
            if (pw !== confirm) { e.preventDefault(); errBox.textContent = 'Passwords do not match.'; errBox.style.display = 'block'; return; }
            if (pw.length < 8) { e.preventDefault(); errBox.textContent = 'Password must be at least 8 characters.'; errBox.style.display = 'block'; return; }
        });

        document.addEventListener('DOMContentLoaded', () => {
            if (!localStorage.getItem('cookiesAccepted')) setTimeout(() => document.getElementById('cookieBanner').classList.remove('cookie-hidden'), 1000);

            // Counter animation
            document.querySelectorAll('[data-target]').forEach(counter => {
                const obs = new IntersectionObserver(entries => {
                    if (entries[0].isIntersecting) {
                        const target = +counter.getAttribute('data-target');
                        let count = 0;
                        const inc = target / 200;
                        const update = () => { count = Math.min(count + inc, target); counter.textContent = Math.ceil(count) + '+'; if (count < target) setTimeout(update, 10); };
                        update(); obs.disconnect();
                    }
                });
                obs.observe(counter);
            });

            // Slider
            let cur = 0;
            const slides = document.querySelectorAll('.slide');
            setInterval(() => { slides[cur].classList.remove('active'); cur = (cur + 1) % slides.length; slides[cur].classList.add('active'); }, 5000);
        });

        function acceptCookies() { localStorage.setItem('cookiesAccepted', 'true'); document.getElementById('cookieBanner').classList.add('cookie-hidden'); }
    </script>
</body>
</html>
