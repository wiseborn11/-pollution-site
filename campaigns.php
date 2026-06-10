<?php require_once 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaigns - PlasticPollutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0a0f1e; color: #e2e8f0; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        body::before { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(ellipse at 20% 40%, rgba(0,212,170,0.07) 0%, transparent 60%), radial-gradient(ellipse at 80% 70%, rgba(108,99,255,0.07) 0%, transparent 60%), linear-gradient(135deg, #0a0f1e, #0d1b3e, #0a0f1e); z-index: -1; pointer-events: none; }
        .glass-card { background: rgba(13,27,62,0.7); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; backdrop-filter: blur(12px); overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s, box-shadow 0.3s; }
        .glass-card:hover { transform: translateY(-6px); box-shadow: 0 30px 60px rgba(0,0,0,0.4); }
        .section-label { display: inline-block; padding: 4px 14px; background: rgba(0,212,170,0.1); border: 1px solid rgba(0,212,170,0.3); border-radius: 20px; color: #00d4aa; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.75rem; }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main style="flex: 1; padding: 4rem 1.5rem;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 4rem;">
                <div class="section-label">📢 Take Action</div>
                <h1 style="font-size: 2.8rem; font-weight: 900; margin: 0 0 10px; letter-spacing: -1px;">Active Campaigns</h1>
                <p style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; max-width: 600px; margin: 0 auto;">Discover our ongoing initiatives and see the real-time impact we are making together.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(420px, 1fr)); gap: 2.5rem;">
                
                <!-- Campaign 1 -->
                <div class="glass-card">
                    <img src="assets/images/clean_ocean_1778711329902.png" alt="Operation Blue Ocean" style="height: 260px; width: 100%; object-fit: cover; border-bottom: 1px solid rgba(255,255,255,0.08);">
                    <div style="padding: 2rem; display: flex; flex-direction: column; flex-grow: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <span style="background: rgba(0,212,170,0.15); color: #00d4aa; border: 1px solid rgba(0,212,170,0.3); font-size: 0.75rem; font-weight: 700; px: 10px; py: 3px; padding: 3px 10px; border-radius: 99px; text-transform: uppercase; letter-spacing: 0.5px;">Ongoing</span>
                            <span style="font-size: 0.85rem; color: #475569;">Est. 2024</span>
                        </div>
                        <h2 style="font-size: 1.5rem; font-weight: 800; margin: 0 0 10px; color: #e2e8f0;">Operation Blue Coast</h2>
                        <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.6; margin: 0 0 1.5rem; flex-grow: 1;">Our flagship coastal cleanup initiative targeting heavily polluted beaches along the Greater Accra coastline. We organize massive volunteer drives bi-monthly.</p>
                        
                        <!-- Progress -->
                        <div style="margin-bottom: 1.5rem;">
                            <div style="display: flex; justify-content: space-between; font-size: 0.85rem; font-weight: 600; margin-bottom: 6px;">
                                <span style="color:#64748b;">Goal: 10,000kg removed</span>
                                <span style="color:#00d4aa;">8,500kg (85%)</span>
                            </div>
                            <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.08); border-radius: 999px; overflow: hidden;">
                                <div style="height: 100%; width: 85%; background: linear-gradient(90deg, #00d4aa, #6c63ff); border-radius: 999px;"></div>
                            </div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.06);">
                            <div>
                                <p style="font-size: 0.75rem; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 4px;">Volunteers</p>
                                <p style="font-size: 1.25rem; font-weight: 800; color: #e2e8f0; margin: 0;">450+</p>
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 4px;">Events Held</p>
                                <p style="font-size: 1.25rem; font-weight: 800; color: #e2e8f0; margin: 0;">12</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Campaign 2 -->
                <div class="glass-card">
                    <img src="assets/images/recycling_bins_1778711382994.png" alt="Campus Recycling" style="height: 260px; width: 100%; object-fit: cover; border-bottom: 1px solid rgba(255,255,255,0.08);">
                    <div style="padding: 2rem; display: flex; flex-direction: column; flex-grow: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <span style="background: rgba(108,99,255,0.15); color: #a78bfa; border: 1px solid rgba(108,99,255,0.3); font-size: 0.75rem; font-weight: 700; px: 10px; py: 3px; padding: 3px 10px; border-radius: 99px; text-transform: uppercase; letter-spacing: 0.5px;">High Priority</span>
                            <span style="font-size: 0.85rem; color: #475569;">Est. 2025</span>
                        </div>
                        <h2 style="font-size: 1.5rem; font-weight: 800; margin: 0 0 10px; color: #e2e8f0;">Sort It Out PU</h2>
                        <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.6; margin: 0 0 1.5rem; flex-grow: 1;">A massive infrastructure push to provide proper waste segregation bins across every faculty building and hostel at Pentecost University.</p>
                        
                        <!-- Progress -->
                        <div style="margin-bottom: 1.5rem;">
                            <div style="display: flex; justify-content: space-between; font-size: 0.85rem; font-weight: 600; margin-bottom: 6px;">
                                <span style="color:#64748b;">Goal: 200 bins installed</span>
                                <span style="color:#6c63ff;">120 units (60%)</span>
                            </div>
                            <div style="width: 100%; height: 8px; background: rgba(255,255,255,0.08); border-radius: 999px; overflow: hidden;">
                                <div style="height: 100%; width: 60%; background: linear-gradient(90deg, #6c63ff, #00e5ff); border-radius: 999px;"></div>
                            </div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.06);">
                            <div>
                                <p style="font-size: 0.75rem; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 4px;">Funds Raised</p>
                                <p style="font-size: 1.25rem; font-weight: 800; color: #e2e8f0; margin: 0;">$12,000</p>
                            </div>
                            <div>
                                <p style="font-size: 0.75rem; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 4px;">Faculties Reached</p>
                                <p style="font-size: 1.25rem; font-weight: 800; color: #e2e8f0; margin: 0;">4 / 7</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
