<?php
require_once 'auth.php';

$petition_msg = '';
$petition_status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sign_petition'])) {
    verify_csrf_token($_POST['csrf_token'] ?? '');
    
    if (!isset($_SESSION['user_id'])) {
        $petition_status = 'error';
        $petition_msg = 'You must be logged in to sign the petition.';
    } else {
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM petitions WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            if ($stmt->fetchColumn() > 0) {
                $petition_status = 'info';
                $petition_msg = 'You have already signed this petition. Thank you!';
            } else {
                $stmt = $pdo->prepare("INSERT INTO petitions (user_id) VALUES (?)");
                $stmt->execute([$_SESSION['user_id']]);
                $petition_status = 'success';
                $petition_msg = 'Thank you for signing the petition!';
            }
        } catch (Exception $e) {
            $petition_status = 'error';
            $petition_msg = 'An error occurred. Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What To Do - PlasticPollutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0a0f1e; color: #e2e8f0; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        body::before { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(ellipse at 20% 40%, rgba(0,212,170,0.07) 0%, transparent 60%), radial-gradient(ellipse at 80% 70%, rgba(108,99,255,0.07) 0%, transparent 60%), linear-gradient(135deg, #0a0f1e, #0d1b3e, #0a0f1e); z-index: -1; pointer-events: none; }
        .glass-card { background: rgba(13,27,62,0.7); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; backdrop-filter: blur(12px); padding: 1.5rem; transition: transform 0.3s, box-shadow 0.3s; }
        .glass-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.3); }
        .btn-teal { display: block; width: 100%; padding: 13px; background: linear-gradient(135deg, #00d4aa, #00b894); color: #0a0f1e; font-weight: 800; font-size: 1rem; border-radius: 10px; border: none; cursor: pointer; transition: all 0.3s; text-align: center; box-shadow: 0 4px 20px rgba(0,212,170,0.3); text-decoration: none; }
        .btn-teal:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,212,170,0.45); }
        .section-label { display: inline-block; padding: 4px 14px; background: rgba(0,212,170,0.1); border: 1px solid rgba(0,212,170,0.3); border-radius: 20px; color: #00d4aa; font-size: 0.78rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.75rem; }
        table { width: 100%; border-collapse: collapse; }
        thead th { padding: 12px 14px; text-align: left; font-size: .75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .5px; border-bottom: 1px solid rgba(255,255,255,0.07); }
        tbody td { padding: 14px; font-size: .875rem; color: #cbd5e1; border-bottom: 1px solid rgba(255,255,255,0.05); }
        tbody tr:hover td { background: rgba(255,255,255,0.02); }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <main style="flex: 1;">
        <!-- Header -->
        <section style="background: linear-gradient(135deg, rgba(0,212,170,0.12), rgba(108,99,255,0.12)); border-bottom: 1px solid rgba(255,255,255,0.07); padding: 4rem 1.5rem; text-align: center;">
            <div style="max-width: 700px; margin: 0 auto;">
                <div class="section-label">🧠 Educational Guide</div>
                <h1 style="font-size: 2.8rem; font-weight: 900; margin: 0 0 1rem; letter-spacing: -1px;">What Can You Do?</h1>
                <p style="color: #94a3b8; font-size: 1.05rem; line-height: 1.7; margin: 0;">Understanding plastic types and proper recycling methods is the first step towards a cleaner planet.</p>
            </div>
        </section>

        <div style="max-width: 1200px; margin: 0 auto; padding: 3rem 1.5rem; display: flex; flex-direction: column; gap: 3.5rem;">
            
            <!-- Video Section -->
            <section>
                <div style="text-align: center; margin-bottom: 2rem;">
                    <div class="section-label">🎬 Watch & Learn</div>
                    <h2 style="font-size: 1.8rem; font-weight: 800; margin: 0;">The Impact of Plastic Pollution</h2>
                </div>
                <div style="max-width: 800px; margin: 0 auto; rounded-xl; overflow: hidden; box-shadow: 0 30px 80px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; position: relative; padding-top: 56.25%;">
                    <iframe style="position: absolute; top:0; left:0; width:100%; height:100%; border:0;" src="https://www.youtube.com/embed/HQTUWK7CM-Y" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <p style="text-align: center; font-size: 0.8rem; color: #475569; mt-3; margin-top: 12px;">Video by TED-Ed (Subtitles/Captions available on YouTube)</p>
            </section>

            <!-- Types of Plastic Table -->
            <section>
                <div style="margin-bottom: 1.5rem;">
                    <div class="section-label">🔬 Resin Identification Codes</div>
                    <h2 style="font-size: 1.8rem; font-weight: 800; margin: 0;">Know Your Plastics</h2>
                </div>
                <div class="glass-card" style="padding: 0; overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Type (Resin Code)</th>
                                <th>Common Uses</th>
                                <th>Recyclability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span style="color:#00d4aa; font-weight:700;">1 - PET</span> (Polyethylene Terephthalate)</td>
                                <td>Water bottles, soda bottles, salad domes</td>
                                <td style="color:#00d4aa; font-weight:600;">Widely Recycled</td>
                            </tr>
                            <tr>
                                <td><span style="color:#00d4aa; font-weight:700;">2 - HDPE</span> (High-Density Polyethylene)</td>
                                <td>Milk jugs, shampoo bottles, detergent bottles</td>
                                <td style="color:#00d4aa; font-weight:600;">Widely Recycled</td>
                            </tr>
                            <tr>
                                <td><span style="color:#a78bfa; font-weight:700;">3 - PVC</span> (Polyvinyl Chloride)</td>
                                <td>Pipes, blister packaging, some toys</td>
                                <td style="color:#f87171; font-weight:600;">Rarely Recycled</td>
                            </tr>
                            <tr>
                                <td><span style="color:#fbbf24; font-weight:700;">4 - LDPE</span> (Low-Density Polyethylene)</td>
                                <td>Grocery bags, bread bags, shrink wrap</td>
                                <td style="color:#fbbf24; font-weight:600;">Recyclable at specific drops</td>
                            </tr>
                            <tr>
                                <td><span style="color:#00d4aa; font-weight:700;">5 - PP</span> (Polypropylene)</td>
                                <td>Yogurt containers, straws, bottle caps</td>
                                <td style="color:#34d399; font-weight:600;">Often Recycled</td>
                            </tr>
                            <tr>
                                <td><span style="color:#a78bfa; font-weight:700;">6 - PS</span> (Polystyrene)</td>
                                <td>Styrofoam cups, takeout containers</td>
                                <td style="color:#f87171; font-weight:600;">Rarely Recycled</td>
                            </tr>
                            <tr>
                                <td><span style="color:#a78bfa; font-weight:700;">7 - Other</span> (Mixed Plastics)</td>
                                <td>CDs, baby bottles, large water jugs</td>
                                <td style="color:#f87171; font-weight:600;">Rarely Recycled</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Methods of Recycling -->
            <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                <div class="glass-card" style="text-align: center; border-top: 3px solid #00d4aa;">
                    <div style="background: rgba(0,212,170,0.1); width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem; font-size: 1.8rem;">🗑️</div>
                    <h3 style="font-size: 1.15rem; font-weight: 800; margin: 0 0 10px;">Reduce</h3>
                    <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin: 0;">The best way to manage waste is to not produce it. Buy products with less packaging and opt for reusable bags, bottles, and straws.</p>
                </div>
                <div class="glass-card" style="text-align: center; border-top: 3px solid #6c63ff;">
                    <div style="background: rgba(108,99,255,0.1); width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem; font-size: 1.8rem;">♻️</div>
                    <h3 style="font-size: 1.15rem; font-weight: 800; margin: 0 0 10px;">Reuse</h3>
                    <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin: 0;">Find new ways to use plastic items before throwing them away. Upcycle containers into planters or use them for storage.</p>
                </div>
                <div class="glass-card" style="text-align: center; border-top: 3px solid #fbbf24;">
                    <div style="background: rgba(251,191,36,0.1); width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem; font-size: 1.8rem;">🏭</div>
                    <h3 style="font-size: 1.15rem; font-weight: 800; margin: 0 0 10px;">Recycle</h3>
                    <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin: 0;">Always wash and dry plastics before putting them in the correct bin. Check local guidelines for what is accepted in your area.</p>
                </div>
            </section>

            <!-- Petition & Donate CTA -->
            <section style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: stretch;">
                <!-- Petition -->
                <div class="glass-card" style="display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h3 style="font-size: 1.4rem; font-weight: 800; margin: 0 0 10px;">Sign Our Petition</h3>
                        <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.6; margin: 0 0 1.5rem;">Demand the university administration ban single-use plastics on campus. Add your voice to our movement.</p>
                        
                        <?php if ($petition_msg): ?>
                            <div style="margin-bottom: 1.5rem; padding: 12px 16px; border-radius: 10px; font-size: 0.875rem; <?php 
                                echo $petition_status === 'error' ? 'background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.3); color:#f87171;' : 
                                    ($petition_status === 'info' ? 'background:rgba(108,99,255,0.1); border:1px solid rgba(108,99,255,0.3); color:#a78bfa;' : 'background:rgba(0,212,170,0.1); border:1px solid rgba(0,212,170,0.3); color:#00d4aa;'); 
                            ?>">
                                <?php echo htmlspecialchars($petition_msg); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <form action="what-to-do.php" method="POST">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
                        <button type="submit" name="sign_petition" class="btn-teal">
                            Sign Petition Now
                        </button>
                    </form>
                </div>

                <!-- Donate CTA -->
                <div class="glass-card" style="background: linear-gradient(135deg, rgba(0,212,170,0.15), rgba(108,99,255,0.15)); border: 1px solid rgba(0,212,170,0.25); text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 2rem;">
                    <div style="font-size: 2.5rem; margin-bottom: 12px;">💚</div>
                    <h3 style="font-size: 1.4rem; font-weight: 800; margin: 0 0 10px;">Support Our Work</h3>
                    <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.6; margin: 0 0 1.5rem; max-width: 340px;">We rely on donations to fund our cleanups and educational materials. Every little bit helps.</p>
                    <a href="donations.php" class="btn-teal" style="display:inline-block; width:auto; padding:12px 32px;">
                        Make a Donation
                    </a>
                </div>
            </section>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
