

<?php $__env->startSection('title', 'Nos Suites de Prestige - Morada Lodge'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section pour les chambres -->
    <section class="hero-section-rooms">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 mb-4">Nos Suites de Prestige</h1>
                    <p class="lead mb-4">Chaque hébergement est conçu comme un havre de paix, alliant confort moderne et charme authentique africain</p>
                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <span class="badge" style="background-color: var(--primary-brown); color: white; border-radius: 20px; padding: 8px 12px;">
                            <i class="fas fa-bed me-1"></i>20 Chambres
                        </span>
                        <span class="badge bg-info">
                            <i class="fas fa-check-circle me-1"></i>20 Disponibles
                        </span>
                        <span class="badge bg-warning">
                            <i class="fas fa-star me-1"></i>15 Types
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section de filtres -->
    <section class="py-4" style="background-color: var(--warm-beige);">
        <div class="container">
            <form action="<?php echo e(route('frontend.rooms')); ?>" method="GET" id="filterForm">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="type" class="form-label" style="color: var(--primary-brown); font-weight: 500;">
                                <i class="fas fa-filter me-2"></i>Type de chambre
                            </label>
                            <select class="form-select" id="type" name="type" style="border: 1px solid var(--secondary-brown);">
                                <option value="">Tous les types</option>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($type->id); ?>" <?php echo e(request('type') == $type->id ? 'selected' : ''); ?>>
                                        <?php echo e($type->name); ?> (<?php echo e($type->rooms_count ?? 0); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="capacity" class="form-label" style="color: var(--primary-brown); font-weight: 500;">
                                <i class="fas fa-users me-2"></i>Capacité
                            </label>
                            <select class="form-select" id="capacity" name="capacity" style="border: 1px solid var(--secondary-brown);">
                                <option value="">Toute capacité</option>
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <?php $count = $roomsByCapacity[$i] ?? 0; ?>
                                    <option value="<?php echo e($i); ?>" <?php echo e(request('capacity') == $i ? 'selected' : ''); ?>>
                                        <?php echo e($i); ?> personne<?php echo e($i > 1 ? 's' : ''); ?> (<?php echo e($count); ?>)
                                    </option>
                                <?php endfor; ?>
                                <option value="6" <?php echo e(request('capacity') == 6 ? 'selected' : ''); ?>>6+ personnes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="price_range" class="form-label" style="color: var(--primary-brown); font-weight: 500;">
                                <i class="fas fa-money-bill me-2"></i>Budget/nuit (FCFA)
                            </label>
                            <select class="form-select" id="price_range" name="price_range" style="border: 1px solid var(--secondary-brown);">
                                <option value="">Tous les prix</option>
                                <option value="0-50000" <?php echo e(request('price_range') == '0-50000' ? 'selected' : ''); ?>>
                                    < 50 000 FCFA (<?php echo e($priceRanges['0-50000'] ?? 0); ?>)
                                </option>
                                <option value="50000-100000" <?php echo e(request('price_range') == '50000-100000' ? 'selected' : ''); ?>>
                                    50k - 100k FCFA (<?php echo e($priceRanges['50000-100000'] ?? 0); ?>)
                                </option>
                                <option value="100000-150000" <?php echo e(request('price_range') == '100000-150000' ? 'selected' : ''); ?>>
                                    100k - 150k FCFA (<?php echo e($priceRanges['100000-150000'] ?? 0); ?>)
                                </option>
                                <option value="150000-200000" <?php echo e(request('price_range') == '150000-200000' ? 'selected' : ''); ?>>
                                    150k - 200k FCFA (<?php echo e($priceRanges['150000-200000'] ?? 0); ?>)
                                </option>
                                <option value="200000+" <?php echo e(request('price_range') == '200000+' ? 'selected' : ''); ?>>
                                    > 200k FCFA (<?php echo e($priceRanges['200000+'] ?? 0); ?>)
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 text-lg-end">
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn" style="background-color: var(--primary-brown); border-color: var(--primary-brown); color: white; padding: 10px 20px;">
                                <i class="fas fa-search me-2"></i>Filtrer
                            </button>
                            <a href="<?php echo e(route('frontend.rooms')); ?>" class="btn" style="background-color: #FF9800; border-color: #FF9800; color: white; padding: 10px 20px;">
                                <i class="fas fa-redo me-2"></i>Réinitialiser
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Résultats de recherche -->
    <?php if(request()->hasAny(['type', 'capacity', 'price_range'])): ?>
    <section class="py-3" style="background-color: var(--light-brown);">
        <div class="container">
            <div class="alert" style="background-color: var(--light-brown); color: var(--primary-brown); border-left: 4px solid var(--primary-brown); border-radius: 8px;" d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-filter me-2"></i>
                    <strong><?php echo e($rooms->total()); ?> chambre(s)</strong> correspondant à vos critères
                    <?php if(request('type')): ?> • Type: <?php echo e(\App\Models\Type::find(request('type'))->name ?? ''); ?> <?php endif; ?>
                    <?php if(request('capacity')): ?> • Capacité: <?php echo e(request('capacity')); ?> personne(s) <?php endif; ?>
                    <?php if(request('price_range')): ?> • Budget: <?php echo e(request('price_range')); ?> FCFA <?php endif; ?>
                </div>
                <div>
                    <a href="<?php echo e(route('frontend.rooms')); ?>" class="btn btn-sm" style="color: var(--primary-brown); border-color: var(--primary-brown); background-color: transparent;">
                        <i class="fas fa-times me-1"></i>Effacer filtres
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Liste des chambres -->
    <section class="py-5">
        <div class="container">
            <!-- Tri et vue -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <span class="me-1 text-muted"><i class="fas fa-sort me-1"></i>Trier par:</span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn sort-btn" style="color: var(--primary-brown); border-color: var(--primary-brown); background-color: white;" data-sort="price_asc">Prix ↑</button>
                            <button type="button" class="btn sort-btn" style="color: var(--primary-brown); border-color: var(--primary-brown); background-color: white;" data-sort="price_desc">Prix ↓</button>
                            <button type="button" class="btn sort-btn" style="color: var(--primary-brown); border-color: var(--primary-brown); background-color: white;" data-sort="name_asc">Nom A-Z</button>
                            <button type="button" class="btn sort-btn" style="color: var(--primary-brown); border-color: var(--primary-brown); background-color: white;" data-sort="capacity_desc">Capacité</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn view-btn active" style="color: var(--primary-brown); border-color: var(--primary-brown); background-color: var(--primary-brown); color: white;" data-view="grid">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button type="button" class="btn view-btn" style="color: var(--primary-brown); border-color: var(--primary-brown); background-color: white;" data-view="list">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Grille / Liste -->
            <div id="rooms-grid" class="row g-4">
                <!-- Bungalows Majestueux -->
                <div class="col-lg-4 col-md-6 room-item" data-aos="fade-up" data-aos-delay="0">
                    <div class="room-card-modern">
                        <div class="room-image-wrapper">
                            <img src="<?php echo e(asset('img/room/buglow.jpg')); ?>" 
                                 alt="Bungalows Majestueux"
                                 class="room-image">
                            <div class="room-status">
                                <span class="status-badge premium">
                                    <i class="fas fa-crown"></i> Premium
                                </span>
                            </div>
                            <button class="wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        
                        <div class="room-details">
                            <div class="room-header">
                                <div>
                                    <h3 class="room-name">Bungalows Majestueux</h3>
                                    <p class="room-type">Authenticité et Sérénité</p>
                                </div>
                                <span class="capacity-badge">
                                    <i class="fas fa-user"></i> 2-4
                                </span>
                            </div>
                            
                            <p class="room-description">
                                Authenticité et sérénité dans des hébergements traditionnels réinventés avec tout le confort moderne.
                            </p>
                            
                            <div class="room-specs">
                                <div class="spec-item">
                                    <i class="fas fa-tree"></i>
                                    <span>Terrasse privée avec vue jardin</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-snowflake"></i>
                                    <span>Climatisation et ventilateur</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-bath"></i>
                                    <span>Salle de bain privée luxueuse</span>
                                </div>
                            </div>
                            
                            <div class="room-footer">
                                <div class="price-info">
                                    <span class="price">125 000</span>
                                    <span class="price-label">FCFA/nuit</span>
                                </div>
                                <a href="<?php echo e(route('frontend.contact')); ?>?room=Bungalows" class="btn-view">
                                    Réserver
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chambre Confort -->
                <div class="col-lg-4 col-md-6 room-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="room-card-modern">
                        <div class="room-image-wrapper">
                            <img src="<?php echo e(asset('img/room/lit.jpg')); ?>" 
                                 alt="Chambre Confort"
                                 class="room-image">
                            <div class="room-status">
                                <span class="status-badge classic">
                                    <i class="fas fa-star"></i> Classic
                                </span>
                            </div>
                            <button class="wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        
                        <div class="room-details">
                            <div class="room-header">
                                <div>
                                    <h3 class="room-name">Chambre Confort</h3>
                                    <p class="room-type">Élégance et Pratique</p>
                                </div>
                                <span class="capacity-badge">
                                    <i class="fas fa-user"></i> 1-2
                                </span>
                            </div>
                            
                            <p class="room-description">
                                Élégantes et pratiques, parfaites pour un séjour alliant simplicité et raffinement à prix accessible.
                            </p>
                            
                            <div class="room-specs">
                                <div class="spec-item">
                                    <i class="fas fa-bed"></i>
                                    <span>Lit queen size confortable</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-wifi"></i>
                                    <span>Wi-Fi haut débit gratuit</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-tv"></i>
                                    <span>Minibar et télévision HD</span>
                                </div>
                            </div>
                            
                            <div class="room-footer">
                                <div class="price-info">
                                    <span class="price">20 000</span>
                                    <span class="price-label">FCFA/nuit</span>
                                </div>
                                <a href="<?php echo e(route('frontend.contact')); ?>?room=Confort" class="btn-view">
                                    Réserver
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Suite Présidentielle -->
                <div class="col-lg-4 col-md-6 room-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="room-card-modern">
                        <div class="room-image-wrapper">
                            <img src="<?php echo e(asset('img/room/suite.jpg')); ?>" 
                                 alt="Suite Présidentielle"
                                 class="room-image">
                            <div class="room-status">
                                <span class="status-badge prestige">
                                    <i class="fas fa-gem"></i> Prestige
                                </span>
                            </div>
                            <button class="wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        
                        <div class="room-details">
                            <div class="room-header">
                                <div>
                                    <h3 class="room-name">Suite Présidentielle</h3>
                                    <p class="room-type">Prestige et Luxe</p>
                                </div>
                                <span class="capacity-badge">
                                    <i class="fas fa-user"></i> 2-4
                                </span>
                            </div>
                            
                            <p class="room-description">
                                L'expérience ultime du luxe avec vue panoramique, service personnalisé et prestations d'exception.
                            </p>
                            
                            <div class="room-specs">
                                <div class="spec-item">
                                    <i class="fas fa-door-open"></i>
                                    <span>Suite 2 pièces avec salon privé</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-mountain"></i>
                                    <span>Balcon avec vue panoramique</span>
                                </div>
                                <div class="spec-item">
                                    <i class="fas fa-concierge-bell"></i>
                                    <span>Service de conciergerie 24h/24</span>
                                </div>
                            </div>
                            
                            <div class="room-footer">
                                <div class="price-info">
                                    <span class="price">250 000</span>
                                    <span class="price-label">FCFA/nuit</span>
                                </div>
                                <a href="<?php echo e(route('frontend.contact')); ?>?room=Presidentielle" class="btn-view">
                                    Réserver
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Les autres chambres dynamiques restent ici -->
                <?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if($loop->index >= 3): ?>
                <div class="col-lg-4 col-md-6 room-item"
                     data-price="<?php echo e($room->price); ?>"
                     data-name="<?php echo e(strtolower($room->name)); ?>"
                     data-capacity="<?php echo e($room->capacity); ?>">
                    <div class="card room-card h-100 border-0 shadow-sm" style="border-top: 4px solid var(--primary-brown);">
                        
                        <!-- Badge statut -->
                        <div class="room-status-badge" style="position: absolute; top: 15px; right: 15px; z-index: 1;">
                            <?php if($room->is_available_today): ?>
                                <span class="badge" style="padding: 6px 12px; font-weight: 600; background-color: var(--primary-brown); color: white; border-radius: 20px;">
                                    <i class="fas fa-check-circle me-1"></i>Disponible
                                </span>
                            <?php else: ?>
                                <span class="badge" style="padding: 6px 12px; font-weight: 600; background-color: var(--secondary-brown); color: white; border-radius: 20px;">
                                    <i class="fas fa-clock me-1"></i>Sur demande
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Favoris -->
                        <div class="room-favorite" style="position: absolute; top: 15px; left: 15px; z-index: 1;">
                            <button class="favorite-btn" data-room-id="<?php echo e($room->id); ?>" tabindex="-1" style="background: rgba(255,255,255,0.9); border: 2px solid var(--primary-brown); color: var(--primary-brown); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>

                        <!-- Image -->
                        <div class="room-image-container" style="height: 250px; overflow: hidden;">
                            <?php
                                // Images de haute qualité pour les chambres
                                $roomImages = [
                                    'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1611892440507-42a662e3ab78?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                    'https://images.unsplash.com/photo-1596394632027-86b0aafe782c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                                ];
                                $imageUrl = $roomImages[$loop->index % 5]; // Utiliser une image différente pour chaque chambre
                                
                                // Alternative: utiliser les images locales si elles existent
                                $localImage = 'img/room/room' . (($loop->index % 3) + 1) . '.jpg';
                                if(file_exists(public_path($localImage))) {
                                    $imageUrl = asset($localImage);
                                }
                            ?>
                            <img src="<?php echo e($imageUrl); ?>"
                                 class="card-img-top room-image"
                                 alt="<?php echo e($room->name); ?>"
                                 onerror="this.onerror=null; this.src='<?php echo e(asset('img/room/gamesetting.png')); ?>';"
                                 style="height: 100%; width: 100%; object-fit: cover; transition: transform 0.5s ease;">
                            <?php if($room->images && $room->images->count() > 1): ?>
                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                <span class="badge bg-dark opacity-75">
                                    <i class="fas fa-images me-1"></i><?php echo e($room->images->count()); ?>

                                </span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Corps -->
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h5 class="card-title mb-1" style="color: var(--primary-brown); font-weight: 600;"><?php echo e($room->name); ?></h5>
                                    <h6 class="text-muted mb-2">
                                        <i class="fas fa-door-closed me-1"></i><?php echo e($room->type->name ?? 'Chambre Standard'); ?>

                                    </h6>
                                </div>
                                <div class="text-end">
                                    <span class="badge" style="background-color: var(--primary-brown); color: white; border-radius: 15px; padding: 4px 8px;">
                                        <i class="fas fa-user-friends me-1"></i><?php echo e($room->capacity); ?>

                                    </span>
                                    <div class="mt-1">
                                        <span class="badge" style="background-color: #2196F3; color: white;">
                                            Chambre <?php echo e($room->number); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>

                            <?php
                                $theme = '';
                                if ($room->view) {
                                    $parts = explode(' - ', $room->view);
                                    if (count($parts) > 1) { $theme = trim($parts[0]); }
                                }
                            ?>

                            <?php if($theme): ?>
                            <div class="room-theme mb-3">
                                <span class="badge" style="background-color: var(--warm-beige); color: var(--primary-brown); font-weight: 500; border: 1px solid var(--secondary-brown);">
                                    <i class="fas fa-leaf me-1"></i><?php echo e($theme); ?>

                                </span>
                            </div>
                            <?php endif; ?>

                            <?php if($room->view): ?>
                            <div class="room-description mb-3">
                                <p class="card-text text-muted mb-1" style="font-size: 0.9rem; line-height: 1.4; min-height: 60px;">
                                    <i class="fas fa-quote-left me-1" style="color: var(--primary-brown);"></i>
                                    <?php echo e(Str::limit($room->view, 80)); ?>

                                </p>
                                <small class="text-muted">
                                    <a href="<?php echo e(route('frontend.room.details', $room->id)); ?>" class="text-decoration-none" style="color: var(--primary-brown);">
                                        Lire la suite <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </small>
                            </div>
                            <?php endif; ?>

                            <!-- Équipements -->
                            <div class="room-equipments mb-3">
                                <h6 class="text-muted mb-2" style="font-size: 0.85rem;">
                                    <i class="fas fa-concierge-bell me-1"></i>Équipements
                                </h6>
                                <div class="d-flex flex-wrap gap-1">
                                    <?php $__currentLoopData = $room->facilities->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-light text-dark border" style="font-size: 0.75rem;">
                                            <i class="fas fa-<?php echo e($facility->icon ?? 'check'); ?> me-1"></i><?php echo e($facility->name); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($room->facilities->count() > 4): ?>
                                        <span class="badge bg-light text-dark border" style="font-size: 0.75rem;">
                                            +<?php echo e($room->facilities->count() - 4); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Détails surface / étage -->
                            <div class="room-details mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-expand-arrows-alt me-1"></i> <?php echo e($room->size ?? '25'); ?> m²
                                        </small>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-building me-1"></i> Étage <?php echo e($room->floor ?? 'RDC'); ?>

                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Prix + boutons — poussés tout en bas -->
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <div>
                                    <span class="h4 mb-0" style="color: var(--primary-brown);">
                                        <?php echo e(number_format($room->price, 0, ',', ' ')); ?> FCFA
                                    </span>
                                    <small class="text-muted d-block">par nuit</small>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('frontend.room.details', $room->id)); ?>"
                                       class="btn btn-sm"
                                       style="background-color: var(--primary-brown); border-color: var(--primary-brown); color: white;">
                                        <i class="fas fa-eye me-1"></i> Détails
                                    </a>
                                    <?php if($room->is_available_today): ?>
                                        <a href="<?php echo e(route('frontend.reservation')); ?>?room_id=<?php echo e($room->id); ?>"
                                           class="btn btn-sm"
                                           style="color: var(--primary-brown); border-color: var(--primary-brown); background-color: transparent;">
                                            <i class="fas fa-calendar-check me-1"></i> Réserver
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if(!$room->is_available_today && $room->next_available_date): ?>
                            <div class="mt-2">
                                <small class="text-warning">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    Disponible à partir du <?php echo e(\Carbon\Carbon::parse($room->next_available_date)->format('d/m/Y')); ?>

                                </small>
                            </div>
                            <?php endif; ?>
                        </div>

                        
                        <div class="card-footer bg-transparent border-top-0 pt-0 room-card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    <?php if($room->room_status_id == 1): ?>
                                        <span style="color: var(--primary-brown);">Prête à accueillir</span>
                                    <?php elseif($room->room_status_id == 3): ?>
                                        <span class="text-warning">En nettoyage</span>
                                    <?php elseif($room->room_status_id == 4): ?>
                                        <span class="text-danger">En maintenance</span>
                                    <?php else: ?>
                                        <span class="text-secondary">Statut: <?php echo e($room->roomStatus->name ?? 'N/A'); ?></span>
                                    <?php endif; ?>
                                </small>
                                <small class="text-muted">
                                    <i class="fas fa-star me-1 text-warning"></i>
                                    <?php echo e($room->average_rating ?? '4.5'); ?>/5
                                </small>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="text-center py-5" style="background-color: var(--light-brown); border-radius: 10px;">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                             style="width: 80px; height: 80px; background-color: var(--secondary-brown);">
                            <i class="fas fa-bed fa-2x" style="color: var(--primary-brown);"></i>
                        </div>
                        <h4 style="color: var(--primary-brown);">Aucune chambre trouvée</h4>
                        <p class="text-muted mb-4">Aucune chambre ne correspond à vos critères de recherche.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="<?php echo e(route('frontend.rooms')); ?>" class="btn" style="background-color: var(--primary-brown); border-color: var(--primary-brown); color: white;">
                                <i class="fas fa-redo me-1"></i> Voir toutes les chambres
                            </a>
                            <a href="<?php echo e(route('frontend.contact')); ?>" class="btn" style="color: var(--primary-brown); border-color: var(--primary-brown); background-color: transparent;">
                                <i class="fas fa-question-circle me-1"></i> Demander conseil
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if($rooms->hasPages()): ?>
            <div class="mt-5 pt-4">
                <nav aria-label="Navigation des chambres" class="d-flex justify-content-center">
                    <?php echo e($rooms->onEachSide(1)->links('vendor.pagination.bootstrap-5')); ?>

                </nav>
            </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* ── RESET FOCUS GLOBAL ── */
*:focus,
*:focus-visible {
    outline: none !important;
    box-shadow: none !important;
    -webkit-tap-highlight-color: transparent !important;
}

/* ── HERO ── */
.hero-section-rooms {
    background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
                url('https://images.unsplash.com/photo-1584132967334-10e028bd69f7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
    background-size: cover;
    background-position: center;
    color: white;
    padding: 150px 0;
}

/* ── CARDS ── */
.room-card {
    transition: all 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
}

.room-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(139,69,19,0.2) !important;
}

.room-card:hover .room-image {
    transform: scale(1.05);
}

.room-image-container {
    position: relative;
    overflow: hidden;
}

/* ── BOUTON FAVORI ── */
.favorite-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: none;
    background-color: rgba(255,255,255,0.9);
    color: #aaa;
    cursor: pointer;
    transition: background-color 0.2s, color 0.2s, transform 0.15s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    outline: none !important;
    -webkit-tap-highlight-color: transparent;
    padding: 0;
    font-size: 0.95rem;
}

.favorite-btn:hover {
    background-color: #FF5252;
    color: white;
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(255,82,82,0.4);
}

.favorite-btn:active,
.favorite-btn:focus,
.favorite-btn:focus-visible {
    outline: none !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15) !important;
}

