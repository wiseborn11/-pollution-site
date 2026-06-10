<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    :root {
        --ocean-deep: #0a0f1e;
        --ocean-mid: #0d1b3e;
        --teal-primary: #00d4aa;
        --teal-secondary: #00b894;
        --indigo-accent: #6c63ff;
        --cyan-glow: #00e5ff;
        --text-primary: #e2e8f0;
        --text-muted: #94a3b8;
        --glass-bg: rgba(255,255,255,0.05);
        --glass-border: rgba(255,255,255,0.1);
        --card-bg: rgba(13,27,62,0.8);
    }

    * { box-sizing: border-box; }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--ocean-deep);
        color: var(--text-primary);
        margin: 0;
    }

    /* Animated background */
    body::before {
        content: '';
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background:
            radial-gradient(ellipse at 20% 50%, rgba(0,212,170,0.08) 0%, transparent 60%),
            radial-gradient(ellipse at 80% 20%, rgba(108,99,255,0.08) 0%, transparent 60%),
            radial-gradient(ellipse at 60% 80%, rgba(0,229,255,0.05) 0%, transparent 50%),
            linear-gradient(135deg, #0a0f1e 0%, #0d1b3e 50%, #0a0f1e 100%);
        z-index: -1;
        pointer-events: none;
    }

    /* Navbar */
    .pp-nav {
        position: sticky;
        top: 0;
        z-index: 100;
        background: rgba(10,15,30,0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid var(--glass-border);
        box-shadow: 0 4px 30px rgba(0,0,0,0.3);
    }

    .pp-nav-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 68px;
    }

    .pp-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        font-weight: 800;
        font-size: 1.2rem;
        letter-spacing: -0.3px;
        color: var(--text-primary);
        transition: opacity 0.2s;
    }

    .pp-logo:hover { opacity: 0.85; }

    .pp-logo-icon {
        width: 36px; height: 36px;
        background: linear-gradient(135deg, var(--teal-primary), var(--indigo-accent));
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 0 15px rgba(0,212,170,0.4);
    }

    .pp-logo-icon svg { color: white; }

    .pp-logo span { color: var(--teal-primary); }

    .pp-nav-links {
        display: flex;
        align-items: center;
        gap: 4px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .pp-nav-links a {
        display: block;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-muted);
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .pp-nav-links a:hover,
    .pp-nav-links a.active {
        color: var(--text-primary);
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
    }

    .pp-nav-links a.active {
        color: var(--teal-primary);
        background: rgba(0,212,170,0.1);
        border-color: rgba(0,212,170,0.3);
    }

    .pp-btn-dashboard {
        padding: 8px 16px !important;
        background: linear-gradient(135deg, var(--indigo-accent), #8b5cf6) !important;
        color: white !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        border: none !important;
    }

    .pp-btn-dashboard:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(108,99,255,0.4) !important;
        background: linear-gradient(135deg, #7c73ff, #9b7dff) !important;
    }

    .pp-btn-login {
        padding: 8px 16px !important;
        background: linear-gradient(135deg, var(--teal-primary), var(--teal-secondary)) !important;
        color: #0a0f1e !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        border: none !important;
    }

    .pp-btn-login:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0,212,170,0.4) !important;
        opacity: 0.9;
    }

    .pp-btn-logout {
        padding: 8px 16px !important;
        background: rgba(239,68,68,0.15) !important;
        color: #f87171 !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        border: 1px solid rgba(239,68,68,0.3) !important;
    }

    .pp-btn-logout:hover {
        background: rgba(239,68,68,0.25) !important;
        color: #fca5a5 !important;
    }

    /* Dropdown */
    .pp-dropdown {
        position: relative;
    }

    .pp-dropdown-btn {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-muted);
        background: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .pp-dropdown-btn:hover {
        color: var(--text-primary);
        background: var(--glass-bg);
    }

    .pp-dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        min-width: 190px;
        background: rgba(10,15,30,0.95);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 12px;
        padding: 6px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        z-index: 200;
    }

    .pp-dropdown:hover .pp-dropdown-menu { display: block; }

    .pp-dropdown-menu a {
        display: block;
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 0.875rem;
        color: var(--text-muted);
        text-decoration: none;
        transition: all 0.15s;
    }

    .pp-dropdown-menu a:hover {
        background: rgba(0,212,170,0.1);
        color: var(--teal-primary);
    }

    /* Mobile menu button */
    .pp-mobile-btn {
        display: none;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 8px;
        padding: 8px;
        cursor: pointer;
        color: var(--text-primary);
    }

    .pp-mobile-menu {
        display: none;
        padding: 12px 16px 16px;
        border-top: 1px solid var(--glass-border);
        background: rgba(10,15,30,0.95);
        backdrop-filter: blur(20px);
    }

    .pp-mobile-menu.open { display: block; }

    .pp-mobile-menu a {
        display: block;
        padding: 10px 14px;
        border-radius: 8px;
        color: var(--text-muted);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s;
        margin-bottom: 2px;
    }

    .pp-mobile-menu a:hover {
        color: var(--teal-primary);
        background: rgba(0,212,170,0.1);
    }

    @media (max-width: 900px) {
        .pp-nav-desktop { display: none; }
        .pp-mobile-btn { display: flex; align-items: center; }
    }

    @media (min-width: 901px) {
        .pp-mobile-btn { display: none; }
        .pp-mobile-menu { display: none !important; }
    }
