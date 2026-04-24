<?php
session_start();

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    
    // Connexion à la base de données
    try {
        $pdo = new PDO("mysql:host=127.0.0.1;dbname=hotelio", "root", "aaa");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Vérification de l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user["password"]) && $user["role"] === "Super") {
            // Connexion réussie
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_email"] = $user["email"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_role"] = $user["role"];
            $_SESSION["logged_in"] = true;
            $_SESSION["login_time"] = time();
            
            // Mettre à jour la dernière connexion
            $updateStmt = $pdo->prepare("UPDATE users SET last_login_at = NOW(), last_login_ip = ? WHERE id = ?");
            $updateStmt->execute([$_SERVER["REMOTE_ADDR"], $user["id"]]);
            
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Email ou mot de passe incorrect";
        }
    } catch (Exception $e) {
        $error = "Erreur de connexion à la base de données";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin - Système PHP Pur</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }
        
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .login-header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .login-header p {
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .login-body {
            padding: 2.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }
        
        .btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .alert-error {
            background: #fee;
            color: #c53030;
            border: 1px solid #fca5a5;
        }
        
        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        
        .info-box {
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
        }
        
        .system-info {
            text-align: center;
            color: #666;
            font-size: 0.8rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>🎯 Super Admin</h1>
            <p>Système de gestion PHP pur</p>
        </div>
        
        <div class="login-body">
            <div class="info-box">
                <strong>🔧 Système PHP Pur</strong><br>
                Ce système contourne complètement Laravel pour garantir un fonctionnement optimal.
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($superAdmin["email"]); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" value="admin123" required>
                </div>
                
                <button type="submit" class="btn">
                    🚀 Se connecter
                </button>
            </form>
            
            <div class="system-info">
                Système PHP pur v1.0 | Base de données: MySQL | Connexion sécurisée
            </div>
        </div>
    </div>
</body>
</html>