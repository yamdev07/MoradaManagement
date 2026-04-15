

<?php $__env->startPush('styles'); ?>
<style>
/* SUPPRESSION RADICALE DE TOUT FILTRE VERT - UTILISER COULEURS DU TENANT AVEC OPACITÉ 30% */
.hero-section {
    background: linear-gradient(var(--primary-brown, rgba(60, 87, 114, 0.30)), var(--secondary-brown, rgba(52, 152, 219, 0.30))), url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') !important;
    background-color: transparent !important;
    background-image: linear-gradient(var(--primary-brown, rgba(60, 87, 114, 0.30)), var(--secondary-brown, rgba(52, 152, 219, 0.30))), url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') !important;
}

/* Forcer la suppression de tout fond vert */
.hero-section,
.hero-section * {
    background-color: transparent !important;
    background: none !important;
    background-image: none !important;
}

/* Forcer l'image de fond avec couleurs du tenant et opacité 30% */
body .hero-section {
    background: linear-gradient(var(--primary-brown, rgba(60, 87, 114, 0.30)), var(--secondary-brown, rgba(52, 152, 219, 0.30))), url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') !important;
    background-color: transparent !important;
    background-image: linear-gradient(var(--primary-brown, rgba(60, 87, 114, 0.30)), var(--secondary-brown, rgba(52, 152, 219, 0.30))), url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') !important;
}

