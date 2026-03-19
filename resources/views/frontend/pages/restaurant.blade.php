@extends('frontend.layouts.master')

@section('title', 'Restaurant Gastronomique - Morada Lodge')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 mb-4">Le Restaurant Gastronomique</h1>
                    <p class="lead mb-4">Une expérience culinaire unique par notre chef étoilé</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Présentation -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="mb-4">Cuisine Française Raffinée</h2>
                    <p>Notre restaurant vous invite à un voyage culinaire exceptionnel. Sous la direction de notre chef étoilé, nous proposons une cuisine française contemporaine mettant en valeur les produits de saison.</p>
                    <p>Avec une vue imprenable sur les jardins de l'hôtel, le restaurant offre une ambiance élégante et chaleureuse, parfaite pour un dîner romantique ou un déjeuner d'affaires.</p>
                    
                    <div class="mt-4">
                        <h5>Horaires d'ouverture :</h5>
                        <ul class="list-unstyled">
                            <li><strong>Petit-déjeuner :</strong> 7h - 11h</li>
                            <li><strong>Déjeuner :</strong> 12h - 15h</li>
                            <li><strong>Dîner :</strong> 19h - 23h</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                         alt="Notre chef" 
                         class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Réservation -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h2 class="mb-2">Réservation de table</h2>
                                <p class="text-muted">Réservez votre table pour une expérience culinaire inoubliable</p>
                            </div>
                            
                            <form id="reservationForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nom complet *</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Téléphone *</label>
                                        <input type="tel" class="form-control" name="phone" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Date *</label>
                                        <input type="date" class="form-control" name="date" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Heure *</label>
                                        <input type="time" class="form-control" name="time" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nombre de personnes *</label>
                                        <select class="form-select" name="persons" required>
                                            <option value="1">1 personne</option>
                                            <option value="2" selected>2 personnes</option>
                                            <option value="3">3 personnes</option>
                                            <option value="4">4 personnes</option>
                                            <option value="5">5 personnes</option>
                                            <option value="6">6 personnes</option>
                                            <option value="7">7 personnes</option>
                                            <option value="8">8 personnes</option>
                                            <option value="9">9 personnes</option>
                                            <option value="10">10 personnes</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Type de table</label>
                                        <select class="form-select" name="table_type">
                                            <option value="standard">Standard</option>
                                            <option value="window">Fenêtre</option>
                                            <option value="terrace">Terrasse</option>
                                            <option value="private">Salle privée</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Notes spéciales</label>
                                    <textarea class="form-control" name="notes" rows="3" placeholder="Allergies, préférences alimentaires..."></textarea>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary-custom btn-lg">
                                        <i class="fas fa-calendar-check me-2"></i> Réserver maintenant
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu -->
    <section class="py-5 light-brown-bg">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="mb-3">Notre Carte</h2>
                <p class="text-muted">Découvrez une symphonie de saveurs locales et internationales</p>
            </div>

            <!-- Filtres catégories -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="d-flex justify-content-center flex-wrap">
                        <button class="btn btn-outline-primary-custom m-1 category-filter active" data-category="all">
                            Toute la carte
                        </button>
                        <button class="btn btn-outline-primary-custom m-1 category-filter" data-category="africain">
                            Mets Africains
                        </button>
                        <button class="btn btn-outline-primary-custom m-1 category-filter" data-category="europeen">
                            Européen
                        </button>
                        <button class="btn btn-outline-primary-custom m-1 category-filter" data-category="grillade">
                            Grillades & Fruits de mer
                        </button>
                        <button class="btn btn-outline-primary-custom m-1 category-filter" data-category="rapide">
                            Fast Food
                        </button>
                        <button class="btn btn-outline-primary-custom m-1 category-filter" data-category="salade">
                            Salades
                        </button>
                        <button class="btn btn-outline-primary-custom m-1 category-filter" data-category="boisson">
                            Bar & Cocktails
                        </button>
                    </div>
                </div>
            </div>

            <!-- Menu Section Designer -->
            <div id="menuContainer" class="max-w-5xl mx-auto">
                <div class="bg-white rounded shadow-lg overflow-hidden border-0">
                    <!-- Mets Africains -->
                    <div class="p-4 p-md-5 border-bottom category-section menu-item" data-category="africain">
                        <h2 class="h3 font-weight-bold mb-4 d-flex align-items-center" style="color: #654321;">
                            <span class="p-2 rounded me-3" style="background: #654321; color: white;"><i class="fas fa-utensils"></i></span>
                            Mets Africains
                        </h2>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #654321 !important; background-color: #fdfaf8;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">Amiwo au poulet</h4>
                                        <span class="font-weight-bold" style="color: #654321;">5.000 FCFA</span>
                                    </div>
                                    <p class="small text-muted mb-0">Plat traditionnel à base de maïs avec poulet</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #654321 !important; background-color: #fdfaf8;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">Atassi avec Dja</h4>
                                        <span class="font-weight-bold" style="color: #654321;">3.500 FCFA</span>
                                    </div>
                                    <p class="small text-muted mb-0">Riz parfumé accompagné de sauce tomate</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #654321 !important; background-color: #fdfaf8;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">Bomiwo au poulet</h4>
                                        <span class="font-weight-bold" style="color: #654321;">5.500 FCFA</span>
                                    </div>
                                    <p class="small text-muted mb-0">Spécialité à base de pâte de maïs et poulet</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #654321 !important; background-color: #fdfaf8;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">MAN au Télibo</h4>
                                        <span class="font-weight-bold" style="color: #654321;">6.000 FCFA</span>
                                    </div>
                                    <p class="small text-muted mb-0">Plat signature du chef avec poisson fumé</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Spécialités Européennes -->
                    <div class="p-4 p-md-5 border-bottom category-section menu-item" data-category="europeen">
                        <h2 class="h3 font-weight-bold mb-4 d-flex align-items-center" style="color: #654321;">
                            <span class="p-2 rounded me-3" style="background: #654321; color: white;"><i class="fas fa-cheese"></i></span>
                            Spécialités Européennes
                        </h2>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #654321 !important; background-color: #f9f9f9;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">Spaghettis bolognaise</h4>
                                        <span class="font-weight-bold" style="color: #654321;">2.500 FCFA</span>
                                    </div>
                                    <p class="small text-muted mb-0">Pâtes italiennes avec sauce à la viande maison</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #654321 !important; background-color: #f9f9f9;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">Steak de bœuf</h4>
                                        <span class="font-weight-bold" style="color: #654321;">4.500 FCFA</span>
                                    </div>
                                    <p class="small text-muted mb-0">Entrecôte grillée, frites et sauce au choix</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grillades & Fruits de Mer -->
                    <div class="p-4 p-md-5 border-bottom category-section menu-item" data-category="grillade">
                        <h2 class="h3 font-weight-bold mb-4 d-flex align-items-center" style="color: #8B4513;">
                            <span class="p-2 rounded me-3" style="background: #8B4513; color: white;"><i class="fas fa-fish"></i></span>
                            Grillades &amp; Fruits de Mer
                        </h2>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #8B4513 !important; background-color: #fff9f5;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">Brochette de bœuf</h4>
                                        <span class="font-weight-bold" style="color: #8B4513;">4.000 FCFA</span>
                                    </div>
                                    <p class="small text-muted mb-0">Brochettes marinées avec légumes grillés</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #8B4513 !important; background-color: #fff9f5;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">Brochette de poisson</h4>
                                        <span class="font-weight-bold" style="color: #8B4513;">4.500 FCFA</span>
                                    </div>
                                    <p class="small text-muted mb-0">Brochettes de poisson frais et épices</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #8B4513 !important; background-color: #fff9f5;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">Poisson braisé</h4>
                                        <span class="font-weight-bold" style="color: #8B4513;">4.500 FCFA</span>
                                    </div>
                                    <p class="small text-muted mb-0">Poisson entier grillé au feu de bois</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #8B4513 !important; background-color: #fff9f5;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">Gambas sautées à l'ail</h4>
                                        <span class="font-weight-bold" style="color: #8B4513;">12.000 FCFA</span>
                                    </div>
                                    <p class="small text-muted mb-0">Crevettes géantes sautées à l'ail et persil</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Restauration Rapide -->
                    <div class="p-4 p-md-5 border-bottom category-section menu-item" data-category="rapide">
                        <h2 class="h3 font-weight-bold mb-4 d-flex align-items-center" style="color: #556B2F;">
                            <span class="p-2 rounded me-3" style="background: #556B2F; color: white;"><i class="fas fa-hamburger"></i></span>
                            Restauration Rapide
                        </h2>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #556B2F !important; background-color: #f7f9f2;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">Shawarma</h4>
                                        <span class="font-weight-bold" style="color: #556B2F;">2.000 FCFA</span>
                                    </div>
                                    <p class="small text-muted mb-0">Wrap garni de viande, légumes et sauce</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #556B2F !important; background-color: #f7f9f2;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">Burgers variés</h4>
                                        <span class="italic text-muted">Sur commande</span>
                                    </div>
                                    <p class="small text-muted mb-0">Selon l'inspiration du chef - demandez-nous</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-lg border-start border-4" style="border-color: #556B2F !important; background-color: #f7f9f2;">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="h6 font-weight-bold mb-1">Frites au poulet</h4>
                                        <span class="font-weight-bold" style="color: #556B2F;">2.500 FCFA</span>
                                    </div>
                                    <p class="small text-muted mb-0">Frites croustillantes avec poulet pané</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Salades -->
                    <div class="p-4 p-md-5 border-bottom category-section menu-item" data-category="salade">
                        <h2 class="h3 font-weight-bold mb-4 d-flex align-items-center" style="color: #2E8B57;">
                            <span class="p-2 rounded me-3" style="background: #2E8B57; color: white;"><i class="fas fa-leaf"></i></span>
                            Salades Fraîches
                        </h2>
                        <div class="p-4 rounded-lg text-center" style="background: #f0f7f3; border: 1px dashed #2E8B57;">
                            <p class="mb-0 text-dark">Salades composées accompagnées de sauces maison — <span class="font-weight-bold">prix selon la carte du jour</span></p>
                        </div>
                    </div>

                    <!-- Bar & Cocktails -->
                    <div class="p-4 p-md-5 border-bottom category-section menu-item" data-category="boisson">
                        <h2 class="h3 font-weight-bold mb-4 d-flex align-items-center" style="color: #B8860B;">
                            <span class="p-2 rounded me-3" style="background: #B8860B; color: white;"><i class="fas fa-cocktail"></i></span>
                            Bar &amp; Cocktails
                        </h2>
                        <div class="p-4 rounded-lg" style="background: #fffcf5; border: 1px solid #B8860B;">
                            <p class="text-center mb-4 text-muted">Un large choix de boissons rafraîchissantes et cocktails originaux.</p>
                            <div class="row text-center">
                                <div class="col-6 border-end">
                                    <i class="fas fa-wine-glass text-2xl mb-2" style="color: #B8860B;"></i>
                                    <p class="font-weight-bold mb-0">Vins sélectionnés</p>
                                </div>
                                <div class="col-6">
                                    <i class="fas fa-glass-martini-alt text-2xl mb-2" style="color: #B8860B;"></i>
                                    <p class="font-weight-bold mb-0">Cocktails maison</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ambiance Festive -->
                    <div class="p-5 text-white text-center" style="background: linear-gradient(135deg, #C5A059 0%, #654321 100%);">
                        <h2 class="h3 font-weight-bold mb-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-music me-3"></i> Ambiance Festive
                        </h2>
                        <p class="lead mb-4">Profitez d'un barbecue ou d'un chili entre amis autour de la piscine.</p>
                        <div class="d-flex justify-content-center gap-4">
                            <div class="bg-white rounded-circle p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                                <i class="fas fa-utensils text-xl" style="color: #654321;"></i>
                            </div>
                            <div class="bg-white rounded-circle p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                                <i class="fas fa-swimming-pool text-xl" style="color: #654321;"></i>
                            </div>
                            <div class="bg-white rounded-circle p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                                <i class="fas fa-music text-xl" style="color: #654321;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="mt-5 text-center text-muted bg-white p-4 rounded shadow-sm border">
                    <div class="row align-items-center">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <i class="fas fa-clock mb-2 d-block" style="color: #C5A059;"></i>
                            <span class="small font-weight-bold">Service continu</span><br>
                            <span class="small">11h00 - 22h00</span>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0 border-start border-end">
                            <i class="fas fa-phone mb-2 d-block" style="color: #C5A059;"></i>
                            <span class="small font-weight-bold">Réservations</span><br>
                            <span class="small">+229 01 67 83 64 81</span>
                        </div>
                        <div class="col-md-4">
                            <i class="fas fa-map-marker-alt mb-2 d-block" style="color: #C5A059;"></i>
                            <span class="small font-weight-bold">Localisation</span><br>
                            <span class="small">Morada Lodge, Covè</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Menu filtering
    const filters = document.querySelectorAll('.category-filter');
    const sections = document.querySelectorAll('.category-section');

    filters.forEach(filter => {
        filter.addEventListener('click', function() {
            // Update active state
            filters.forEach(f => {
                f.classList.remove('active');
                f.style.backgroundColor = 'transparent';
                f.style.color = '#654321';
            });
            
            this.classList.add('active');
            this.style.backgroundColor = '#654321';
            this.style.color = '#ffffff';

            const category = this.getAttribute('data-category');

            sections.forEach(section => {
                if (category === 'all' || section.getAttribute('data-category') === category) {
                    section.style.display = 'block';
                    section.style.opacity = '0';
                    setTimeout(() => {
                        section.style.transition = 'opacity 0.4s ease-in-out';
                        section.style.opacity = '1';
                    }, 10);
                } else {
                    section.style.display = 'none';
                    section.style.opacity = '0';
                }
            });
        });
    });

    // Handle initial state if "all" is active
    const activeFilter = document.querySelector('.category-filter.active');
    if (activeFilter) {
        activeFilter.style.backgroundColor = '#654321';
        activeFilter.style.color = '#ffffff';
    }

    // Reservation Form
    const reservationForm = document.getElementById('reservationForm');
    if (reservationForm) {
        reservationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Envoi...';
            
            fetch('{{ route("restaurant.reservation.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Réservation envoyée !',
                    text: 'Nous vous confirmerons votre réservation par téléphone.',
                    confirmButtonColor: '#654321'
                }).then(() => {
                    reservationForm.reset();
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                });
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur est survenue lors de l\'envoi de votre réservation. Veuillez réessayer.',
                    confirmButtonColor: '#654321'
                });
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            });
        });
    }
});
</script>
@endpush