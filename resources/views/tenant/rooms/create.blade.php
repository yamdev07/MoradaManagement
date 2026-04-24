@extends('frontend.layouts.master')

@section('title', 'Créer une Chambre - {{ $tenant->name }}')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-0">
                    <i class="fas fa-plus me-2 text-primary"></i>
                    Créer une Nouvelle Chambre
                </h2>
                <nav aria-label="breadcrumb" class="mt-2">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('tenant.dashboard', $tenant->subdomain ?? $tenant->id) }}">
                                Dashboard {{ $tenant->name }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('tenant.rooms.index', $tenant->subdomain ?? $tenant->id) }}">
                                Chambres
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Créer</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('tenant.rooms.index', $tenant->subdomain ?? $tenant->id) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
        </div>
    </div>
    
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>Veuillez corriger les erreurs suivantes:</strong>
        <ul class="mb-0 mt-2 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2 text-info"></i>
                        Informations de la Chambre
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tenant.rooms.store', $tenant->subdomain ?? $tenant->id) }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="number" class="form-label">
                                    <i class="fas fa-hashtag text-primary"></i> Numéro de chambre *
                                </label>
                                <input type="text" 
                                       class="form-control @error('number') is-invalid @enderror" 
                                       id="number" 
                                       name="number" 
                                       value="{{ old('number') }}" 
                                       placeholder="Ex: 101, A1, etc."
                                       required>
                                @error('number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-tag text-primary"></i> Nom de la chambre
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="Ex: Suite Deluxe, Chambre Standard, etc.">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="type_id" class="form-label">
                                    <i class="fas fa-door-closed text-primary"></i> Type de chambre *
                                </label>
                                <select class="form-select @error('type_id') is-invalid @enderror" 
                                        id="type_id" 
                                        name="type_id" 
                                        required>
                                    <option value="">Sélectionner un type</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" 
                                                @if(old('type_id') == $type->id) selected @endif>
                                            {{ $type->name }}
                                            @if($type->base_price)
                                                ({{ number_format($type->base_price, 0, ',', ' ') }} FCFA)
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="room_status_id" class="form-label">
                                    <i class="fas fa-toggle-on text-primary"></i> Statut *
                                </label>
                                <select class="form-select @error('room_status_id') is-invalid @enderror" 
                                        id="room_status_id" 
                                        name="room_status_id" 
                                        required>
                                    <option value="">Sélectionner un statut</option>
                                    @foreach($roomStatuses as $status)
                                        <option value="{{ $status->id }}" 
                                                @if(old('room_status_id') == $status->id) selected @endif>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('room_status_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="capacity" class="form-label">
                                    <i class="fas fa-users text-primary"></i> Capacité *
                                </label>
                                <input type="number" 
                                       class="form-control @error('capacity') is-invalid @enderror" 
                                       id="capacity" 
                                       name="capacity" 
                                       value="{{ old('capacity', 2) }}" 
                                       min="1" 
                                       max="10" 
                                       required>
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">
                                    <i class="fas fa-money-bill-wave text-primary"></i> Prix par nuit (FCFA) *
                                </label>
                                <input type="number" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price') }}" 
                                       min="0" 
                                       step="100" 
                                       placeholder="Ex: 25000"
                                       required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="size" class="form-label">
                                    <i class="fas fa-ruler-combined text-primary"></i> Surface
                                </label>
                                <input type="text" 
                                       class="form-control @error('size') is-invalid @enderror" 
                                       id="size" 
                                       name="size" 
                                       value="{{ old('size') }}" 
                                       placeholder="Ex: 25m², 30m², etc.">
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="view" class="form-label">
                                <i class="fas fa-mountain text-primary"></i> Vue
                            </label>
                            <input type="text" 
                                   class="form-control @error('view') is-invalid @enderror" 
                                   id="view" 
                                   name="view" 
                                   value="{{ old('view') }}" 
                                   placeholder="Ex: Mer, Jardin, Ville, etc.">
                            @error('view')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left text-primary"></i> Description
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Décrivez les caractéristiques de la chambre...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('tenant.rooms.index', $tenant->subdomain ?? $tenant->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Créer la chambre
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-lightbulb text-warning"></i>
                        Conseils
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Le numéro de chambre doit être unique dans votre hôtel
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Utilisez des noms descriptifs pour faciliter la gestion
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            La capacité inclut tous les occupants (adultes et enfants)
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Le prix peut être ajusté ultérieurement si nécessaire
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle text-info"></i>
                        Informations du Tenant
                    </h5>
                </div>
                <div class="card-body">
                    <p><strong>Hôtel:</strong> {{ $tenant->name }}</p>
                    <p><strong>ID:</strong> {{ $tenant->id }}</p>
                    @if($tenant->subdomain)
                        <p><strong>Sous-domaine:</strong> {{ $tenant->subdomain }}</p>
                    @endif
                    <div class="alert alert-info">
                        <small>
                            <i class="fas fa-shield-alt"></i>
                            Cette chambre sera automatiquement associée à votre hôtel et ne sera visible que par vous.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
