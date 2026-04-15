/**
 * Tenant Theme System
 * Dynamically injects tenant colors into CSS variables
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('Tenant Theme System: DOM loaded');
    
    // Get tenant colors from meta tag or global variable
    const tenantColors = window.tenantColors || {
        primary_color: '#8b4513',
        secondary_color: '#d2b48c', 
        accent_color: '#f59e0b'
    };
    
    console.log('Tenant Theme: Colors loaded:', tenantColors);
    
    // Inject tenant colors into CSS root variables
    const root = document.documentElement;
    
    // Set tenant colors
    root.style.setProperty('--tenant-primary', tenantColors.primary_color);
    root.style.setProperty('--tenant-secondary', tenantColors.secondary_color);
    root.style.setProperty('--tenant-accent', tenantColors.accent_color);
    
    console.log('Tenant Theme: CSS variables set');
    
    // Update sidebar colors dynamically
    updateSidebarColors(tenantColors);
});

function updateSidebarColors(colors) {
    console.log('Tenant Theme: Updating sidebar colors with:', colors);
    
    const root = document.documentElement;
    
    // Update sidebar gradient
    const sidebarBg = `linear-gradient(180deg, ${colors.primary_color} 0%, ${colors.secondary_color} 100%)`;
    root.style.setProperty('--sidebar-bg-primary', sidebarBg);
    
    // Update active item gradient
    const activeBg = `linear-gradient(135deg, ${hexToRgba(colors.primary_color, 0.2)} 0%, ${hexToRgba(colors.secondary_color, 0.1)} 100%)`;
    root.style.setProperty('--nav-item-bg-active', activeBg);
    
    // Update active item border
    const activeBorder = `${hexToRgba(colors.primary_color, 0.3)}`;
    root.style.setProperty('--nav-item-border-active', activeBorder);
    
    // Update icon gradients
    const iconBg = `linear-gradient(135deg, ${colors.primary_color} 0%, ${colors.secondary_color} 100%)`;
    root.style.setProperty('--nav-item-icon-bg-hover', iconBg);
    root.style.setProperty('--nav-item-icon-bg-active', iconBg);
    
    // Update active item indicator
    const indicatorBg = `linear-gradient(180deg, ${colors.primary_color} 0%, ${colors.secondary_color} 100%)`;
    root.style.setProperty('--nav-item-indicator-bg', indicatorBg);
    
    // Update box shadows with tenant colors
    const boxShadow = `0 4px 12px ${hexToRgba(colors.primary_color, 0.2)}`;
    root.style.setProperty('--nav-item-shadow-active', boxShadow);
    
    const iconShadow = `0 4px 8px ${hexToRgba(colors.primary_color, 0.3)}`;
    root.style.setProperty('--nav-item-icon-shadow-active', iconShadow);
    
    console.log('Tenant Theme: Sidebar colors updated successfully');
}

function hexToRgba(hex, alpha) {
    const r = parseInt(hex.slice(1, 3), 16);
    const g = parseInt(hex.slice(3, 5), 16);
    const b = parseInt(hex.slice(5, 7), 16);
    return `rgba(${r}, ${g}, ${b}, ${alpha})`;
}

// Function to update theme when tenant changes
window.updateTenantTheme = function(tenantColors) {
    console.log('Tenant Theme: Manual update requested with:', tenantColors);
    updateSidebarColors(tenantColors);
};
