<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di BONDAA POS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --secondary: #94a3b8;
            --bg: #0f172a;
        }
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(148, 163, 184, 0.05) 0%, transparent 40%);
        }
        .container {
            text-align: center;
            z-index: 1;
        }
        h1 {
            font-size: 80px;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(to right, #ffffff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        p {
            font-size: 18px;
            color: var(--secondary);
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .btn {
            background: var(--primary);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
            display: inline-block;
        }
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.4);
            background: #1d4ed8;
        }
        .decor {
            position: absolute;
            font-size: 200px;
            opacity: 0.03;
            font-weight: 900;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="decor" style="top: -50px; left: -50px;">BONDAA</div>
    <div class="decor" style="bottom: -50px; right: -50px;">POS</div>

    <div class="container">
        <h1>BONDAA<span>.</span></h1>
        <p>Sistem manajemen kasir modern dengan performa tinggi dan antarmuka yang bersih untuk bisnis Anda.</p>
        <?php if(Route::has('login')): ?>
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(url('/dashboard')); ?>" class="btn">Masuk ke Dashboard</a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="btn">Mulai Sekarang</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\bondaa\resources\views/welcome.blade.php ENDPATH**/ ?>