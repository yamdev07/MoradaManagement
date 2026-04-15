@extends('template.auth')
@section('title', 'Devenir partenaire - Morada Management')
@section('content')

<style>
:root {
    --primary: #2c3e50;
    --primary-light: #34495e;
    --secondary: #3498db;
    --success: #27ae60;
    --warning: #f39c12;
    --danger: #e74c3c;
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

.landing-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.hero-section {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color: white;
    border-radius: 24px;
    padding: 4rem 3rem;
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
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

.hero-section::after {
    content: '';
    position: absolute;
    bottom: -50px;
    left: -50px;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-20px) scale(1.05); }
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    letter-spacing: -1px;
}

.hero-subtitle {
    font-size: 1.3rem;
    opacity: 0.9;
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.hero-cta {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-hero {
    padding: 1rem 2.5rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.1rem;
}

.btn-primary-hero {
    background: var(--success);
    color: white;
}

.btn-primary-hero:hover {
    background: #229954;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3);
}

.btn-outline-hero {
    background: transparent;
    color: white;
    border: 2px solid white;
}

.btn-outline-hero:hover {
    background: white;
    color: var(--primary);
}

.features-section {
    margin-bottom: 3rem;
}

.section-title {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 1rem;
}

.section-subtitle {
    text-align: center;
    font-size: 1.1rem;
    color: var(--gray-600);
    margin-bottom: 3rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.feature-card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    transition: var(--transition);
    box-shadow: var(--shadow);
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
}

.feature-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 1rem;
}

.feature-description {
    color: var(--gray-600);
    line-height: 1.6;
}

.testimonials-section {
    background: var(--gray-50);
    border-radius: 16px;
    padding: 3rem 2rem;
    margin-bottom: 3rem;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.testimonial-card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: 12px;
    padding: 2rem;
    position: relative;
}

.testimonial-text {
    font-style: italic;
    color: var(--gray-600);
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.testimonial-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.testimonial-info h4 {
    margin: 0;
    color: var(--primary);
    font-size: 1rem;
}

.testimonial-info p {
    margin: 0;
    color: var(--gray-500);
    font-size: 0.9rem;
}

.testimonial-rating {
    color: var(--warning);
    margin-bottom: 1rem;
}

.pricing-section {
    margin-bottom: 3rem;
}

.pricing-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.pricing-card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    position: relative;
    transition: var(--transition);
}

.pricing-card.featured {
    border: 2px solid var(--primary);
    transform: scale(1.05);
}

.pricing-badge {
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--warning);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.pricing-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.pricing-card.featured:hover {
    transform: scale(1.05) translateY(-5px);
}

.pricing-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.pricing-price {
    font-size: 3rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.5rem;
}

.pricing-period {
    color: var(--gray-500);
    margin-bottom: 2rem;
}

.pricing-features {
    list-style: none;
    padding: 0;
    margin: 0 0 2rem;
    text-align: left;
}

.pricing-features li {
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.pricing-features li:last-child {
    border-bottom: none;
}

.pricing-features i {
    color: var(--success);
    width: 20px;
}

.btn-pricing {
    width: 100%;
    padding: 1rem 2rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-pricing-primary {
    background: var(--primary);
    color: white;
}

.btn-pricing-primary:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
}

.btn-pricing-outline {
    background: transparent;
    color: var(--primary);
    border: 2px solid var(--primary);
}

.btn-pricing-outline:hover {
    background: var(--primary);
    color: white;
}

.cta-section {
    background: linear-gradient(135deg, var(--success) 0%, #229954 100%);
    color: white;
    border-radius: 16px;
    padding: 3rem 2rem;
    text-align: center;
}

.cta-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.cta-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 2rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* Responsive */
@media (max-width: 768px) {
    .landing-container {
        padding: 1rem 0.5rem;
    }
    
    .hero-section {
        padding: 3rem 2rem;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .hero-cta {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-hero {
        width: 100%;
        max-width: 300px;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .features-grid,
    .testimonials-grid,
    .pricing-grid {
        grid-template-columns: 1fr;
    }
    
    .pricing-card.featured {
        transform: none;
    }
    
    .pricing-card.featured:hover {
        transform: translateY(-5px);
    }
}
</style>

<div class="landing-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Rejoignez Morada Management</h1>
            <p class="hero-subtitle">La solution de gestion hôtelière complète pour développer votre activité et offrir une expérience exceptionnelle à vos clients</p>
            <div class="hero-cta">
                <a href="{{ route('tenant.register') }}" class="btn-hero btn-primary-hero">
                    <i class="fas fa-rocket"></i>
                    Commencer maintenant
                </a>
                <a href="#features" class="btn-hero btn-outline-hero">
                    <i class="fas fa-play-circle"></i>
                    En savoir plus
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="features-section">
        <h2 class="section-title">Pourquoi choisir Morada Management ?</h2>
        <p class="section-subtitle">Découvrez toutes les fonctionnalités qui feront la différence pour votre hôtel</p>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <h3 class="feature-title">Interface personnalisable</h3>
                <p class="feature-description">Adaptez les couleurs, polices et design à l'image de votre hôtel pour une expérience client unique</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3 class="feature-title">Gestion des réservations</h3>
                <p class="feature-description">Système de réservation en temps réel avec synchronisation automatique sur tous vos canaux de distribution</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="feature-title">Gestion client avancée</h3>
                <p class="feature-description">Suivi complet des profils clients, historique des séjours et programme de fidélité intégré</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="feature-title">Rapports et analyses</h3>
                <p class="feature-description">Tableaux de bord en temps réel et rapports détaillés pour optimiser votre rentabilité</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3 class="feature-title">Application mobile</h3>
                <p class="feature-description">Gérez votre hôtel depuis n'importe où avec notre application mobile native</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="feature-title">Support 24/7</h3>
                <p class="feature-description">Assistance technique disponible en permanence pour vous accompagner dans votre développement</p>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonials-section">
        <h2 class="section-title">Ce que nos partenaires disent</h2>
        <p class="section-subtitle">Témoignages d'hôteliers qui font confiance à Morada Management</p>
        
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">"Morada Management a transformé notre gestion quotidienne. Plus de réservations manquées et une visibilité accrue sur nos canaux de distribution."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">JD</div>
                    <div class="testimonial-info">
                        <h4>Jean Dupont</h4>
                        <p>Manager, Hôtel Paradise</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">"La personnalisation de l'interface nous a permis de renforcer notre image de marque. Nos clients adorent l'expérience de réservation en ligne."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">MB</div>
                    <div class="testimonial-info">
                        <h4>Marie Besson</h4>
                        <p>Directrice, Ada Lodge</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">"Les rapports détaillés nous ont permis d'optimiser notre taux d'occupation de 25% en seulement 3 mois. Investissement très rentable!"</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">AK</div>
                    <div class="testimonial-info">
                        <h4>Abdou Karim</h4>
                        <p>Propriétaire, Royal Palace</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing Section -->
    <div class="pricing-section">
        <h2 class="section-title">Tarifs simples et transparents</h2>
        <p class="section-subtitle">Choisissez l'offre qui correspond à vos besoins</p>
        
        <div class="pricing-grid">
            <div class="pricing-card">
                <h3 class="pricing-title">Starter</h3>
                <div class="pricing-price">29€</div>
                <div class="pricing-period">par mois</div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> Jusqu'à 10 chambres</li>
                    <li><i class="fas fa-check"></i> Gestion des réservations</li>
                    <li><i class="fas fa-check"></i> Site web personnalisé</li>
                    <li><i class="fas fa-check"></i> Support par email</li>
                    <li><i class="fas fa-check"></i> Rapports de base</li>
                </ul>
                <a href="{{ route('tenant.register') }}" class="btn-pricing btn-pricing-outline">
                    Commencer
                </a>
            </div>
            
            <div class="pricing-card featured">
                <div class="pricing-badge">Plus populaire</div>
                <h3 class="pricing-title">Professional</h3>
                <div class="pricing-price">79€</div>
                <div class="pricing-period">par mois</div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> Jusqu'à 50 chambres</li>
                    <li><i class="fas fa-check"></i> Gestion multi-canaux</li>
                    <li><i class="fas fa-check"></i> Application mobile</li>
                    <li><i class="fas fa-check"></i> Support prioritaire</li>
                    <li><i class="fas fa-check"></i> Rapports avancés</li>
                    <li><i class="fas fa-check"></i> Programme de fidélité</li>
                </ul>
                <a href="{{ route('tenant.register') }}" class="btn-pricing btn-pricing-primary">
                    Choisir cette offre
                </a>
            </div>
            
            <div class="pricing-card">
                <h3 class="pricing-title">Enterprise</h3>
                <div class="pricing-price">199€</div>
                <div class="pricing-period">par mois</div>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> Chambres illimitées</li>
                    <li><i class="fas fa-check"></i> Multi-établissements</li>
                    <li><i class="fas fa-check"></i> API personnalisée</li>
                    <li><i class="fas fa-check"></i> Support dédié 24/7</li>
                    <li><i class="fas fa-check"></i> Business Intelligence</li>
                    <li><i class="fas fa-check"></i> Formation incluse</li>
                </ul>
                <a href="{{ route('tenant.register') }}" class="btn-pricing btn-pricing-outline">
                    Nous contacter
                </a>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <h2 class="cta-title">Prêt à transformer votre gestion hôtelière ?</h2>
        <p class="cta-subtitle">Rejoignez des centaines d'hôtels qui optimisent leur performance avec Morada Management</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('tenant.register') }}" class="btn-hero btn-primary-hero" style="background: white; color: var(--success);">
                <i class="fas fa-rocket"></i>
                Créer mon compte
            </a>
            <a href="mailto:contact@morada-management.com" class="btn-hero btn-outline-hero" style="border-color: white; color: white;">
                <i class="fas fa-envelope"></i>
                Demander une démo
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll pour les ancres
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Animation des cartes au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observer les cartes de fonctionnalités
    document.querySelectorAll('.feature-card, .testimonial-card, .pricing-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease-out';
        observer.observe(card);
    });
});
</script>

@endsection