.favorite-btn.active {
    background-color: #FF5252;
    color: white;
    box-shadow: 0 4px 12px rgba(255,82,82,0.4);
}

/* ── BOUTONS TRI / VUE ── */
.sort-btn.active,
.view-btn.active {
    background-color: var(--primary-brown) !important;
    color: white !important;
}

.form-select:focus {
    border-color: var(--primary-brown) !important;
    box-shadow: 0 0 0 0.2rem rgba(139,69,19,0.25) !important;
    outline: none !important;
}

/* ═════════════════════════════════════
   VUE LISTE — layout horizontal propre
════════════════════════════════════════ */

/* Chaque item prend toute la largeur */
#rooms-grid.view-list .room-item {
    flex: 0 0 100% !important;
    max-width: 100% !important;
    width: 100% !important;
}

/* La carte devient une ligne */
#rooms-grid.view-list .room-card {
    flex-direction: row !important;
    height: auto !important;
    min-height: 200px;
    align-items: stretch;
}

/* Pas de translateY au hover en vue liste */
#rooms-grid.view-list .room-card:hover {
    transform: none !important;
    box-shadow: 0 4px 20px rgba(76,175,80,0.15) !important;
}

/* Image fixe à gauche */
#rooms-grid.view-list .room-image-container {
    flex: 0 0 260px !important;
    width: 260px !important;
    height: auto !important;
    min-height: 200px;
}

