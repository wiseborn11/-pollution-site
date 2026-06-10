<?php require_once 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Volunteer - PlasticPollutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0a0f1e; color: #e2e8f0; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        body::before { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(ellipse at 20% 40%, rgba(0,212,170,0.07) 0%, transparent 60%), radial-gradient(ellipse at 80% 70%, rgba(108,99,255,0.07) 0%, transparent 60%), linear-gradient(135deg, #0a0f1e, #0d1b3e, #0a0f1e); z-index: -1; pointer-events: none; }
        .glass-card { background: rgba(13,27,62,0.7); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; backdrop-filter: blur(12px); padding: 2.2rem; }
        .fi { width: 100%; padding: 11px 14px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #e2e8f0; font-size: 0.9rem; box-sizing: border-box; outline: none; transition: all 0.2s; font-family: 'Inter', sans-serif; }
        .fi:focus { border-color: rgba(0,212,170,0.5); background: rgba(0,212,170,0.04); box-shadow: 0 0 0 3px rgba(0,212,170,0.1); }
        .fi::placeholder { color: #475569; }
        label { display: block; font-size: 0.75rem; font-weight: 600; color: #94a3b8; margin-bottom: 6px; letter-spacing: 0.3px; text-transform: uppercase; }
        .btn-teal { display: block; width: 100%; padding: 13px; background: linear-gradient(135deg, #00d4aa, #00b894); color: #0a0f1e; font-weight: 800; font-size: 1rem; border-radius: 10px; border: none; cursor: pointer; transition: all 0.3s; text-align: center; box-shadow: 0 4px 20px rgba(0,212,170,0.3); text-decoration: none; }
        .btn-teal:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,212,170,0.45); }
        .section-label { display: inline-block; padding: 4px 14px; background: rgba(0,212,170,0.1); border: 1px solid rgba(0,212,170,0.3); border-radius: 20px; color: #00d4aa; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.75rem; }
        .custom-checkbox {
            width: 1.4rem;
            height: 1.4rem;
            accent-color: #00d4aa;
            cursor: pointer;
        }
        select.fi option {
            background: #0d1b3e;
            color: #e2e8f0;
        }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main style="flex: 1; padding: 4rem 1.5rem;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 4rem;">
                <div class="section-label">🤝 Get Involved</div>
                <h1 style="font-size: 2.8rem; font-weight: 900; margin: 0 0 10px; letter-spacing: -1px;">Join The Fight</h1>
                <p style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; max-width: 600px; margin: 0 auto;">Whether you have an hour a week or just want to make personal lifestyle changes, there's a place for you here.</p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem; align-items: start;">
                
                <!-- Volunteer Signup Form -->
                <div class="glass-card" style="border-top: 3px solid #00d4aa;">
                    <h2 style="font-size: 1.5rem; font-weight: 800; margin: 0 0 6px;">Become a Volunteer</h2>
                    <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin: 0 0 2rem;">Sign up to receive alerts about upcoming beach cleanups, sorting days, and advocacy events.</p>
                    
                    <form onsubmit="event.preventDefault(); alert('Thank you for volunteering! We will contact you soon.'); this.reset();" style="display: flex; flex-direction: column; gap: 1.2rem;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div>
                                <label>First Name</label>
                                <input type="text" required class="fi" placeholder="John">
                            </div>
                            <div>
                                <label>Last Name</label>
                                <input type="text" required class="fi" placeholder="Doe">
                            </div>
                        </div>
                        <div>
                            <label>Email Address</label>
                            <input type="email" required class="fi" placeholder="john@example.com">
                        </div>
                        <div>
                            <label>Phone Number (Optional)</label>
                            <input type="tel" class="fi" placeholder="+233 ...">
                        </div>
                        <div>
                            <label>Areas of Interest</label>
                            <select class="fi">
                                <option>Beach Cleanups</option>
                                <option>Campus Sorting Station Monitor</option>
                                <option>Social Media & Marketing</option>
                                <option>Policy Advocacy</option>
                                <option>General Help</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-teal" style="margin-top: 0.5rem;">
                            Register as Volunteer 💚
                        </button>
                    </form>
                </div>

                <!-- Personal Pledge Tracker -->
                <div class="glass-card" style="border-top: 3px solid #6c63ff; position: relative; overflow: hidden;">
                    <div style="position: absolute; right: -40px; top: -40px; opacity: 0.05; pointer-events: none;">
                        <svg width="200" height="200" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.59-12.42L10 14.17l-2.59-2.58L6 13l4 4 8-8z"/></svg>
                    </div>
                    <div>
                        <h2 style="font-size: 1.5rem; font-weight: 800; margin: 0 0 6px;">My Plastic-Free Pledge</h2>
                        <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin: 0 0 2rem;">Commit to small daily changes. Check off the habits you've successfully adopted. Your progress is saved in your browser.</p>
                        
                        <div style="display: flex; flex-direction: column; gap: 10px;" id="pledgeList">
                            <label style="display: flex; align-items: center; gap: 14px; padding: 14px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.06)'" onmouseout="this.style.background='rgba(255,255,255,0.03)'">
                                <input type="checkbox" class="custom-checkbox pledge-cb" data-id="p1">
                                <span style="font-size: 0.95rem; font-weight: 500; color: #cbd5e1;">Use a reusable water bottle daily</span>
                            </label>
                            
                            <label style="display: flex; align-items: center; gap: 14px; padding: 14px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.06)'" onmouseout="this.style.background='rgba(255,255,255,0.03)'">
                                <input type="checkbox" class="custom-checkbox pledge-cb" data-id="p2">
                                <span style="font-size: 0.95rem; font-weight: 500; color: #cbd5e1;">Say no to plastic straws at restaurants</span>
                            </label>
                            
                            <label style="display: flex; align-items: center; gap: 14px; padding: 14px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.06)'" onmouseout="this.style.background='rgba(255,255,255,0.03)'">
                                <input type="checkbox" class="custom-checkbox pledge-cb" data-id="p3">
                                <span style="font-size: 0.95rem; font-weight: 500; color: #cbd5e1;">Bring reusable bags to the grocery store</span>
                            </label>
                            
                            <label style="display: flex; align-items: center; gap: 14px; padding: 14px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.06)'" onmouseout="this.style.background='rgba(255,255,255,0.03)'">
                                <input type="checkbox" class="custom-checkbox pledge-cb" data-id="p4">
                                <span style="font-size: 0.95rem; font-weight: 500; color: #cbd5e1;">Avoid single-use plastic cutlery</span>
                            </label>
                            
                            <label style="display: flex; align-items: center; gap: 14px; padding: 14px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.06)'" onmouseout="this.style.background='rgba(255,255,255,0.03)'">
                                <input type="checkbox" class="custom-checkbox pledge-cb" data-id="p5">
                                <span style="font-size: 0.95rem; font-weight: 500; color: #cbd5e1;">Properly sort my waste into recycling bins</span>
                            </label>
                        </div>
                        
                        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.08); display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 1.1rem; font-weight: 800;">Progress: <span id="pledgeProgress" style="color: #00d4aa; transition: color 0.3s;">0/5</span></span>
                            <button onclick="resetPledges()" style="background: none; border: none; font-size: 0.85rem; color: #64748b; text-decoration: underline; cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='#cbd5e1'" onmouseout="this.style.color='#64748b'">Reset Tracker</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        // Pledge Tracker Logic
        const checkboxes = document.querySelectorAll('.pledge-cb');
        const progressText = document.getElementById('pledgeProgress');

        function updateProgress() {
            let checked = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) checked++;
                // Save state
                localStorage.setItem(cb.dataset.id, cb.checked);
            });
            progressText.textContent = `${checked}/${checkboxes.length}`;
            
            if(checked === checkboxes.length) {
                progressText.style.color = '#fbbf24'; // Golden complete
            } else {
                progressText.style.color = '#00d4aa';
            }
        }

        // Load saved state
        checkboxes.forEach(cb => {
            const saved = localStorage.getItem(cb.dataset.id);
            if (saved === 'true') {
                cb.checked = true;
            }
            cb.addEventListener('change', updateProgress);
        });

        // Initial update
        updateProgress();

        function resetPledges() {
            if(confirm("Are you sure you want to reset your pledge progress?")) {
                checkboxes.forEach(cb => {
                    cb.checked = false;
                    localStorage.removeItem(cb.dataset.id);
                });
                updateProgress();
            }
        }
    </script>
</body>
</html>
