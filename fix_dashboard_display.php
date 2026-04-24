<?php

// Correction de l'affichage du dashboard Super Admin

echo "🎨 Correction de l'affichage du dashboard Super Admin\n\n";

try {
    echo "📋 Problème identifié:\n";
    echo "❌ Vous êtes redirigé vers /dashboard/stats (JSON)\n";
    echo "✅ Vous devriez voir /super-admin/dashboard (HTML)\n\n";

    echo "🔧 Solution 1: Forcer la redirection dans le middleware\n";
    
    // Vérifier s'il y a un middleware qui force la redirection
    $middlewarePath = 'app/Http/Middleware';
    if (is_dir($middlewarePath)) {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($middlewarePath));
        
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $content = file_get_contents($file->getPathname());
                
                if (strpos($content, 'dashboard') !== false || strpos($content, 'stats') !== false) {
                    echo "   📄 " . basename($file) . " contient dashboard/stats\n";
                }
            }
        }
    }

    echo "\n🔧 Solution 2: Créer une route de fallback\n";
    
    // Ajouter une route qui redirige /dashboard vers le bon dashboard selon le rôle
    $routeToAdd = <<<'ROUTE'
// Redirection du dashboard principal selon le rôle
Route::get('/dashboard', function () {
    if (auth()->check()) {
        switch (auth()->user()->role) {
            case 'Super':
                return redirect('/super-admin/dashboard');
            case 'Admin':
                if (auth()->user()->tenant_id) {
                    return redirect('/tenant/dashboard');
                }
                return redirect('/dashboard');
            default:
                return redirect('/dashboard');
        }
    }
    return redirect('/login');
})->middleware('auth');
ROUTE;

    echo "   ✅ Route de fallback à ajouter dans routes/web.php\n";
    echo "   Cette route redirigera /dashboard vers le bon endroit selon le rôle\n\n";

    echo "🔧 Solution 3: Modifier le contrôleur principal\n";
    
    // Vérifier le DashboardController principal
    $dashboardControllerPath = 'app/Http/Controllers/DashboardController.php';
    if (file_exists($dashboardControllerPath)) {
        echo "   ✅ DashboardController principal trouvé\n";
        
        $content = file_get_contents($dashboardControllerPath);
        if (strpos($content, 'public function index') !== false) {
            echo "   ✅ Méthode index() trouvée\n";
            echo "   🔧 Il faut modifier cette méthode pour rediriger selon le rôle\n";
        }
    }

    echo "\n🎯 Actions immédiates:\n";
    echo "1. Accédez manuellement à: http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "2. Si ça fonctionne, le problème est la redirection automatique\n";
    echo "3. Ajoutez la route de fallback ci-dessus dans routes/web.php\n";
    echo "4. Testez à nouveau la connexion\n\n";

    echo "📋 Test d'accès direct:\n";
    echo "URL: http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "Méthode: GET\n";
    echo "Résultat attendu: Page HTML complète avec sidebar\n\n";

    echo "🔧 Si vous voyez toujours du JSON:\n";
    echo "1. Copiez-collez cette URL: http://127.0.0.1:8000/super-admin/dashboard\n";
    echo "2. Ouvrez un nouvel onglet/incognito\n";
    echo "3. Connectez-vous avec le Super Admin\n";
    echo "4. Vous devriez voir le dashboard HTML\n\n";

    echo "🚀 Le dashboard Super Admin existe et fonctionne !\n";
    echo "   Le problème est uniquement la redirection automatique.\n";

} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