/* Utiliser les couleurs du tenant, pas de vert */
.hero-section {
    --accent-gold: var(--primary-brown, #3c5772) !important;
    --primary-brown: var(--primary-brown, #3c5772) !important;
    --secondary-brown: var(--secondary-brown, #3498db) !important;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// SUPPRESSION RADICALE DE TOUT FILTRE VERT - TOUS TENANTS
document.addEventListener('DOMContentLoaded', function() {
    // Forcer la suppression de tout fond vert sur la hero section
    var heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        // Utiliser les variables CSS du tenant
        var primaryColor = getComputedStyle(heroSection).getPropertyValue('--primary-brown') || '#007bff';
        var secondaryColor = getComputedStyle(heroSection).getPropertyValue('--secondary-brown') || '#6c757d';
        
        // Forcer les variables CSS avec les couleurs du tenant
        heroSection.style.setProperty('--accent-gold', primaryColor, 'important');
        heroSection.style.setProperty('--primary-brown', primaryColor, 'important');
        heroSection.style.setProperty('--secondary-brown', secondaryColor, 'important');
    }
    
    // Boucle agressive pour forcer l'image toutes les 10ms
    setInterval(function() {
        var heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            // Récupérer les couleurs du tenant
            var primaryColor = getComputedStyle(heroSection).getPropertyValue('--primary-brown') || '#007bff';
            var secondaryColor = getComputedStyle(heroSection).getPropertyValue('--secondary-brown') || '#6c757d';
            
            // Convertir les couleurs du tenant en rgba avec opacité réduite
            var primaryColorRgba = hexToRgba(primaryColor, 0.30);
            var secondaryColorRgba = hexToRgba(secondaryColor, 0.30);
            
            // Forcer l'image avec les couleurs du tenant et opacité réduite
            heroSection.style.setProperty('background', `linear-gradient(${primaryColorRgba}, ${secondaryColorRgba}), url(https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80)`, 'important');
            heroSection.style.setProperty('background-color', 'transparent', 'important');
            heroSection.style.setProperty('background-image', `linear-gradient(${primaryColorRgba}, ${secondaryColorRgba}), url(https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80)`, 'important');
            
            // Supprimer tout style vert potentiel
            var computedStyle = window.getComputedStyle(heroSection);
            var bgImage = computedStyle.backgroundImage;
            if (bgImage && bgImage.includes('rgba(40, 167, 69')) {
                heroSection.style.setProperty('background-image', `linear-gradient(${primaryColorRgba}, ${secondaryColorRgba}), url(https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80)`, 'important');
            }
        }
    }, 10);
    
    // Supprimer les styles inline verts
    setTimeout(function() {
        var allElements = document.querySelectorAll('*');
        allElements.forEach(function(element) {
            var style = element.getAttribute('style');
            if (style && (style.includes('rgba(40, 167, 69') || style.includes('#28a745') || style.includes('green'))) {
                // Supprimer les styles verts
                element.style.removeProperty('background-color');
                element.style.removeProperty('background');
                element.style.removeProperty('background-image');
            }
        });
    }, 100);
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'Gastronomie - ' . ($currentHotel->name ?? 'Morada Lodge')); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="hero-section" style="background-image: linear-gradient(var(--primary-brown, rgba(60, 87, 114, 0.30)), var(--secondary-brown, rgba(52, 152, 219, 0.30))), url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 mb-4">Gastronomie</h1>
                    <p class="lead mb-4" style="font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 400; font-style: italic; color: #f8f9fa; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Saveurs d'Afrique & du Monde</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Présentation -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="mb-4" style="font-family: Arial, sans-serif; font-weight: normal; color: black; font-size: 1.6rem;">Notre restaurant vous invite à un voyage culinaire exceptionnel sous une majestueuse paillote face à la piscine. Découvrez nos spécialités locales revisitées et notre cuisine internationale raffinée.</h2>
                    
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div style="width: 45px; height: 45px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-leaf fa-lg" style="color: white;"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black;">Cuisine Locale Authentique</h5>
                                        <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: black;">Amiwo, Atassi, MAN au Télibo revisités avec passion</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div style="width: 45px; height: 45px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-glass-martini-alt fa-lg" style="color: white;"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black;">Bar & Cocktails</h5>
                                        <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: black;">Cocktails signature et boissons rafraîchissantes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div style="width: 45px; height: 45px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-drumstick-bite fa-lg" style="color: white;"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black;">Grillades & Fruits de Mer</h5>
                                        <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: black;">Brochettes, poissons braisés, gambas sautées</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div style="width: 45px; height: 45px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-clock fa-lg" style="color: white;"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black;">Service Continu</h5>
                                        <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: black;">Ouvert de 7h à 23h tous les jours</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="#menu" class="btn" style="display: none;">
                                Voir le menu
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <?php if(request()->get('hotel_id') == 3 || (isset($currentHotel) && $currentHotel->id == 3)): ?>
                    <!-- Image spéciale pour Hotel Paradise -->
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Restaurant Hotel Paradise" 
                         class="img-fluid rounded shadow">
                    <?php else: ?>
                    <!-- Image par défaut -->
                    <img src="<?php echo e(asset('img/room/Photo11.jpeg')); ?>" 
                         alt="Notre restaurant" 
                         class="img-fluid rounded shadow">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Carte du Restaurant -->
    <section class="py-5" style="background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <!-- Carte principale -->
                    <div class="card border-0 shadow-xl" style="border-radius: 20px; overflow: hidden; background: white;">
                        
                        <!-- En-tête simple -->
                        <div class="text-center p-4" style="background: linear-gradient(135deg, #007bff 0%, #A0522D 100%); color: white;">
                            <h1 class="mb-0" style="font-family: Arial, sans-serif; font-weight: bold; font-size: 2rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                                <i class="fas fa-utensils me-3"></i>MENU
                            </h1>
                        </div>

                        <div class="card-body p-0">
                            
                            <!-- Mets Africains -->
                            <div class="p-4" style="border-bottom: 1px solid #f0f0f0;">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="me-3">
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-leaf" style="color: white;"></i>
                                        </div>
                                    </div>
                                    <h3 class="mb-0" style="font-family: Arial, sans-serif; font-weight: bold; color: #007bff; font-size: 1.4rem;">Mets Africains</h3>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">Amiwo au poulet</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Plat traditionnel à base de maïs avec poulet</p>
                                            </div>
                                            <span class="badge" style="background-color: #007bff; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">5.000 FCFA</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">Atassi avec Dja</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Riz parfumé accompagné de sauce tomate</p>
                                            </div>
                                            <span class="badge" style="background-color: #007bff; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">3.500 FCFA</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">Bomiwo au poulet</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Spécialité à base de pâte de maïs et poulet</p>
                                            </div>
                                            <span class="badge" style="background-color: #007bff; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">5.500 FCFA</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">MAN au Télibo</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Plat signature du chef avec poisson fumé</p>
                                            </div>
                                            <span class="badge" style="background-color: #007bff; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">6.000 FCFA</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Spécialités Européennes -->
                            <div class="p-4" style="border-bottom: 1px solid #f0f0f0;">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="me-3">
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-hamburger" style="color: white;"></i>
                                        </div>
                                    </div>
                                    <h3 class="mb-0" style="font-family: Arial, sans-serif; font-weight: bold; color: #007bff; font-size: 1.4rem;">Spécialités Européennes</h3>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">Spaghettis bolognaise</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Pâtes italiennes avec sauce à la viande maison</p>
                                            </div>
                                            <span class="badge" style="background-color: #007bff; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">2.500 FCFA</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">Steak de bœuf</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Entrecôte grillée, frites et sauce au choix</p>
                                            </div>
                                            <span class="badge" style="background-color: #007bff; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">4.500 FCFA</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Grillades & Fruits de Mer -->
                            <div class="p-4" style="border-bottom: 1px solid #f0f0f0;">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="me-3">
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-drumstick-bite" style="color: white;"></i>
                                        </div>
                                    </div>
                                    <h3 class="mb-0" style="font-family: Arial, sans-serif; font-weight: bold; color: #007bff; font-size: 1.4rem;">Grillades & Fruits de Mer</h3>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">Brochette de bœuf</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Brochettes marinées avec légumes grillés</p>
                                            </div>
                                            <span class="badge" style="background-color: #007bff; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">4.000 FCFA</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">Brochette de poisson</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Brochettes de poisson frais et épices</p>
                                            </div>
                                            <span class="badge" style="background-color: #007bff; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">4.500 FCFA</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">Poisson braisé</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Poisson entier grillé au feu de bois</p>
                                            </div>
                                            <span class="badge" style="background-color: #007bff; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">4.500 FCFA</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">Gambas sautées à l'ail</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Crevettes géantes sautées à l'ail et persil</p>
                                            </div>
                                            <span class="badge" style="background-color: #007bff; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">12.000 FCFA</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Restauration Rapide -->
                            <div class="p-4" style="border-bottom: 1px solid #f0f0f0;">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="me-3">
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-clock" style="color: white;"></i>
                                        </div>
                                    </div>
                                    <h3 class="mb-0" style="font-family: Arial, sans-serif; font-weight: bold; color: #007bff; font-size: 1.4rem;">Restauration Rapide</h3>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">Shawarma (poulet ou viande)</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Wrap garni de viande, légumes et sauce</p>
                                            </div>
                                            <span class="badge" style="background-color: #007bff; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">2.000 FCFA</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">Burgers variés</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Selon l'inspiration du chef - demandez-nous</p>
                                            </div>
                                            <span class="badge" style="background-color: #6c757d; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">Sur commande</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex justify-content-between align-items-start p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                            <div>
                                                <h5 class="mb-1" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">Frites au poulet</h5>
                                                <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.9rem;">Frites croustillantes avec poulet pané</p>
                                            </div>
                                            <span class="badge" style="background-color: #007bff; color: white; padding: 8px 12px; border-radius: 20px; font-weight: bold;">2.500 FCFA</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Salades Fraîches -->
                            <div class="p-4" style="border-bottom: 1px solid #f0f0f0;">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="me-3">
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-leaf" style="color: white;"></i>
                                        </div>
                                    </div>
                                    <h3 class="mb-0" style="font-family: Arial, sans-serif; font-weight: bold; color: #007bff; font-size: 1.4rem;">Salades Fraîches</h3>
                                </div>
                                <div class="p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                    <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.95rem;">Salades composées accompagnées de sauces maison — prix selon la carte du jour</p>
                                </div>
                            </div>

                            <!-- Bar & Cocktails -->
                            <div class="p-4" style="border-bottom: 1px solid #f0f0f0;">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="me-3">
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-glass-martini-alt" style="color: white;"></i>
                                        </div>
                                    </div>
                                    <h3 class="mb-0" style="font-family: Arial, sans-serif; font-weight: bold; color: #007bff; font-size: 1.4rem;">Bar & Cocktails</h3>
                                </div>
                                <div class="p-3" style="background-color: #fafafa; border-radius: 10px; border-left: 4px solid #007bff;">
                                    <p class="mb-3" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.95rem;">Un large choix de boissons rafraîchissantes et cocktails originaux pour accompagner vos repas ou vos moments de détente.</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-2" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">
                                                <i class="fas fa-wine-glass me-2" style="color: #007bff;"></i>Vins sélectionnés
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-2" style="font-family: Arial, sans-serif; font-weight: bold; color: black; font-size: 1rem;">
                                                <i class="fas fa-cocktail me-2" style="color: #007bff;"></i>Cocktails maison
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ambiance Festive -->
                            <div class="p-4" style="border-bottom: 1px solid #f0f0f0;">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="me-3">
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #007bff; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-music" style="color: white;"></i>
                                        </div>
                                    </div>
                                    <h3 class="mb-0" style="font-family: Arial, sans-serif; font-weight: bold; color: #007bff; font-size: 1.4rem;">Ambiance Festive</h3>
                                </div>
                                    <p class="mb-0" style="font-family: Arial, sans-serif; font-weight: normal; color: #666; font-size: 0.95rem;">Profitez d'un barbecue ou d'un chili entre amis autour de la piscine, dans une ambiance conviviale et musicale.</p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('scripts'); ?>
    <script>
    $(document).ready(function() {
        // Filtrage des menus
        $('.category-filter').click(function() {
            $('.category-filter').removeClass('active');
            $(this).addClass('active');
            
            const category = $(this).data('category');
            
            if (category === 'all') {
                $('.menu-item').show();
            } else {
                $('.menu-item').hide();
                $(`.menu-item[data-category="${category}"]`).show();
            }
        });
    });
    </script>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('styles'); ?>
    <?php if(request()->get('hotel_id') == 3 || (isset($currentHotel) && $currentHotel->id == 3)): ?>
    <style>
        /* Menu en vert pour Hotel Paradise */
        .py-5[style*="background: linear-gradient"] {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%) !important;
        }
        
        .card.border-0.shadow-xl {
            border: 2px solid rgba(0, 123, 255, 0.1) !important;
            box-shadow: 0 20px 40px rgba(0, 123, 255, 0.15) !important;
        }
        
        .card.border-0.shadow-xl .text-center.p-4 {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
            color: white !important;
        }
        
        .card.border-0.shadow-xl .text-center.p-4 h1 {
            color: white !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3) !important;
        }
        
        .card.border-0.shadow-xl .text-center.p-4 h1 i {
            color: white !important;
        }
        
        /* Sections du menu */
        .p-4[style*="border-bottom: 1px solid #f0f0f0"] {
            border-bottom: 2px solid rgba(0, 123, 255, 0.2) !important;
        }
        
        .p-4[style*="border-bottom: 1px solid #f0f0f0"] .d-flex.align-items-center.mb-4 h3 {
            color: #007bff !important;
            font-weight: bold !important;
        }
        
        /* Icônes des sections */
        .p-4[style*="border-bottom: 1px solid #f0f0f0"] .d-flex.align-items-center.mb-4 div.me-3 div {
            background: linear-gradient(135deg, #007bff, #0056b3) !important;
            border: 2px solid rgba(0, 123, 255, 0.3) !important;
        }
        
        .p-4[style*="border-bottom: 1px solid #f0f0f0"] .d-flex.align-items-center.mb-4 div.me-3 div i {
            color: white !important;
        }
        
        /* Items du menu */
        .d-flex.justify-content-between.align-items-start.p-3[style*="background-color: #fafafa"] {
            background-color: rgba(255, 255, 255, 0.95) !important;
            border-left: 4px solid #007bff !important;
            border-radius: 10px !important;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.1) !important;
        }
        
        .d-flex.justify-content-between.align-items-start.p-3[style*="background-color: #fafafa"] h5 {
            color: #0056b3 !important;
            font-weight: bold !important;
        }
        
        .d-flex.justify-content-between.align-items-start.p-3[style*="background-color: #fafafa"] p {
            color: #666 !important;
        }
        
        /* Badges de prix */
        .badge[style*="background-color: #007bff"] {
            background-color: #007bff !important;
            color: white !important;
            border: 1px solid rgba(0, 123, 255, 0.3) !important;
        }
        
        .badge[style*="background-color: #6c757d"] {
            background-color: #0056b3 !important;
            color: white !important;
            border: 1px solid rgba(0, 123, 255, 0.3) !important;
        }
        
        /* Section des salades */
        .p-3[style*="background-color: #fafafa"] {
            background-color: rgba(255, 255, 255, 0.95) !important;
            border-left: 4px solid #007bff !important;
            border-radius: 10px !important;
        }
        
        .p-3[style*="background-color: #fafafa"] p {
            color: #666 !important;
        }
        
        /* Section Bar & Cocktails */
        .p-3[style*="background-color: #fafafa"] .row .col-md-6 p {
            color: #666 !important;
        }
        
        .p-3[style*="background-color: #fafafa"] .row .col-md-6 p i {
            color: #007bff !important;
        }
        
        /* Section Ambiance Festive */
        .p-4[style*="border-bottom: 1px solid #f0f0f0"]:last-child {
            border-bottom: 2px solid rgba(0, 123, 255, 0.2) !important;
        }
        
        .p-4[style*="border-bottom: 1px solid #f0f0f0"]:last-child .d-flex.align-items-center.mb-4 h3 {
            color: #007bff !important;
        }
        
        .p-4[style*="border-bottom: 1px solid #f0f0f0"]:last-child .d-flex.align-items-center.mb-4 div.me-3 div {
            background: linear-gradient(135deg, #007bff, #0056b3) !important;
        }
        
        .p-4[style*="border-bottom: 1px solid #f0f0f0"]:last-child .d-flex.align-items-center.mb-4 div.me-3 div i {
            color: white !important;
        }
        
        .p-4[style*="border-bottom: 1px solid #f0f0f0"]:last-child p.mb-0 {
            color: #666 !important;
        }
        
        /* Icônes de la section présentation */
        div[style*="background-color: #007bff"] {
            background: linear-gradient(135deg, #007bff, #0056b3) !important;
            border: 2px solid rgba(0, 123, 255, 0.3) !important;
        }
        
        div[style*="background-color: #007bff"] i {
            color: white !important;
        }
        
        /* Titres de la présentation */
        h5[style*="color: black"] {
            color: #0056b3 !important;
        }
        
        p[style*="color: black"] {
            color: #666 !important;
        }
    </style>
    <?php endif; ?>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Majorelle V\Documents\MoradaManagement\resources\views/frontend/pages/restaurant.blade.php ENDPATH**/ ?>