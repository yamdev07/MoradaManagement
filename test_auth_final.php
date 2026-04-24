<?php
require_once __DIR__ . "/vendor/autoload.php";

$app = require_once __DIR__ . "/bootstrap/app.php";

// Test direct
$credentials = [
    "email" => "admin@moradalodge.com", 
    "password" => "password"
];

$user = \App\Models\User::where("email", $credentials["email"])->first();

if ($user && \Hash::check($credentials["password"], $user->password)) {
    echo "✅ Test Laravel: Authentification réussie\n";
    echo "   User ID: " . $user->id . "\n";
    echo "   Role: " . $user->role . "\n";
    echo "   Email vérifié: " . ($user->email_verified_at ? "Oui" : "Non") . "\n";
    echo "   Actif: " . ($user->is_active ? "Oui" : "Non") . "\n";
    
    // Test de login
    if (\Auth::attempt($credentials)) {
        echo "✅ Test Laravel: Auth::attempt réussi\n";
        $loggedUser = \Auth::user();
        echo "   Utilisateur connecté: " . $loggedUser->name . "\n";
    } else {
        echo "❌ Test Laravel: Auth::attempt échoué\n";
    }
} else {
    echo "❌ Test Laravel: User non trouvé ou mot de passe incorrect\n";
}
?>