<?php

// Script pour diagnostiquer les problèmes de la page de réservation

echo "🔍 Diagnostic de la page de réservation\n\n";

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=hotelio', 'root', 'aaa');
    
    echo "📋 Vérification des tenants disponibles...\n";
    
    // Lister tous les tenants actifs
    $stmt = $pdo->query("SELECT id, name, domain, subdomain, theme_settings FROM tenants WHERE is_active = 1 ORDER BY id");
    $tenants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($tenants) > 0) {
        echo "✅ Tenants actifs trouvés :\n";
        foreach ($tenants as $tenant) {
            echo "   - ID: " . $tenant['id'] . "\n";
            echo "     Nom: " . $tenant['name'] . "\n";
            echo "     Domain: " . $tenant['domain'] . "\n";
            echo "     Subdomain: " . $tenant['subdomain'] . "\n";
            
            // Analyser les theme_settings
            if ($tenant['theme_settings']) {
                $themeSettings = json_decode($tenant['theme_settings'], true);
                if ($themeSettings) {
                    echo "     Theme Settings:\n";
                    echo "       Primary Color: " . ($themeSettings['primary_color'] ?? 'Non défini') . "\n";
                    echo "       Secondary Color: " . ($themeSettings['secondary_color'] ?? 'Non défini') . "\n";
                    echo "       Accent Color: " . ($themeSettings['accent_color'] ?? 'Non défini') . "\n";
                } else {
                    echo "     ⚠️  Theme Settings: JSON invalide\n";
                }
            } else {
                echo "     ⚠️  Theme Settings: Non défini\n";
            }
            echo "\n";
        }
    } else {
        echo "❌ Aucun tenant actif trouvé\n";
    }
    
    echo "🔍 Vérification du middleware tenant.theme...\n";
    
    // Vérifier si le middleware SetTenant fonctionne
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM tenants WHERE is_active = 1");
    $activeTenants = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "   Nombre de tenants actifs: " . $activeTenants . "\n";
    
    if ($activeTenants > 0) {
        echo "   ✅ Il y a des tenants actifs disponibles\n";
        echo "   🔧 Le middleware devrait pouvoir définir le tenant actuel\n";
    } else {
        echo "   ❌ Aucun tenant actif disponible\n";
        echo "   🔧 Créez d'abord un tenant actif\n";
    }
    
    echo "\n🎯 Solutions possibles pour le problème de réservation:\n";
    echo "1. Vérifier que le middleware SetTenant fonctionne correctement\n";
    echo "2. S'assurer que currentHotel est bien défini dans le contrôleur\n";
    echo "3. Ajouter des valeurs par défaut pour tenantColors dans la vue\n";
    echo "4. Vérifier que l'utilisateur est bien authentifié avec un tenant\n";
    
    echo "\n🔧 Test des routes de réservation:\n";
    
    // Simuler l'appel à la route de réservation
    $routes = [
        'transaction.reservation.createIdentity' => '/transaction/reservation/createIdentity',
        'transaction.reservation.pickFromCustomer' => '/transaction/reservation/pickFromCustomer',
    ];
    
    foreach ($routes as $name => $path) {
        echo "   - " . $name . ": " . $path . "\n";
    }
    
    echo "\n💡 Recommandation:\n";
    echo "Si le problème persiste, ajoutez ce code au début du contrôleur:\n";
    echo "
\$tenantColors = [
    'primary_color' => '#8b4513',
    'secondary_color' => '#d2b48c', 
    'accent_color' => '#f59e0b'
];
if (session('hotel_id')) {
    \$tenant = \\App\\Models\\Tenant::find(session('hotel_id'));
    if (\$tenant && \$tenant->theme_settings) {
        \$settings = json_decode(\$tenant->theme_settings, true);
        \$tenantColors = array_merge(\$tenantColors, \$settings);
    }
}
";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
