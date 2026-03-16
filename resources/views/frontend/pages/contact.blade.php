@extends('frontend.layouts.master')

@section('title', 'Contact - Morada Lodge')

@section('content')
    <!-- Hero Section Contact -->
    <section class="hero-section-contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 mb-4">Contact</h1>
                    <p class="lead mb-4">Réservez votre Séjour d'Exception</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Messages de succès/erreur -->
    @if(session('success'))
        <div class="container mt-4">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mt-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- Informations de contact -->
    <section class="py-5" style="background-color: var(--warm-beige);">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: white; border-top: 4px solid var(--primary-brown);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 60px; height: 60px; background-color: var(--primary-brown);">
                                <i class="fas fa-map-marker-alt fa-2x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown);">Adresse</h4>
                            <p class="text-muted mb-0">
                                Covè, République du Bénin
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: white; border-top: 4px solid var(--primary-brown);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 60px; height: 60px; background-color: var(--primary-brown);">
                                <i class="fas fa-phone fa-2x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown);">Téléphone</h4>
                            <p class="text-muted mb-2">
                                <i class="fas fa-phone me-2"></i>+229 0167836481
                            </p>
                            <p class="text-muted mb-0">
                                <i class="fas fa-headset me-2"></i>Réception 24h/24 - 7j/7
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: white; border-top: 4px solid var(--primary-brown);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 60px; height: 60px; background-color: var(--primary-brown);">
                                <i class="fas fa-envelope fa-2x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown);">Email</h4>
                            <p class="text-muted mb-0">
                                <i class="fas fa-envelope me-2"></i>admin@moradalodge.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulaire de contact -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="text-center mb-5">
                        <h2 style="color: var(--primary-brown);">Notre équipe est à votre disposition pour organiser un séjour sur mesure qui dépassera toutes vos attentes.</h2>
                    </div>
                    
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            <form action="{{ route('frontend.contact.submit') }}" method="POST" id="contactForm">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname" class="form-label" style="color: var(--primary-brown); font-weight: 500;">
                                                <i class="fas fa-user me-1"></i>Prénom *
                                            </label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="firstname" 
                                                   name="firstname" 
                                                   required
                                                   placeholder="Votre prénom"
                                                   style="border: 1px solid var(--secondary-brown);"
                                                   value="{{ old('firstname') }}">
                                            @error('firstname')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname" class="form-label" style="color: var(--primary-brown); font-weight: 500;">
                                                <i class="fas fa-user me-1"></i>Nom *
                                            </label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="lastname" 
                                                   name="lastname" 
                                                   required
                                                   placeholder="Votre nom"
                                                   style="border: 1px solid var(--secondary-brown);"
                                                   value="{{ old('lastname') }}">
                                            @error('lastname')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label" style="color: var(--primary-brown); font-weight: 500;">
                                                <i class="fas fa-envelope me-1"></i>Email *
                                            </label>
                                            <input type="email" 
                                                   class="form-control" 
                                                   id="email" 
                                                   name="email" 
                                                   required
                                                   placeholder="votre@email.com"
                                                   style="border: 1px solid var(--secondary-brown);"
                                                   value="{{ old('email') }}">
                                            @error('email')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="arrival" class="form-label" style="color: var(--primary-brown); font-weight: 500;">
                                                <i class="fas fa-calendar me-1"></i>Arrivée
                                            </label>
                                            <input type="date" 
                                                   class="form-control" 
                                                   id="arrival" 
                                                   name="arrival"
                                                   style="border: 1px solid var(--secondary-brown);"
                                                   value="{{ old('arrival') }}">
                                            @error('arrival')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="departure" class="form-label" style="color: var(--primary-brown); font-weight: 500;">
                                                <i class="fas fa-calendar me-1"></i>Départ
                                            </label>
                                            <input type="date" 
                                                   class="form-control" 
                                                   id="departure" 
                                                   name="departure"
                                                   style="border: 1px solid var(--secondary-brown);"
                                                   value="{{ old('departure') }}">
                                            @error('departure')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="room_type" class="form-label" style="color: var(--primary-brown); font-weight: 500;">
                                                <i class="fas fa-bed me-1"></i>Type de chambre
                                            </label>
                                            <select class="form-select" 
                                                    id="room_type" 
                                                    name="room_type" 
                                                    style="border: 1px solid var(--secondary-brown);">
                                                <option value="" selected disabled>Choisir un hébergement</option>
                                                <option value="bungalow" {{ old('room_type') == 'bungalow' ? 'selected' : '' }}>Bungalows Majestueux</option>
                                                <option value="chambre" {{ old('room_type') == 'chambre' ? 'selected' : '' }}>Chambre Confort</option>
                                                <option value="suite" {{ old('room_type') == 'suite' ? 'selected' : '' }}>Suite Présidentielle</option>
                                            </select>
                                            @error('room_type')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="message" class="form-label" style="color: var(--primary-brown); font-weight: 500;">
                                                <i class="fas fa-comment me-1"></i>Message (optionnel)
                                            </label>
                                            <textarea class="form-control" 
                                                      id="message" 
                                                      name="message" 
                                                      rows="6" 
                                                      placeholder=""
                                                      style="border: 1px solid var(--secondary-brown);">{{ old('message') }}</textarea>
                                            @error('message')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 text-center">
                                        <button type="submit" 
                                                class="btn btn-lg me-3"
                                                style="background-color: var(--primary-brown); border-color: var(--primary-brown); color: white; padding: 12px 40px;">
                                            <i class="fas fa-calendar-check me-2"></i>Réserver en ligne
                                        </button>
                                        <button type="button" 
                                                class="btn btn-lg"
                                                onclick="window.location.href='tel:+2290167836481'"
                                                style="background-color: var(--primary-brown); border-color: var(--primary-brown); color: white; padding: 12px 40px;">
                                            <i class="fas fa-phone me-2"></i>Appeler maintenant
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <!-- FAQ -->
    <section class="py-5" style="background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 style="color: var(--primary-brown); font-size: 2.5rem; font-weight: bold;">Questions fréquentes</h2>
                <p class="text-muted" style="font-size: 1.2rem;">Trouvez rapidement des réponses à vos questions</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item mb-4 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; background: white;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#faq1"
                                        style="background-color: white; color: var(--primary-brown); font-weight: 600; font-size: 1.1rem; border: none; box-shadow: none; padding: 20px;">
                                    <i class="fas fa-clock me-3" style="color: var(--primary-brown);"></i>
                                    Quels sont les horaires de check-in et check-out ?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" style="background-color: #fafafa; padding: 25px;">
                                    <p style="margin-bottom: 15px; font-size: 1rem;"><strong>Check-in:</strong> À partir de 15h00</p>
                                    <p style="margin-bottom: 10px; font-size: 1rem;"><strong>Check-out:</strong> Avant 12h00</p>
                                    <p style="font-size: 0.95rem; color: #666; font-style: italic;">Un check-in anticipé ou un check-out tardif peut être organisé sous réserve de disponibilité et peut engendrer des frais supplémentaires.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item mb-4 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; background: white;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#faq2"
                                        style="background-color: white; color: var(--primary-brown); font-weight: 600; font-size: 1.1rem; border: none; box-shadow: none; padding: 20px;">
                                    <i class="fas fa-paw me-3" style="color: var(--primary-brown);"></i>
                                    L'hôtel accepte-t-il les animaux de compagnie ?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" style="background-color: #fafafa; padding: 25px;">
                                    <p style="margin-bottom: 15px; font-size: 1rem;"><strong>Oui, Morada Lodge accepte les animaux de compagnie</strong> (chiens et chats jusqu'à 8kg).</p>
                                    <p style="font-size: 0.95rem; color: #666;">Des frais supplémentaires de 50€ par nuit sont appliqués. Un lit et des gamelles sont fournis sur demande.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item mb-4 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; background: white;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#faq3"
                                        style="background-color: white; color: var(--primary-brown); font-weight: 600; font-size: 1.1rem; border: none; box-shadow: none; padding: 20px;">
                                    <i class="fas fa-shuttle-van me-3" style="color: var(--primary-brown);"></i>
                                    Proposez-vous des services de navette depuis l'aéroport ?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" style="background-color: #fafafa; padding: 25px;">
                                    <p style="margin-bottom: 15px; font-size: 1rem;"><strong>Oui, nous proposons un service de navette privée</strong> depuis les aéroports.</p>
                                    <p style="font-size: 0.95rem; color: #666; font-style: italic;">Le service doit être réservé au minimum 48 heures à l'avance. Des véhicules de luxe (Berline, Van) sont disponibles.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item mb-4 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; background: white;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#faq4"
                                        style="background-color: white; color: var(--primary-brown); font-weight: 600; font-size: 1.1rem; border: none; box-shadow: none; padding: 20px;">
                                    <i class="fas fa-credit-card me-3" style="color: var(--primary-brown);"></i>
                                    Quels sont les moyens de paiement acceptés ?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" style="background-color: #fafafa; padding: 25px;">
                                    <p style="margin-bottom: 15px; font-size: 1rem;"><strong>Cartes acceptées:</strong> Visa, MasterCard, American Express</p>
                                    <p style="font-size: 0.95rem; color: #666; font-style: italic;">Les paiements en espèces sont également acceptés, ainsi que les virements bancaires pour les réservations de groupes.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <p class="text-muted mb-3">Vous ne trouvez pas la réponse à votre question ?</p>
                        <a href="#contactForm" class="btn" style="color: var(--primary-brown); border-color: var(--primary-brown); background-color: transparent;">
                            <i class="fas fa-envelope me-2"></i>Contactez-nous directement
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
.hero-section-contact {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                url('https://images.unsplash.com/photo-1522798514-97ceb8c4f1c8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
    background-size: cover;
    background-position: center;
    color: white;
    padding: 150px 0;
}

/* Style pour les formulaires */
.form-control:focus,
.form-select:focus {
    border-color: var(--primary-brown);
    box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.25);
}

/* Style pour la carte */
.map-container iframe {
    border: none;
}

/* Style pour les accordéons */
.accordion-button:not(.collapsed) {
    background-color: var(--primary-brown) !important;
    color: white !important;
}

.accordion-button:focus {
    box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.25);
    border-color: var(--primary-brown);
}

