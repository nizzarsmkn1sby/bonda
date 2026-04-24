<?php $__env->startSection('title', 'Autentikasi | Varap Japanese'); ?>

<?php $__env->startSection('content'); ?>
<div style="width: 100%; max-width: 450px; position: relative;">
    <!-- Tech Frame Background -->
    <div style="position: absolute; top: -20px; left: -20px; right: -20px; bottom: -20px; border: 1px solid var(--border); border-radius: 40px; pointer-events: none; z-index: -1;"></div>
    
    <div class="card" style="padding: 50px 40px; margin-bottom: 0;">
        <div style="text-align: center; margin-bottom: 40px;">
            <div style="display: inline-flex; align-items: center; justify-content: center; width: 64px; height: 64px; background: var(--primary-light); border-radius: 16px; margin-bottom: 20px; border: 1px solid var(--border);">
                <span style="font-size: 32px;">⛩️</span>
            </div>
            <h2 style="font-size: 24px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; color: #fff; margin-bottom: 8px;">
                Akses <span style="color: var(--primary);">Sistem</span>
            </h2>
            <p style="color: var(--text-muted); font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">
                Sakura POS | Gerbang Masuk
            </p>
        </div>

        <?php if($errors->any()): ?>
            <div class="alert" style="background: rgba(239, 68, 68, 0.1); border-color: rgba(239, 68, 68, 0.2); color: #ef4444; margin-bottom: 25px;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="font-size: 12px; font-weight: 600;">
                        <span>⚠️</span> <?php echo e($error); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        
        <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="form-group" style="margin-bottom: 20px;">
                <label class="form-label" style="font-size: 12px; color: #fff;">Alamat Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo e(old('email', 'owner@cashier.com')); ?>" required autofocus placeholder="operator@arap.sys" 
                       style="background: rgba(0,0,0,0.2); border-color: var(--border); border-radius: 12px; height: 50px; color: #fff;">
            </div>
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label class="form-label" style="font-size: 12px; color: #fff;">Kata Sandi</label>
                <input type="password" name="password" class="form-control" value="password" required placeholder="••••••••" 
                       style="background: rgba(0,0,0,0.2); border-color: var(--border); border-radius: 12px; height: 50px; color: #fff;">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color: var(--text-muted); font-size: 12px; font-weight: 600;">
                    <input type="checkbox" name="remember" style="accent-color: var(--primary);"> Ingat Saya
                </label>
                <a href="#" style="color: var(--primary); font-size: 12px; text-decoration: none; font-weight: 700;">Lupa Sandi?</a>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; height: 55px; font-size: 15px; letter-spacing: 1px; border-radius: 14px;">
                Masuk ke Sistem 🌸
            </button>
        </form>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <p style="color: var(--text-muted); font-size: 13px; font-weight: 500;">
            Belum memiliki akses? <a href="<?php echo e(route('register')); ?>" style="color: #fff; font-weight: 700; text-decoration: none; border-bottom: 1px solid var(--primary); padding-bottom: 2px;">Daftar Akun Baru</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bonda-main\bonda-main\resources\views/auth/login.blade.php ENDPATH**/ ?>