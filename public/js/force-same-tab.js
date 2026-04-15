// Force navigation in same tab
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 Force same tab navigation loaded');
    
    // Intercept all link clicks
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && link.href) {
            console.log('🔗 Link clicked:', link.href);
            console.log('🎯 Target:', link.target);
            
            // Force same tab navigation for internal links
            const isInternal = link.href.includes(window.location.hostname);
            if (isInternal) {
                console.log('✅ Internal link detected, forcing same tab');
                e.preventDefault();
                window.location.href = link.href;
            }
        }
    });
    
    // Override window.open for internal links
    const originalOpen = window.open;
    window.open = function(url, target, features) {
        if (url.includes(window.location.hostname)) {
            console.log('🔧 Overriding window.open for internal link');
            window.location.href = url;
            return null;
        }
        return originalOpen.call(this, url, target, features);
    };
});
