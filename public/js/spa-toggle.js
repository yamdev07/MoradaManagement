/**
 * Bouton pour activer/désactiver le mode SPA
 */
document.addEventListener('DOMContentLoaded', function() {
    // Créer le bouton de contrôle SPA
    const spaToggle = document.createElement('div');
    spaToggle.id = 'spa-toggle';
    spaToggle.innerHTML = `
        <button id="spa-toggle-btn" class="btn btn-sm btn-outline-secondary" style="position: fixed; top: 20px; right: 20px; z-index: 1000; opacity: 0.7;" title="Activer/Désactiver Sidebar Fixe">
            <i class="fas fa-bolt"></i> SPA
        </button>
    `;
    document.body.appendChild(spaToggle);
    
    const toggleBtn = document.getElementById('spa-toggle-btn');
    
    // Vérifier l'état actuel du SPA
    let spaEnabled = localStorage.getItem('dashboard_spa_enabled') !== 'false';
    updateToggleButton();
    
    toggleBtn.addEventListener('click', function() {
        spaEnabled = !spaEnabled;
        localStorage.setItem('dashboard_spa_enabled', spaEnabled);
        updateToggleButton();
        
        if (spaEnabled) {
            // Activer SPA
            location.reload();
        } else {
            // Désactiver SPA
            if (window.disableDashboardSPA) {
                window.disableDashboardSPA();
            } else {
                location.reload();
            }
        }
    });
    
    function updateToggleButton() {
        if (spaEnabled) {
            toggleBtn.className = 'btn btn-sm btn-success';
            toggleBtn.innerHTML = '<i class="fas fa-bolt"></i> SPA ON';
            toggleBtn.title = 'Sidebar Fixe Activé - Cliquez pour désactiver';
        } else {
            toggleBtn.className = 'btn btn-sm btn-outline-secondary';
            toggleBtn.innerHTML = '<i class="fas fa-power-off"></i> SPA OFF';
            toggleBtn.title = 'Sidebar Fixe Désactivé - Cliquez pour activer';
        }
    }
    
    // Afficher/masquer le bouton selon la page
    function hideToggleIfNotDashboard() {
        const isDashboardPage = window.location.pathname.includes('/dashboard') || 
                              window.location.pathname.includes('/transaction') || 
                              window.location.pathname.includes('/room') || 
                              window.location.pathname.includes('/customer') || 
                              window.location.pathname.includes('/checkin') || 
                              window.location.pathname.includes('/availability') || 
                              window.location.pathname.includes('/profile') || 
                              window.location.pathname.includes('/reports');
        
        spaToggle.style.display = isDashboardPage ? 'block' : 'none';
    }
    
    hideToggleIfNotDashboard();
    
    // Surveiller les changements d'URL
    let currentUrl = window.location.pathname;
    setInterval(function() {
        if (window.location.pathname !== currentUrl) {
            currentUrl = window.location.pathname;
            hideToggleIfNotDashboard();
        }
    }, 100);
});
