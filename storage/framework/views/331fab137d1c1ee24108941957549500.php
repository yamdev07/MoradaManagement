

<?php $__env->startSection('title', 'Profil Utilisateur - ' . $user->name); ?>

<?php $__env->startSection('content'); ?>
<style>
    .profile-card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        border: none;
        margin-bottom: 2rem;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 2rem;
        color: white;
        text-align: center;
        position: relative;
    }
    
    .profile-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 5px solid white;
        object-fit: cover;
        margin: 0 auto 1.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .role-badge {
        font-size: 0.9rem;
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-super {
        background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
    }
    
    .badge-admin {
        background: linear-gradient(135deg, #4ecdc4, #6deae1);
    }
    
    .badge-receptionist {
        background: linear-gradient(135deg, #45b7d1, #67d9f2);
    }
    
    .badge-customer {
        background: linear-gradient(135deg, #96c93d, #b4e866);
    }
    
    .badge-housekeeping {
        background: linear-gradient(135deg, #a363d9, #c185f0);
    }
    
    .info-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease;
    }
    
    .info-card:hover {
        transform: translateY(-5px);
    }
    
    .info-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-right: 15px;
    }
    
    .activity-item {
        padding: 1rem;
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
    }
    
    .activity-item:hover {
        background: #f8f9fa;
        border-left-color: #4ecdc4;
    }
    
    .stat-item {
        text-align: center;
        padding: 1.5rem;
        border-radius: 12px;
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>

<div class="container-fluid">
    <!-- En-tête du profil -->
    <div class="profile-card">
        <div class="profile-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-3">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard.index')); ?>" class="text-white">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('user.index')); ?>" class="text-white">
                            <i class="fas fa-users"></i> Utilisateurs
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">
                        <?php echo e($user->name); ?>

                    </li>
                </ol>
            </nav>
            
            <img src="<?php echo e($user->getAvatar()); ?>" 
                 class="profile-avatar" 
                 alt="<?php echo e($user->name); ?>"
                 onerror="this.src='https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=4ecdc4&color=fff&size=150'">
            
            <h2 class="mb-2"><?php echo e($user->name); ?></h2>
            
            <?php switch($user->role):
                case ('Super'): ?>
                    <span class="role-badge badge-super">
                        <i class="fas fa-crown me-1"></i>Super Admin
                    </span>
                    <?php break; ?>
                <?php case ('Admin'): ?>
                    <span class="role-badge badge-admin">
                        <i class="fas fa-user-shield me-1"></i>Administrateur
                    </span>
                    <?php break; ?>
                <?php case ('Receptionist'): ?>
                    <span class="role-badge badge-receptionist">
                        <i class="fas fa-concierge-bell me-1"></i>Réceptionniste
                    </span>
                    <?php break; ?>
                <?php case ('Housekeeping'): ?>
                    <span class="role-badge badge-housekeeping">
                        <i class="fas fa-broom me-1"></i>Housekeeping
                    </span>
                    <?php break; ?>
                <?php default: ?>
                    <span class="role-badge badge-customer">
                        <i class="fas fa-user me-1"></i><?php echo e($user->role); ?>

                    </span>
            <?php endswitch; ?>
            
            <p class="mt-3 mb-0 opacity-75">
                <i class="fas fa-user-circle me-1"></i> ID: #<?php echo e($user->id); ?>

                • Membre depuis <?php echo e($user->created_at->format('d/m/Y')); ?>

            </p>
        </div>
        
        <div class="card-body p-4">
            <div class="row">
                <!-- Colonne gauche : Informations -->
                <div class="col-lg-8">
                    <!-- Informations personnelles -->
                    <div class="info-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-id-card text-primary me-2"></i>Informations Personnelles
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="info-icon bg-primary bg-opacity-10 text-primary">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Email</small>
                                            <strong><?php echo e($user->email); ?></strong>
                                            <?php if($user->email_verified_at): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success ms-2">
                                                <i class="fas fa-check-circle"></i> Vérifié
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="info-icon bg-info bg-opacity-10 text-info">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Téléphone</small>
                                            <strong><?php echo e($user->phone ?? 'Non renseigné'); ?></strong>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php if($user->address): ?>
                                <div class="col-12 mb-3">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="info-icon bg-warning bg-opacity-10 text-warning">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Adresse</small>
                                            <strong><?php echo e($user->address); ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Actions -->
                            <div class="mt-4 pt-3 border-top">
                                <div class="d-flex gap-2">
                                    <a href="mailto:<?php echo e($user->email); ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-envelope me-2"></i>Envoyer un email
                                    </a>
                                    
                                    <?php if(auth()->user()->role === 'Super' && auth()->user()->id !== $user->id): ?>
                                    <a href="<?php echo e(route('user.edit', $user)); ?>" class="btn btn-outline-warning">
                                        <i class="fas fa-edit me-2"></i>Modifier
                                    </a>
                                    <?php endif; ?>
                                    
                                    <?php if(auth()->user()->id === $user->id): ?>
                                    <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-outline-info">
                                        <i class="fas fa-user-edit me-2"></i>Mon profil
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Statistiques (si applicable) -->
                    <?php if($user->role === 'Customer'): ?>
                    <div class="info-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-chart-line text-success me-2"></i>Statistiques Client
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="stat-item">
                                        <div class="stat-number text-primary">
                                            <?php echo e($user->customer->transactions->count() ?? 0); ?>

                                        </div>
                                        <div class="stat-label">Réservations</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <div class="stat-item">
                                        <div class="stat-number text-success">
                                            <?php echo e(number_format($user->customer->transactions->sum('total_price') ?? 0, 0)); ?>

                                        </div>
                                        <div class="stat-label">FCFA dépensés</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <div class="stat-item">
                                        <div class="stat-number text-warning">
                                            <?php echo e($user->customer->transactions->where('status', 'active')->count() ?? 0); ?>

                                        </div>
                                        <div class="stat-label">Séjours actifs</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <div class="stat-item">
                                        <div class="stat-number text-info">
                                            <?php echo e($user->customer->transactions->where('status', 'completed')->count() ?? 0); ?>

                                        </div>
                                        <div class="stat-label">Séjours terminés</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Dernières activités -->
                    <?php if($user->activities && $user->activities->count() > 0): ?>
                    <div class="info-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-history text-purple me-2"></i>Dernières Activités
                            </h5>
                            
                            <div class="activity-list">
                                <?php $__currentLoopData = $user->activities->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="activity-item">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <i class="fas fa-circle text-primary me-2" style="font-size: 0.5rem;"></i>
                                            <span class="fw-medium"><?php echo e($activity->description); ?></span>
                                        </div>
                                        <small class="text-muted"><?php echo e($activity->created_at->diffForHumans()); ?></small>
                                    </div>
                                    <?php if($activity->properties && !empty($activity->properties)): ?>
                                    <small class="text-muted ms-4">
                                        <i class="fas fa-info-circle me-1"></i>
                                        <?php echo e(json_encode($activity->properties)); ?>

                                    </small>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Colonne droite : Métadonnées -->
                <div class="col-lg-4">
                    <!-- Statut -->
                    <div class="info-card">
                        <div class="card-body">
                            <h6 class="card-title mb-3">
                                <i class="fas fa-user-check text-success me-2"></i>Statut du Compte
                            </h6>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Statut:</span>
                                    <span>
                                        <?php if($user->is_active): ?>
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Actif
                                        </span>
                                        <?php else: ?>
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i>Inactif
                                        </span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Email vérifié:</span>
                                    <span>
                                        <?php if($user->email_verified_at): ?>
                                        <span class="badge bg-success">Oui</span>
                                        <?php else: ?>
                                        <span class="badge bg-warning">Non</span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Dernière connexion:</span>
                                    <span>
                                        <?php if($user->last_login_at): ?>
                                        <small><?php echo e($user->last_login_at->diffForHumans()); ?></small>
                                        <?php else: ?>
                                        <small class="text-muted">Jamais</small>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <span>Créé le:</span>
                                    <small><?php echo e($user->created_at->format('d/m/Y H:i')); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Permissions -->
                    <div class="info-card">
                        <div class="card-body">
                            <h6 class="card-title mb-3">
                                <i class="fas fa-shield-alt text-warning me-2"></i>Permissions
                            </h6>
                            
                            <?php switch($user->role):
                                case ('Super'): ?>
                                    <div class="alert alert-danger bg-opacity-10 border-danger">
                                        <i class="fas fa-crown me-2"></i>
                                        <strong>Super Admin</strong>
                                        <p class="mb-0 small mt-1">Accès complet à toutes les fonctionnalités</p>
                                    </div>
                                    <?php break; ?>
                                <?php case ('Admin'): ?>
                                    <div class="alert alert-primary bg-opacity-10 border-primary">
                                        <i class="fas fa-user-shield me-2"></i>
                                        <strong>Administrateur</strong>
                                        <p class="mb-0 small mt-1">Gestion complète avec restrictions mineures</p>
                                    </div>
                                    <?php break; ?>
                                <?php case ('Receptionist'): ?>
                                    <div class="alert alert-info bg-opacity-10 border-info">
                                        <i class="fas fa-concierge-bell me-2"></i>
                                        <strong>Réceptionniste</strong>
                                        <p class="mb-0 small mt-1">Accès limité aux opérations de réception</p>
                                    </div>
                                    <?php break; ?>
                                <?php case ('Housekeeping'): ?>
                                    <div class="alert alert-purple bg-opacity-10 border-purple">
                                        <i class="fas fa-broom me-2"></i>
                                        <strong>Housekeeping</strong>
                                        <p class="mb-0 small mt-1">Accès aux fonctions de nettoyage uniquement</p>
                                    </div>
                                    <?php break; ?>
                                <?php default: ?>
                                    <div class="alert alert-success bg-opacity-10 border-success">
                                        <i class="fas fa-user me-2"></i>
                                        <strong>Client</strong>
                                        <p class="mb-0 small mt-1">Accès à ses propres réservations seulement</p>
                                    </div>
                            <?php endswitch; ?>
                        </div>
                    </div>
                    
                    <!-- Actions rapides (Super seulement) -->
                    <?php if(auth()->user()->role === 'Super' && auth()->user()->id !== $user->id): ?>
                    <div class="info-card">
                        <div class="card-body">
                            <h6 class="card-title mb-3">
                                <i class="fas fa-bolt text-danger me-2"></i>Actions Rapides
                            </h6>
                            
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#resetPasswordModal">
                                    <i class="fas fa-key me-2"></i>Réinitialiser le mot de passe
                                </button>
                                
                                <button class="btn btn-outline-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#toggleStatusModal">
                                    <?php if($user->is_active): ?>
                                    <i class="fas fa-user-slash me-2"></i>Désactiver le compte
                                    <?php else: ?>
                                    <i class="fas fa-user-check me-2"></i>Activer le compte
                                    <?php endif; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de réinitialisation de mot de passe -->
<?php if(auth()->user()->role === 'Super' && auth()->user()->id !== $user->id): ?>
<div class="modal fade" id="resetPasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-key me-2"></i>Réinitialiser le mot de passe
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir réinitialiser le mot de passe de <strong><?php echo e($user->name); ?></strong> ?</p>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Un email sera envoyé à <?php echo e($user->email); ?> avec les instructions de réinitialisation.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="<?php echo e(route('user.password.reset', $user)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-key me-1"></i>Réinitialiser
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'activation/désactivation -->
<div class="modal fade" id="toggleStatusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <?php if($user->is_active): ?>
                    <i class="fas fa-user-slash me-2"></i>Désactiver le compte
                    <?php else: ?>
                    <i class="fas fa-user-check me-2"></i>Activer le compte
                    <?php endif; ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php if($user->is_active): ?>
                <p>Êtes-vous sûr de vouloir désactiver le compte de <strong><?php echo e($user->name); ?></strong> ?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    L'utilisateur ne pourra plus se connecter jusqu'à réactivation.
                </div>
                <?php else: ?>
                <p>Êtes-vous sûr de vouloir activer le compte de <strong><?php echo e($user->name); ?></strong> ?</p>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    L'utilisateur pourra à nouveau se connecter.
                </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="<?php echo e(route('user.toggle.status', $user)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="btn btn-warning">
                        <?php if($user->is_active): ?>
                        <i class="fas fa-user-slash me-1"></i>Désactiver
                        <?php else: ?>
                        <i class="fas fa-user-check me-1"></i>Activer
                        <?php endif; ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Style pour les badges violets -->
<style>
    .bg-purple { background-color: #a363d9 !important; }
    .border-purple { border-color: #a363d9 !important; }
    .text-purple { color: #a363d9 !important; }
    .bg-purple.bg-opacity-10 { background-color: rgba(163, 99, 217, 0.1) !important; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Animation de l'avatar
    const avatar = document.querySelector('.profile-avatar');
    if (avatar) {
        avatar.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        avatar.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }
    
    // Confirmation avant action
    const actionButtons = document.querySelectorAll('.btn-outline-danger, .btn-outline-warning');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir effectuer cette action ?')) {
                e.preventDefault();
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\HP ELITEBOOK\Desktop\dev\HotelManagement\resources\views/user/show.blade.php ENDPATH**/ ?>