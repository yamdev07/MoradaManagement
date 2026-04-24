<?php
session_start();

// Vérification de la session
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: admin-login.php");
    exit;
}

// Vérification du rôle
if ($_SESSION["user_role"] !== "Super") {
    header("Location: admin-login.php");
    exit;
}

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=hotelio", "root", "aaa");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Statistiques générales
    $stats = [
        "tenants" => $pdo->query("SELECT COUNT(*) as count FROM tenants WHERE is_active = 1")->fetch(PDO::FETCH_ASSOC)["count"],
        "users" => $pdo->query("SELECT COUNT(*) as count FROM users")->fetch(PDO::FETCH_ASSOC)["count"],
        "rooms" => $pdo->query("SELECT COUNT(*) as count FROM rooms")->fetch(PDO::FETCH_ASSOC)["count"],
        "customers" => $pdo->query("SELECT COUNT(*) as count FROM customers")->fetch(PDO::FETCH_ASSOC)["count"],
        "transactions" => $pdo->query("SELECT COUNT(*) as count FROM transactions")->fetch(PDO::FETCH_ASSOC)["count"],
        "revenue" => $pdo->query("SELECT SUM(total_price) as total FROM transactions")->fetch(PDO::FETCH_ASSOC)["total"] ?? 0,
    ];
    
    // Derniers tenants
    $stmt = $pdo->query("SELECT id, name, email, is_active, created_at FROM tenants ORDER BY created_at DESC LIMIT 5");
    $recentTenants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Dernières transactions
    $stmt = $pdo->query("SELECT t.id, t.total_price, t.check_in, t.check_out, c.name as customer_name, r.name as room_name FROM transactions t LEFT JOIN customers c ON t.customer_id = c.id LEFT JOIN rooms r ON t.room_id = r.id ORDER BY t.created_at DESC LIMIT 10");
    $recentTransactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Super Admin - Système PHP Pur</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .header p {
            opacity: 0.9;
            font-size: 1.1rem;
        }
        
        .user-info {
            text-align: right;
        }
        
        .user-info .name {
            font-size: 1.2rem;
            font-weight: bold;
        }
        
        .user-info .email {
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .user-info .role {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 1rem;
            border-radius: 20px;
            display: inline-block;
            margin-top: 0.5rem;
            font-size: 0.9rem;
        }
        
        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.75rem 1.5rem;
            border: 2px solid white;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
        }
        
        .logout-btn:hover {
            background: white;
            color: #667eea;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .success-banner {
            background: #28a745;
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
            font-size: 1.1rem;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        
        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .stat-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #666;
            font-size: 1rem;
            font-weight: 600;
        }
        
        .section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .section h2 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        
        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #666;
        }
        
        .status-active {
            background: #d4edda;
            color: #155724;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        
        .status-inactive {
            background: #f8d7da;
            color: #721c24;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        
        .timestamp {
            text-align: center;
            color: #666;
            font-size: 0.9rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div>
                <h1>🎯 Dashboard Super Admin</h1>
                <p>Système de gestion PHP pur - Fonctionnement optimal</p>
            </div>
            <div class="user-info">
                <div class="name"><?php echo htmlspecialchars($_SESSION["user_name"]); ?></div>
                <div class="email"><?php echo htmlspecialchars($_SESSION["user_email"]); ?></div>
                <div class="role">👑 Super Admin</div>
                <a href="admin-logout.php"><button class="logout-btn">Déconnexion</button></a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="success-banner">
            🎉 SYSTÈME PHP PUR FONCTIONNEL - Super Admin Connecté
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🏨</div>
                <div class="stat-number"><?php echo $stats["tenants"]; ?></div>
                <div class="stat-label">Tenants Actifs</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-number"><?php echo $stats["users"]; ?></div>
                <div class="stat-label">Utilisateurs</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🛏️</div>
                <div class="stat-number"><?php echo $stats["rooms"]; ?></div>
                <div class="stat-label">Chambres</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👤</div>
                <div class="stat-number"><?php echo $stats["customers"]; ?></div>
                <div class="stat-label">Clients</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-number"><?php echo $stats["transactions"]; ?></div>
                <div class="stat-label">Transactions</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-number"><?php echo number_format($stats["revenue"], 0, ",", " "); ?></div>
                <div class="stat-label">Revenu Total (FCFA)</div>
            </div>
        </div>
        
        <div class="section">
            <h2>📊 Derniers Tenants</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th>Date de création</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentTenants as $tenant): ?>
                    <tr>
                        <td><?php echo $tenant["id"]; ?></td>
                        <td><?php echo htmlspecialchars($tenant["name"]); ?></td>
                        <td><?php echo htmlspecialchars($tenant["email"]); ?></td>
                        <td>
                            <?php if ($tenant["is_active"]): ?>
                                <span class="status-active">Actif</span>
                            <?php else: ?>
                                <span class="status-inactive">Inactif</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date("d/m/Y H:i", strtotime($tenant["created_at"])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="section">
            <h2>💳 Dernières Transactions</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Chambre</th>
                        <th>Montant</th>
                        <th>Période</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentTransactions as $transaction): ?>
                    <tr>
                        <td><?php echo $transaction["id"]; ?></td>
                        <td><?php echo htmlspecialchars($transaction["customer_name"] ?? "N/A"); ?></td>
                        <td><?php echo htmlspecialchars($transaction["room_name"] ?? "N/A"); ?></td>
                        <td><?php echo number_format($transaction["total_price"], 0, ",", " "); ?> FCFA</td>
                        <td>
                            <?php 
                            if ($transaction["check_in"] && $transaction["check_out"]) {
                                echo date("d/m/Y", strtotime($transaction["check_in"])) . " - " . date("d/m/Y", strtotime($transaction["check_out"]));
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="timestamp">
            Système PHP pur v1.0 | Dernière mise à jour: <?php echo date("d/m/Y H:i:s"); ?> | Connexion: <?php echo date("d/m/Y H:i:s", $_SESSION["login_time"]); ?>
        </div>
    </div>
</body>
</html>