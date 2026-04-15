
<?php $__env->startSection('title', 'Login - Morada Lodge'); ?>
<?php $__env->startSection('content'); ?>

<style>
/* ═══════════════════════════════════════════════════════════════
   STYLES LOGIN - Design moderne cohérent
═══════════════════════════════════════════════════════════════════ */
:root {
    /* ── THÈME BLEU UNIFORME ── */
    --primary: #2563eb;
    --primary-light: #3b82f6;
    --primary-soft: rgba(37, 99, 235, 0.08);
    --primary-dark: #1d4ed8;
    --secondary: #60a5fa;
    --secondary-light: #93c5fd;
    --secondary-soft: rgba(96, 165, 250, 0.08);
    --accent: #3b82f6;
    --accent-light: rgba(59, 130, 246, 0.08);
    --success: #10b981;
    --success-light: #34d399;
    --success-soft: rgba(16, 185, 129, 0.08);
    --warning: #f59e0b;
    --warning-light: #fbbf24;
    --warning-soft: rgba(251, 191, 36, 0.08);
    --danger: #ef4444;
    --danger-light: #f87171;
    --danger-soft: rgba(239, 68, 68, 0.08);
    --info: #6366f1;
    --info-light: #818cf8;
    --info-soft: rgba(129, 140, 248, 0.08);
    
    /* Couleurs de base */
    --gray-50: #f8fafc;
    --gray-100: #f1f5f9;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    --white: #ffffff;
    
    /* Espacements et ombres */
    --radius-sm: 6px;
    --radius: 8px;
    --radius-lg: 12px;
    --radius-xl: 16px;
    --shadow-sm: 0 1px 2px rgba(37, 99, 235, 0.05);
    --shadow: 0 4px 6px rgba(37, 99, 235, 0.07);
    --shadow-lg: 0 10px 15px rgba(37, 99, 235, 0.1);
    --shadow-xl: 0 20px 25px rgba(37, 99, 235, 0.15);
    
    /* Transitions */
    --transition-fast: all 0.15s ease;
    --transition: all 0.2s ease;
    --transition-slow: all 0.3s ease;
    
    /* Typography */
    --font-sans: 'Inter', system-ui, -apple-system, sans-serif;
    --font-display: 'Inter Display', sans-serif;
}

body {
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%) !important;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    min-height: 100vh;
}

.login-container {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}

.login-card {
    background: var(--white);
    border-radius: 24px;
    box-shadow: var(--shadow-hover);
    overflow: hidden;
    width: 100%;
    max-width: 1000px;
    display: flex;
    min-height: 600px;
    border: 1px solid var(--gray-200);
    transition: var(--transition);
}

.login-card:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 6px 12px rgba(0, 0, 0, 0.05);
}

/* Côté gauche avec l'icône et présentation */
.login-left {
    background: linear-gradient(135deg, var(--primary) 0%, #654321 100%);
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

.login-left::after {
    content: '';
    position: absolute;
    bottom: -50px;
    left: -50px;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-20px) scale(1.05); }
}

.hotel-icon {
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
    text-align: center;
}

.hotel-icon img {
    height: 80px;
    width: auto;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    transition: var(--transition);
}

.hotel-icon img:hover {
    transform: scale(1.05) rotate(2deg);
}

.hotel-name {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    letter-spacing: 1px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.hotel-slogan {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 3rem;
    font-weight: 400;
    letter-spacing: 0.5px;
}

.features-list {
    list-style: none;
    padding: 0;
    margin: 0;
    position: relative;
    z-index: 2;
}

.features-list li {
    margin-bottom: 1.8rem;
    display: flex;
    align-items: center;
    transition: var(--transition);
}

.features-list li:hover {
    transform: translateX(10px);
}

.features-list i {
    background: rgba(255, 255, 255, 0.15);
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.2rem;
    backdrop-filter: blur(4px);
    transition: var(--transition);
}

.features-list li:hover i {
    background: rgba(255, 255, 255, 0.25);
    transform: scale(1.1);
}

.features-list strong {
    display: block;
    font-size: 1.1rem;
    margin-bottom: 0.25rem;
}

.features-list small {
    font-size: 0.85rem;
    opacity: 0.8;
}

/* Côté droit avec le formulaire */
.login-right {
    flex: 1;
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: var(--white);
}

.login-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.login-header h3 {
    color: var(--primary);
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 1.8rem;
}

.login-header p {
    color: var(--gray-500);
    font-size: 0.95rem;
}

.form-group {
    margin-bottom: 1.8rem;
    position: relative;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--gray-700);
    font-weight: 500;
    font-size: 0.9rem;
    letter-spacing: 0.3px;
}

