@extends('template.auth')
@section('title', 'Créer votre compte Hôtel - Version Simple')
@section('content')

<style>
:root {
    --primary: #2c3e50;
    --primary-light: #34495e;
    --success: #27ae60;
    --gray-50: #f8f9fa;
    --gray-100: #e9ecef;
    --gray-200: #dee2e6;
    --gray-300: #ced4da;
    --gray-400: #adb5bd;
    --gray-500: #6c757d;
    --gray-600: #495057;
    --gray-700: #343a40;
    --gray-800: #212529;
    --white: #ffffff;
    --radius: 12px;
    --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

body {
    background: transparent !important;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.card {
    background: var(--white);
    border-radius: 24px;
    box-shadow: var(--shadow);
    overflow: hidden;
    border: 1px solid var(--gray-200);
}

.card-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    color: white;
    padding: 2rem;
    text-align: center;
}

.card-body {
    padding: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: var(--gray-700);
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--gray-200);
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(44, 62, 80, 0.1);
}

.btn {
    padding: 1rem 2rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-primary {
    background: var(--primary);
    color: white;
    width: 100%;
}

.btn-primary:hover {
    background: var(--primary-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(44, 62, 80, 0.3);
}

.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.alert-danger {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.alert-success {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.text-muted {
    color: var(--gray-500);
    font-size: 0.875rem;
}

.required {
    color: #e74c3c;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary);
}

@media (max-width: 768px) {
    .container {
        padding: 1rem 0.5rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
}
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="h3 mb-2">
                <i class="fas fa-hotel me-2"></i>
                Créer votre compte Hôtel
            </h1>
            <p class="mb-0">Version simplifiée - Test de soumission</p>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <h5><i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation</h5>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tenant.register.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Informations du Tenant -->
                <div class="section-title">
                    <i class="fas fa-building me-2"></i>
                    Informations de l'Hôtel
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tenant_name" class="form-label">
                                Nom de l'hôtel <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('tenant_name') is-invalid @enderror" 
                                   id="tenant_name" 
                                   name="tenant_name" 
                                   value="{{ old('tenant_name') }}" 
                                   required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tenant_domain" class="form-label">
                                Domaine <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('tenant_domain') is-invalid @enderror" 
                                   id="tenant_domain" 
                                   name="tenant_domain" 
                                   value="{{ old('tenant_domain') }}" 
                                   placeholder="ex: mon-hotel"
                                   required>
                            <small class="text-muted">Votre domaine sera: mon-hotel.morada.com</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tenant_email" class="form-label">
                                Email de l'hôtel <span class="required">*</span>
                            </label>
                            <input type="email" 
                                   class="form-control @error('tenant_email') is-invalid @enderror" 
                                   id="tenant_email" 
                                   name="tenant_email" 
                                   value="{{ old('tenant_email') }}" 
                                   required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tenant_phone" class="form-label">
                                Téléphone
                            </label>
                            <input type="tel" 
                                   class="form-control @error('tenant_phone') is-invalid @enderror" 
                                   id="tenant_phone" 
                                   name="tenant_phone" 
                                   value="{{ old('tenant_phone') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tenant_address" class="form-label">
                        Adresse
                    </label>
                    <textarea class="form-control @error('tenant_address') is-invalid @enderror" 
                              id="tenant_address" 
                              name="tenant_address" 
                              rows="3">{{ old('tenant_address') }}</textarea>
                </div>

                <!-- Thème -->
                <div class="section-title mt-4">
                    <i class="fas fa-palette me-2"></i>
                    Personnalisation du thème
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="primary_color" class="form-label">
                                Couleur principale <span class="required">*</span>
                            </label>
                            <input type="color" 
                                   class="form-control @error('primary_color') is-invalid @enderror" 
                                   id="primary_color" 
                                   name="primary_color" 
                                   value="{{ old('primary_color', '#8b4513') }}" 
                                   required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="secondary_color" class="form-label">
                                Couleur secondaire <span class="required">*</span>
                            </label>
                            <input type="color" 
                                   class="form-control @error('secondary_color') is-invalid @enderror" 
                                   id="secondary_color" 
                                   name="secondary_color" 
                                   value="{{ old('secondary_color', '#3498db') }}" 
                                   required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="accent_color" class="form-label">
                                Couleur d'accent <span class="required">*</span>
                            </label>
                            <input type="color" 
                                   class="form-control @error('accent_color') is-invalid @enderror" 
                                   id="accent_color" 
                                   name="accent_color" 
                                   value="{{ old('accent_color', '#f39c12') }}" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Administrateur -->
                <div class="section-title mt-4">
                    <i class="fas fa-user-tie me-2"></i>
                    Compte Administrateur
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="admin_name" class="form-label">
                                Nom complet <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('admin_name') is-invalid @enderror" 
                                   id="admin_name" 
                                   name="admin_name" 
                                   value="{{ old('admin_name') }}" 
                                   required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="admin_email" class="form-label">
                                Email <span class="required">*</span>
                            </label>
                            <input type="email" 
                                   class="form-control @error('admin_email') is-invalid @enderror" 
                                   id="admin_email" 
                                   name="admin_email" 
                                   value="{{ old('admin_email') }}" 
                                   required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="admin_password" class="form-label">
                                Mot de passe <span class="required">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control @error('admin_password') is-invalid @enderror" 
                                   id="admin_password" 
                                   name="admin_password" 
                                   required>
                            <small class="text-muted">Minimum 8 caractères</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="admin_password_confirmation" class="form-label">
                                Confirmer le mot de passe <span class="required">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control @error('admin_password_confirmation') is-invalid @enderror" 
                                   id="admin_password_confirmation" 
                                   name="admin_password_confirmation" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Conditions -->
                <div class="form-group mt-4">
                    <div class="form-check">
                        <input type="checkbox" 
                               class="form-check-input @error('terms') is-invalid @enderror" 
                               id="terms" 
                               name="terms" 
                               value="1" 
                               required>
                        <label class="form-check-label" for="terms">
                            J'accepte les <a href="#" target="_blank">conditions d'utilisation</a> et la <a href="#" target="_blank">politique de confidentialité</a> <span class="required">*</span>
                        </label>
                    </div>
                    @error('terms')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bouton de soumission -->
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>
                        Soumettre ma demande
                    </button>
                </div>

                <div class="text-center mt-3">
                    <small class="text-muted">
                        Vous recevrez un email de confirmation après validation de votre demande.
                    </small>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
