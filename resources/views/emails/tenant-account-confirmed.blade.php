<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Compte Hôtel</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 300;
        }
        .content {
            padding: 40px 30px;
        }
        .welcome {
            background: #e8f5e8;
            border-left: 4px solid #28a745;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 30px 0;
        }
        .info-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #e9ecef;
        }
        .info-item strong {
            color: #2c3e50;
            display: block;
            margin-bottom: 5px;
        }
        .next-steps {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 20px;
            margin: 30px 0;
            border-radius: 5px;
        }
        .next-steps h3 {
            color: #856404;
            margin-top: 0;
        }
        .next-steps ul {
            margin: 15px 0;
            padding-left: 20px;
        }
        .next-steps li {
            margin: 10px 0;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            margin: 20px 0;
            transition: all 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
        }
        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 5px 0;
            color: #6c757d;
            font-size: 14px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .status-badge {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">🏨 Morada Lodge</div>
            <h1>Compte Hôtel Confirmé</h1>
            <p>Votre établissement est maintenant actif sur notre plateforme</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Welcome Message -->
            <div class="welcome">
                <h2>🎉 Félicitations, {{ $tenant->name }} !</h2>
                <p>Votre compte hôtel a été confirmé par notre équipe d'administration.</p>
                <p><strong>Confirmé par :</strong> {{ $adminName }}</p>
            </div>

            <!-- Hotel Information -->
            <h3>📋 Informations de votre établissement</h3>
            <div class="info-grid">
                <div class="info-item">
                    <strong>Nom de l'hôtel</strong>
                    {{ $tenant->name }}
                </div>
                <div class="info-item">
                    <strong>Sous-domaine</strong>
                    {{ $tenant->subdomain }}.moradalodge.com
                </div>
                <div class="info-item">
                    <strong>Email</strong>
                    {{ $tenant->email }}
                </div>
                <div class="info-item">
                    <strong>Téléphone</strong>
                    {{ $tenant->phone ?? 'Non spécifié' }}
                </div>
                <div class="info-item">
                    <strong>Statut</strong>
                    <span class="status-badge">Actif</span>
                </div>
                <div class="info-item">
                    <strong>Date de confirmation</strong>
                    {{ now()->format('d/m/Y à H:i') }}
                </div>
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <h3>🚀 Prochaines étapes</h3>
                <p>Voici ce que vous pouvez faire maintenant :</p>
                <ul>
                    <li><strong>Configurer votre hôtel :</strong> Ajoutez vos chambres, types et tarifs</li>
                    <li><strong>Personnaliser l'apparence :</strong> Choisissez vos couleurs et thème</li>
                    <li><strong>Gérer les réservations :</strong> Consultez et gérez les demandes de réservation</li>
                    <li><strong>Accéder au dashboard :</strong> Suivez vos performances et statistiques</li>
                </ul>
            </div>

            <!-- Call to Action -->
            <div style="text-align: center;">
                <a href="{{ url('login') }}" class="cta-button">
                    Accéder à mon espace hôtel
                </a>
            </div>

            <!-- Important Information -->
            <div style="background: #d1ecf1; border-left: 4px solid #17a2b8; padding: 20px; margin: 30px 0; border-radius: 5px;">
                <h4 style="color: #0c5460; margin-top: 0;">📧 Informations importantes</h4>
                <ul style="color: #0c5460; padding-left: 20px;">
                    <li>Conservez cet email pour vos archives</li>
                    <li>Votre identifiant est votre email : {{ $tenant->email }}</li>
                    <li>En cas de problème, contactez notre support technique</li>
                    <li>Pour des raisons de sécurité, ne partagez jamais vos identifiants</li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Morada Lodge</strong></p>
            <p>Plateforme de gestion hôtelière multitenant</p>
            <p>Covè, République du Bénin</p>
            <p>+229 0167836481 | admin@moradalodge.com</p>
            <p style="margin-top: 20px; font-size: 12px;">
                © {{ date('Y') }} Morada Lodge. Tous droits réservés.
            </p>
        </div>
    </div>
</body>
</html>
