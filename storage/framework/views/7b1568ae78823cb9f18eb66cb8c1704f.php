<?php $__env->startSection('title', 'Connexion - Check-Sys'); ?>

<?php
    // Récupérer les couleurs du tenant (session ou middleware)
    $tenantColors = session('tenant_colors', view()->shared('tenantColors', [
        'primary_color' => '#2c3e50',
        'secondary_color' => '#3498db',
        'accent_color' => '#f39c12'
    ]));
    
    // Forcer les couleurs de test selon l'URL
    if (request()->get('hotel_id') == '3') {
        $tenantColors = [
            'primary_color' => '#1e3a8a',
            'secondary_color' => '#3b82f6',
            'accent_color' => '#f59e0b'
        ];
    } elseif (request()->get('hotel_id') == '4') {
        $tenantColors = [
            'primary_color' => '#059669',
            'secondary_color' => '#10b981',
            'accent_color' => '#fbbf24'
        ];
    } elseif (request()->get('hotel_id') == '45') {
        $tenantColors = [
            'primary_color' => '#7c3aed',
            'secondary_color' => '#a78bfa',
            'accent_color' => '#f59e0b'
        ];
    }
?>

<?php $__env->startSection('content'); ?>

<style>
/* ═════════════════════════════════════════════════════════════
   STYLES CONNEXION TENANT - Design moderne avec personnalisation
═════════════════════════════════════════════════════════════════ */
:root {
    --primary: <?php echo e($tenantColors['primary_color'] ?? '#2c3e50'); ?>;
    --primary-light: <?php echo e($tenantColors['primary_color'] ?? '#2c3e50'); ?>dd;
    --primary-soft: <?php echo e($tenantColors['primary_color'] ?? '#2c3e50'); ?>15;
    --secondary: <?php echo e($tenantColors['secondary_color'] ?? '#3498db'); ?>;
    --accent: <?php echo e($tenantColors['accent_color'] ?? '#f39c12'); ?>;
    --success: #27ae60;
    --warning: #f39c12;
    --danger: #e74c3c;
    --info: #17a2b8;
    --gray-50: #f8f9fa;
    --gray-100: #e9ecef;
    --gray-200: #dee2e6;
    --gray-300: #ced4da;
    --gray-400: #adb5bd;
    --gray-500: #6c757d;
    --gray-600: #495057;
    --gray-700: #343a40;
    --gray-800: #212529;
    --white: #ffffff;
    --radius: 12px;
    --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    --shadow-hover: 0 10px 30px rgba(0, 0, 0, 0.12);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

body {
    background: transparent !important;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
}

.login-container {
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.login-card {
    background: var(--white);
    border-radius: 24px;
    box-shadow: var(--shadow-hover);
    overflow: hidden;
    display: flex;
    min-height: 800px;
    border: 1px solid var(--gray-200);
}

.login-left {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color: white;
    padding: 3rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.login-left::before {
    content: '';
    position: absolute;
    top: -100px;
    right: -100px;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-20px) scale(1.05); }
}

.login-right {
    flex: 2;
    padding: 3rem;
    display: flex;
    flex-direction: column;
    background: var(--white);
    overflow-y: auto;
    max-height: 90vh;
}

.login-header {
    text-align: center;
    margin-bottom: 2rem;
}

.login-header h2 {
    color: var(--primary);
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 2rem;
}

.login-header p {
    color: var(--gray-500);
    font-size: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--gray-700);
    font-weight: 500;
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 1px solid var(--gray-200);
    border-radius: 8px;
    font-size: 0.95rem;
    transition: var(--transition);
    background: var(--white);
    color: var(--gray-800);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-soft);
    color: var(--gray-800) !important;
}

.form-control::placeholder {
    color: var(--gray-400);
}

.btn-login {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    font-size: 1rem;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px <?php echo e($tenantColors['primary_color'] ?? '#2c3e50'); ?>40;
}

.btn-register {
    background: transparent;
    color: var(--primary);
    padding: 0.875rem 1.5rem;
    border: 2px solid var(--primary);
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    font-size: 0.95rem;
}

.btn-register:hover {
    background: var(--primary);
    color: white;
    transform: translateY(-2px);
}

.forgot-password {
    text-align: center;
    margin-top: 1rem;
}

.forgot-password a {
    color: var(--primary);
    text-decoration: none;
    font-size: 0.9rem;
    transition: var(--tranarition);
}

.forgot-password a:hover {
    color: var(--primary-light);
    text-decoration: underline;
}

