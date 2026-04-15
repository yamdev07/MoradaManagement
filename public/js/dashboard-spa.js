/**
 * Dashboard SPA - Sidebar Fixe avec Navigation AJAX
 * Empêche le rechargement de la sidebar à chaque navigation
 */

class DashboardSPA {
    constructor() {
        this.init();
    }

    init() {
        // Attendre que le DOM soit prêt
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        this.setupNavigation();
        this.setupHistory();
        this.setupLoading();
        this.setupActiveMenu();
        console.log('🚀 Dashboard SPA initialisé');
    }

    setupNavigation() {
        // Intercepter tous les liens internes du dashboard
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            
            if (!link) return;
            
            const href = link.getAttribute('href');
            
            // Ignorer les liens externes, ancres, et liens spéciaux
            if (!href || href.startsWith('#') || href.startsWith('http') || 
                href.includes('logout') || href.includes('download') || 
                href.includes('export') || link.getAttribute('target') === '_blank') {
                return;
            }

            // Vérifier si c'est un lien interne du dashboard
            if (href.includes('/dashboard') || href.includes('/transaction') || 
                href.includes('/room') || href.includes('/customer') || 
                href.includes('/checkin') || href.includes('/availability') ||
                href.includes('/profile') || href.includes('/reports')) {
                
                e.preventDefault();
                this.navigate(href);
            }
        });
    }

    setupHistory() {
        // Gérer le bouton retour du navigateur
        window.addEventListener('popstate', (e) => {
            if (e.state && e.state.url) {
                this.loadContent(e.state.url, false);
            }
        });
    }

    setupLoading() {
        // Créer l'indicateur de chargement s'il n'existe pas
        if (!document.getElementById('spa-loading')) {
            const loading = document.createElement('div');
            loading.id = 'spa-loading';
            loading.innerHTML = `
                <div class="spa-loading-overlay">
                    <div class="spa-loading-spinner">
                        <i class="fas fa-spinner fa-spin"></i>
                        <span>Chargement...</span>
                    </div>
                </div>
            `;
            
            // Ajouter les styles
            loading.innerHTML += `
                <style>
                    .spa-loading-overlay {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(255, 255, 255, 0.9);
                        display: none;
                        justify-content: center;
                        align-items: center;
                        z-index: 9999;
                        backdrop-filter: blur(2px);
                    }
                    
                    .spa-loading-spinner {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        gap: 10px;
                        color: var(--primary600, #0284c7);
                        font-size: 1.1rem;
                        font-weight: 500;
                    }
                    
                    .spa-loading-spinner i {
                        font-size: 2rem;
                    }
                    
                    .spa-loading.active {
                        display: flex !important;
                    }
                </style>
            `;
            
            document.body.appendChild(loading);
        }
    }

    setupActiveMenu() {
        // Mettre à jour les classes actives dans la sidebar
        this.updateActiveMenu(window.location.pathname);
    }

    async navigate(url) {
        // Afficher le chargement
        this.showLoading();
        
        try {
            await this.loadContent(url, true);
        } catch (error) {
            console.error('Erreur de navigation:', error);
            this.hideLoading();
            // En cas d'erreur, recharger normalement
            window.location.href = url;
        }
    }

    async loadContent(url, addToHistory = true) {
        try {
            // Récupérer le contenu via AJAX
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const html = await response.text();
            
            // Parser le HTML pour extraire le contenu principal
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // Extraire le contenu principal
            const newContent = doc.querySelector('#page-content-wrapper .p-3');
            const currentContent = document.querySelector('#page-content-wrapper .p-3');
            
            if (newContent && currentContent) {
                // Remplacer le contenu avec animation
                currentContent.style.opacity = '0';
                
                setTimeout(() => {
                    currentContent.innerHTML = newContent.innerHTML;
                    currentContent.style.opacity = '1';
                    
                    // Réinitialiser les scripts et composants
                    this.reinitializeComponents();
                    
                    // Mettre à jour l'URL et l'historique
                    if (addToHistory) {
                        history.pushState({ url }, '', url);
                    }
                    
                    // Mettre à jour le menu actif
                    this.updateActiveMenu(url);
                    
                    // Mettre à jour le titre de la page
                    this.updatePageTitle(doc);
                    
                    this.hideLoading();
                }, 200);
            } else {
                throw new Error('Structure de page incompatible');
            }
            
        } catch (error) {
            console.error('Erreur lors du chargement du contenu:', error);
            throw error;
        }
    }

    updateActiveMenu(url) {
        // Supprimer toutes les classes actives
        document.querySelectorAll('.nav-item.active').forEach(item => {
            item.classList.remove('active');
        });
        
        // Ajouter la classe active au bon menu
        document.querySelectorAll('.nav-item').forEach(item => {
            const href = item.getAttribute('href');
            if (href && (url === href || url.startsWith(href + '/') || href.startsWith(url + '/'))) {
                item.classList.add('active');
            }
        });
    }

    updatePageTitle(doc) {
        const newTitle = doc.querySelector('title');
        if (newTitle) {
            document.title = newTitle.textContent;
        }
    }

    reinitializeComponents() {
        // Réinitialiser les tooltips Bootstrap
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Réinitialiser les modals
        const modalElements = document.querySelectorAll('.modal');
        modalElements.forEach(modalEl => {
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) {
                modal.dispose();
            }
            new bootstrap.Modal(modalEl);
        });
        
        // Réinitialiser les dropdowns
        const dropdownElements = document.querySelectorAll('.dropdown-toggle');
        dropdownElements.forEach(dropdownEl => {
            const dropdown = bootstrap.Dropdown.getInstance(dropdownEl);
            if (dropdown) {
                dropdown.dispose();
            }
            new bootstrap.Dropdown(dropdownEl);
        });
        
        // Réinitialiser les événements personnalisés
        if (window.initializePageComponents) {
            window.initializePageComponents();
        }
    }

    showLoading() {
        const loading = document.getElementById('spa-loading');
        if (loading) {
            loading.classList.add('active');
        }
    }

    hideLoading() {
        const loading = document.getElementById('spa-loading');
        if (loading) {
            loading.classList.remove('active');
        }
    }
}

// Initialiser automatiquement
new DashboardSPA();

// Fonction utilitaire pour désactiver le SPA si nécessaire
window.disableDashboardSPA = function() {
    console.log('🚫 Dashboard SPA désactivé');
    // Supprimer les écouteurs d'événements
    window.location.reload();
};
