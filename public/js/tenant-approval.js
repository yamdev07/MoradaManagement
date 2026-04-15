/**
 * Système d'approbation des tenants pour Super Admin
 * Gère l'approbation automatique avec création des pages personnalisées
 */

class TenantApprovalSystem {
    constructor() {
        console.log('🏢 TenantApprovalSystem constructor called');
        this.init();
    }

    init() {
        console.log('🏢 Tenant Approval System Initialisé');
        this.setupEventListeners();
        this.loadPendingTenants();
    }

    setupEventListeners() {
        // Écouter les clics sur les boutons d'approbation avec délégation d'événements
        document.addEventListener('click', (e) => {
            // Vérifier si le clic est sur un bouton ou à l'intérieur
            const button = e.target.closest('[data-action]');
            if (!button) {
                console.log('🖱️ Click detected on non-action element:', e.target);
                return;
            }

            console.log('🖱️ Click detected on button:', button);
            console.log('🎯 Data attributes:', {
                action: button.dataset.action,
                tenantId: button.dataset.tenantId,
                tenantName: button.dataset.tenantName
            });

            const action = button.dataset.action;
            const tenantId = button.dataset.tenantId;
            const tenantName = button.dataset.tenantName;

            switch (action) {
                case 'approve-tenant':
                    console.log('✅ Approve button clicked');
                    console.log('🏨 Approving tenant:', tenantId, tenantName);
                    this.approveTenant(tenantId, tenantName);
                    break;

                case 'reject-tenant':
                    console.log('❌ Reject button clicked');
                    console.log('🏨 Rejecting tenant:', tenantId, tenantName);
                    this.rejectTenant(tenantId, tenantName);
                    break;

                case 'view-tenant-details':
                    console.log('👁️ Details button clicked');
                    console.log('🏨 Viewing tenant details:', tenantId);
                    this.viewTenantDetails(tenantId);
                    break;

                default:
                    console.log('❓ Unknown action:', action);
            }
        });
    }

