<?php

// Chercher où le code crée un User au lieu d'un Customer

echo "🔍 Recherche du bug de création de User\n\n";

try {
    // Rechercher dans tous les fichiers PHP où User::create est appelé
    $directories = [
        'app/Http/Controllers',
        'app/Models',
        'app/Services',
        'app/Listeners',
        'app/Observers',
        'app/Jobs',
        'app/Middleware'
    ];
    
    $userCreationCalls = [];
    
    foreach ($directories as $dir) {
        if (is_dir($dir)) {
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
            
            foreach ($iterator as $file) {
                if ($file->isFile() && $file->getExtension() === 'php') {
                    $content = file_get_contents($file->getPathname());
                    $lines = explode("\n", $content);
                    
                    foreach ($lines as $lineNumber => $line) {
                        // Chercher les appels à User::create
                        if (strpos($line, 'User::create') !== false) {
                            $userCreationCalls[] = [
                                'file' => $file->getPathname(),
                                'line' => $lineNumber + 1,
                                'code' => trim($line)
                            ];
                        }
                        
                        // Chercher les appels à \App\Models\User::create
                        if (strpos($line, '\App\Models\User::create') !== false) {
                            $userCreationCalls[] = [
                                'file' => $file->getPathname(),
                                'line' => $lineNumber + 1,
                                'code' => trim($line)
                            ];
                        }
                    }
                }
            }
        }
    }
    
    if (!empty($userCreationCalls)) {
        echo "🔴 Appels à User::create trouvés:\n";
        foreach ($userCreationCalls as $call) {
            echo "   Fichier: " . $call['file'] . "\n";
            echo "   Ligne: " . $call['line'] . "\n";
            echo "   Code: " . $call['code'] . "\n";
            echo "\n";
        }
    } else {
        echo "✅ Aucun appel direct à User::create trouvé\n";
    }
    
    echo "📋 Recherche des appels indirects:\n";
    
    // Rechercher les patterns qui pourraient créer des users
    $patterns = [
        'new User',
        'User::insert',
        'User::firstOrCreate',
        'User::updateOrCreate',
        'DB::table(\'users\')',
        'DB::table("users")'
    ];
    
    $indirectCalls = [];
    
    foreach ($directories as $dir) {
        if (is_dir($dir)) {
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
            
            foreach ($iterator as $file) {
                if ($file->isFile() && $file->getExtension() === 'php') {
                    $content = file_get_contents($file->getPathname());
                    $lines = explode("\n", $content);
                    
                    foreach ($lines as $lineNumber => $line) {
                        foreach ($patterns as $pattern) {
                            if (strpos($line, $pattern) !== false) {
                                $indirectCalls[] = [
                                    'file' => $file->getPathname(),
                                    'line' => $lineNumber + 1,
                                    'code' => trim($line),
                                    'pattern' => $pattern
                                ];
                            }
                        }
                    }
                }
            }
        }
    }
    
    if (!empty($indirectCalls)) {
        echo "🟡 Appels indirects trouvés:\n";
        foreach ($indirectCalls as $call) {
            echo "   Fichier: " . $call['file'] . "\n";
            echo "   Ligne: " . $call['line'] . "\n";
            echo "   Pattern: " . $call['pattern'] . "\n";
            echo "   Code: " . $call['code'] . "\n";
            echo "\n";
        }
    } else {
        echo "✅ Aucun appel indirect trouvé\n";
    }
    
    echo "📋 Recherche dans les fichiers de réservation:\n";
    
    // Vérifier spécifiquement les fichiers de réservation
    $reservationFiles = [
        'app/Http/Controllers/TransactionRoomReservationController.php',
        'app/Models/Customer.php',
        'app/Http/Controllers/FrontendController.php'
    ];
    
    foreach ($reservationFiles as $file) {
        if (file_exists($file)) {
            echo "   Vérification: " . $file . "\n";
            $content = file_get_contents($file);
            
            if (strpos($content, 'User::create') !== false) {
                echo "   ❌ Contient User::create\n";
            } else {
                echo "   ✅ Pas de User::create\n";
            }
            
            if (strpos($content, 'Customer::create') !== false) {
                echo "   ✅ Contient Customer::create\n";
            } else {
                echo "   ❌ Pas de Customer::create\n";
            }
        }
    }
    
    echo "\n🎯 Conclusion:\n";
    if (!empty($userCreationCalls)) {
        echo "Le bug est dans les appels User::create trouvés ci-dessus.\n";
        echo "Il faut corriger ces appels pour créer des Customers à la place.\n";
    } else {
        echo "Le bug est probablement dans un observer, un événement, ou un middleware.\n";
        echo "Il faut vérifier les événements de modèle et les middlewares.\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

?>