/* Corps flex colonne */
#rooms-grid.view-list .card-body {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    padding: 18px 20px;
    overflow: hidden;
}

/* Description courte en liste */
#rooms-grid.view-list .room-description p {
    min-height: unset !important;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

/* Prix + boutons collés en bas */
#rooms-grid.view-list .card-body .mt-auto {
    margin-top: auto !important;
}

/* *** CORRECTION PRINCIPALE ***
   Footer masqué en vue liste → évite la collision
   "Prête à accueillir" / "Disponible" */
#rooms-grid.view-list .room-card-footer {
    display: none !important;
}

/* Badges repositionnés en vue liste */
#rooms-grid.view-list .room-status-badge {
    top: 10px !important;
    right: 10px !important;
}

#rooms-grid.view-list .room-favorite {
    top: 10px !important;
    left: 10px !important;
}

/* ── ANIMATIONS ── */
.room-item {
    animation: fadeInUp 0.5s ease-out both;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

.room-item:nth-child(1) { animation-delay: 0.05s; }
.room-item:nth-child(2) { animation-delay: 0.10s; }
.room-item:nth-child(3) { animation-delay: 0.15s; }
.room-item:nth-child(4) { animation-delay: 0.20s; }
.room-item:nth-child(5) { animation-delay: 0.25s; }
.room-item:nth-child(6) { animation-delay: 0.30s; }

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
    .hero-section-rooms { padding: 100px 0; }
    .hero-section-rooms h1 { font-size: 2.2rem; }

    /* En mobile, repasse en colonne */
    #rooms-grid.view-list .room-card { flex-direction: column !important; }
    #rooms-grid.view-list .room-image-container {
        width: 100% !important;
        height: 200px !important;
    }
}

