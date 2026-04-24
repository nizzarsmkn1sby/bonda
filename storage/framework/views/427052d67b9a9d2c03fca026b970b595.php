<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'ARAP POS | Sistem Manajemen Kasir'); ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        :root {
            --primary: #6366f1;
            --primary-light: rgba(99, 102, 241, 0.1);
            --primary-glow: rgba(99, 102, 241, 0.4);
            --bg-color: #0b0f1a;
            --sidebar-bg: rgba(17, 24, 39, 0.95);
            --card-bg: rgba(31, 41, 55, 0.4);
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
            --border: rgba(255, 255, 255, 0.08);
            --glass: blur(16px) saturate(180%);
            --sidebar-width: 280px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(circle at 0% 0%, rgba(99, 102, 241, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 100% 100%, rgba(168, 85, 247, 0.1) 0%, transparent 40%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* --- Sidebar Styles --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            backdrop-filter: var(--glass);
            -webkit-backdrop-filter: var(--glass);
            border-right: 1px solid var(--border);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
        }

        .sidebar-brand {
            margin-bottom: 50px;
            padding: 0 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .sidebar-brand-inner {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand h2 {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -1px;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
        }

        .sidebar-brand .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 0 20px var(--primary-glow);
        }

        .close-sidebar-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 24px;
            cursor: pointer;
        }

        .sidebar-menu {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
            overflow-y: auto;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 14px;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            gap: 12px;
        }

        .sidebar-item:hover {
            color: var(--text-main);
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(5px);
        }

        .sidebar-item.active {
            color: #fff;
            background: var(--primary);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            margin-bottom: 15px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        /* --- Main Content Area --- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: var(--transition);
        }

        .guest-layout {
            margin-left: 0;
            align-items: center;
            justify-content: center;
        }

        .content-area {
            padding: 40px;
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
        }

        .page-title h1 {
            font-size: clamp(24px, 4vw, 32px);
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -1px;
            margin-bottom: 8px;
        }

        .page-title p {
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 500;
        }

        /* --- Mobile Header --- */
        .mobile-header {
            display: none;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
            background: rgba(11, 15, 26, 0.9);
            backdrop-filter: var(--glass);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .hamburger {
            background: none;
            border: none;
            color: #fff;
            font-size: 28px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        /* --- Aesthetic Cards --- */
        .card {
            background: var(--card-bg);
            backdrop-filter: var(--glass);
            -webkit-backdrop-filter: var(--glass);
            border-radius: 24px;
            padding: 30px;
            border: 1px solid var(--border);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            transition: var(--transition);
        }

        .card:hover {
            border-color: rgba(99, 102, 241, 0.3);
            transform: translateY(-5px);
        }

        /* --- Custom Scrollbar --- */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-color);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.2);
        }

        /* --- Buttons --- */
        .btn {
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: var(--transition);
            border: none;
            outline: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .btn-primary:hover {
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
            transform: translateY(-2px);
        }

        /* --- Alerts --- */
        .alert {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #10b981;
            padding: 18px 24px;
            border-radius: 16px;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Layout Helpers */
        .grid { display: grid; gap: 24px; }
        .grid-2 { grid-template-columns: repeat(2, 1fr); }
        .grid-3 { grid-template-columns: repeat(3, 1fr); }
        .grid-4 { grid-template-columns: repeat(4, 1fr); }

        /* Responsive Utilities */
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); box-shadow: 20px 0 50px rgba(0,0,0,0.5); }
            .main-wrapper { margin-left: 0; }
            .mobile-header { display: flex; }
            .close-sidebar-btn { display: block; }
            .sidebar-overlay.active { display: block; opacity: 1; }
            .grid-3, .grid-4 { grid-template-columns: repeat(2, 1fr); }
            
            /* Responsive content padding */
            .content-area { padding: 20px; }
            .card { padding: 20px; }
        }

        @media (max-width: 640px) {
            .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .sidebar { width: 100%; max-width: 320px; }
        }
    </style>
</head>
<body>

    <?php if(auth()->guard()->check()): ?>
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar Navigation -->
    <aside class="sidebar" id="mainSidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-inner">
                <div class="logo-icon">⚡</div>
                <h2>ARAP POS</h2>
            </div>
            <button class="close-sidebar-btn" onclick="toggleSidebar()">✕</button>
        </div>
        
        <nav class="sidebar-menu">
            <a href="<?php echo e(route('dashboard')); ?>" class="sidebar-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                <span style="font-size: 18px;">📊</span> Dasbor
            </a>
            
            <?php if(auth()->user()->isOwner() || auth()->user()->isCashier()): ?>
            <a href="<?php echo e(route('pos.index')); ?>" class="sidebar-item <?php echo e(request()->routeIs('pos.*') ? 'active' : ''); ?>">
                <span style="font-size: 18px;">💻</span> Kasir Utama
            </a>
            
            <a href="<?php echo e(route('transactions.index')); ?>" class="sidebar-item <?php echo e(request()->routeIs('transactions.*') ? 'active' : ''); ?>">
                <span style="font-size: 18px;">📝</span> Riwayat Transaksi
            </a>
            <?php endif; ?>

            <?php if(auth()->user()->isOwner()): ?>
            <a href="<?php echo e(route('products.index')); ?>" class="sidebar-item <?php echo e(request()->routeIs('products.*') ? 'active' : ''); ?>">
                <span style="font-size: 18px;">📦</span> Kelola Produk
            </a>
            <?php endif; ?>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="avatar">
                    <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                </div>
                <div style="overflow: hidden;">
                    <div style="font-weight: 700; font-size: 14px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><?php echo e(auth()->user()->name); ?></div>
                    <div style="font-size: 11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px;">
                        <?php echo e(auth()->user()->role->name); ?>

                    </div>
                </div>
            </div>
            
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="sidebar-item" style="width: 100%; background: none; border: none; cursor: pointer; color: #ef4444;">
                    <span style="font-size: 18px;">🚪</span> Keluar Sesi
                </button>
            </form>
        </div>
    </aside>
    <?php endif; ?>

    <!-- Main Content Area -->
    <main class="main-wrapper <?php if(auth()->guard()->guest()): ?> guest-layout <?php endif; ?>">
        
        <?php if(auth()->guard()->check()): ?>
        <!-- Mobile Header (Visible only on smaller screens) -->
        <div class="mobile-header">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 35px; height: 35px; background: var(--primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px;">⚡</div>
                <h2 style="font-size: 18px; font-weight: 800; margin: 0; color: #fff;">ARAP POS</h2>
            </div>
            <button class="hamburger" onclick="toggleSidebar()">☰</button>
        </div>
        <?php endif; ?>

        <div class="content-area">
            <?php if(session('success')): ?>
                <div class="alert">
                    <span>✨</span> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            document.getElementById('mainSidebar').classList.toggle('active');
            document.getElementById('sidebarOverlay').classList.toggle('active');
            // Prevent scrolling on body when sidebar is open on mobile
            if(document.getElementById('mainSidebar').classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\ARAP\resources\views/layouts/app.blade.php ENDPATH**/ ?>