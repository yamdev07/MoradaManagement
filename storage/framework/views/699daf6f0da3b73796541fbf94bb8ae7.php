
<?php $__env->startSection('title', 'Créer votre compte Hôtel - Check-Sys'); ?>
<?php $__env->startSection('content'); ?>

<style>
/* ═══════════════════════════════════════════════════════════════
   STYLES INSCRIPTION TENANT - Design moderne avec personnalisation
═══════════════════════════════════════════════════════════════════ */
:root {
    --primary: #2c3e50;
    --primary-light: #34495e;
    --primary-soft: rgba(44, 62, 80, 0.08);
    --secondary: #3498db;
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

.registration-container {
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.registration-card {
    background: var(--white);
    border-radius: 24px;
    box-shadow: var(--shadow-hover);
    overflow: hidden;
    display: flex;
    min-height: 800px;
    border: 1px solid var(--gray-200);
}

.registration-left {
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

.registration-left::before {
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

.registration-right {
    flex: 2;
    padding: 3rem;
    display: flex;
    flex-direction: column;
    background: var(--white);
    overflow-y: auto;
    max-height: 90vh;
}

.registration-header {
    text-align: center;
    margin-bottom: 2rem;
}

.registration-header h2 {
    color: var(--primary);
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 2rem;
}

.registration-header p {
    color: var(--gray-500);
    font-size: 1rem;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    margin-bottom: 3rem;
    position: relative;
}

.progress-step {
    flex: 1;
    text-align: center;
    position: relative;
    z-index: 2;
}

.progress-step::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 50%;
    right: -50%;
    height: 2px;
    background: var(--gray-200);
    z-index: -1;
}

.progress-step:last-child::before {
    display: none;
}

.progress-step.active::before {
    background: var(--primary);
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--gray-200);
    color: var(--gray-500);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.5rem;
    font-weight: 600;
    transition: var(--transition);
}

.progress-step.active .step-number {
    background: var(--primary);
    color: white;
}

.progress-step.completed .step-number {
    background: var(--success);
    color: white;
}

.step-label {
    font-size: 0.875rem;
    color: var(--gray-500);
    font-weight: 500;
}

.progress-step.active .step-label {
    color: var(--primary);
}

.progress-step.completed .step-label {
    color: var(--success);
}

.form-section {
    display: none;
    animation: slideIn 0.3s ease-out;
}

.form-section.active {
    display: block;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
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
    border: 1px solid var(--gray-200, #dee2e6);
    border-radius: 8px;
    font-size: 0.95rem;
    transition: var(--transition, all 0.3s ease);
    background: var(--white, #ffffff);
    color: var(--gray-800, #343a40);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-soft);
    color: var(--gray-800, #343a40) !important;
}

select.form-control {
    color: var(--gray-800, #343a40) !important;
}

textarea.form-control {
    color: var(--gray-800, #343a40) !important;
}

.form-control::placeholder {
    color: var(--gray-400);
}

.color-input-group {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.color-input {
    width: 80px;
    height: 40px;
    border: 2px solid var(--gray-200);
    border-radius: 8px;
    cursor: pointer;
    transition: var(--transition);
}

.color-input:focus {
    border-color: var(--primary);
    outline: none;
}

.color-preview {
    flex: 1;
    padding: 0.5rem 1rem;
    border: 1px solid var(--gray-200);
    border-radius: 8px;
    font-family: monospace;
    font-size: 0.875rem;
}

.theme-preview {
    background: var(--gray-50);
    border: 1px solid var(--gray-200);
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 1rem;
}

.theme-preview-header {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    text-align: center;
    color: white;
    font-weight: 600;
}

.theme-preview-button {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 6px;
    color: white;
    font-weight: 500;
    cursor: pointer;
    margin-right: 0.5rem;
}

.logo-upload {
    border: 2px dashed var(--gray-300);
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    transition: var(--transition);
    cursor: pointer;
}

.logo-upload:hover {
    border-color: var(--primary);
    background: var(--gray-50);
}

.logo-upload.has-logo {
    border-style: solid;
    border-color: var(--success);
    background: rgba(39, 174, 96, 0.05);
}

.logo-preview {
    max-width: 120px;
    max-height: 120px;
    margin: 1rem auto;
    border-radius: 8px;
    box-shadow: var(--shadow);
}

.form-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--gray-200);
}

.btn-nav {
    padding: 0.875rem 2rem;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-prev {
    background: var(--gray-100);
    color: var(--gray-600);
}

.btn-prev:hover {
    background: var(--gray-200);
}

.btn-next {
    background: var(--primary);
    color: white;
}

.btn-next:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
}

.btn-next:disabled {
    background: var(--gray-300);
    color: var(--gray-500);
    cursor: not-allowed;
    transform: none;
}

.btn-submit {
    background: linear-gradient(135deg, var(--success) 0%, #229954 100%);
    color: white;
    padding: 1rem 3rem;
    font-size: 1rem;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3);
}

.terms-section {
    background: var(--gray-50);
    border: 1px solid var(--gray-200);
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 1rem;
}

.terms-content {
    max-height: 200px;
    overflow-y: auto;
    padding: 1rem;
    background: white;
    border: 1px solid var(--gray-200);
    border-radius: 8px;
    font-size: 0.875rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-check-input {
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

.validation-feedback {
    margin-top: 0.5rem;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.validation-feedback.success {
    color: var(--success);
}

.validation-feedback.error {
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

/* Responsive */
@media (max-width: 1024px) {
    .registration-card {
        flex-direction: column;
        max-height: none;
    }
    
    .registration-left {
        padding: 2rem;
        min-height: 200px;
    }
    
    .registration-right {
        max-height: none;
    }
}

@media (max-width: 768px) {
    .registration-container {
        padding: 1rem 0.5rem;
    }
    
    .registration-right {
        padding: 1.5rem;
    }
    
    .progress-steps {
        flex-direction: column;
        gap: 1rem;
    }
    
    .progress-step::before {
        display: none;
    }
    
    .form-navigation {
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-nav {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="registration-container">
    <div class="registration-card">
        <!-- Côté gauche avec présentation -->
        <div class="registration-left">
            <div style="position: relative; z-index: 2;">
                <div style="text-align: center; margin-bottom: 2rem;">
                    <i class="fas fa-hotel" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.8rem; margin-bottom: 0.5rem;">Check-Sys</h3>
                    <p style="opacity: 0.9; font-size: 1rem;">Votre solution de gestion hôtelière complète</p>
                </div>

                <div style="margin-bottom: 2rem;">
                    <h4 style="font-size: 1.2rem; margin-bottom: 1rem;">Pourquoi nous choisir ?</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 1rem; display: flex; align-items: center;">
                            <i class="fas fa-check-circle" style="margin-right: 0.75rem; color: #27ae60;"></i>
                            <span>Interface personnalisable pour votre hôtel</span>
                        </li>
                        <li style="margin-bottom: 1rem; display: flex; align-items: center;">
                            <i class="fas fa-check-circle" style="margin-right: 0.75rem; color: #27ae60;"></i>
                            <span>Gestion multi-établissements</span>
                        </li>
                        <li style="margin-bottom: 1rem; display: flex; align-items: center;">
                            <i class="fas fa-check-circle" style="margin-right: 0.75rem; color: #27ae60;"></i>
                            <span>Rapports et analyses détaillées</span>
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
                        Processus d'inscription
                    </h4>
                    <p style="font-size: 0.9rem; opacity: 0.9; line-height: 1.5;">
                        1. Remplissez vos informations<br>
                        2. Personnalisez votre interface<br>
                        3. Créez votre compte administrateur<br>
                        4. Soumettez pour validation
                    </p>
                </div>
            </div>
        </div>

        <!-- Côté droit avec le formulaire -->
        <div class="registration-right">
            <div class="registration-header">
                <h2>Créer votre compte hôtel</h2>
                <p>Rejoignez des centaines d'hôtels qui nous font confiance</p>
            </div>

            <?php if(session('error')): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span><?php echo e(session('error')); ?></span>
                </div>
            <?php endif; ?>

            <form id="tenantRegistrationForm" action="<?php echo e(route('tenant.register.submit')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <!-- Barre de progression -->
                <div class="progress-steps">
                    <div class="progress-step active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">Informations hôtel</div>
                    </div>
                    <div class="progress-step" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">Personnalisation</div>
                    </div>
                    <div class="progress-step" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">Administrateur</div>
                    </div>
                    <div class="progress-step" data-step="4">
                        <div class="step-number">4</div>
                        <div class="step-label">Validation</div>
                    </div>
                </div>

                <!-- Section 1: Informations de l'hôtel -->
                <div class="form-section active" data-section="1">
                    <h3 style="margin-bottom: 1.5rem; color: var(--primary);">
                        <i class="fas fa-hotel" style="margin-right: 0.5rem;"></i>
                        Informations de l'hôtel
                    </h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tenant_name" class="form-label">Nom de l'hôtel *</label>
                                <input type="text" id="tenant_name" name="tenant_name" class="form-control" 
                                       placeholder="Ex: Hôtel Paradise" required>
                                <?php $__errorArgs = ['tenant_name'];
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tenant_domain" class="form-label">Domaine *</label>
                                <div style="display: flex; align-items: center;">
                                    <input type="text" id="tenant_domain" name="tenant_domain" class="form-control" 
                                           placeholder="hotel-paradise" required>
                                    <span style="margin-left: 0.5rem; color: var(--gray-500);">.morada.com</span>
                                </div>
                                <div id="domainFeedback" class="validation-feedback"></div>
                                <?php $__errorArgs = ['tenant_domain'];
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
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tenant_email" class="form-label">Email de l'hôtel *</label>
                                <input type="email" id="tenant_email" name="tenant_email" class="form-control" 
                                       placeholder="contact@hotel-paradise.com" required>
                                <div id="emailFeedback" class="validation-feedback"></div>
                                <?php $__errorArgs = ['tenant_email'];
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tenant_phone" class="form-label">Téléphone</label>
                                <input type="tel" id="tenant_phone" name="tenant_phone" class="form-control" 
                                       placeholder="+229 12 34 56 78">
                                <?php $__errorArgs = ['tenant_phone'];
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
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tenant_address" class="form-label">Adresse</label>
                        <textarea id="tenant_address" name="tenant_address" class="form-control" rows="3" 
                                  placeholder="123 Avenue des Palmiers, Cotonou, Bénin"></textarea>
                        <?php $__errorArgs = ['tenant_address'];
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
                        <label for="tenant_description" class="form-label">Description</label>
                        <textarea id="tenant_description" name="tenant_description" class="form-control" rows="4" 
                                  placeholder="Décrivez votre hôtel, vos services, votre ambiance..."></textarea>
                        <?php $__errorArgs = ['tenant_description'];
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
                        <label class="form-label">Logo de l'hôtel</label>
                        <div class="logo-upload" id="logoUpload">
                            <input type="file" id="logo" name="logo" accept="image/*" style="display: none;">
                            <div id="logoUploadContent">
                                <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; color: var(--gray-400); margin-bottom: 1rem;"></i>
                                <p style="margin: 0; color: var(--gray-600); font-weight: 500;">Cliquez pour uploader votre logo</p>
                                <p style="margin: 0.5rem 0 0; color: var(--gray-400); font-size: 0.875rem;">PNG, JPG, GIF (Max: 2MB)</p>
                            </div>
                            <img id="logoPreview" class="logo-preview" style="display: none;">
                        </div>
                        <?php $__errorArgs = ['logo'];
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
                </div>

                <!-- Section 2: Personnalisation -->
                <div class="form-section" data-section="2">
                    <h3 style="margin-bottom: 1.5rem; color: var(--primary);">
                        <i class="fas fa-palette" style="margin-right: 0.5rem;"></i>
                        Personnalisation de l'interface
                    </h3>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="primary_color" class="form-label">Couleur principale *</label>
                                <div class="color-input-group">
                                    <input type="color" id="primary_color" name="primary_color" class="color-input" 
                                           value="#2c3e50" required>
                                    <div class="color-preview" id="primaryColorPreview">#2c3e50</div>
                                </div>
                                <?php $__errorArgs = ['primary_color'];
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
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="secondary_color" class="form-label">Couleur secondaire *</label>
                                <div class="color-input-group">
                                    <input type="color" id="secondary_color" name="secondary_color" class="color-input" 
                                           value="#3498db" required>
                                    <div class="color-preview" id="secondaryColorPreview">#3498db</div>
                                </div>
                                <?php $__errorArgs = ['secondary_color'];
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
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="accent_color" class="form-label">Couleur d'accent *</label>
                                <div class="color-input-group">
                                    <input type="color" id="accent_color" name="accent_color" class="color-input" 
                                           value="#f39c12" required>
                                    <div class="color-preview" id="accentColorPreview">#f39c12</div>
                                </div>
                                <?php $__errorArgs = ['accent_color'];
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
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="font_family" class="form-label">Police de caractères</label>
                        <select id="font_family" name="font_family" class="form-control">
                            <option value="Inter">Inter (Moderne)</option>
                            <option value="Roboto">Roboto (Google)</option>
                            <option value="Playfair Display">Playfair Display (Élégant)</option>
                            <option value="Montserrat">Montserrat (Professionnel)</option>
                            <option value="Poppins">Poppins (Amical)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="custom_css" class="form-label">CSS personnalisé (optionnel)</label>
                        <textarea id="custom_css" name="custom_css" class="form-control" rows="4" 
                                  placeholder="/* Ajoutez votre CSS personnalisé ici */"></textarea>
                    </div>

                    <div class="theme-preview">
                        <h4 style="margin-bottom: 1rem; font-size: 1rem; color: var(--gray-700);">Aperçu du thème</h4>
                        <div class="theme-preview-header" id="themePreviewHeader">
                            Hôtel Paradise - Votre interface personnalisée
                        </div>
                        <div style="display: flex; gap: 0.5rem; justify-content: center;">
                            <button class="theme-preview-button" id="themePreviewButton1" style="background: var(--primary-color, #2c3e50);">
                                Réserver
                            </button>
                            <button class="theme-preview-button" id="themePreviewButton2" style="background: var(--secondary-color, #3498db);">
                                Contact
                            </button>
                            <button class="theme-preview-button" id="themePreviewButton3" style="background: var(--accent-color, #f39c12);">
                                Services
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Administrateur -->
                <div class="form-section" data-section="3">
                    <h3 style="margin-bottom: 1.5rem; color: var(--primary);">
                        <i class="fas fa-user-shield" style="margin-right: 0.5rem;"></i>
                        Compte administrateur
                    </h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="admin_name" class="form-label">Nom complet *</label>
                                <input type="text" id="admin_name" name="admin_name" class="form-control" 
                                       placeholder="Jean Dupont" required>
                                <?php $__errorArgs = ['admin_name'];
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="admin_phone" class="form-label">Téléphone</label>
                                <input type="tel" id="admin_phone" name="admin_phone" class="form-control" 
                                       placeholder="+229 12 34 56 78">
                                <?php $__errorArgs = ['admin_phone'];
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
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="admin_email" class="form-label">Email administrateur *</label>
                        <input type="email" id="admin_email" name="admin_email" class="form-control" 
                               placeholder="jean.dupont@hotel-paradise.com" required>
                        <div id="adminEmailFeedback" class="validation-feedback"></div>
                        <?php $__errorArgs = ['admin_email'];
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="admin_password" class="form-label">Mot de passe *</label>
                                <input type="password" id="admin_password" name="admin_password" class="form-control" 
                                       placeholder="••••••••" required>
                                <?php $__errorArgs = ['admin_password'];
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="admin_password_confirmation" class="form-label">Confirmer le mot de passe *</label>
                                <input type="password" id="admin_password_confirmation" name="admin_password_confirmation" 
                                       class="form-control" placeholder="••••••••" required>
                                <?php $__errorArgs = ['admin_password_confirmation'];
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
                        </div>
                    </div>

                    <div style="background: var(--info-soft, rgba(23, 162, 184, 0.1)); border: 1px solid var(--info); border-radius: 8px; padding: 1rem; margin-top: 1rem;">
                        <h5 style="color: var(--info); margin-bottom: 0.5rem; font-size: 0.9rem;">
                            <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                            Sécurité du mot de passe
                        </h5>
                        <ul style="margin: 0; padding-left: 1.2rem; font-size: 0.875rem; color: var(--gray-600);">
                            <li>Minimum 8 caractères</li>
                            <li>Contenir des lettres et chiffres</li>
                            <li>Privilégiez les mots de passe complexes</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 4: Validation -->
                <div class="form-section" data-section="4">
                    <h3 style="margin-bottom: 1.5rem; color: var(--primary);">
                        <i class="fas fa-check-double" style="margin-right: 0.5rem;"></i>
                        Validation et soumission
                    </h3>

                    <div style="background: var(--gray-50); border: 1px solid var(--gray-200); border-radius: 12px; padding: 2rem;">
                        <h4 style="margin-bottom: 1.5rem; color: var(--primary);">Récapitulatif de votre inscription</h4>
                        
                        <div id="summaryContent" style="display: grid; gap: 1.5rem;">
                            <!-- Le contenu sera rempli dynamiquement par JavaScript -->
                        </div>

                        <div class="terms-section">
                            <h5 style="margin-bottom: 1rem; color: var(--gray-700);">
                                <i class="fas fa-file-contract" style="margin-right: 0.5rem;"></i>
                                Conditions d'utilisation
                            </h5>
                            <div class="terms-content">
                                <h6 style="margin-bottom: 1rem;">1. Acceptation des conditions</h6>
                                <p>En créant un compte sur Check-Sys, vous acceptez les présentes conditions d'utilisation.</p>
                                
                                <h6 style="margin-bottom: 1rem; margin-top: 1.5rem;">2. Description du service</h6>
                                <p>Check-Sys est une plateforme de gestion hôtelière qui permet aux établissements de gérer leurs réservations, clients, et opérations quotidiennes.</p>
                                
                                <h6 style="margin-bottom: 1rem; margin-top: 1.5rem;">3. Responsabilités</h6>
                                <p>Vous êtes responsable de la précision des informations fournies et de l'utilisation conforme de la plateforme.</p>
                                
                                <h6 style="margin-bottom: 1rem; margin-top: 1.5rem;">4. Données personnelles</h6>
                                <p>Nous nous engageons à protéger vos données conformément à notre politique de confidentialité.</p>
                                
                                <h6 style="margin-bottom: 1rem; margin-top: 1.5rem;">5. Processus de validation</h6>
                                <p>Toute nouvelle inscription est soumise à validation par notre équipe avant activation du compte.</p>
                            </div>
                            
                            <div class="form-check">
                                <input type="checkbox" id="terms" name="terms" class="form-check-input" required>
                                <label for="terms" class="form-check-label">
                                    J'ai lu et j'accepte les conditions d'utilisation et la politique de confidentialité *
                                </label>
                            </div>
                            <?php $__errorArgs = ['terms'];
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
                    </div>
                </div>

                <!-- Navigation -->
                <div class="form-navigation">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <button type="button" class="btn-nav btn-prev" id="prevBtn" style="display: none;">
                            <i class="fas fa-arrow-left"></i>
                            Précédent
                        </button>
                        
                        <a href="<?php echo e(route('tenant.login.page')); ?>" class="btn-nav btn-register" style="display: flex; align-items: center; justify-content: center; text-decoration: none;">
                            <i class="fas fa-sign-in-alt" style="margin-right: 0.5rem;"></i>
                            Connexion
                        </a>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <button type="button" class="btn-nav btn-next" id="nextBtn">
                            Suivant
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        
                        <button type="submit" class="btn-nav btn-submit" id="submitBtn" style="display: none;">
                            <i class="fas fa-paper-plane"></i>
                            Soumettre ma demande
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 4;
    const form = document.getElementById('tenantRegistrationForm');
    
    // Éléments du DOM
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    
    // Navigation entre les étapes
    function showStep(step) {
        // Masquer toutes les sections
        document.querySelectorAll('.form-section').forEach(section => {
            section.classList.remove('active');
        });
        
        // Afficher la section actuelle
        document.querySelector(`[data-section="${step}"]`).classList.add('active');
        
        // Mettre à jour la barre de progression
        document.querySelectorAll('.progress-step').forEach((progressStep, index) => {
            if (index < step - 1) {
                progressStep.classList.add('completed');
                progressStep.classList.remove('active');
            } else if (index === step - 1) {
                progressStep.classList.add('active');
                progressStep.classList.remove('completed');
            } else {
                progressStep.classList.remove('active', 'completed');
            }
        });
        
        // Mettre à jour les boutons
        prevBtn.style.display = step === 1 ? 'none' : 'flex';
        nextBtn.style.display = step === totalSteps ? 'none' : 'flex';
        submitBtn.style.display = step === totalSteps ? 'flex' : 'none';
        
        // Si c'est la dernière étape, générer le récapitulatif
        if (step === totalSteps) {
            generateSummary();
        }
        
        currentStep = step;
    }
    
    // Validation d'une étape
    function validateStep(step) {
        const section = document.querySelector(`[data-section="${step}"]`);
        const requiredFields = section.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.focus();
                isValid = false;
                return;
            }
            
            // Validation spécifique pour les emails
            if (field.type === 'email' && !isValidEmail(field.value)) {
                field.focus();
                isValid = false;
                return;
            }
            
            // Validation pour la confirmation du mot de passe
            if (field.id === 'admin_password_confirmation') {
                const password = document.getElementById('admin_password').value;
                if (field.value !== password) {
                    field.focus();
                    isValid = false;
                    return;
                }
            }
        });
        
        return isValid;
    }
    
    // Validation email
    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
    
    // Génération du récapitulatif
    function generateSummary() {
        const summaryContent = document.getElementById('summaryContent');
        
        const hotelInfo = {
            'Nom de l\'hôtel': document.getElementById('tenant_name').value,
            'Domaine': document.getElementById('tenant_domain').value + '.morada.com',
            'Email': document.getElementById('tenant_email').value,
            'Téléphone': document.getElementById('tenant_phone').value || 'Non spécifié',
            'Adresse': document.getElementById('tenant_address').value || 'Non spécifiée',
        };
        
        const themeInfo = {
            'Couleur principale': document.getElementById('primary_color').value,
            'Couleur secondaire': document.getElementById('secondary_color').value,
            'Couleur d\'accent': document.getElementById('accent_color').value,
            'Police': document.getElementById('font_family').value,
        };
        
        const adminInfo = {
            'Nom': document.getElementById('admin_name').value,
            'Email': document.getElementById('admin_email').value,
            'Téléphone': document.getElementById('admin_phone').value || 'Non spécifié',
        };
        
        let html = '';
        
        // Section Hôtel
        html += '<div><h5 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-hotel" style="margin-right: 0.5rem;"></i>Informations hôtel</h5><ul style="margin: 0; padding-left: 1.2rem;">';
        for (const [key, value] of Object.entries(hotelInfo)) {
            html += `<li><strong>${key}:</strong> ${value}</li>`;
        }
        html += '</ul></div>';
        
        // Section Thème
        html += '<div><h5 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-palette" style="margin-right: 0.5rem;"></i>Personnalisation</h5><ul style="margin: 0; padding-left: 1.2rem;">';
        for (const [key, value] of Object.entries(themeInfo)) {
            html += `<li><strong>${key}:</strong> ${value}</li>`;
        }
        html += '</ul></div>';
        
        // Section Administrateur
        html += '<div><h5 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-user-shield" style="margin-right: 0.5rem;"></i>Administrateur</h5><ul style="margin: 0; padding-left: 1.2rem;">';
        for (const [key, value] of Object.entries(adminInfo)) {
            html += `<li><strong>${key}:</strong> ${value}</li>`;
        }
        html += '</ul></div>';
        
        summaryContent.innerHTML = html;
    }
    
    // Événements des boutons
    prevBtn.addEventListener('click', function() {
        if (currentStep > 1) {
            showStep(currentStep - 1);
        }
    });
    
    nextBtn.addEventListener('click', function() {
        if (validateStep(currentStep)) {
            showStep(currentStep + 1);
        } else {
            alert('Veuillez remplir tous les champs obligatoires avant de continuer.');
        }
    });
    
    // Gestionnaire de soumission du formulaire
    document.getElementById('tenantRegistrationForm').addEventListener('submit', function(e) {
        if (currentStep === totalSteps) {
            if (!validateStep(currentStep)) {
                e.preventDefault();
                alert('Veuillez remplir tous les champs obligatoires avant de soumettre.');
                return false;
            }
        } else {
            e.preventDefault();
            alert('Veuillez compléter toutes les étapes avant de soumettre.');
            return false;
        }
    });
    
    // Upload du logo
    const logoUpload = document.getElementById('logoUpload');
    const logoInput = document.getElementById('logo');
    const logoPreview = document.getElementById('logoPreview');
    const logoUploadContent = document.getElementById('logoUploadContent');
    
    logoUpload.addEventListener('click', function() {
        logoInput.click();
    });
    
    logoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('Le fichier ne doit pas dépasser 2MB.');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                logoPreview.src = e.target.result;
                logoPreview.style.display = 'block';
                logoUploadContent.style.display = 'none';
                logoUpload.classList.add('has-logo');
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Vérification domaine
    const domainInput = document.getElementById('tenant_domain');
    const domainFeedback = document.getElementById('domainFeedback');
    let domainCheckTimeout;
    
    domainInput.addEventListener('input', function() {
        clearTimeout(domainCheckTimeout);
        const domain = this.value.trim();
        
        if (domain.length < 3) {
            domainFeedback.innerHTML = '';
            return;
        }
        
        domainCheckTimeout = setTimeout(() => {
            fetch('/api/check-domain', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ domain: domain })
            })
            .then(response => response.json())
            .then(data => {
                if (data.available) {
                    domainFeedback.innerHTML = '<i class="fas fa-check-circle"></i> Domaine disponible';
                    domainFeedback.className = 'validation-feedback success';
                } else {
                    domainFeedback.innerHTML = '<i class="fas fa-times-circle"></i> Ce domaine est déjà utilisé';
                    domainFeedback.className = 'validation-feedback error';
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        }, 500);
    });
    
    // Vérification email
    const emailInput = document.getElementById('tenant_email');
    const emailFeedback = document.getElementById('emailFeedback');
    let emailCheckTimeout;
    
    emailInput.addEventListener('input', function() {
        clearTimeout(emailCheckTimeout);
        const email = this.value.trim();
        
        if (!isValidEmail(email)) {
            emailFeedback.innerHTML = '';
            return;
        }
        
        emailCheckTimeout = setTimeout(() => {
            fetch('/api/check-email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.available) {
                    emailFeedback.innerHTML = '<i class="fas fa-check-circle"></i> Email disponible';
                    emailFeedback.className = 'validation-feedback success';
                } else {
                    emailFeedback.innerHTML = '<i class="fas fa-times-circle"></i> Cet email est déjà utilisé';
                    emailFeedback.className = 'validation-feedback error';
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        }, 500);
    });
    
    // Aperçu du thème
    const colorInputs = ['primary_color', 'secondary_color', 'accent_color'];
    
    colorInputs.forEach(colorId => {
        const input = document.getElementById(colorId);
        const preview = document.getElementById(colorId + 'Preview');
        
        input.addEventListener('input', function() {
            preview.textContent = this.value;
            updateThemePreview();
        });
    });
    
    function updateThemePreview() {
        const primaryColor = document.getElementById('primary_color').value;
        const secondaryColor = document.getElementById('secondary_color').value;
        const accentColor = document.getElementById('accent_color').value;
        
        const header = document.getElementById('themePreviewHeader');
        const button1 = document.getElementById('themePreviewButton1');
        const button2 = document.getElementById('themePreviewButton2');
        const button3 = document.getElementById('themePreviewButton3');
        
        header.style.background = `linear-gradient(135deg, ${primaryColor} 0%, ${secondaryColor} 100%)`;
        button1.style.background = primaryColor;
        button2.style.background = secondaryColor;
        button3.style.background = accentColor;
    }
    
    // Initialisation
    updateThemePreview();
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Majorelle V\Documents\MoradaManagement\resources\views/auth/tenant-register.blade.php ENDPATH**/ ?>