.form-control {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 1px solid var(--gray-200);
    border-radius: 10px;
    font-size: 0.95rem;
    transition: var(--transition);
    background: var(--gray-50);
    color: var(--gray-800);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    background: var(--white);
    box-shadow: 0 0 0 3px var(--primary-soft);
}

.form-control::placeholder {
    color: var(--gray-400);
    font-size: 0.9rem;
}

.input-icon {
    position: absolute;
    left: 1rem;
    top: 2.7rem;
    color: var(--gray-400);
    font-size: 1.1rem;
    transition: var(--transition);
    pointer-events: none;
}

.form-control:focus + .input-icon {
    color: var(--primary);
}

.remember-forgot {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.form-check {
    display: flex;
    align-items: center;
}

.form-check-input {
    margin-right: 0.5rem;
    width: 18px;
    height: 18px;
    border: 2px solid var(--gray-300);
    border-radius: 4px;
    transition: var(--transition);
    cursor: pointer;
}

.form-check-input:checked {
    background-color: var(--primary);
    border-color: var(--primary);
}

.form-check-label {
    color: var(--gray-600);
    font-size: 0.9rem;
    cursor: pointer;
}

.forgot-link {
    color: var(--primary);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: var(--transition);
    position: relative;
}

.forgot-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 1px;
    background: var(--primary);
    transition: var(--transition);
}

.forgot-link:hover {
    color: #654321;
}

.forgot-link:hover::after {
    width: 100%;
}

.btn-login {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    border: none;
    padding: 0.8rem 2.5rem;
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: var(--transition);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
}

.btn-login::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: var(--transition-slow);
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
}

.btn-login:hover::before {
    left: 100%;
    height: 300px;
}

.btn-login:active {
    transform: translateY(0);
}

.btn-login i {
    font-size: 1rem;
    transition: var(--transition);
}

.btn-login:hover i {
    transform: translateX(5px);
}

.login-divider {
    text-align: center;
    margin: 2rem 0;
    position: relative;
}

.login-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--gray-200);
}

.login-divider span {
    background: var(--white);
    padding: 0 1rem;
    color: var(--gray-500);
    font-size: 0.85rem;
    position: relative;
    z-index: 1;
}

.demo-credentials {
    background: var(--primary-soft);
    border: 1px solid rgba(139, 69, 19, 0.2);
    border-radius: 12px;
    padding: 1.2rem;
    margin-top: 1.5rem;
    transition: var(--transition);
}

.demo-credentials:hover {
    background: rgba(139, 69, 19, 0.12);
    transform: translateY(-2px);
}

