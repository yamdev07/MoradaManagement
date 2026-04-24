<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: /direct-login.php");
    exit;
}

// Vérifier si c'est un Super Admin
if ($_SESSION["user_role"] !== "Super") {
    header("Location: /login");
    exit;
}

// Connexion à la base de données pour les statistiques
$pdo = new PDO("mysql:host=127.0.0.1;dbname=hotelio", "root", "aaa");

// Statistiques
$totalTenants = $pdo->query("SELECT COUNT(*) as count FROM tenants WHERE is_active = 1")->fetch(PDO::FETCH_ASSOC)["count"];
$totalUsers = $pdo->query("SELECT COUNT(*) as count FROM users")->fetch(PDO::FETCH_ASSOC)["count"];
$totalRooms = $pdo->query("SELECT COUNT(*) as count FROM rooms")->fetch(PDO::FETCH_ASSOC)["count"];
$totalCustomers = $pdo->query("SELECT COUNT(*) as count FROM customers")->fetch(PDO::FETCH_ASSOC)["count"];
$totalTransactions = $pdo->query("SELECT COUNT(*) as count FROM transactions")->fetch(PDO::FETCH_ASSOC)["count"];
$totalRevenue = $pdo->query("SELECT SUM(total_price) as total FROM transactions")->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Super Admin - Solution Directe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
        }
        .header .user-info {
            text-align: right;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }
        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .info-box {
            background: #e3f2fd;
            color: #1565c0;
            border: 1px solid #bbdefb;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1>🎯 Dashboard Super Admin</h1>
            <p>Solution directe - PHP pur</p>
        </div>
        <div class="user-info">
            <div><strong><?php echo htmlspecialchars($_SESSION["user_name"]); ?></strong></div>
            <div><?php echo htmlspecialchars($_SESSION["user_email"]); ?></div>
            <div><small>Super Admin</small></div>
            <br>
            <a href="/direct-logout.php"><button class="logout-btn">Déconnexion</button></a>
        </div>
    </div>
    
    <div class="info-box">
        <strong>🎉 Connexion réussie !</strong><br>
        Vous êtes connecté en tant que Super Admin avec la solution directe PHP pur.
    </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number"><?php echo $totalTenants; ?></div>
            <div class="stat-label">Tenants Actifs</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo $totalUsers; ?></div>
            <div class="stat-label">Utilisateurs</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo $totalRooms; ?></div>
            <div class="stat-label">Chambres</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo $totalCustomers; ?></div>
            <div class="stat-label">Clients</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo $totalTransactions; ?></div>
            <div class="stat-label">Transactions</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo number_format($totalRevenue, 0, ",", " "); ?> FCFA</div>
            <div class="stat-label">Revenu Total</div>
        </div>
    </div>
    
    <div style="text-align: center; color: #666; margin-top: 2rem;">
        <p>Cette solution utilise PHP pur pour contourner les problèmes Laravel.</p>
        <p>Les données sont directement extraites de la base de données.</p>
    </div>
</body>
</html>