/* Style pour les cartes de contact */
.card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

/* Boutons avec effet hover */
.btn[style*="background-color: var(--primary-brown)"]:hover {
    background-color: var(--dark-brown) !important;
    border-color: var(--dark-brown) !important;
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

.btn[style*="color: var(--primary-brown)"]:hover {
    background-color: var(--primary-brown) !important;
    color: white !important;
    border-color: var(--primary-brown) !important;
}

/* Alertes */
.alert {
    border-radius: 10px;
    border: none;
}

.alert-success {
    background-color: var(--light-brown);
    color: var(--primary-brown);
    border-left: 4px solid var(--primary-brown);
}

.alert-danger {
    background-color: #FFEBEE;
    color: #C62828;
    border-left: 4px solid #F44336;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section-contact {
        padding: 100px 0;
    }
    
    .hero-section-contact h1 {
        font-size: 2.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validation du formulaire
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            // Validation basique côté client
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const subject = document.getElementById('subject');
            const message = document.getElementById('message');
            
            let isValid = true;
            
            // Réinitialiser les bordures
            [name, email, subject, message].forEach(input => {
                input.style.borderColor = 'var(--secondary-brown)';
            });
            
            // Validation des champs requis
            if (!name.value.trim()) {
                name.style.borderColor = '#dc2626';
                isValid = false;
            }
            
            if (!email.value.trim() || !isValidEmail(email.value)) {
                email.style.borderColor = '#dc2626';
                isValid = false;
            }
            
            if (!subject.value) {
                subject.style.borderColor = '#dc2626';
                isValid = false;
            }
            
            if (!message.value.trim()) {
                message.style.borderColor = '#dc2626';
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Veuillez remplir correctement tous les champs obligatoires (*)');
            }
        });
    }
    
    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    // Animation pour les cartes
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Auto-dismiss des alertes après 5 secondes
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endpush
