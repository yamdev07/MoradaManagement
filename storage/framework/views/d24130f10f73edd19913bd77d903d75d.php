

<?php $__env->startSection('title', 'Contact - ' . ($currentHotel->name ?? 'Morada Lodge')); ?>

<?php $__env->startSection('content'); ?>
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
    <?php if(session('success')): ?>
        <div class="container mt-4">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="container mt-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <!-- Informations de contact -->
    <section class="py-5" style="background-color: var(--warm-beige);">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: white; border-top: 4px solid var(--primary-brown, #007bff);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 60px; height: 60px; background-color: var(--primary-brown, #007bff);">
                                <i class="fas fa-map-marker-alt fa-2x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown, #007bff);">Adresse</h4>
                            <p class="text-muted mb-0">
                                Covè, République du Bénin
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: white; border-top: 4px solid var(--primary-brown, #007bff);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 60px; height: 60px; background-color: var(--primary-brown, #007bff);">
                                <i class="fas fa-phone fa-2x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown, #007bff);">Téléphone</h4>
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
                    <div class="card border-0 shadow-sm h-100" style="background-color: white; border-top: 4px solid var(--primary-brown, #007bff);">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 60px; height: 60px; background-color: var(--primary-brown, #007bff);">
                                <i class="fas fa-envelope fa-2x text-white"></i>
                            </div>
                            <h4 style="color: var(--primary-brown, #007bff);">Email</h4>
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
                        <h2 style="color: var(--primary-brown, #007bff);">Notre équipe est à votre disposition pour organiser un séjour sur mesure qui dépassera toutes vos attentes.</h2>
                    </div>
                    
                    <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                        <div class="card-body p-4 p-md-5" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                            <form action="<?php echo e(route('frontend.contact.submit')); ?>" method="POST" id="contactForm">
                                <?php echo csrf_field(); ?>
                                <div class="row g-4">
                                    <!-- Section Informations Personnelles -->
                                    <div class="col-12">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center me-3" 
                                                 style="width: 40px; height: 40px; background-color: var(--primary-brown, #007bff);">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                            <h4 class="mb-0" style="color: var(--primary-brown, #007bff); font-weight: 600;">Informations Personnelles</h4>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="firstname" class="form-label fw-semibold" style="color: var(--primary-brown, #007bff);">
                                                <i class="fas fa-user me-2"></i>Prénom *
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background-color: var(--primary-brown, #007bff); color: white; border: none;">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                                <input type="text" 
                                                       class="form-control" 
                                                       id="firstname" 
                                                       name="firstname" 
                                                       required
                                                       placeholder="Votre prénom"
                                                       style="border-left: none; border-color: var(--secondary-brown, #6c757d);"
                                                       value="<?php echo e(old('firstname')); ?>">
                                            </div>
                                            <?php $__errorArgs = ['firstname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger small mt-1 d-block"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="lastname" class="form-label fw-semibold" style="color: var(--primary-brown, #007bff);">
                                                <i class="fas fa-user me-2"></i>Nom *
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background-color: var(--primary-brown, #007bff); color: white; border: none;">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                                <input type="text" 
                                                       class="form-control" 
                                                       id="lastname" 
                                                       name="lastname" 
                                                       required
                                                       placeholder="Votre nom"
                                                       style="border-left: none; border-color: var(--secondary-brown, #6c757d);"
                                                       value="<?php echo e(old('lastname')); ?>">
                                            </div>
                                            <?php $__errorArgs = ['lastname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger small mt-1 d-block"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Section Contact -->
                                    <div class="col-12">
                                        <div class="d-flex align-items-center mb-3 mt-4">
                                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center me-3" 
                                                 style="width: 40px; height: 40px; background-color: var(--primary-brown, #007bff);">
                                                <i class="fas fa-envelope text-white"></i>
                                            </div>
                                            <h4 class="mb-0" style="color: var(--primary-brown, #007bff); font-weight: 600;">Coordonnées</h4>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="email" class="form-label fw-semibold" style="color: var(--primary-brown, #007bff);">
                                                <i class="fas fa-envelope me-2"></i>Email *
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background-color: var(--primary-brown, #007bff); color: white; border: none;">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                <input type="email" 
                                                       class="form-control" 
                                                       id="email" 
                                                       name="email" 
                                                       required
                                                       placeholder="votre@email.com"
                                                       style="border-left: none; border-color: var(--secondary-brown, #6c757d);"
                                                       value="<?php echo e(old('email')); ?>">
                                            </div>
                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger small mt-1 d-block"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="phone" class="form-label fw-semibold" style="color: var(--primary-brown, #007bff);">
                                                <i class="fas fa-phone me-2"></i>Téléphone
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background-color: var(--primary-brown, #007bff); color: white; border: none;">
                                                    <i class="fas fa-phone"></i>
                                                </span>
                                                <input type="tel" 
                                                       class="form-control" 
                                                       id="phone" 
                                                       name="phone" 
                                                       placeholder="+229 XXXXXXXX"
                                                       style="border-left: none; border-color: var(--secondary-brown, #6c757d);"
                                                       value="<?php echo e(old('phone')); ?>">
                                            </div>
                                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger small mt-1 d-block"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Section Réservation -->
                                    <div class="col-12">
                                        <div class="d-flex align-items-center mb-3 mt-4">
                                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center me-3" 
                                                 style="width: 40px; height: 40px; background-color: var(--primary-brown, #007bff);">
                                                <i class="fas fa-calendar text-white"></i>
                                            </div>
                                            <h4 class="mb-0" style="color: var(--primary-brown, #007bff); font-weight: 600;">Détails du Séjour</h4>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="arrival" class="form-label fw-semibold" style="color: var(--primary-brown, #007bff);">
                                                <i class="fas fa-calendar-check me-2"></i>Date d'Arrivée
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background-color: var(--primary-brown, #007bff); color: white; border: none;">
                                                    <i class="fas fa-calendar"></i>
                                                </span>
                                                <input type="date" 
                                                       class="form-control" 
                                                       id="arrival" 
                                                       name="arrival"
                                                       style="border-left: none; border-color: var(--secondary-brown, #6c757d);"
                                                       value="<?php echo e(old('arrival')); ?>">
                                            </div>
                                            <?php $__errorArgs = ['arrival'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger small mt-1 d-block"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="departure" class="form-label fw-semibold" style="color: var(--primary-brown, #007bff);">
                                                <i class="fas fa-calendar-times me-2"></i>Date de Départ
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background-color: var(--primary-brown, #007bff); color: white; border: none;">
                                                    <i class="fas fa-calendar"></i>
                                                </span>
                                                <input type="date" 
                                                       class="form-control" 
                                                       id="departure" 
                                                       name="departure"
                                                       style="border-left: none; border-color: var(--secondary-brown, #6c757d);"
                                                       value="<?php echo e(old('departure')); ?>">
                                            </div>
                                            <?php $__errorArgs = ['departure'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger small mt-1 d-block"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group mb-4">
                                            <label for="room_type" class="form-label fw-semibold" style="color: var(--primary-brown, #007bff);">
                                                <i class="fas fa-bed me-2"></i>Type de Chambre
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background-color: var(--primary-brown, #007bff); color: white; border: none;">
                                                    <i class="fas fa-bed"></i>
                                                </span>
                                                <select class="form-select" 
                                                        id="room_type" 
                                                        name="room_type" 
                                                        style="border-left: none; border-color: var(--secondary-brown, #6c757d);">
                                                    <option value="" selected disabled>Choisir un hébergement</option>
                                                    <option value="bungalow" <?php echo e(old('room_type') == 'bungalow' ? 'selected' : ''); ?>>🏠 Bungalows Majestueux</option>
                                                    <option value="chambre" <?php echo e(old('room_type') == 'chambre' ? 'selected' : ''); ?>>🛏️ Chambre Confort</option>
                                                    <option value="suite" <?php echo e(old('room_type') == 'suite' ? 'selected' : ''); ?>>👑 Suite Présidentielle</option>
                                                </select>
                                            </div>
                                            <?php $__errorArgs = ['room_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger small mt-1 d-block"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Section Message -->
                                    <div class="col-12">
                                        <div class="d-flex align-items-center mb-3 mt-4">
                                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center me-3" 
                                                 style="width: 40px; height: 40px; background-color: var(--primary-brown, #007bff);">
                                                <i class="fas fa-comment text-white"></i>
                                            </div>
                                            <h4 class="mb-0" style="color: var(--primary-brown, #007bff); font-weight: 600;">Message</h4>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group mb-4">
                                            <label for="message" class="form-label fw-semibold" style="color: var(--primary-brown, #007bff);">
                                                <i class="fas fa-comment-dots me-2"></i>Message (optionnel)
                                            </label>
                                            <textarea class="form-control" 
                                                      id="message" 
                                                      name="message" 
                                                      rows="5" 
                                                      placeholder="Dites-nous en plus sur vos besoins ou vos souhaits spéciaux..."
                                                      style="border: 1px solid var(--secondary-brown, #6c757d); resize: vertical;"><?php echo e(old('message')); ?></textarea>
                                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger small mt-1 d-block"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Boutons d'action -->
                                    <div class="col-12">
                                        <div class="row g-3 mt-4">
                                            <div class="col-md-6">
                                                <button type="submit" 
                                                        class="btn btn-lg w-100"
                                                        style="background: linear-gradient(135deg, var(--primary-brown, #007bff) 0%, var(--dark-brown, #343a40) 100%); border: none; color: white; padding: 15px; border-radius: 10px; font-weight: 600; transition: all 0.3s ease;">
                                                    <i class="fas fa-paper-plane me-2"></i>Envoyer la Demande
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" 
                                                        class="btn btn-lg w-100"
                                                        onclick="window.location.href='tel:+2290167836481'"
                                                        style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; color: white; padding: 15px; border-radius: 10px; font-weight: 600; transition: all 0.3s ease;">
                                                    <i class="fas fa-phone me-2"></i>Appeler Maintenant
                                                </button>
                                            </div>
                                        </div>
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
                <h2 style="color: var(--primary-brown, #007bff); font-size: 2.5rem; font-weight: bold;">Questions fréquentes</h2>
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
                                        style="background-color: white; color: var(--primary-brown, #007bff); font-weight: 600; font-size: 1.1rem; border: none; box-shadow: none; padding: 20px;">
                                    <i class="fas fa-clock me-3" style="color: var(--primary-brown, #007bff);"></i>
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
                                        style="background-color: white; color: var(--primary-brown, #007bff); font-weight: 600; font-size: 1.1rem; border: none; box-shadow: none; padding: 20px;">
                                    <i class="fas fa-paw me-3" style="color: var(--primary-brown, #007bff);"></i>
                                    L'hôtel accepte-t-il les animaux de compagnie ?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body" style="background-color: #fafafa; padding: 25px;">
                                    <p style="margin-bottom: 15px; font-size: 1rem;"><strong>Oui, <?php echo e($currentHotel->name ?? 'Morada Lodge'); ?> accepte les animaux de compagnie</strong> (chiens et chats jusqu'à 8kg).</p>
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
                                        style="background-color: white; color: var(--primary-brown, #007bff); font-weight: 600; font-size: 1.1rem; border: none; box-shadow: none; padding: 20px;">
                                    <i class="fas fa-shuttle-van me-3" style="color: var(--primary-brown, #007bff);"></i>
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
                                        style="background-color: white; color: var(--primary-brown, #007bff); font-weight: 600; font-size: 1.1rem; border: none; box-shadow: none; padding: 20px;">
                                    <i class="fas fa-credit-card me-3" style="color: var(--primary-brown, #007bff);"></i>
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
                        <a href="#contactForm" class="btn" style="color: var(--primary-brown, #007bff); border-color: var(--primary-brown, #007bff); background-color: transparent;">
                            <i class="fas fa-envelope me-2"></i>Contactez-nous directement
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
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
    border-color: var(--primary-brown, #007bff);
    box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
}

/* Style pour les input-groups */
.input-group .input-group-text {
    border-radius: 8px 0 0 8px;
}

.input-group .form-control {
    border-radius: 0 8px 8px 0;
}

.input-group .form-select {
    border-radius: 0 8px 8px 0;
}

/* Style pour les cartes de contact */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
}

/* Boutons avec effets hover */
.btn[style*="background: linear-gradient"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

/* Sections du formulaire */
.form-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    border: 1px solid #e9ecef;
}

/* Labels améliorés */
.form-label.fw-semibold {
    margin-bottom: 8px;
    font-size: 0.95rem;
}

/* Champs de formulaire améliorés */
.form-control,
.form-select {
    padding: 12px 15px;
    font-size: 0.95rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control:focus,
.form-select:focus {
    padding: 12px 15px;
    border-color: var(--primary-brown, #007bff);
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
}

/* Textarea améliorée */
textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

/* Alertes */
.alert {
    border-radius: 10px;
    border: none;
}

.alert-success {
    background-color: var(--light-brown, #f8f9fa);
    color: var(--primary-brown, #007bff);
    border-left: 4px solid var(--primary-brown, #007bff);
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
    
    .card-body {
        padding: 30px 20px !important;
    }
    
    .btn-lg {
        padding: 12px 20px;
        font-size: 0.95rem;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
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
                input.style.borderColor = 'var(--secondary-brown, #6c757d)';
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Majorelle V\Documents\MoradaManagement\resources\views/frontend/pages/contact.blade.php ENDPATH**/ ?>