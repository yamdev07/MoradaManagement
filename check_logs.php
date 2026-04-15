<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== DERNIERS LOGS LARAVEL ===\n\n";

$logFile = storage_path('logs/laravel.log');
if (file_exists($logFile)) {
    $lines = file($logFile);
    $lastLines = array_slice($lines, -50); // Dernières 50 lignes
    
    foreach ($lastLines as $line) {
        echo trim($line) . "\n";
    }
} else {
    echo "Fichier de logs non trouvé\n";
}

echo "\n=== TEST SIMPLIFIÉ DE CONNEXION ===\n";

// Test direct avec le contrôleur
try {
    $request = new \Illuminate\Http\Request();
    $request->merge([
        'email' => 'admin-3@hotelparadise.com',
        'password' => 'password',
        'hotel_id' => '3'
    ]);
    
    echo "Test avec hotel_id=3\n";
    echo "Email: admin-3@hotelparadise.com\n";
    echo "Password: password\n";
    
    // Simuler la logique du contrôleur
    $user = \App\Models\User::where('email', 'admin-3@hotelparadise.com')
        ->where('tenant_id', 3)
        ->first();
    
    if ($user && \Illuminate\Support\Facades\Hash::check('password', $user->password)) {
        echo "Résultat: SUCCESS - Utilisateur trouvé et mot de passe valide\n";
    } else {
        echo "Résultat: FAILED - Utilisateur non trouvé ou mot de passe invalide\n";
    }
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
}

?>
