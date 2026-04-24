<?php

// Script pour déboguer la transaction et comprendre pourquoi customer est null

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

echo "🔍 Débogage de la transaction ID 13\n\n";

// Récupérer la transaction
$transaction = \App\Models\Transaction::find(13);

if (!$transaction) {
    echo "❌ Transaction ID 13 non trouvée\n";
    exit;
}

echo "✅ Transaction trouvée\n";
echo "📋 Informations de la transaction :\n";
echo "   ID: " . $transaction->id . "\n";
echo "   Customer ID: " . $transaction->customer_id . "\n";
echo "   Room ID: " . $transaction->room_id . "\n";
echo "   User ID: " . $transaction->user_id . "\n";
echo "   Tenant ID: " . $transaction->tenant_id . "\n";
echo "   Status: " . $transaction->status . "\n";
echo "   Total Price: " . $transaction->total_price . "\n";
echo "   Check-in: " . $transaction->check_in . "\n";
echo "   Check-out: " . $transaction->check_out . "\n\n";

// Vérifier le customer
echo "🔍 Vérification du customer (ID: " . $transaction->customer_id . ")\n";

$customer = \App\Models\Customer::find($transaction->customer_id);

if (!$customer) {
    echo "❌ Customer ID " . $transaction->customer_id . " non trouvé dans la table customers\n";
    
    // Vérifier si le customer existe dans le tenant
    echo "🔍 Recherche du customer dans le tenant " . $transaction->tenant_id . "\n";
    $customerInTenant = \App\Models\Customer::where('id', $transaction->customer_id)
        ->where('tenant_id', $transaction->tenant_id)
        ->first();
    
    if (!$customerInTenant) {
        echo "❌ Customer non trouvé même dans le tenant\n";
        
        // Lister tous les customers du tenant
        echo "📋 Liste des customers du tenant " . $transaction->tenant_id . " :\n";
        $allCustomers = \App\Models\Customer::where('tenant_id', $transaction->tenant_id)->get();
        if ($allCustomers->count() > 0) {
            foreach ($allCustomers as $c) {
                echo "   - ID: " . $c->id . ", Nom: " . $c->name . ", Email: " . $c->email . "\n";
            }
        } else {
            echo "   Aucun customer trouvé pour ce tenant\n";
        }
    } else {
        echo "✅ Customer trouvé dans le tenant mais problème de relation\n";
        echo "   Nom: " . $customerInTenant->name . "\n";
        echo "   Email: " . $customerInTenant->email . "\n";
    }
} else {
    echo "✅ Customer trouvé\n";
    echo "   Nom: " . $customer->name . "\n";
    echo "   Email: " . $customer->email . "\n";
    echo "   Phone: " . ($customer->phone ?? 'Non défini') . "\n";
    echo "   Tenant ID: " . $customer->tenant_id . "\n";
    
    // Vérifier la relation
    echo "\n🔍 Test de la relation transaction->customer :\n";
    $customerRelation = $transaction->customer;
    if ($customerRelation) {
        echo "✅ Relation fonctionne\n";
        echo "   Nom depuis la relation: " . $customerRelation->name . "\n";
    } else {
        echo "❌ Relation ne fonctionne pas (retourne null)\n";
    }
}

// Vérifier si le problème vient du chargement eager
echo "\n🔍 Test avec eager loading :\n";
$transactionWithCustomer = \App\Models\Transaction::with('customer')->find(13);
if ($transactionWithCustomer && $transactionWithCustomer->customer) {
    echo "✅ Avec eager loading: " . $transactionWithCustomer->customer->name . "\n";
} else {
    echo "❌ Avec eager loading: relation toujours null\n";
}

// Vérifier la base de données directement
echo "\n🔍 Vérification directe en base de données :\n";
try {
    $pdo = \DB::connection()->getPdo();
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ? AND tenant_id = ?");
    $stmt->execute([$transaction->customer_id, $transaction->tenant_id]);
    $dbCustomer = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($dbCustomer) {
        echo "✅ Customer trouvé en base de données:\n";
        echo "   ID: " . $dbCustomer['id'] . "\n";
        echo "   Name: " . $dbCustomer['name'] . "\n";
        echo "   Email: " . $dbCustomer['email'] . "\n";
        echo "   Tenant ID: " . $dbCustomer['tenant_id'] . "\n";
    } else {
        echo "❌ Customer non trouvé en base de données\n";
    }
} catch (Exception $e) {
    echo "❌ Erreur base de données: " . $e->getMessage() . "\n";
}

echo "\n🎯 Conclusion :\n";
echo "Le problème vient probablement du fait que le customer ID " . $transaction->customer_id;
echo " n'existe pas ou n'est pas associé au tenant " . $transaction->tenant_id . "\n";

?>
