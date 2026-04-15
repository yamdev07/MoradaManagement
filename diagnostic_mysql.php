<?php

echo "=== DIAGNOSTIC MYSQL ===\n\n";

// 1. Vérifier les extensions PHP requises
echo "1. Extensions PHP requises:\n";
$required_extensions = ['pdo', 'pdo_mysql', 'mysqli'];
foreach ($required_extensions as $ext) {
    $status = extension_loaded($ext) ? '✅' : '❌';
    echo "   $ext: $status\n";
}

echo "\n2. Configuration Laravel (.env):\n";
$env_file = file_get_contents(__DIR__ . '/.env');
$lines = explode("\n", $env_file);
foreach ($lines as $line) {
    if (strpos($line, 'DB_') === 0) {
        echo "   $line\n";
    }
}

echo "\n3. Test de connexion avec différents paramètres:\n";

// Test 1: Configuration actuelle
echo "   Test 1 - Configuration actuelle:\n";
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=hotelio', 'root', 'aaa');
    echo "   ✅ Connexion réussie avec la configuration actuelle\n";
} catch (PDOException $e) {
    echo "   ❌ Échec: " . $e->getMessage() . "\n";
}

// Test 2: Sans base de données
echo "   Test 2 - Sans base de données:\n";
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', 'aaa');
    echo "   ✅ Connexion réussie sans base de données\n";
} catch (PDOException $e) {
    echo "   ❌ Échec: " . $e->getMessage() . "\n";
}

// Test 3: Host localhost
echo "   Test 3 - Host localhost:\n";
try {
    $pdo = new PDO('mysql:host=localhost;port=3306', 'root', 'aaa');
    echo "   ✅ Connexion réussie avec localhost\n";
} catch (PDOException $e) {
    echo "   ❌ Échec: " . $e->getMessage() . "\n";
}

// Test 4: Port différent
echo "   Test 4 - Port 3307:\n";
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3307', 'root', 'aaa');
    echo "   ✅ Connexion réussie sur port 3307\n";
} catch (PDOException $e) {
    echo "   ❌ Échec: " . $e->getMessage() . "\n";
}

echo "\n4. Ports MySQL courants:\n";
$ports = [3306, 3307, 3308, 3309];
foreach ($ports as $port) {
    $socket = @fsockopen('127.0.0.1', $port, $errno, $errstr, 1);
    if ($socket) {
        echo "   Port $port: ✅ Ouvert\n";
        fclose($socket);
    } else {
        echo "   Port $port: ❌ Fermé ($errno: $errstr)\n";
    }
}

echo "\n=== RECOMMANDATIONS ===\n";
echo "1. Assurez-vous que MySQL est démarré dans XAMPP Control Panel\n";
echo "2. Vérifiez que le port 3306 n'est pas bloqué par un firewall\n";
echo "3. Essayez de redémarrer les services MySQL et Apache dans XAMPP\n";
echo "4. Vérifiez les logs d'erreur MySQL dans C:\\xampp\\mysql\\data\\mysql_error.log\n";

?>