</style>

<nav class="pp-nav">
    <div class="pp-nav-inner">
        <a href="index.php" class="pp-logo">
            <div class="pp-logo-icon">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            Plastic<span>Pollutions</span>
        </a>

        <!-- Desktop Nav -->
        <ul class="pp-nav-links pp-nav-desktop">
            <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="what-to-do.php" class="<?php echo $current_page == 'what-to-do.php' ? 'active' : ''; ?>">What To Do</a></li>
            <li><a href="campaigns.php" class="<?php echo $current_page == 'campaigns.php' ? 'active' : ''; ?>">Campaigns</a></li>
            <li><a href="donations.php" class="<?php echo $current_page == 'donations.php' ? 'active' : ''; ?>">Donate</a></li>

            <li class="pp-dropdown">
                <button class="pp-dropdown-btn">
                    More
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="pp-dropdown-menu">
                    <a href="latest.php">📰 Latest News</a>
                    <a href="strategy.php">🎯 Strategy</a>
                    <a href="help.php">🤝 Help & Volunteer</a>
                    <a href="developers.php">👨‍💻 Developers</a>
                    <a href="contact.php">✉️ Contact</a>
                </div>
            </li>

            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="dashboard.php" class="pp-btn-dashboard">Dashboard</a></li>
                <li><a href="logout.php" class="pp-btn-logout">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php" class="pp-btn-login">Login</a></li>
            <?php endif; ?>
        </ul>

        <!-- Mobile button -->
        <button class="pp-mobile-btn" onclick="document.getElementById('ppMobileMenu').classList.toggle('open')">
            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="pp-mobile-menu" id="ppMobileMenu">
        <a href="index.php">Home</a>
        <a href="what-to-do.php">What To Do</a>
        <a href="campaigns.php">Campaigns</a>
        <a href="donations.php">Donate</a>
        <a href="latest.php">Latest News</a>
        <a href="strategy.php">Strategy</a>
        <a href="help.php">Help & Volunteer</a>
        <a href="developers.php">Developers</a>
        <a href="contact.php">Contact</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php" style="color: #a78bfa; font-weight: 600;">Dashboard</a>
            <a href="logout.php" style="color: #f87171;">Logout</a>
        <?php else: ?>
            <a href="login.php" style="color: var(--teal-primary); font-weight: 600;">Login</a>
        <?php endif; ?>
    </div>
</nav>
