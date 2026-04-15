<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TenantRegistrationController extends Controller
{
    /**
     * Afficher la page d'inscription pour tenant
     */
    public function showRegistrationForm()
    {
        return view('auth.tenant-register');
    }

    /**
     * Traiter l'inscription d'un nouveau tenant
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Informations du tenant
            'tenant_name' => 'required|string|max:255|unique:tenants,name',
            'tenant_domain' => 'required|string|max:255|unique:tenants,domain',
            'tenant_email' => 'required|email|max:255|unique:tenants,email',
            'tenant_phone' => 'nullable|string|max:20',
            'tenant_address' => 'nullable|string|max:500',
            'tenant_description' => 'nullable|string|max:1000',
            
            // Personnalisation du thème
            'primary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'accent_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Informations de l'administrateur
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255|unique:users,email',
            'admin_phone' => 'nullable|string|max:20',
            'admin_password' => 'required|string|min:8',
            
            // Conditions
            'terms' => 'accepted',
        ], [
            'tenant_name.required' => 'Le nom de l\'hôtel est obligatoire',
            'tenant_name.unique' => 'Ce nom d\'hôtel est déjà utilisé',
            'tenant_domain.required' => 'Le domaine est obligatoire',
            'tenant_domain.unique' => 'Ce domaine est déjà utilisé',
            'tenant_email.required' => 'L\'email de l\'hôtel est obligatoire',
            'tenant_email.email' => 'Veuillez entrer une adresse email valide',
            'primary_color.required' => 'La couleur principale est obligatoire',
            'primary_color.regex' => 'Veuillez entrer une couleur hexadécimale valide (ex: #FF5733)',
            'secondary_color.required' => 'La couleur secondaire est obligatoire',
            'secondary_color.regex' => 'Veuillez entrer une couleur hexadécimale valide (ex: #FF5733)',
            'accent_color.required' => 'La couleur d\'accent est obligatoire',
            'accent_color.regex' => 'Veuillez entrer une couleur hexadécimale valide (ex: #FF5733)',
            'admin_name.required' => 'Le nom de l\'administrateur est obligatoire',
            'admin_email.required' => 'L\'email de l\'administrateur est obligatoire',
            'admin_email.email' => 'Veuillez entrer une adresse email valide',
            'admin_email.unique' => 'Cet email est déjà utilisé',
            'admin_password.required' => 'Le mot de passe est obligatoire',
            'admin_password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'terms.accepted' => 'Vous devez accepter les conditions d\'utilisation',
        ]);

        // Validation manuelle de la confirmation du mot de passe
        if ($request->admin_password !== $request->admin_password_confirmation) {
            return back()
                ->withErrors(['admin_password_confirmation' => 'La confirmation du mot de passe ne correspond pas'])
                ->withInput();
        }

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Upload du logo si fourni
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('logos', 'public');
            }

            // Création du tenant - test simple
            try {
                $tenant = new Tenant();
                $tenant->name = $request->tenant_name;
                $tenant->subdomain = strtolower(str_replace(' ', '-', $request->tenant_domain));
                $tenant->database_name = 'hotelio_' . strtolower(str_replace(' ', '_', $request->tenant_domain));
                $tenant->database_user = 'hotelio_user_' . strtolower(str_replace(' ', '_', $request->tenant_domain));
                $tenant->database_password = bcrypt(Str::random(32));
                $tenant->domain = $request->tenant_domain;
                $tenant->email = $request->tenant_email;
                $tenant->phone = $request->tenant_phone;
                $tenant->address = $request->tenant_address;
                $tenant->description = $request->tenant_description;
                $tenant->logo = $logoPath;
                $tenant->is_active = false;
                $tenant->status = 0;
                $tenant->theme_settings = [
                    'primary_color' => $request->primary_color,
                    'secondary_color' => $request->secondary_color,
                    'accent_color' => $request->accent_color,
                    'font_family' => $request->font_family ?? 'Inter',
                    'custom_css' => $request->custom_css ?? '',
                ];
                $tenant->save();
            } catch (\Exception $e) {
                \Log::error('Tenant creation failed', [
                    'message' => $e->getMessage(),
                    'data' => $request->all()
                ]);
                throw $e;
            }

            // Création de l'utilisateur administrateur
            $admin = User::create([
                'name' => $request->admin_name,
                'email' => $request->admin_email,
                'phone' => $request->admin_phone,
                'password' => Hash::make($request->admin_password),
                'tenant_id' => $tenant->id,
                'role' => 'admin',
                'is_active' => false, // Nécessite validation du tenant
                'email_verified_at' => null,
                'random_key' => Str::random(60),
            ]);

            // Envoyer un email de notification au super admin
            // TODO: Implémenter la notification

            return redirect()->route('tenant.registration.success')
                ->with('success', 'Votre demande de création de compte a été soumise avec succès. Vous recevrez un email dès que votre compte sera validé.');

        } catch (\Exception $e) {
            \Log::error('Tenant registration error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all()
            ]);
            return back()
                ->with('error', 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.')
                ->withInput();
        }
    }

    /**
     * Page de succès après inscription
     */
    public function registrationSuccess()
    {
        return view('auth.tenant-registration-success');
    }

    /**
     * Vérifier la disponibilité du domaine
     */
    public function checkDomainAvailability(Request $request)
    {
        $domain = $request->input('domain');
        $isAvailable = !Tenant::where('domain', $domain)->exists();
        
        return response()->json([
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Domaine disponible' : 'Ce domaine est déjà utilisé'
        ]);
    }

    /**
     * Vérifier la disponibilité de l'email
     */
    public function checkEmailAvailability(Request $request)
    {
        $email = $request->input('email');
        $isAvailable = !Tenant::where('email', $email)->exists() && !User::where('email', $email)->exists();
        
        return response()->json([
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Email disponible' : 'Cet email est déjà utilisé'
        ]);
    }

    /**
     * Prévisualiser le thème
     */
    public function previewTheme(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'primary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'accent_color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Couleurs invalides',
                'messages' => $validator->errors()
            ], 422);
        }

        return response()->json([
            'theme' => [
                'primary_color' => $request->primary_color,
                'secondary_color' => $request->secondary_color,
                'accent_color' => $request->accent_color,
                'font_family' => $request->font_family ?? 'Inter',
            ]
        ]);
    }
}
