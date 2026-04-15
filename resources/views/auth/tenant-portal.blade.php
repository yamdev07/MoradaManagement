@extends('template.auth')
@section('title', 'Portail des Connexions - Morada Lodge')
@section('content')

@push('styles')
<style>
/* ═════════════════════════════════════════════════════════════
   STYLES PORTAIL TENANTS
═══════════════════════════════════════════════════════════════ */
:root {
    --primary: #8b4513;
    --primary-light: #a0522d;
    --primary-soft: rgba(139, 69, 19, 0.08);
    --secondary: #3498db;
    --secondary-light: rgba(52, 152, 219, 0.08);
    --accent: #f39c12;
    --accent-light: rgba(243, 156, 18, 0.08);
    --success: #28a745;
    --success-light: rgba(40, 167, 69, 0.08);
    --warning: #f59e0b;
    --warning-light: rgba(245, 158, 11, 0.08);
    --danger: #ef4444;
    --danger-light: rgba(239, 68, 68, 0.08);
    --info: #17a2b8;
    --info-light: rgba(23, 162, 184, 0.08);
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
    --shadow: 0 4px 20px rgba(0, 0, 0, 0.02), 0 1px 3px rgba(0, 0, 0, 0.05);
    --shadow-hover: 0 10px 30px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
    --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
}

.portal-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}

.portal-header {
    text-align: center;
    margin-bottom: 3rem;
    color: white;
}

.portal-header h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    animation: fadeInDown 0.8s ease;
}

.portal-header p {
    font-size: 1.2rem;
    opacity: 0.9;
    animation: fadeInUp 0.8s ease 0.2s both;
}

.portal-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}

.tenant-card {
    background: var(--white);
    border-radius: 20px;
    box-shadow: var(--shadow-hover);
    overflow: hidden;
    transition: var(--transition);
    border: 1px solid var(--gray-200);
    animation: fadeInUp 0.6s ease both;
    position: relative;
}

.tenant-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.1);
}

.tenant-card:nth-child(1) { animation-delay: 0.1s; }
.tenant-card:nth-child(2) { animation-delay: 0.2s; }
.tenant-card:nth-child(3) { animation-delay: 0.3s; }
.tenant-card:nth-child(4) { animation-delay: 0.4s; }
.tenant-card:nth-child(5) { animation-delay: 0.5s; }
.tenant-card:nth-child(6) { animation-delay: 0.6s; }

.tenant-header {
    padding: 2rem;
    text-align: center;
    position: relative;
}

.tenant-logo {
    width: 80px;
    height: 80px;
    border-radius: 16px;
    margin: 0 auto 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--gray-100);
    border: 2px solid var(--gray-200);
    transition: var(--transition);
}

.tenant-logo img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 12px;
    object-fit: cover;
}

.tenant-name {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: var(--gray-800);
}

.tenant-domain {
    font-size: 0.9rem;
    color: var(--gray-500);
    margin-bottom: 1rem;
    font-family: 'Courier New', monospace;
    background: var(--gray-100);
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
}

