/**
 * Version simplifiée du système d'approbation des tenants
 * Utilise des alertes natives pour éviter les problèmes avec SweetAlert2
 */

class TenantApprovalSystemSimple {
    constructor() {
        console.log('🏢 TenantApprovalSystemSimple constructor called');
        this.init();
    }

    init() {
        console.log('🏢 Tenant Approval System Simple Initialisé');
        this.setupEventListeners();
    }

    setupEventListeners() {
        // Écouter les clics sur les boutons d'approbation
        document.addEventListener('click', (e) => {
            // Vérifier si le clic est sur un bouton ou à l'intérieur
            const button = e.target.closest('[data-action]');
            if (!button) {
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
                    this.approveTenant(tenantId, tenantName);
                    break;

                case 'reject-tenant':
                    console.log('❌ Reject button clicked');
                    this.rejectTenant(tenantId, tenantName);
                    break;

                case 'view-tenant-details':
                    console.log('👁️ Details button clicked');
                    this.viewTenantDetails(tenantId);
                    break;

                default:
                    console.log('❓ Unknown action:', action);
            }
        });
    }

    async approveTenant(tenantId, tenantName) {
        try {
            // Approbation silencieuse - pas de confirmation
            console.log('🚀 Approving tenant:', tenantId);
            
            // Afficher un message de chargement très discret
            this.showLoading('Approbation...');

            // Effectuer l'appel AJAX
            const response = await fetch(`/super-admin/tenant/${tenantId}/approve`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log('✅ Approval result:', result);

            if (result.success) {
                // Approbation silencieuse - pas de notification
                console.log(`✅ ${tenantName} approuvé avec succès`);
                
                // Rechargement ultra-rapide sans notification
                setTimeout(() => {
                    window.location.reload();
                }, 300); // 0.3 secondes pour un rechargement fluide
            } else {
                alert(`❌ Erreur lors de l'approbation: ${result.message || 'Erreur inconnue'}`);
            }

        } catch (error) {
            console.error('❌ Erreur lors de l\'approbation:', error);
            alert(`❌ Erreur lors de l'approbation du tenant: ${error.message}`);
        }
    }

    async rejectTenant(tenantId, tenantName) {
        try {
            // Confirmation avec alert native
            const confirmed = confirm(`Voulez-vous vraiment rejeter ce tenant ?\n\n${tenantName}\n\nCette action supprimera définitivement :\n- Le compte tenant\n- L\'utilisateur administrateur associé\n- Toutes les données liées\n\nCette action est irréversible !`);
            
            if (!confirmed) {
                return;
            }

            console.log('🗑️ Rejecting tenant:', tenantId);
            
            // Afficher un message de chargement
            this.showLoading('Suppression en cours...');

            // Effectuer l'appel AJAX
            const response = await fetch(`/super-admin/tenant/${tenantId}/reject`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log('✅ Rejection result:', result);

            if (result.success) {
                alert(`🗑️ ${tenantName} a été rejeté et supprimé avec succès !`);
                // Recharger la page pour mettre à jour la liste
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                alert(`❌ Erreur lors du rejet: ${result.message || 'Erreur inconnue'}`);
            }

        } catch (error) {
            console.error('❌ Erreur lors du rejet:', error);
            alert(`❌ Erreur lors du rejet du tenant: ${error.message}`);
        }
    }

    viewTenantDetails(tenantId) {
        alert(`📋 Détails du tenant ID: ${tenantId}\n\nFonctionnalité de détails en cours de développement.`);
    }

    showLoading(message) {
        // Créer une overlay de chargement simple
        const loadingDiv = document.createElement('div');
        loadingDiv.id = 'loading-overlay';
        loadingDiv.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            color: white;
            font-size: 18px;
        `;
        loadingDiv.innerHTML = `<div>${message}</div>`;
        document.body.appendChild(loadingDiv);
    }

    hideLoading() {
        const loadingDiv = document.getElementById('loading-overlay');
        if (loadingDiv) {
            loadingDiv.remove();
        }
    }
}

// Initialiser le système quand le DOM est prêt
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔍 DOM chargé, vérification du système simple...');
    
    // Vérifier si on est sur la page du Super Admin
    if (window.location.pathname.includes('super-admin')) {
        window.tenantApprovalSystemSimple = new TenantApprovalSystemSimple();
        console.log('🏢 Système d\'approbation simple des tenants chargé');
    }
});

// Exposer globalement pour utilisation dans les templates
window.TenantApprovalSystemSimple = TenantApprovalSystemSimple;