.demo-credentials h6 {
    color: var(--primary);
    margin-bottom: 1rem;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.demo-credentials h6 i {
    font-size: 1rem;
}

.demo-credentials p {
    margin: 0.5rem 0;
    color: var(--gray-700);
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.demo-credentials strong {
    color: var(--primary);
    min-width: 80px;
    display: inline-block;
    font-weight: 600;
}

.demo-credentials i {
    color: var(--primary);
    width: 20px;
}

.text-danger {
    color: var(--danger);
    font-size: 0.8rem;
    margin-top: 0.3rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

/* Animations */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-left {
    animation: slideIn 0.6s ease both;
}

.login-right {
    animation: slideIn 0.6s 0.1s ease both;
}

/* Responsive */
@media (max-width: 768px) {
    .login-card {
        flex-direction: column;
        max-width: 450px;
        margin: 1rem;
    }

    .login-left {
        padding: 2rem;
        animation: slideIn 0.6s ease both;
    }

    .login-right {
        padding: 2rem;
        animation: slideIn 0.6s 0.1s ease both;
    }

    .hotel-name {
        font-size: 1.8rem;
    }

    .features-list li {
        margin-bottom: 1.2rem;
    }
}

@media (max-width: 480px) {
    .login-card {
        border-radius: 16px;
    }

    .login-left {
        padding: 1.5rem;
    }

    .login-right {
        padding: 1.5rem;
    }

    .hotel-name {
        font-size: 1.5rem;
    }

    .hotel-slogan {
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }

    .features-list i {
        width: 36px;
        height: 36px;
        font-size: 1rem;
    }

    .btn-login {
        padding: 0.875rem 1.5rem;
    }
}
</style>

<div class="login-container">
    <div class="login-card">
        <!-- Côté gauche avec présentation -->
        <div class="login-left">
            <div class="hotel-icon">
                <?php if($currentHotel && $currentHotel->logo): ?>
                    <img src="<?php echo e(asset('storage/' . $currentHotel->logo)); ?>"
                         alt="<?php echo e($currentHotel->name); ?>"
                         class="mb-2">
                <?php else: ?>
                    <img src="<?php echo e(asset('img/logo/logo_ancien.jpg')); ?>"
                         alt="Morada Lodge"
                         class="mb-2">
                <?php endif; ?>
                <div class="hotel-name"><?php echo e($currentHotel->name ?? 'MORADA LODGE'); ?></div>
                <div class="hotel-slogan"><?php echo e($currentHotel->description ?? 'Votre oasis de tranquillité et de saveurs'); ?></div>
            </div>

            <ul class="features-list">
                <li>
                    <i class="fas fa-swimming-pool"></i>
                    <div>
                        <strong>Piscine privée</strong>
                        <small>Détente absolue dans un cadre idyllique</small>
                    </div>
                </li>
                <li>
                    <i class="fas fa-utensils"></i>
                    <div>
                        <strong>Gastronomie</strong>
                        <small>Cuisine raffinée locale et internationale</small>
                    </div>
                </li>
                <li>
                    <i class="fas fa-concierge-bell"></i>
                    <div>
                        <strong>Service 5 étoiles</strong>
                        <small>Excellence et attention personnalisée</small>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Côté droit avec formulaire -->
        <div class="login-right">
            <div class="login-header">
                <h3>Bienvenue</h3>
                <p>Connectez-vous pour accéder à votre tableau de bord</p>
            </div>

            <form id="form-login" action="/login" method="POST">
                <?php echo csrf_field(); ?>
                <?php if($currentHotel): ?>
                    <input type="hidden" name="tenant_id" value="<?php echo e($currentHotel->id); ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="email" class="form-label">Adresse email</label>
                    <div class="position-relative">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email"
                               class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="Entrez votre email"
                               value="<?php echo e(old('email')); ?>" required autofocus>
                    </div>
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
                    <div class="position-relative">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password"
                               class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               placeholder="Entrez votre mot de passe" required>
                    </div>
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

                <div class="remember-forgot">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Se souvenir de moi
                        </label>
                    </div>
                    <a href="/forgot-password" class="forgot-link">
                        Mot de passe oublié ?
                    </a>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </button>
                
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form-login');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Animation des icônes au focus
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.querySelector('.input-icon').style.color = 'var(--primary)';
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.querySelector('.input-icon').style.color = 'var(--gray-400)';
            }
        });
    });
    
    // Soumission du formulaire
    form.addEventListener('submit', function(e) {
        // Validation basique
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        if (!email || !password) {
            e.preventDefault();
            alert('Veuillez remplir tous les champs');
            return;
        }
        
        // Désactiver le bouton pendant la soumission
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Connexion en cours...';
        
        // Réactiver après 3 secondes au cas où
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Se connecter';
        }, 3000);
    });
    
    // Raccourci clavier : Entrée pour soumettre
    const passwordInput = document.getElementById('password');
    passwordInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            form.requestSubmit();
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Majorelle V\Documents\MoradaManagement\resources\views/auth/login.blade.php ENDPATH**/ ?>