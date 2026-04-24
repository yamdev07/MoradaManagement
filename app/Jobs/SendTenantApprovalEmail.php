<?php

namespace App\Jobs;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendTenantApprovalEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue;

    public $tenant;
    public $admin;

    /**
     * Create a new job instance.
     */
    public function __construct(Tenant $tenant, User $admin)
    {
        $this->tenant = $tenant;
        $this->admin = $admin;
        
        Log::info('SendTenantApprovalEmail job created', [
            'tenant_id' => $tenant->id,
            'tenant_name' => $tenant->name,
            'admin_id' => $admin->id,
            'admin_email' => $admin->email
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            Log::info('Sending tenant approval email', [
                'tenant_id' => $this->tenant->id,
                'tenant_name' => $this->tenant->name,
                'tenant_email' => $this->tenant->email,
                'admin_id' => $this->admin->id,
                'admin_email' => $this->admin->email
            ]);

            // Préparer les données pour l'email
            $tenantData = [
                'name' => $this->tenant->name,
                'domain' => $this->tenant->domain,
                'subdomain' => $this->tenant->subdomain,
                'description' => $this->tenant->description,
                'email' => $this->tenant->email,
                'phone' => $this->tenant->phone,
                'address' => $this->tenant->address,
                'city' => $this->tenant->city,
                'country' => $this->tenant->country,
                'approved_at' => now()->format('d/m/Y à H:i'),
                'login_url' => url('/login'),
                'admin_name' => $this->admin->name,
                'admin_email' => $this->admin->email,
                'theme_colors' => $this->tenant->theme_settings ?? [
                    'primary_color' => '#8b4513',
                    'secondary_color' => '#d2b48c',
                    'accent_color' => '#f59e0b'
                ]
            ];

            // Vérifier que le tenant a un email valide
            if (empty($this->tenant->email)) {
                Log::error('Tenant has no email address', [
                    'tenant_id' => $this->tenant->id,
                    'tenant_name' => $this->tenant->name
                ]);
                throw new \Exception('Le tenant n\'a pas d\'adresse email valide');
            }

            // Envoyer l'email au tenant
            $recipientEmail = $this->tenant->email;
            $subject = "🎉 Félicitations ! Votre compte Morada Lodge a été approuvé";
            
            $emailContent = $this->buildEmailContent($tenantData);

            Mail::send([], [], function($message) use ($recipientEmail, $subject, $emailContent) {
                $message->to($recipientEmail)
                        ->subject($subject)
                        ->html($emailContent);
            });

            Log::info('Tenant approval email sent successfully', [
                'tenant_id' => $this->tenant->id,
                'recipient' => $recipientEmail,
                'subject' => $subject
            ]);

            return "Email d'approbation envoyé avec succès";

        } catch (\Exception $e) {
            Log::error('Failed to send tenant approval email', [
                'tenant_id' => $this->tenant->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }

    /**
     * Construire le contenu de l'email
     */
    private function buildEmailContent($tenantData)
    {
        $primaryColor = $tenantData['theme_colors']['primary_color'] ?? '#8b4513';
        $secondaryColor = $tenantData['theme_colors']['secondary_color'] ?? '#d2b48c';
        
        return "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>🎉 Votre compte a été approuvé !</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, {$primaryColor} 0%, {$secondaryColor} 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0;
            margin-bottom: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header .subtitle {
            margin: 10px 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .approval-info {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .approval-info h2 {
            color: #155724;
            margin: 0 0 10px;
            font-size: 20px;
        }
        .approval-info p {
            color: #155724;
            margin: 0;
        }
        .tenant-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .tenant-info h3 {
            margin: 0 0 15px;
            color: #333;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: 600;
            color: #666;
            margin-bottom: 5px;
        }
        .info-value {
            color: #333;
        }
        .next-steps {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .next-steps h3 {
            color: #856404;
            margin: 0 0 15px;
        }
        .next-steps ul {
            margin: 0;
            padding-left: 20px;
            color: #856404;
        }
        .next-steps li {
            margin-bottom: 8px;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            background: {$primaryColor};
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 10px;
            text-align: center;
        }
        .btn:hover {
            background: {$secondaryColor};
            transform: translateY(-2px);
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 8px 8px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .contact-info {
            background: #e9ecef;
            padding: 15px;
            border-radius: 6px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>🎉 Félicitations !</h1>
            <div class='subtitle'>Votre compte Morada Lodge a été approuvé</div>
        </div>
        
        <div class='approval-info'>
            <h2>✅ Votre demande a été validée</h2>
            <p>Votre hôtel <strong>{$tenantData['name']}</strong> est maintenant actif et prêt à être utilisé.</p>
        </div>
        
        <div class='tenant-info'>
            <h3>📋 Informations de votre compte</h3>
            <div class='info-grid'>
                <div class='info-item'>
                    <div class='info-label'>Nom de l'hôtel:</div>
                    <div class='info-value'>{$tenantData['name']}</div>
                </div>
                <div class='info-item'>
                    <div class='info-label'>Domaine:</div>
                    <div class='info-value'>{$tenantData['domain']}</div>
                </div>
                <div class='info-item'>
                    <div class='info-label'>Sous-domaine:</div>
                    <div class='info-value'>{$tenantData['subdomain']}</div>
                </div>
                <div class='info-item'>
                    <div class='info-label'>Email:</div>
                    <div class='info-value'>{$tenantData['email']}</div>
                </div>
                <div class='info-item'>
                    <div class='info-label'>Date d'approbation:</div>
                    <div class='info-value'>{$tenantData['approved_at']}</div>
                </div>
                <div class='info-item'>
                    <div class='info-label'>Approuvé par:</div>
                    <div class='info-value'>{$tenantData['admin_name']}</div>
                </div>
            </div>
        </div>
        
        <div class='next-steps'>
            <h3>🚀 Prochaines étapes</h3>
            <ul>
                <li>Connectez-vous à votre compte avec vos identifiants</li>
                <li>Configurez les informations de votre hôtel</li>
                <li>Ajoutez vos chambres et tarifs</li>
                <li>Commencez à gérer vos réservations</li>
            </ul>
        </div>
        
        <div style='text-align: center; margin: 30px 0;'>
            <a href='{$tenantData['login_url']}' class='btn' style='color: white; text-decoration: none;'>
                🔐 Se connecter maintenant
            </a>
        </div>
        
        <div class='footer'>
            <p>Cet email a été généré automatiquement par le système Morada Lodge.</p>
            <p>Pour toute question ou assistance technique, contactez-nous:</p>
            <div class='contact-info'>
                <p>📧 Email: {$tenantData['admin_email']}</p>
                <p>🌐 Site: www.moradalodge.com</p>
            </div>
        </div>
    </div>
</body>
</html>
        ";
    }

    /**
     * Get the tags that should be assigned to the job.
     */
    public function tags()
    {
        return ['tenant', 'email', 'approval', 'notifications'];
    }
}