.tenant-status {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

.status-active {
    background: var(--success);
    box-shadow: 0 0 0 3px var(--success-light);
}

.status-inactive {
    background: var(--warning);
    box-shadow: 0 0 0 3px var(--warning-light);
}

.tenant-body {
    padding: 0 2rem 2rem;
}

.tenant-description {
    color: var(--gray-600);
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.tenant-theme {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.theme-color {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    border: 2px solid var(--gray-200);
    transition: var(--transition);
}

.theme-color:hover {
    transform: scale(1.1);
}

.tenant-stats {
    display: flex;
    justify-content: space-around;
    margin-bottom: 1.5rem;
    padding: 1rem 0;
    border-top: 1px solid var(--gray-200);
    border-bottom: 1px solid var(--gray-200);
}

.stat-item {
    text-align: center;
}

.stat-value {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--primary);
    display: block;
}

.stat-label {
    font-size: 0.8rem;
    color: var(--gray-500);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.tenant-footer {
    padding: 1.5rem 2rem;
    background: var(--gray-50);
}

.btn-tenant-login {
    width: 100%;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: white;
    border: none;
    padding: 0.875rem 1.5rem;
    border-radius: var(--radius);
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
}

.btn-tenant-login:hover {
    background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(139, 69, 19, 0.3);
}

.btn-tenant-login i {
    font-size: 0.9rem;
    transition: var(--transition);
}

.btn-tenant-login:hover i {
    transform: translateX(5px);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: white;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.7;
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.empty-state p {
    font-size: 1rem;
    opacity: 0.8;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .portal-header h1 {
        font-size: 2rem;
    }
    
    .portal-header p {
        font-size: 1rem;
    }
    
    .portal-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .tenant-card {
        margin-bottom: 1rem;
    }
}
</style>
@endpush

<div class="portal-container">
    <div>
        <div class="portal-header">
            <h1>🏨 Portail des Connexions</h1>
            <p>Sélectionnez votre établissement pour vous connecter</p>
        </div>

        @if($tenants->count() > 0)
            <div class="portal-grid">
                @foreach($tenants as $tenant)
                    <div class="tenant-card">
                        <div class="tenant-header">
                            @if($tenant->logo)
                                <div class="tenant-logo">
                                    <img src="{{ asset('storage/' . $tenant->logo) }}" alt="{{ $tenant->name }}">
                                </div>
                            @else
                                <div class="tenant-logo">
                                    <i class="fas fa-hotel fa-2x" style="color: var(--primary);"></i>
                                </div>
                            @endif
                            
                            <div class="tenant-status {{ $tenant->is_active ? 'status-active' : 'status-inactive' }}" 
                                 title="{{ $tenant->is_active ? 'Actif' : 'Inactif' }}"></div>
                            
                            <h3 class="tenant-name">{{ $tenant->name }}</h3>
                            <div class="tenant-domain">{{ $tenant->domain ?? $tenant->subdomain }}</div>
                        </div>

                        <div class="tenant-body">
                            @if($tenant->description)
                                <p class="tenant-description">{{ Str::limit($tenant->description, 100) }}</p>
                            @endif

                            @if($tenant->theme_settings)
                                <div class="tenant-theme">
                                    <span style="font-size: 0.8rem; color: var(--gray-500);">Thème:</span>
                                    @if(isset($tenant->theme_settings['primary_color']))
                                        <div class="theme-color" 
                                             style="background-color: {{ $tenant->theme_settings['primary_color'] }};" 
                                             title="Couleur primaire"></div>
                                    @endif
                                    @if(isset($tenant->theme_settings['secondary_color']))
                                        <div class="theme-color" 
                                             style="background-color: {{ $tenant->theme_settings['secondary_color'] }};" 
                                             title="Couleur secondaire"></div>
                                    @endif
                                    @if(isset($tenant->theme_settings['accent_color']))
                                        <div class="theme-color" 
                                             style="background-color: {{ $tenant->theme_settings['accent_color'] }};" 
                                             title="Couleur d'accent"></div>
                                    @endif
                                </div>
                            @endif

                            <div class="tenant-stats">
                                <div class="stat-item">
                                    <span class="stat-value">{{ $tenant->users()->count() }}</span>
                                    <span class="stat-label">Utilisateurs</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-value">{{ $tenant->rooms()->count() }}</span>
                                    <span class="stat-label">Chambres</span>
                                </div>
                            </div>
                        </div>

                        <div class="tenant-footer">
                            <a href="{{ route('tenant.login', $tenant->domain ?? $tenant->subdomain ?? $tenant->id) }}" 
                               class="btn-tenant-login">
                                <i class="fas fa-sign-in-alt"></i>
                                Se connecter
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-hotel"></i>
                <h3>Aucun établissement disponible</h3>
                <p>Veuillez contacter l'administrateur pour créer un compte tenant.</p>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes au survol
    const cards = document.querySelectorAll('.tenant-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Effet de parallaxe subtil sur le fond
    document.addEventListener('mousemove', function(e) {
        const x = e.clientX / window.innerWidth;
        const y = e.clientY / window.innerHeight;
        
        document.body.style.background = `
            linear-gradient(${135 + x * 10}deg, 
                #667eea 0%, 
                #764ba2 100%)
        `;
    });
});
</script>
@endsection
