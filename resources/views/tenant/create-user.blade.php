@extends('frontend.layouts.master')

@section('title', 'Créer un utilisateur - {{ $tenant->name }}')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user-plus"></i>
                        Créer un nouvel utilisateur
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        Ajoutez un nouvel utilisateur à votre entreprise <strong>{{ $tenant->name }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire de création -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informations de l'utilisateur</h4>
                </div>
                <form action="{{ route('tenant.store-user', ['subdomain' => $tenant->subdomain]) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nom complet <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Mot de passe <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmer le mot de passe <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                           id="password_confirmation" name="password_confirmation" required>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role">Rôle <span class="text-danger">*</span></label>
                            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">Sélectionner un rôle</option>
                                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Receptionist" {{ old('role') == 'Receptionist' ? 'selected' : '' }}>Réceptionniste</option>
                                <option value="Housekeeping" {{ old('role') == 'Housekeeping' ? 'selected' : '' }}>Housekeeping</option>
                                <option value="Customer" {{ old('role') == 'Customer' ? 'selected' : '' }}>Client</option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Créer l'utilisateur
                        </button>
                        <a href="{{ route('tenant.users', ['subdomain' => $tenant->subdomain]) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Guide des rôles -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-info-circle"></i>
                        Guide des rôles
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-danger">Admin</h6>
                        <p class="text-muted small">
                            Accès complet à toutes les fonctionnalités de gestion de l'entreprise.
                        </p>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-warning">Réceptionniste</h6>
                        <p class="text-muted small">
                            Gère les réservations, check-in/check-out, et les transactions.
                        </p>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-info">Housekeeping</h6>
                        <p class="text-muted small">
                            Gère l'état des chambres et le nettoyage.
                        </p>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-secondary">Client</h6>
                        <p class="text-muted small">
                            Accès limité à la consultation et réservation en ligne.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Informations importantes -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Important
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="small text-muted">
                        <li>L'utilisateur sera automatiquement associé à votre entreprise</li>
                        <li>Le mot de passe doit contenir au moins 6 caractères</li>
                        <li>L'email doit être unique dans tout le système</li>
                        <li>Vous ne pouvez pas supprimer votre propre compte</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