.alert {
    padding: 1rem 1.5rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.alert-success {
    background: rgba(39, 174, 96, 0.1);
    border: 1px solid var(--success);
    color: var(--success);
}

.alert-error {
    background: rgba(231, 76, 60, 0.1);
    border: 1px solid var(--danger);
    color: var(--danger);
}

.text-danger {
    color: var(--danger);
    font-size: 0.8rem;
    margin-top: 0.3rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

/* Responsive */
@media (max-width: 1024px) {
    .login-card {
        flex-direction: column;
        max-height: none;
    }
    
    .login-left {
        padding: 2rem;
        min-height: 200px;
    }
    
    .login-right {
        max-height: none;
    }
}

@media (max-width: 768px) {
    .login-container {
        padding: 1rem 0.5rem;
    }
    
    .login-right {
        padding: 1.5rem;
    }
}
</style>

<div class="login-container">
    <div class="login-card">
        <!-- Côté gauche avec présentation -->
        <div class="login-left">
            <div style="position: relative; z-index: 2;">
                <div style="text-align: center; margin-bottom: 2rem;">
                    <i class="fas fa-hotel" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.8rem; margin-bottom: 0.5rem;">Check-Sys</h3>
                    <p style="opacity: 0.9; font-size: 1rem;">Votre solution de gestion hôtelière complète</p>
                </div>

                <div style="margin-bottom: 2rem;">
                    <h4 style="font-size: 1.2rem; margin-bottom: 1rem;">Bienvenue de retour !</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 1rem; display: flex; align-items: center;">
                            <i class="fas fa-check-circle" style="margin-right: 0.75rem; color: #27ae60;"></i>
                            <span>Accès sécurisé à votre espace</span>
                        </li>
                        <li style="margin-bottom: 1rem; display: flex; align-items: center;">
                            <i class="fas fa-check-circle" style="margin-right: 0.75rem; color: #27ae60;"></i>
                            <span>Gestion multi-établissements</span>
                        </li>
                        <li style="margin-bottom: 1rem; display: flex; align-items: center;">
                            <i class="fas fa-check-circle" style="margin-right: 0.75rem; color: #27ae60;"></i>
                            <span>Tableau de bord personnalisé</span>
                        </li>
                        <li style="margin-bottom: 1rem; display: flex; align-items: center;">
                            <i class="fas fa-check-circle" style="margin-right: 0.75rem; color: #27ae60;"></i>
                            <span>Support technique 24/7</span>
                        </li>
                    </ul>
                </div>

                <div style="background: rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 1.5rem; backdrop-filter: blur(10px);">
                    <h4 style="font-size: 1.1rem; margin-bottom: 0.5rem;">
                        <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                        Besoin d'aide ?
                    </h4>
                    <p style="font-size: 0.9rem; opacity: 0.9; line-height: 1.5;">
                        Contactez notre support technique pour toute assistance concernant votre connexion.
                    </p>
                </div>
            </div>
        </div>

        <!-- Côté droit avec le formulaire -->
        <div class="login-right">
            <div class="login-header">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <div>
                        <h2>Connexion</h2>
                        <p>Accédez à votre espace de gestion</p>
                    </div>
                    
                </div>
            </div>

            <?php if(session('error')): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span><?php echo e(session('error')); ?></span>
                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login.submit')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" 
                           placeholder="votre.email@hotel.com" required autofocus>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" 
                           placeholder="••••••••" required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" id="remember" name="remember" class="form-check-input" 
                               style="width: 18px; height: 18px; border: 2px solid var(--gray-300); border-radius: 4px;">
                        <label for="remember" class="form-check-label" style="color: var(--gray-600); font-size: 0.9rem;">
                            Se souvenir de moi
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Se connecter
                    </button>
                </div>

                <div class="forgot-password">
                    <a href="/forgot-password">
                        <i class="fas fa-key me-1"></i>
                        Mot de passe oublié ?
                    </a>
                </div>
            </form>

            <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--gray-200);">
                <p style="color: var(--gray-500); font-size: 0.9rem;">
                    Pas encore de compte ? 
                    <a href="/register-tenant" style="color: var(--primary); font-weight: 500; text-decoration: none;">
                        Créez votre compte hôtel
                    </a>
                </p>
                
                <div style="margin-top: 1rem;">
                    <a href="/register-tenant" class="btn-register" style="display: inline-block; padding: 8px 16px; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border: none; border-radius: 5px; font-weight: 500; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 8px <?php echo e($tenantColors['primary_color'] ?? '#2c3e50'); ?>25; font-size: 0.9rem; min-width: 180px; text-align: center;">
                        <i class="fas fa-plus-circle me-2"></i>
                        Créer un compte hôtel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script forçage des couleurs du tenant -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Tenant Login: Loading colors...');
    
    // Couleurs du tenant depuis PHP
    const tenantColors = <?php echo json_encode($tenantColors, 15, 512) ?>;
    console.log('Tenant Login Colors:', tenantColors);
    
    // Forcer les variables CSS
    const root = document.documentElement;
    root.style.setProperty('--primary', tenantColors.primary_color);
    root.style.setProperty('--primary-light', tenantColors.primary_color + 'dd');
    root.style.setProperty('--primary-soft', tenantColors.primary_color + '15');
    root.style.setProperty('--secondary', tenantColors.secondary_color);
    root.style.setProperty('--accent', tenantColors.accent_color);
    
    // Forcer les styles directement sur les éléments
    const elementsToUpdate = [
        { selector: '.btn-login', properties: { background: `linear-gradient(135deg, ${tenantColors.primary_color}, ${tenantColors.secondary_color})` } },
        { selector: '.btn-register', properties: { background: `linear-gradient(135deg, ${tenantColors.primary_color}, ${tenantColors.secondary_color})` } },
        { selector: '.login-card', properties: { borderTop: `4px solid ${tenantColors.primary_color}` } },
        { selector: '.form-control:focus', properties: { borderColor: tenantColors.primary_color, boxShadow: `0 0 0 0.2rem ${tenantColors.primary_color}25` } }
    ];
    
    elementsToUpdate.forEach(item => {
        const elements = document.querySelectorAll(item.selector);
        elements.forEach(el => {
            Object.keys(item.properties).forEach(prop => {
                el.style[prop] = item.properties[prop];
            });
        });
    });
    
    console.log('Tenant Login: Colors applied successfully!');
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Majorelle V\Documents\MoradaManagement\resources\views/auth/tenant-login.blade.php ENDPATH**/ ?>