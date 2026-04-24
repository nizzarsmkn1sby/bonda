<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Varap Japanese | Sakura Edition'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #E53935; /* Crimson Red */
            --primary-dark: #B71C1C;
            --primary-light: rgba(229, 57, 53, 0.1);
            --bg-color: #121212; /* Dark theme */
            --nav-bg: rgba(26, 26, 26, 0.95);
            --card-bg: rgba(30, 30, 30, 0.8);
            --text-main: #F5F5F5;
            --text-muted: #9E9E9E;
            --border: rgba(255, 255, 255, 0.08);
            --gold: #FFD700;
            --transition: all 0.3s ease;
            --glass: blur(10px) saturate(150%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Noto Sans JP', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(circle at 100% 0%, rgba(229, 57, 53, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 0% 100%, rgba(255, 215, 0, 0.05) 0%, transparent 30%),
                url('data:image/svg+xml;utf8,<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><g fill="%23e53935" fill-opacity="0.03" fill-rule="evenodd"><path d="M0 40L40 0H20L0 20M40 40V20L20 40"/></g></svg>');
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* --- Navbar Styles --- */
        .navbar {
            background: var(--nav-bg);
            backdrop-filter: var(--glass);
            -webkit-backdrop-filter: var(--glass);
            border-bottom: 2px solid var(--primary);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            padding: 0 20px;
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
        }

        .navbar-brand .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            box-shadow: 0 0 15px rgba(229, 57, 53, 0.5);
            border: 2px solid var(--gold);
        }

        .navbar-brand h2 {
            font-size: 22px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .navbar-brand h2 span {
            color: var(--primary);
        }

        .navbar-menu {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .nav-item {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid transparent;
        }

        .nav-item:hover {
            color: var(--text-main);
            background: var(--primary-light);
            border-color: rgba(229, 57, 53, 0.3);
            transform: translateY(-2px);
        }

        .nav-item.active {
            color: var(--text-main);
            border-bottom: 2px solid var(--primary);
            border-radius: 8px 8px 0 0;
            background: linear-gradient(to top, rgba(229, 57, 53, 0.2), transparent);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 1px solid var(--border);
            padding-left: 20px;
            margin-left: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            border: 2px solid var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            box-shadow: 0 0 10px rgba(229, 57, 53, 0.3);
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 700;
            font-size: 14px;
        }

        .user-role {
            font-size: 11px;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-logout {
            background: transparent;
            color: #E53935;
            border: 1px solid #E53935;
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 700;
        }

        .btn-logout:hover {
            background: #E53935;
            color: white;
            box-shadow: 0 0 10px rgba(229,57,53,0.5);
        }

        /* Mobile Hamburger */
        .hamburger {
            display: none;
            background: none;
            border: none;
            color: var(--text-main);
            font-size: 28px;
            cursor: pointer;
        }

        /* --- Main Content Area --- */
        .content-area {
            padding: 40px 20px;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            flex: 1;
        }

        .page-header {
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 20px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 15px;
        }

        .page-title h1 {
            font-size: clamp(24px, 4vw, 32px);
            font-weight: 800;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-title h1::before {
            content: '⛩️';
            font-size: 28px;
        }

        .page-title p {
            color: var(--text-muted);
            font-size: 14px;
            margin-top: 5px;
            font-weight: 500;
        }

        /* --- Cards & UI Elements --- */
        .card {
            background: var(--card-bg);
            backdrop-filter: var(--glass);
            -webkit-backdrop-filter: var(--glass);
            border-radius: 12px;
            padding: 25px;
            border: 1px solid var(--border);
            border-top: 3px solid var(--primary);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .card::after {
            content: '';
            position: absolute;
            top: 0; right: 0; width: 150px; height: 150px;
            background: radial-gradient(circle, rgba(229,57,53,0.1) 0%, transparent 70%);
            border-radius: 50%;
            transform: translate(30%, -30%);
            pointer-events: none;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(229, 57, 53, 0.15);
            border-color: rgba(229, 57, 53, 0.5);
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
            border: 1px solid transparent;
            text-transform: uppercase;
            letter-spacing: 1px;
            outline: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border-color: var(--primary-dark);
            box-shadow: 0 4px 10px rgba(229, 57, 53, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            box-shadow: 0 8px 20px rgba(229, 57, 53, 0.4);
            transform: translateY(-2px);
        }

        /* Forms */
        .form-control, .form-select {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid var(--border);
            color: var(--text-main);
            padding: 14px 16px;
            border-radius: 8px;
            width: 100%;
            transition: var(--transition);
            font-size: 14px;
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
            background: rgba(0, 0, 0, 0.6);
        }

        /* Tables */
        .table-responsive {
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
            background: rgba(20, 20, 20, 0.5);
        }

        th {
            background: rgba(229, 57, 53, 0.1);
            color: var(--primary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 12px;
            padding: 16px;
            text-align: left;
            border-bottom: 2px solid var(--primary-dark);
        }

        td {
            padding: 16px;
            border-bottom: 1px solid var(--border);
            color: var(--text-main);
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.03);
        }

        /* --- Alerts --- */
        .alert {
            background: rgba(229, 57, 53, 0.1);
            border-left: 4px solid var(--primary);
            color: var(--text-main);
            padding: 15px 20px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 30px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-color);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(229, 57, 53, 0.3);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(229, 57, 53, 0.6);
        }

        /* Layout Helpers */
        .grid { display: grid; gap: 24px; }
        .grid-2 { grid-template-columns: repeat(2, 1fr); }
        .grid-3 { grid-template-columns: repeat(3, 1fr); }
        .grid-4 { grid-template-columns: repeat(4, 1fr); }

        /* Responsive Mobile Menu */
        .mobile-nav-overlay {
            display: none;
            position: fixed;
            top: 70px; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(5px);
            z-index: 998;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .mobile-nav-overlay.active {
            opacity: 1;
        }

        @media (max-width: 1024px) {
            .navbar-menu {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 280px;
                height: calc(100vh - 70px);
                background: var(--nav-bg);
                backdrop-filter: var(--glass);
                -webkit-backdrop-filter: var(--glass);
                flex-direction: column;
                align-items: flex-start;
                padding: 20px;
                transition: var(--transition);
                border-right: 2px solid var(--primary);
                z-index: 999;
                overflow-y: auto;
            }
            .navbar-menu.active {
                left: 0;
            }
            .nav-item {
                width: 100%;
                border-radius: 8px;
                padding: 12px 16px;
                font-size: 16px;
            }
            .nav-item.active {
                border-bottom: none;
                border-left: 3px solid var(--primary);
                border-radius: 0 8px 8px 0;
                background: linear-gradient(to right, rgba(229, 57, 53, 0.2), transparent);
            }
            .hamburger { display: block; }
            .user-menu {
                border-left: none;
                padding-left: 0;
                margin-left: 0;
                width: 100%;
                margin-top: 20px;
                padding-top: 20px;
                border-top: 1px solid var(--border);
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            .btn-logout { width: 100%; }
        }

        @media (max-width: 640px) {
            .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .content-area { padding: 20px; }
        }
    </style>
</head>
<body>

    <?php if(auth()->guard()->check()): ?>
    <!-- Navbar -->
    <header class="navbar">
        <div class="navbar-container">
            <a href="<?php echo e(route('dashboard')); ?>" class="navbar-brand">
                <div class="logo-icon">🏮</div>
                <h2>VARAP <span>JAPANESE</span></h2>
            </a>

            <button class="hamburger" onclick="toggleNav()">☰</button>

            <div class="mobile-nav-overlay" id="navOverlay" onclick="toggleNav()"></div>

            <nav class="navbar-menu" id="navMenu">
                <a href="<?php echo e(route('dashboard')); ?>" class="nav-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                    ⛩️ Dasbor
                </a>
                
                <?php if(auth()->user()->isOwner() || auth()->user()->isCashier()): ?>
                <a href="<?php echo e(route('pos.index')); ?>" class="nav-item <?php echo e(request()->routeIs('pos.*') ? 'active' : ''); ?>">
                    🍱 Kasir Utama
                </a>
                
                <a href="<?php echo e(route('transactions.index')); ?>" class="nav-item <?php echo e(request()->routeIs('transactions.*') ? 'active' : ''); ?>">
                    📜 Riwayat Transaksi
                </a>
                <?php endif; ?>

                <?php if(auth()->user()->isOwner()): ?>
                <a href="<?php echo e(route('products.index')); ?>" class="nav-item <?php echo e(request()->routeIs('products.*') ? 'active' : ''); ?>">
                    📦 Kelola Produk
                </a>
                <?php endif; ?>

                <div class="user-menu">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="avatar">
                            <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                        </div>
                        <div class="user-info">
                            <span class="user-name"><?php echo e(auth()->user()->name); ?></span>
                            <span class="user-role"><?php echo e(auth()->user()->role->name); ?></span>
                        </div>
                    </div>
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-logout">
                            Keluar Sesi
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </header>
    <?php endif; ?>

    <!-- Main Content Area -->
    <main class="content-area">
        <?php if(session('success')): ?>
            <div class="alert">
                <span>🌸</span> <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <script>
        function toggleNav() {
            document.getElementById('navMenu').classList.toggle('active');
            
            const overlay = document.getElementById('navOverlay');
            if (overlay.style.display === 'block') {
                overlay.style.display = 'none';
                setTimeout(() => { overlay.classList.remove('active'); }, 10);
                document.body.style.overflow = '';
            } else {
                overlay.style.display = 'block';
                setTimeout(() => { overlay.classList.add('active'); }, 10);
                document.body.style.overflow = 'hidden';
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\ARAP_JAPAN\resources\views/layouts/app.blade.php ENDPATH**/ ?>