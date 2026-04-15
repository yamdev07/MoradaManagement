<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function tenantLoginGeneric(Request $request)
    {
        try {
            \Log::info('=== DEBUT CONNEXION TENANT ===');
            \Log::info('Données reçues:', $request->all());
            
            // Validation simple
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            \Log::info('Validation OK');

            // Récupérer le hotel_id de l'URL ou de la session
            $hotelId = $request->get('hotel_id') ?: session('selected_hotel_id');
            \Log::info('Hotel ID: ' . $hotelId);

            // Si on a un hotel_id, vérifier que l'utilisateur appartient à ce tenant
            if ($hotelId) {
                $user = User::where('email', $credentials['email'])
                    ->where('tenant_id', $hotelId)
                    ->first();
                
                if ($user && Hash::check($credentials['password'], $user->password)) {
                    \Log::info('Authentification RÉUSSIE avec tenant_id: ' . $hotelId);
                    
                    // Connecter l'utilisateur
                    Auth::login($user);
                    
                    // Mettre en session
                    session(['selected_hotel_id' => $hotelId]);
                    
                    // Redirection selon le rôle
                    if ($user->role === 'Super') {
                        return redirect()->route('super-admin.dashboard')
                            ->with('success', 'Bienvenue Super Admin ' . $user->name);
                    } else {
                        return redirect('/hotel')
                            ->with('success', 'Bienvenue ' . $user->name);
                    }
                }
            }
            
            // Si pas de hotel_id, essayer l'authentification standard (pour admin global)
            if (Auth::attempt($credentials)) {
                \Log::info('Authentification standard RÉUSSIE');
                
                $user = Auth::user();
                
                if ($user->role === 'Super') {
                    return redirect()->route('super-admin.dashboard')
                        ->with('success', 'Bienvenue Super Admin ' . $user->name);
                } elseif ($user->tenant_id) {
                    session(['selected_hotel_id' => $user->tenant_id]);
                    return redirect('/hotel')
                        ->with('success', 'Bienvenue ' . $user->name);
                } else {
                    return redirect('/dashboard')->with('success', 'Connexion réussie');
                }
            }
            
            \Log::info('Authentification ÉCHOUÉE');
            return redirect('/login-tenant' . ($hotelId ? '?hotel_id=' . $hotelId : ''))
                ->with('error', 'Email ou mot de passe incorrect')
                ->withInput();
                
        } catch (\Exception $e) {
            \Log::error('ERREUR CONNEXION: ' . $e->getMessage());
            return redirect('/login-tenant')
                ->with('error', 'Erreur de connexion: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            activity()->causedBy(auth()->user())->log('User logged into portal');

            // Redirection selon le rôle et le contexte du tenant
            $user = Auth::user();
            
            // Si un hotel_id est fourni, le mettre en session
            if ($request->has('hotel_id') && $request->get('hotel_id')) {
                session(['selected_hotel_id' => $request->get('hotel_id')]);
            }
            
            if ($user->role === 'Super') {
                return redirect()->route('super-admin.dashboard')->with('success', 'Welcome Super Admin '.$user->name);
            } else {
                // Si l'utilisateur a un tenant_id, l'utiliser pour le dashboard
                if ($user->tenant_id) {
                    // Mettre le tenant_id en session pour le contexte
                    session(['selected_hotel_id' => $user->tenant_id]);
                    
                    // Récupérer les informations du tenant pour le message
                    $tenant = Tenant::find($user->tenant_id);
                    $tenantName = $tenant ? $tenant->name : 'Hôtel';
                    
                    return redirect()->route('dashboard.index', ['hotel_id' => $user->tenant_id])
                        ->with('success', 'Bienvenue '.$user->name.' sur '.$tenantName);
                } else {
                    return redirect('dashboard')->with('success', 'Welcome '.$user->name);
                }
            }
        }

        return redirect('/login-tenant')->with('failed', 'Email ou mot de passe incorrect');
    }

    public function tenantLogin(Request $request, $tenant)
    {
        // Récupérer le tenant
        $tenantModel = Tenant::where('domain', $tenant)
            ->orWhere('subdomain', $tenant)
            ->orWhere('id', $tenant)
            ->first();

        if (!$tenantModel) {
            return redirect()->route('login.index')->with('error', 'Tenant non trouvé');
        }

        // Validation des champs
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'tenant_id' => 'required'
        ]);

        // Vérifier que le tenant_id correspond
        if ($credentials['tenant_id'] != $tenantModel->id) {
            return back()->with('error', 'Tenant ID invalide');
        }

        // Tenter l'authentification
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            // Vérifier que l'utilisateur appartient à ce tenant
            if ($user->tenant_id != $tenantModel->id) {
                Auth::logout();
                return back()->with('error', 'Vous n\'êtes pas autorisé à accéder à ce tenant');
            }

            activity()->causedBy($user)->log('User logged into tenant: ' . $tenantModel->name);

            // Redirection selon le rôle
            if ($user->role === 'Super') {
                return redirect()->route('super-admin.dashboard')->with('success', 'Welcome Super Admin '.$user->name);
            } else {
                // Rediriger vers le dashboard avec le contexte du tenant
                return redirect()->route('dashboard.index', ['hotel_id' => $tenantModel->id])->with('success', 'Welcome '.$user->name.' to '.$tenantModel->name);
            }
        }

        return back()->with('failed', 'Email ou mot de passe incorrect');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        $request->validated();

        $status = Password::sendResetLink($request->only('email'));

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with(['status' => 'success', 'message' => 'Password reset link sent to your email']);
        }

        return back()->with(['status' => 'error', 'message' => 'Unable to send password reset link']);
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $request->validated();

        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            $user->setRememberToken(Str::random(60));

            event(new PasswordReset($user, $password));
        });

        if ($status == Password::PASSWORD_RESET) {
            return redirect('/login')->with(['status' => 'success', 'message' => 'Password has been reset successfully']);
        }

        return back()->with(['status' => 'error', 'message' => 'Unable to reset password']);
    }
}
