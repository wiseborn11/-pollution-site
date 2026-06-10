<?php require_once 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Strategy - PlasticPollutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0a0f1e; color: #e2e8f0; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        body::before { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(ellipse at 20% 40%, rgba(0,212,170,0.07) 0%, transparent 60%), radial-gradient(ellipse at 80% 70%, rgba(108,99,255,0.07) 0%, transparent 60%), linear-gradient(135deg, #0a0f1e, #0d1b3e, #0a0f1e); z-index: -1; pointer-events: none; }
        .glass-card { background: rgba(13,27,62,0.7); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; backdrop-filter: blur(12px); padding: 2rem; transition: transform 0.3s, box-shadow 0.3s; }
        .glass-card:hover { transform: translateY(-6px); box-shadow: 0 30px 60px rgba(0,0,0,0.4); }
        .section-label { display: inline-block; padding: 4px 14px; background: rgba(0,212,170,0.1); border: 1px solid rgba(0,212,170,0.3); border-radius: 20px; color: #00d4aa; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.75rem; }
        
        /* Custom timeline CSS */
        .timeline-container {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }
        .timeline-container::after {
            content: '';
            position: absolute;
            width: 4px;
            background: linear-gradient(#00d4aa, #6c63ff);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
        }
        .timeline-item {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
            box-sizing: border-box;
        }
        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: #0a0f1e;
            border: 4px solid #00d4aa;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
            box-shadow: 0 0 10px rgba(0,212,170,0.5);
        }
        .left { left: 0; }
        .right { left: 50%; }
        .right::after { left: -10px; border-color: #6c63ff; box-shadow: 0 0 10px rgba(108,99,255,0.5); }
        
        .content {
            padding: 20px;
            background: rgba(13,27,62,0.8);
            border: 1px solid rgba(255,255,255,0.08);
            position: relative;
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }
        @media screen and (max-width: 600px) {
            .timeline-container::after { left: 31px; }
            .timeline-item { width: 100%; padding-left: 70px; padding-right: 25px; }
            .left::after, .right::after { left: 21px; }
            .right { left: 0%; }
        }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main style="flex: 1; padding: 4rem 1.5rem;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 4rem;">
                <div class="section-label">🎯 Vision 2030</div>
                <h1 style="font-size: 2.8rem; font-weight: 900; margin: 0 0 10px; letter-spacing: -1px;">Strategic Vision</h1>
                <p style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; max-width: 600px; margin: 0 auto;">Our clear, actionable plan to eliminate plastic pollution at Pentecost University and beyond by 2030.</p>
            </div>

            <!-- Goals -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-bottom: 5rem;">
                <div class="glass-card" style="border-top: 3px solid #00d4aa; text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🎓</div>
                    <h3 style="font-size: 1.35rem; font-weight: 800; margin: 0 0 10px; color: #e2e8f0;">Educate</h3>
                    <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin: 0;">Integrate environmental awareness into the core curriculum and host regular workshops for all students.</p>
                </div>
                <div class="glass-card" style="border-top: 3px solid #6c63ff; text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">⚖️</div>
                    <h3 style="font-size: 1.35rem; font-weight: 800; margin: 0 0 10px; color: #e2e8f0;">Advocate</h3>
                    <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin: 0;">Lobby university administration to ban single-use plastics on campus and adopt sustainable procurement policies.</p>
                </div>
                <div class="glass-card" style="border-top: 3px solid #00e5ff; text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🔄</div>
                    <h3 style="font-size: 1.35rem; font-weight: 800; margin: 0 0 10px; color: #e2e8f0;">Innovate</h3>
                    <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin: 0;">Implement advanced recycling infrastructure and support student-led research into biodegradable alternatives.</p>
                </div>
            </div>

            <!-- Timeline -->
            <div style="text-align: center; margin-bottom: 3rem;">
                <div class="section-label">📅 Roadmap</div>
                <h2 style="font-size: 2rem; font-weight: 800; margin: 0;">Our Timeline to Zero Waste</h2>
            </div>
            
            <div class="timeline-container">
                <div class="timeline-item left">
                    <div class="content">
                        <h2 style="font-weight: 900; color: #00d4aa; margin: 0 0 4px; font-size: 1.25rem;">2024</h2>
                        <p style="font-weight: 700; margin: 0 0 8px; color: #e2e8f0;">Awareness & Infrastructure</p>
                        <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.6; margin: 0;">Launch campus-wide educational campaigns and install 100 new recycling sorting stations across all faculty buildings.</p>
                    </div>
                </div>
                <div class="timeline-item right">
                    <div class="content">
                        <h2 style="font-weight: 900; color: #6c63ff; margin: 0 0 4px; font-size: 1.25rem;">2026</h2>
                        <p style="font-weight: 700; margin: 0 0 8px; color: #e2e8f0;">Policy Implementation</p>
                        <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.6; margin: 0;">Work with the Student Representative Council to pass a mandate banning the sale of water sachets and plastic straws on campus.</p>
                    </div>
                </div>
                <div class="timeline-item left">
                    <div class="content">
                        <h2 style="font-weight: 900; color: #00e5ff; margin: 0 0 4px; font-size: 1.25rem;">2028</h2>
                        <p style="font-weight: 700; margin: 0 0 8px; color: #e2e8f0;">Community Expansion</p>
                        <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.6; margin: 0;">Extend our initiatives to the surrounding Sowutuom community, providing bins and organizing monthly district cleanups.</p>
                    </div>
                </div>
                <div class="timeline-item right">
                    <div class="content">
                        <h2 style="font-weight: 900; color: #eab308; margin: 0 0 4px; font-size: 1.25rem;">2030</h2>
                        <p style="font-weight: 700; margin: 0 0 8px; color: #e2e8f0;">Zero-Waste Campus</p>
                        <p style="font-size: 0.85rem; color: #94a3b8; line-height: 1.6; margin: 0;">Achieve a 95% diversion rate of waste from landfills, completely phasing out all non-essential single-use plastics.</p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
