@extends('template.auth')
@section('title', 'Reset Password - Morada Lodge')
@section('content')

<style>
/* ═══════════════════════════════════════════════════════════════
   STYLES RESET PASSWORD - Design cohérent avec login
═══════════════════════════════════════════════════════════════════ */
:root {
    --primary: #8b4513;
    --primary-light: #a0522d;
    --primary-soft: rgba(139, 69, 19, 0.08);
    --success: #8b4513;
    --success-light: rgba(139, 69, 19, 0.08);
    --warning: #f59e0b;
    --warning-light: rgba(245, 158, 11, 0.08);
    --danger: #ef4444;
    --danger-light: rgba(239, 68, 68, 0.08);
    --info: #8b4513;
    --info-light: rgba(139, 69, 19, 0.08);
    --gray-50: #fcf8f3;
    --gray-100: #f9f0e6;
    --gray-200: #f5e6d3;
    --gray-300: #e8d5c4;
    --gray-400: #d2b48c;
    --gray-500: #704838;
    --gray-600: #5f3c2e;
    --gray-700: #4e3024;
    --gray-800: #3d241a;
    --white: #ffffff;
    --radius: 12px;
    --shadow: 0 4px 20px rgba(0, 0, 0, 0.02), 0 1px 3px rgba(0, 0, 0, 0.05);
    --shadow-hover: 0 10px 30px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
    --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

body {
    background: var(--gray-50);
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.reset-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    background: linear-gradient(135deg, rgba(139, 69, 19, 0.05) 0%, rgba(160, 82, 45, 0.05) 100%);
}

.reset-card {
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

.reset-card:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 6px 12px rgba(0, 0, 0, 0.05);
}

/* Côté gauche avec l'icône et présentation */
.reset-left {
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

.reset-left::before {
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

.reset-left::after {
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
.reset-right {
    flex: 1;
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: var(--white);
}

.reset-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.reset-header h3 {
    color: var(--primary);
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 1.8rem;
}

.reset-header p {
    color: var(--gray-500);
    font-size: 0.95rem;
}

/* Form Styles */
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
    padding: 1rem 2.5rem 1rem 3rem;
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

.form-control[readonly] {
    background: var(--gray-100);
    color: var(--gray-600);
    cursor: not-allowed;
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

/* Password Toggle */
.password-toggle {
    position: absolute;
    right: 1rem;
    top: 2.7rem;
    background: none;
    border: none;
    color: var(--gray-400);
    cursor: pointer;
    padding: 0;
    font-size: 1.1rem;
    transition: var(--transition);
    z-index: 2;
}

.password-toggle:hover {
    color: var(--primary);
}

/* Password Strength */
.password-strength {
    margin-top: 0.75rem;
}

.strength-bar {
    height: 4px;
    background: var(--gray-200);
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.strength-fill {
    height: 100%;
    transition: width 0.3s ease;
    border-radius: 2px;
    width: 0%;
}

.strength-text {
    font-size: 0.75rem;
    color: var(--gray-500);
    font-weight: 500;
}

/* Password Match */
.password-match {
    font-size: 0.8rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.password-match i {
    font-size: 0.9rem;
}

/* Button Styles */
.btn-reset {
    background: linear-gradient(135deg, #8B4513 0%, #964B00 100%);
    color: white;
    border: none;
    padding: 0.8rem 2.5rem;
    border-radius: var(--radius);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    width: 100%;
    box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    position: relative;
    overflow: hidden;
    margin-top: 1rem;
}

.btn-reset::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn-reset:hover {
    background: linear-gradient(135deg, #654321 0%, var(--primary) 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(139, 69, 19, 0.3);
}

.btn-reset:hover::before {
    width: 300px;
    height: 300px;
}

.btn-reset:active {
    transform: translateY(0);
}

.btn-reset:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* Back Link */
.back-link {
    text-align: center;
    margin-top: 1.5rem;
}

.back-link a {
    color: var(--primary);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    position: relative;
}

.back-link a::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 1px;
    background: var(--primary);
    transition: var(--transition);
}

.back-link a:hover {
    color: #654321;
}

.back-link a:hover::after {
    width: 100%;
}

/* Requirements Section */
.reset-help {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--gray-200);
}

.reset-help h6 {
    color: var(--gray-700);
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.requirement-list {
    display: grid;
    gap: 0.5rem;
}

.requirement-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.8rem;
    color: var(--gray-500);
    transition: all 0.3s ease;
}

.requirement-item.met {
    color: var(--success);
}

.requirement-icon {
    font-size: 0.6rem;
    transition: all 0.3s ease;
}

.requirement-item.met .requirement-icon {
    color: var(--success);
}

/* Error Styles */
.text-danger {
    color: var(--danger);
    font-size: 0.8rem;
    margin-top: 0.3rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.is-invalid {
    border-color: var(--danger) !important;
}

.is-invalid:focus {
    border-color: var(--danger) !important;
    box-shadow: 0 0 0 3px var(--danger-light) !important;
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

.reset-left {
    animation: slideIn 0.6s ease both;
}

.reset-right {
    animation: slideIn 0.6s 0.1s ease both;
}

/* Responsive */
@media (max-width: 768px) {
    .reset-card {
        flex-direction: column;
        max-width: 450px;
        margin: 1rem;
    }

    .reset-left {
        padding: 2rem;
    }

    .reset-right {
        padding: 2rem;
    }

    .hotel-name {
        font-size: 1.8rem;
    }

    .features-list li {
        margin-bottom: 1.2rem;
    }
}

@media (max-width: 480px) {
    .reset-card {
        border-radius: 16px;
    }

    .reset-left {
        padding: 1.5rem;
    }

    .reset-right {
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

    .btn-reset {
        padding: 0.875rem 1.5rem;
    }
}
</style>

<div class="reset-container">
    <div class="reset-card">
        <!-- Côté gauche avec présentation -->
        <div class="reset-left">
            <div class="hotel-icon">
                <img src="{{ asset('img/logo/logo_ancien.jpg') }}"
                     alt="Morada Lodge"
                     class="mb-2">
                <div class="hotel-name">MORADA LODGE</div>
                <div class="hotel-slogan">Votre oasis de tranquillité et de saveurs</div>
            </div>

            <ul class="features-list">
                <li>
                    <i class="fas fa-key"></i>
                    <div>
                        <strong>Nouveau mot de passe</strong>
                        <small>Créez un mot de passe sécurisé</small>
                    </div>
                </li>
                <li>
                    <i class="fas fa-shield-alt"></i>
                    <div>
                        <strong>Sécurité renforcée</strong>
                        <small>Protection avancée de votre compte</small>
                    </div>
                </li>
                <li>
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Confirmation requise</strong>
                        <small>Vérifiez que les mots de passe correspondent</small>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Côté droit avec formulaire -->
        <div class="reset-right">
            <div class="reset-header">
                <h3>Nouveau mot de passe</h3>
                <p>Choisissez un mot de passe sécurisé</p>
            </div>

            <!-- Reset Form -->
            <form method="POST" action="{{ route('password.update') }}" id="resetPasswordForm">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">Adresse email</label>
                    <div class="position-relative">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ $email ?? old('email') }}"
                               required autocomplete="email"
                               placeholder="Votre adresse email"
                               readonly>
                    </div>
                    @error('email')
                        <div class="text-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">Nouveau mot de passe</label>
                    <div class="position-relative">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required autocomplete="new-password"
                               placeholder="Entrez votre nouveau mot de passe"
                               minlength="8">
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-toggle-icon"></i>
                        </button>
                    </div>
                    
                    <!-- Password Strength Indicator -->
                    <div class="password-strength" id="password-strength">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strength-fill"></div>
                        </div>
                        <div class="strength-text" id="strength-text">Force du mot de passe</div>
                    </div>
                    
                    @error('password')
                        <div class="text-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label for="password-confirm" class="form-label">Confirmer le mot de passe</label>
                    <div class="position-relative">
                        <i class="fas fa-shield-alt input-icon"></i>
                        <input type="password" id="password-confirm" name="password_confirmation"
                               class="form-control"
                               required autocomplete="new-password"
                               placeholder="Confirmez votre mot de passe">
                        <button type="button" class="password-toggle" onclick="togglePassword('password-confirm')">
                            <i class="fas fa-eye" id="password-confirm-toggle-icon"></i>
                        </button>
                    </div>
                    <div class="password-match" id="password-match" style="display: none;"></div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-reset" id="submitBtn">
                    <span class="btn-text">
                        <i class="fas fa-key"></i>
                        Réinitialiser le mot de passe
                    </span>
                    <span class="btn-loading d-none">
                        <i class="fas fa-spinner fa-spin"></i>
                        Réinitialisation...
                    </span>
                </button>

                <!-- Back to Login -->
                <div class="back-link">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-arrow-left"></i>
                        Retour à la connexion
                    </a>
                </div>
            </form>

            <!-- Password Requirements -->
            <div class="reset-help">
                <h6>
                    <i class="fas fa-info-circle me-2"></i>
                    Exigences du mot de passe
                </h6>
                <div class="requirement-list">
                    <div class="requirement-item" id="req-length">
                        <i class="fas fa-circle requirement-icon"></i>
                        <span>Au moins 8 caractères</span>
                    </div>
                    <div class="requirement-item" id="req-uppercase">
                        <i class="fas fa-circle requirement-icon"></i>
                        <span>Une lettre majuscule</span>
                    </div>
                    <div class="requirement-item" id="req-lowercase">
                        <i class="fas fa-circle requirement-icon"></i>
                        <span>Une lettre minuscule</span>
                    </div>
                    <div class="requirement-item" id="req-number">
                        <i class="fas fa-circle requirement-icon"></i>
                        <span>Un chiffre</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const toggleIcon = document.getElementById(fieldId + '-toggle-icon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.className = 'fas fa-eye-slash';
        } else {
            passwordField.type = 'password';
            toggleIcon.className = 'fas fa-eye';
        }
    }

    // Password strength checker
    function checkPasswordStrength(password) {
        let score = 0;
        const requirements = {
            length: password.length >= 8,
            uppercase: /[A-Z]/.test(password),
            lowercase: /[a-z]/.test(password),
            number: /\d/.test(password)
        };

        // Update requirement indicators
        Object.keys(requirements).forEach(req => {
            const element = document.getElementById(`req-${req}`);
            if (requirements[req]) {
                element.classList.add('met');
                score++;
            } else {
                element.classList.remove('met');
            }
        });

        return { score, total: 4 };
    }

    // Update password strength indicator
    function updatePasswordStrength(password) {
        const { score, total } = checkPasswordStrength(password);
        const strengthFill = document.getElementById('strength-fill');
        const strengthText = document.getElementById('strength-text');

        const percentage = (score / total) * 100;
        strengthFill.style.width = percentage + '%';

        if (score === 0) {
            strengthFill.style.background = 'transparent';
            strengthText.textContent = 'Force du mot de passe';
            strengthText.style.color = 'var(--gray-500)';
        } else if (score < 2) {
            strengthFill.style.background = '#dc3545';
            strengthText.textContent = 'Mot de passe faible';
            strengthText.style.color = '#dc3545';
        } else if (score < 3) {
            strengthFill.style.background = '#ffc107';
            strengthText.textContent = 'Mot de passe moyen';
            strengthText.style.color = '#ffc107';
        } else if (score < 4) {
            strengthFill.style.background = '#fd7e14';
            strengthText.textContent = 'Mot de passe bon';
            strengthText.style.color = '#fd7e14';
        } else {
            strengthFill.style.background = '#28a745';
            strengthText.textContent = 'Mot de passe fort';
            strengthText.style.color = '#28a745';
        }
    }

    // Check if passwords match
    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password-confirm').value;
        const matchIndicator = document.getElementById('password-match');

        if (confirmPassword.length > 0) {
            matchIndicator.style.display = 'flex';
            if (password === confirmPassword) {
                matchIndicator.innerHTML = '<i class="fas fa-check-circle text-success"></i><span>Les mots de passe correspondent</span>';
                matchIndicator.style.color = '#28a745';
            } else {
                matchIndicator.innerHTML = '<i class="fas fa-times-circle text-danger"></i><span>Les mots de passe ne correspondent pas</span>';
                matchIndicator.style.color = '#dc3545';
            }
        } else {
            matchIndicator.style.display = 'none';
        }
    }

    // Event listeners
    document.getElementById('password').addEventListener('input', function() {
        updatePasswordStrength(this.value);
        checkPasswordMatch();
    });

    document.getElementById('password-confirm').addEventListener('input', checkPasswordMatch);

    // Form submission
    document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password-confirm').value;
        
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Les mots de passe ne correspondent pas');
            return;
        }
        
        const submitBtn = document.getElementById('submitBtn');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');

        // Show loading state
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');
        submitBtn.disabled = true;
    });

    // Add smooth focus animations
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('input-focused');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('input-focused');
        });
    });
</script>
@endsection