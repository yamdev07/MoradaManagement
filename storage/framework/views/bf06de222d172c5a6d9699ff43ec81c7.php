<?php $__env->startSection('title', 'Inscription réussie - Morada Management'); ?>
<?php $__env->startSection('content'); ?>

<style>
:root {
    --primary: #27ae60;
    --primary-light: #2ecc71;
    --primary-soft: rgba(39, 174, 96, 0.08);
    --secondary: #3498db;
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

.success-container {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.success-card {
    background: var(--white);
    border-radius: 24px;
    box-shadow: var(--shadow-hover);
    overflow: hidden;
    border: 1px solid var(--gray-200);
    text-align: center;
    position: relative;
}

.success-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color: white;
    padding: 3rem 2rem;
    position: relative;
}

.success-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    animation: scaleIn 0.5s ease-out;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.success-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.success-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.success-body {
    padding: 3rem 2rem;
}

.success-message {
    font-size: 1.1rem;
    color: var(--gray-600);
    line-height: 1.6;
    margin-bottom: 2rem;
}

.next-steps {
    background: var(--gray-50);
    border: 1px solid var(--gray-200);
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.next-steps h3 {
    color: var(--primary);
    margin-bottom: 1.5rem;
    font-size: 1.2rem;
}

.step-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    text-align: left;
}

.step-item:last-child {
    margin-bottom: 0;
}

.step-number {
    width: 32px;
    height: 32px;
    background: var(--primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-right: 1rem;
    flex-shrink: 0;
}

.step-content h4 {
    margin-bottom: 0.25rem;
    color: var(--gray-800);
    font-size: 1rem;
}

.step-content p {
    margin: 0;
    color: var(--gray-600);
    font-size: 0.9rem;
    line-height: 1.5;
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.btn {
    padding: 1rem 2rem;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3);
}

.btn-outline {
    background: transparent;
    color: var(--primary);
    border: 2px solid var(--primary);
}

.btn-outline:hover {
    background: var(--primary);
    color: white;
}

.contact-info {
    background: rgba(52, 152, 219, 0.1);
    border: 1px solid var(--secondary);
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 2rem;
}

.contact-info h4 {
    color: var(--secondary);
    margin-bottom: 1rem;
    font-size: 1rem;
}

.contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
    color: var(--gray-600);
    font-size: 0.9rem;
}

.contact-item:last-child {
    margin-bottom: 0;
}

.contact-item i {
    color: var(--secondary);
    margin-right: 0.75rem;
    width: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .success-container {
        padding: 1rem 0.5rem;
    }
    
    .success-header {
        padding: 2rem 1.5rem;
    }
    
    .success-body {
        padding: 2rem 1.5rem;
    }
    
    .success-title {
        font-size: 1.5rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
    }
}
</style>

<div class="success-container">
    <div class="success-card">
        <!-- Header avec animation -->
        <div class="success-header">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h1 class="success-title">Inscription réussie !</h1>
            <p class="success-subtitle">Votre demande a été soumise avec succès</p>
        </div>

        <!-- Corps du message -->
        <div class="success-body">
            <div class="success-message">
                Merci de votre intérêt pour Morada Management ! Votre demande de création de compte a été enregistrée et est actuellement en cours de validation par notre équipe.
            </div>

            <!-- Prochaines étapes -->
            <div class="next-steps">
                <h3>
                    <i class="fas fa-tasks" style="margin-right: 0.5rem;"></i>
                    Que se passe-t-il maintenant ?
                </h3>
                
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h4>Validation de votre demande</h4>
                        <p>Notre équipe examine votre dossier dans les 24-48 heures ouvrables.</p>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h4>Email de confirmation</h4>
                        <p>Vous recevrez un email dès que votre compte sera validé et activé.</p>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h4>Accès à votre plateforme</h4>
                        <p>Connectez-vous avec vos identifiants pour commencer à configurer votre hôtel.</p>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h4>Configuration initiale</h4>
                        <p>Personnalisez vos paramètres, ajoutez vos chambres et commencez à gérer vos réservations.</p>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="action-buttons">
                <a href="<?php echo e(route('login.index')); ?>" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </a>
                
                <a href="<?php echo e(route('frontend.home')); ?>" class="btn btn-outline">
                    <i class="fas fa-home"></i>
                    Retour à l'accueil
                </a>
            </div>

            <!-- Informations de contact -->
            <div class="contact-info">
                <h4>
                    <i class="fas fa-headset" style="margin-right: 0.5rem;"></i>
                    Besoin d'aide ?
                </h4>
                
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>support@morada-management.com</span>
                </div>
                
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <span>+229 12 34 56 78</span>
                </div>
                
                <div class="contact-item">
                    <i class="fas fa-clock"></i>
                    <span>Lun-Ven: 9h-18h, Sam: 9h-12h</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des éléments au chargement
    const elements = document.querySelectorAll('.step-item');
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.5s ease-out';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, 200 * (index + 1));
    });
    
    // Animation du bouton principal
    const primaryBtn = document.querySelector('.btn-primary');
    setTimeout(() => {
        primaryBtn.style.animation = 'pulse 2s infinite';
    }, 1000);
    
    // Ajouter l'animation pulse
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    `;
    document.head.appendChild(style);
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('template.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Majorelle V\Documents\MoradaManagement\resources\views/auth/tenant-registration-success.blade.php ENDPATH**/ ?>