    async approveTenant(tenantId, tenantName) {
        try {
            // Afficher la confirmation
            const result = await Swal.fire({
                title: 'Approuver ce tenant ?',
                html: `
                    <div class="text-left">
                        <p>Vous êtes sur le point d'approuver :</p>
                        <div class="alert alert-info">
                            <strong>${tenantName}</strong><br>
                            <small>Cela créera automatiquement :</small>
                            <ul class="mb-0 mt-2">
                                <li>Les pages personnalisées avec les thèmes choisis</li>
                                <li>Les types de chambres par défaut</li>
                                <li>Les chambres d'exemple</li>
                                <li>Les menus du restaurant</li>
                                <li>L'accès administrateur pour le tenant</li>
                            </ul>
                        </div>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Oui, approuver',
                cancelButtonText: 'Annuler',
                showLoaderOnConfirm: true,
                preConfirm: async () => {
                    return await this.performApproval(tenantId);
                }
            });

            if (result.isConfirmed) {
                await this.handleApprovalSuccess(result.value, tenantName);
            }
        } catch (error) {
            console.error('Erreur lors de l\'approbation:', error);
            this.showError('Erreur lors de l\'approbation du tenant');
        }
    }

    async performApproval(tenantId) {
        const response = await fetch(`/api/tenant/${tenantId}/approve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    }

    async handleApprovalSuccess(result, tenantName) {
        if (result.success) {
            // Animation de succès
            await Swal.fire({
                title: '✅ Tenant Approuvé !',
                html: `
                    <div class="text-left">
                        <div class="alert alert-success">
                            <strong>${tenantName}</strong> a été approuvé avec succès !
                        </div>
                        <h5>Pages créées automatiquement :</h5>
                        <ul>
                            <li>✅ Page d'accueil personnalisée</li>
                            <li>✅ Page des chambres</li>
                            <li>✅ Page du restaurant</li>
                            <li>✅ Page de réservation</li>
                            <li>✅ Page de contact</li>
                        </ul>
                        <div class="mt-3">
                            <small class="text-muted">
                                Le tenant peut maintenant accéder à son système personnalisé.
                            </small>
                        </div>
                    </div>
                `,
                icon: 'success',
                confirmButtonText: 'Parfait !',
                confirmButtonColor: '#28a745'
            });

            // Recharger la page pour mettre à jour la liste
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            this.showError(result.message || 'Erreur lors de l\'approbation');
        }
    }

    async rejectTenant(tenantId, tenantName) {
        try {
            const result = await Swal.fire({
                title: 'Rejeter ce tenant ?',
                html: `
                    <div class="text-left">
                        <p>Vous êtes sur le point de rejeter :</p>
                        <div class="alert alert-warning">
                            <strong>${tenantName}</strong><br>
                            <small>Cette action supprimera définitivement :</small>
                            <ul class="mb-0 mt-2">
                                <li>Le compte tenant</li>
                                <li>L'utilisateur administrateur associé</li>
                                <li>Toutes les données liées</li>
                            </ul>
                        </div>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, rejeter',
                cancelButtonText: 'Annuler',
                showLoaderOnConfirm: true,
                preConfirm: async () => {
                    return await this.performRejection(tenantId);
                }
            });

            if (result.isConfirmed) {
                await this.handleRejectionSuccess(result.value, tenantName);
            }
        } catch (error) {
            console.error('Erreur lors du rejet:', error);
            this.showError('Erreur lors du rejet du tenant');
        }
    }

    async performRejection(tenantId) {
        const response = await fetch(`/api/tenant/${tenantId}/reject`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();
    }

    async handleRejectionSuccess(result, tenantName) {
        if (result.success) {
            await Swal.fire({
                title: '🗑️ Tenant Rejeté',
                html: `
                    <div class="alert alert-danger">
                        <strong>${tenantName}</strong> a été rejeté et supprimé.
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc3545'
            });

            // Recharger la page
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            this.showError(result.message || 'Erreur lors du rejet');
        }
    }

    async viewTenantDetails(tenantId) {
        try {
            const response = await fetch(`/api/tenant/${tenantId}/stats`);
            const data = await response.json();

            if (data.success) {
                const tenant = data.tenant;
                const stats = data.stats;

                await Swal.fire({
                    title: '📊 Détails du Tenant',
                    html: `
                        <div class="text-left">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>Nom :</strong><br>
                                    ${tenant.name}
                                </div>
                                <div class="col-6">
                                    <strong>Statut :</strong><br>
                                    <span class="badge ${tenant.is_active ? 'bg-success' : 'bg-warning'}">
                                        ${tenant.is_active ? 'Actif' : 'En attente'}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-6">
                                    <strong>Email :</strong><br>
                                    ${tenant.contact_email || tenant.email}
                                </div>
                                <div class="col-6">
                                    <strong>Téléphone :</strong><br>
                                    ${tenant.contact_phone || 'Non défini'}
                                </div>
                            </div>
                            
                            @if(tenant.description)
                            <div class="mb-3">
                                <strong>Description :</strong><br>
                                <small>${tenant.description}</small>
                            </div>
                            @endif
                            
                            <hr>
                            
                            <h6>📈 Statistiques</h6>
                            <div class="row">
                                <div class="col-3 text-center">
                                    <div style="font-size: 1.5rem; font-weight: bold; color: #007bff;">
                                        ${stats.rooms_count}
                                    </div>
                                    <small>Chambres</small>
                                </div>
                                <div class="col-3 text-center">
                                    <div style="font-size: 1.5rem; font-weight: bold; color: #28a745;">
                                        ${stats.active_reservations}
                                    </div>
                                    <small>Réservations</small>
                                </div>
                                <div class="col-3 text-center">
                                    <div style="font-size: 1.5rem; font-weight: bold; color: #ffc107;">
                                        ${stats.users_count}
                                    </div>
                                    <small>Utilisateurs</small>
                                </div>
                                <div class="col-3 text-center">
                                    <div style="font-size: 1.5rem; font-weight: bold; color: #dc3545;">
                                        ${stats.occupancy_rate}%
                                    </div>
                                    <small>Taux occupation</small>
                                </div>
                            </div>
                            
                            @if(tenant.theme_settings)
                            <hr>
                            <h6>🎨 Thème Personnalisé</h6>
                            <div class="row">
                                <div class="col-6">
                                    <small>Couleur primaire :</small><br>
                                    <span style="display: inline-block; width: 20px; height: 20px; background: ${tenant.theme_settings.primary_color}; border-radius: 3px;"></span>
                                    ${tenant.theme_settings.primary_color}
                                </div>
                                <div class="col-6">
                                    <small>Couleur secondaire :</small><br>
                                    <span style="display: inline-block; width: 20px; height: 20px; background: ${tenant.theme_settings.secondary_color}; border-radius: 3px;"></span>
                                    ${tenant.theme_settings.secondary_color}
                                </div>
                            </div>
                            @endif
                        </div>
                    `,
                    width: '600px',
                    confirmButtonText: 'Fermer',
                    confirmButtonColor: '#007bff'
                });
            } else {
                this.showError('Impossible de charger les détails du tenant');
            }
        } catch (error) {
            console.error('Erreur lors du chargement des détails:', error);
            this.showError('Erreur lors du chargement des détails');
        }
    }

    async loadPendingTenants() {
        // Charger les tenants en attente avec animation
        const pendingCards = document.querySelectorAll('.pending-tenant-card');
        pendingCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    showError(message) {
        Swal.fire({
            title: '❌ Erreur',
            text: message,
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#dc3545'
        });
    }

    showSuccess(message) {
        Swal.fire({
            title: '✅ Succès',
            text: message,
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#28a745'
        });
    }

    // Méthode pour créer les boutons d'action
    createActionButtons(tenant) {
        return `
            <div class="btn-group" role="group">
                <button type="button" 
                        class="btn btn-success btn-sm" 
                        data-action="approve-tenant"
                        data-tenant-id="${tenant.id}"
                        data-tenant-name="${tenant.name}"
                        title="Approuver ce tenant">
                    <i class="fas fa-check"></i>
                </button>
                <button type="button" 
                        class="btn btn-info btn-sm" 
                        data-action="view-tenant-details"
                        data-tenant-id="${tenant.id}"
                        title="Voir les détails">
                    <i class="fas fa-eye"></i>
                </button>
                <button type="button" 
                        class="btn btn-danger btn-sm" 
                        data-action="reject-tenant"
                        data-tenant-id="${tenant.id}"
                        data-tenant-name="${tenant.name}"
                        title="Rejeter ce tenant">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
    }
}

// Initialiser le système quand le DOM est prêt
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔍 DOM chargé, vérification du système...');
    
    // Vérifier si SweetAlert2 est disponible
    if (typeof Swal === 'undefined') {
        console.error('❌ SweetAlert2 n\'est pas chargé !');
        return;
    }
    
    console.log('✅ SweetAlert2 est disponible');
    
    // Vérifier si on est sur la page du Super Admin
    if (window.location.pathname.includes('super-admin')) {
        window.tenantApprovalSystem = new TenantApprovalSystem();
        console.log('🏢 Système d\'approbation des tenants chargé');
    }
});

// Exposer globalement pour utilisation dans les templates
window.TenantApprovalSystem = TenantApprovalSystem;