/* Styles pour les cartes modernes (identiques à la page d'accueil) */
.room-card-modern {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(139, 69, 19, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
}

.room-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 48px rgba(139, 69, 19, 0.16);
}

.room-image-wrapper {
    position: relative;
    height: 280px;
    overflow: hidden;
}

.room-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.room-card-modern:hover .room-image {
    transform: scale(1.08);
}

.room-status {
    position: absolute;
    top: 15px;
    right: 15px;
}

.status-badge.premium {
    color: #8b4513;
    background: rgba(139, 69, 19, 0.1);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    backdrop-filter: blur(10px);
}

.status-badge.classic {
    color: #6b7280;
    background: rgba(107, 114, 128, 0.1);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    backdrop-filter: blur(10px);
}

.status-badge.prestige {
    color: #cd853f;
    background: rgba(205, 133, 63, 0.1);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    backdrop-filter: blur(10px);
}

.wishlist-btn {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.wishlist-btn:hover {
    background: white;
    color: #ef4444;
}

.room-details {
    padding: 25px;
}

.room-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.room-name {
    font-size: 1.3rem;
    font-weight: 600;
    color: #654321;
    margin: 0;
}

.room-type {
    color: #6b7280;
    margin: 5px 0;
}

.capacity-badge {
    background: #f5e6d3;
    color: #8b4513;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.room-description {
    color: #6b7280;
    margin-bottom: 15px;
    line-height: 1.5;
}

.room-specs {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 20px;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6b7280;
    font-size: 0.9rem;
}

.spec-item i {
    color: #8b4513;
    width: 16px;
}

.room-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid #E5E7EB;
}

