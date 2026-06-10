<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest News - PlasticPollutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0a0f1e; color: #e2e8f0; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        body::before { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(ellipse at 20% 40%, rgba(0,212,170,0.07) 0%, transparent 60%), radial-gradient(ellipse at 80% 70%, rgba(108,99,255,0.07) 0%, transparent 60%), linear-gradient(135deg, #0a0f1e, #0d1b3e, #0a0f1e); z-index: -1; pointer-events: none; }
        .glass-card { background: rgba(13,27,62,0.7); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; backdrop-filter: blur(12px); overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s, box-shadow 0.3s; }
        .glass-card:hover { transform: translateY(-6px); box-shadow: 0 30px 60px rgba(0,0,0,0.4); }
        .section-label { display: inline-block; padding: 4px 14px; background: rgba(0,212,170,0.1); border: 1px solid rgba(0,212,170,0.3); border-radius: 20px; color: #00d4aa; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.75rem; }
        .news-content {
            max-height: 4.5rem; /* 3 lines roughly */
            overflow: hidden;
            transition: max-height 0.5s ease-out;
        }
        .news-content.expanded {
            max-height: 1000px;
        }
        .btn-text {
            background: none;
            border: none;
            color: #00d4aa;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            padding: 0;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: color 0.2s;
        }
        .btn-text:hover {
            color: #00b894;
        }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main style="flex: 1; padding: 4rem 1.5rem;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 4rem;">
                <div class="section-label">📰 Updates</div>
                <h1 style="font-size: 2.8rem; font-weight: 900; margin: 0 0 10px; letter-spacing: -1px;">Latest News & Blog</h1>
                <p style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; max-width: 600px; margin: 0 auto;">Stay updated with our latest campaigns, achievements, and educational content.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 2rem;">
                
                <!-- Article 1 -->
                <article class="glass-card">
                    <img src="assets/images/plastic_beach_1778711315322.png" alt="Beach Cleanup" style="width: 100%; height: 220px; object-fit: cover; border-bottom: 1px solid rgba(255,255,255,0.08);">
                    <div style="padding: 1.8rem; flex-grow: 1; display: flex; flex-direction: column;">
                        <div style="color: #00d4aa; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Event Report</div>
                        <h2 style="font-size: 1.35rem; font-weight: 800; color: #e2e8f0; margin: 0 0 10px; line-height: 1.3;">Massive Success at Kokrobite Beach Cleanup</h2>
                        <p style="color: #475569; font-size: 0.8rem; margin: 0 0 16px;">Posted on May 10, 2026 by Admin</p>
                        <div class="text-gray-400 news-content relative" id="content-1" style="font-size: 0.9rem; line-height: 1.6; margin-bottom: 1.2rem; color: #94a3b8;">
                            Over 200 volunteers joined us last Saturday at Kokrobite beach for our largest cleanup event of the year. We managed to collect over 1,500kg of plastic waste, primarily single-use water sachets and bottles. 
                            <br><br>
                            This initiative not only cleared the immediate area but also raised significant awareness among the local fishing community. We partnered with a local recycling plant to ensure the collected materials are properly processed.
                        </div>
                        <button onclick="toggleReadMore('content-1', this)" class="btn-text" style="margin-top: auto; align-self: flex-start;">Read More →</button>
                    </div>
                </article>

                <!-- Article 2 -->
                <article class="glass-card">
                    <img src="assets/images/recycling_bins_1778711382994.png" alt="Campus Bins" style="width: 100%; height: 220px; object-fit: cover; border-bottom: 1px solid rgba(255,255,255,0.08);">
                    <div style="padding: 1.8rem; flex-grow: 1; display: flex; flex-direction: column;">
                        <div style="color: #6c63ff; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Campus Initiative</div>
                        <h2 style="font-size: 1.35rem; font-weight: 800; color: #e2e8f0; margin: 0 0 10px; line-height: 1.3;">New Segregation Bins Installed Across Campus</h2>
                        <p style="color: #475569; font-size: 0.8rem; margin: 0 0 16px;">Posted on April 28, 2026 by Sarah Mensah</p>
                        <div class="text-gray-400 news-content relative" id="content-2" style="font-size: 0.9rem; line-height: 1.6; margin-bottom: 1.2rem; color: #94a3b8;">
                            Thanks to your generous donations, we have successfully installed 50 new color-coded segregation bins across the Pentecost University campus. 
                            <br><br>
                            These bins are designed to separate organic waste, paper, and plastics at the source. This is a critical step in our strategy to make PU a zero-waste campus by 2030. We urge all students and staff to adhere to the sorting guidelines posted above each station.
                        </div>
                        <button onclick="toggleReadMore('content-2', this)" class="btn-text" style="margin-top: auto; align-self: flex-start;">Read More →</button>
                    </div>
                </article>

                <!-- Article 3 -->
                <article class="glass-card">
                    <img src="assets/images/marine_life_1778711491513.png" alt="Marine Life" style="width: 100%; height: 220px; object-fit: cover; border-bottom: 1px solid rgba(255,255,255,0.08);">
                    <div style="padding: 1.8rem; flex-grow: 1; display: flex; flex-direction: column;">
                        <div style="color: #00e5ff; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">Education</div>
                        <h2 style="font-size: 1.35rem; font-weight: 800; color: #e2e8f0; margin: 0 0 10px; line-height: 1.3;">The Hidden Cost of Microplastics in Our Diet</h2>
                        <p style="color: #475569; font-size: 0.8rem; margin: 0 0 16px;">Posted on April 15, 2026 by Dr. Kusi</p>
                        <div class="text-gray-400 news-content relative" id="content-3" style="font-size: 0.9rem; line-height: 1.6; margin-bottom: 1.2rem; color: #94a3b8;">
                            Recent studies highlight a disturbing trend: microplastics are entering our food chain at an alarming rate. From the fish we eat to the water we drink, invisible plastic particles are becoming ubiquitous.
                            <br><br>
                            This article explores how large plastics degrade into micro-particles, how marine life ingests them, and the potential long-term health impacts on humans. The solution lies in stopping plastic pollution at the source.
                        </div>
                        <button onclick="toggleReadMore('content-3', this)" class="btn-text" style="margin-top: auto; align-self: flex-start;">Read More →</button>
                    </div>
                </article>

            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        function toggleReadMore(contentId, btn) {
            const content = document.getElementById(contentId);
            if (content.classList.contains('expanded')) {
                content.classList.remove('expanded');
                btn.textContent = 'Read More →';
            } else {
                content.classList.add('expanded');
                btn.textContent = 'Show Less ←';
            }
        }
    </script>
</body>
</html>
