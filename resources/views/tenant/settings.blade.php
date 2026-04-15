@extends('frontend.layouts.master')

@section('title', 'Paramètres - {{ $tenant->name }}')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cog"></i>
                        Paramètres de l'entreprise
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informations de l'entreprise</h4>
                </div>
                <form action="{{ route('tenant.update-settings', ['subdomain' => $tenant->subdomain]) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nom de l'entreprise <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $tenant->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="contact_email">Email de contact</label>
                            <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                                   id="contact_email" name="contact_email" value="{{ old('contact_email', $tenant->contact_email) }}">
                            @error('contact_email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="contact_phone">Téléphone de contact</label>
                            <input type="tel" class="form-control @error('contact_phone') is-invalid @enderror" 
                                   id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $tenant->contact_phone) }}">
                            @error('contact_phone')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer les modifications
                        </button>
                        <a href="{{ route('tenant.dashboard', ['subdomain' => $tenant->subdomain]) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-info-circle"></i>
                        Informations du système
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td><strong>ID Tenant:</strong></td>
                            <td>{{ $tenant->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Sous-domaine:</strong></td>
                            <td>{{ $tenant->subdomain ?? 'Non défini' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Créé le:</strong></td>
                            <td>{{ $tenant->created_at->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Statut:</strong></td>
                            <td>
                                <span class="badge badge-{{ $tenant->status ? 'success' : 'danger' }}">
                                    {{ $tenant->status ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