.price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #8b4513;
}

.price-label {
    color: #6b7280;
    font-size: 0.9rem;
}

.btn-view {
    background: #8b4513;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-view:hover {
    background: #a0522d;
    color: white;
}

@media (max-width: 576px) {
    .card-title { font-size: 1.1rem; }
    .card-text { font-size: 0.85rem; }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // ── Enlever le focus rectangle sur tous les boutons/liens ──
    document.querySelectorAll('button, a').forEach(el => {
        el.addEventListener('mousedown', e => e.preventDefault());
        el.addEventListener('click', function() { this.blur(); });
    });

    // ── Favoris ──
    document.querySelectorAll('.favorite-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const roomId = this.dataset.roomId;
            const icon = this.querySelector('i');

            this.classList.toggle('active');
            if (this.classList.contains('active')) {
                icon.classList.replace('far', 'fas');
                showToast('Chambre ajoutée aux favoris ❤️', 'success');
            } else {
                icon.classList.replace('fas', 'far');
                showToast('Chambre retirée des favoris', 'info');
            }

            let favorites = JSON.parse(localStorage.getItem('room_favorites') || '[]');
            if (this.classList.contains('active')) {
                if (!favorites.includes(roomId)) favorites.push(roomId);
            } else {
                favorites = favorites.filter(id => id !== roomId);
            }
            localStorage.setItem('room_favorites', JSON.stringify(favorites));
            this.blur();
        });
    });

    function restoreFavorites() {
        const favorites = JSON.parse(localStorage.getItem('room_favorites') || '[]');
        document.querySelectorAll('.favorite-btn').forEach(btn => {
            if (favorites.includes(btn.dataset.roomId)) {
                btn.classList.add('active');
                btn.querySelector('i').classList.replace('far', 'fas');
            }
        });
    }

    // ── Auto-submit filtres ──
    document.querySelectorAll('#type, #capacity, #price_range').forEach(select => {
        select.addEventListener('change', () => document.getElementById('filterForm').submit());
    });

    // ── Tri ──
    document.querySelectorAll('.sort-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.sort-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            sortRooms(this.dataset.sort);
        });
    });

    function sortRooms(sortType) {
        const container = document.getElementById('rooms-grid');
        const items = Array.from(container.querySelectorAll('.room-item'));
        items.sort((a, b) => {
            switch(sortType) {
                case 'price_asc':     return +a.dataset.price - +b.dataset.price;
                case 'price_desc':    return +b.dataset.price - +a.dataset.price;
                case 'name_asc':      return a.dataset.name.localeCompare(b.dataset.name);
                case 'capacity_desc': return +b.dataset.capacity - +a.dataset.capacity;
                default: return 0;
            }
        });
        items.forEach(item => container.appendChild(item));
        items.forEach((item, i) => {
            item.style.animationDelay = `${i * 0.05}s`;
            item.classList.remove('room-item');
            void item.offsetWidth;
            item.classList.add('room-item');
        });
    }

    // ── Vue grille / liste ──
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const grid = document.getElementById('rooms-grid');

            if (this.dataset.view === 'list') {
                grid.classList.add('view-list');
                // Passer les colonnes en full-width
                grid.querySelectorAll('.room-item').forEach(item => {
                    item.classList.remove('col-lg-4', 'col-md-6');
                    item.classList.add('col-12');
                });
            } else {
                grid.classList.remove('view-list');
                // Restaurer la grille
                grid.querySelectorAll('.room-item').forEach(item => {
                    item.classList.remove('col-12');
                    item.classList.add('col-lg-4', 'col-md-6');
                });
            }
        });
    });

    /* ── Styles pour les icônes sur les images ── */
    .favorite-btn:hover {
        background: var(--primary-brown) !important;
        color: white !important;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(139, 69, 19, 0.3);
    }

    .favorite-btn.active {
        background: var(--primary-brown) !important;
        color: white !important;
    }

    .favorite-btn.active i {
        color: white !important;
    }

    .room-status-badge .badge {
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    /* Animation subtile pour les badges */
    .room-card:hover .room-status-badge .badge {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 69, 19, 0.2);
    }

    /* Style pour les badges d'images multiples */
    .room-image-container .badge.bg-dark {
        background: rgba(139, 69, 19, 0.8) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Amélioration du hover sur les cartes */
    .room-card:hover {
        box-shadow: 0 12px 32px rgba(139, 69, 19, 0.15) !important;
    }

    /* Animation pour le bouton favoris */
    @keyframes heartBeat {
        0% { transform: scale(1); }
        25% { transform: scale(1.2); }
        50% { transform: scale(1); }
        75% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .favorite-btn:active {
        animation: heartBeat 0.3s ease;
    }

    /* ── Toasts ── */
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-bg-${type} border-0`;
        toast.setAttribute('role', 'alert');
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>`;
        const container = document.getElementById('toastContainer') || createToastContainer();
        container.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();
        toast.addEventListener('hidden.bs.toast', () => toast.remove());
    }

    function createToastContainer() {
        const c = document.createElement('div');
        c.id = 'toastContainer';
        c.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        document.body.appendChild(c);
        return c;
    }

    restoreFavorites();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Majorelle V\Documents\MoradaManagement\resources\views/frontend/pages/rooms.blade.php ENDPATH**/ ?>