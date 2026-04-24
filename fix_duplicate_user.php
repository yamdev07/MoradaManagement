<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Customer;

echo "=== FIX DUPLICATE USER ISSUE ===\n";

try {
    // Vérifier s'il y a des utilisateurs avec le même email
    $duplicateEmails = DB::table('users')
        ->select('email', DB::raw('COUNT(*) as count'))
        ->groupBy('email')
        ->having('count', '>', 1)
        ->get();
    
    if ($duplicateEmails->isEmpty()) {
        echo "Aucun email en double trouvé.\n";
    } else {
        echo "Emails en double trouvés:\n";
        foreach ($duplicateEmails as $duplicate) {
            echo "- {$duplicate->email}: {$duplicate->count} occurrences\n";
            
            // Garder le premier utilisateur, supprimer les autres
            $users = User::where('email', $duplicate->email)->orderBy('id')->get();
            $firstUser = $users->first();
            
            echo "  -> Garder utilisateur ID: {$firstUser->id}\n";
            
            foreach ($users->skip(1) as $userToDelete) {
                echo "  -> Supprimer utilisateur ID: {$userToDelete->id}\n";
                
                // Mettre à jour les clients qui pointent vers cet utilisateur
                Customer::where('user_id', $userToDelete->id)->update(['user_id' => $firstUser->id]);
                
                // Supprimer l'utilisateur
                $userToDelete->delete();
            }
        }
    }
    
    echo "\n=== VERIFICATION ===\n";
    
    // Vérifier l'email spécifique qui causait l'erreur
    $email = 'majorelle@gmail.com';
    $user = User::where('email', $email)->first();
    
    if ($user) {
        echo "Utilisateur trouvé pour {$email}:\n";
        echo "- ID: {$user->id}\n";
        echo "- Name: {$user->name}\n";
        echo "- Role: {$user->role}\n";
    } else {
        echo "Aucun utilisateur trouvé pour {$email}\n";
    }
    
    echo "\n=== TERMINÉ ===\n";
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
}
