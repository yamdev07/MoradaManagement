@extends('frontend.layouts.master')

@section('title', 'Morada Lodge - Nos Chambres')

@section('content')
<style>
.page-header {
    background: linear-gradient(135deg, #654321 0%, #8b4513 100%);
    color: white;
    padding: 60px 0;
    margin-bottom: 3rem;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 1rem;
}

.hotel-breadcrumb {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 10px;
    padding: 1rem;
    display: inline-block;
    backdrop-filter: blur(10px);
}

.filters-section {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.filter-group {
    margin-bottom: 1.5rem;
}

.filter-label {
    font-weight: 600;
    color: #654321;
    margin-bottom: 0.5rem;
    display: block;
}

.form-control, .form-select {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 0.8rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #8b4513;
    box-shadow: 0 0 0 0.2rem rgba(139,69,19,0.25);
}

.btn-filter {
    background: #8b4513;
    color: white;
    border: none;
    padding: 0.8rem 2rem;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-filter:hover {
    background: #654321;
    transform: translateY(-2px);
}

.room-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.room-card {
    background: white;
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.room-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(101,67,33,0.15);
}

.room-image {
    height: 200px;
    object-fit: cover;
    width: 100%;
}

.room-body {
    padding: 1.5rem;
}

.room-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #654321;
    margin-bottom: 0.5rem;
}

.room-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #8b4513;
    margin-bottom: 1rem;
}

.room-features {
    margin-bottom: 1rem;
}

.feature-tag {
    background: #f4f1e8;
    color: #654321;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    margin-right: 0.5rem;
    display: inline-block;
    margin-bottom: 0.5rem;
}

.btn-room {
    background: #8b4513;
    color: white;
    border: none;
    padding: 0.6rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-room:hover {
    background: #654321;
    transform: translateY(-2px);
}

.stats-bar {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-bottom: 3rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #8b4513;
    display: block;
}

.stat-label {
    color: #6c757d;
    font-size: 0.9rem;
}

.pagination-hotel {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 3rem;
}

.page-link {
    background: white;
    color: #654321;
    border: 2px solid #e9ecef;
    padding: 0.8rem 1rem;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.page-link:hover {
    background: #8b4513;
    color: white;
    border-color: #8b4513;
}

.page-link.active {
    background: #8b4513;
    color: white;
    border-color: #8b4513;
}
</style>

<!-- En-tête de page -->
<section class="page-header">
    <div class="container">
        @if($currentHotel)
        <div class="hotel-breadcrumb">
            <i class="fas fa-hotel me-2"></i>
            <strong>{{ $currentHotel->name }}</strong>
            <span class="ms-3">→</span>
            Nos Chambres
        </div>
        @endif
        
        <h1 class="page-title">Nos Chambres</h1>
    </div>
</section>

<!-- Statistiques -->
@if(isset($totalRooms))
<section class="stats-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="stat-item">
                    <span class="stat-number">{{ $totalRooms }}</span>
                    <span class="stat-label">Total Chambres</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <span class="stat-number">{{ $availableCount ?? 0 }}</span>
                    <span class="stat-label">Disponibles</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <span class="stat-number">{{ $distinctTypes ?? 0 }}</span>
                    <span class="stat-label">Types</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-item">
                    <span class="stat-number">{{ number_format($averageCapacity ?? 0, 1) }}</span>
                    <span class="stat-label">Capacité Moyenne</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Filtres -->
<section class="filters-section">
    <div class="container">
        <form method="GET" action="{{ route('multitenant.rooms') }}">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter-group">
                        <label class="filter-label">Type de chambre</label>
                        <select name="type" class="form-select">
                            <option value="">Tous les types</option>
                            @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }} ({{ $type->rooms_count ?? 0 }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="filter-group">
                        <label class="filter-label">Capacité</label>
                        <select name="capacity" class="form-select">
                            <option value="">Toutes les capacités</option>
                            <option value="1" {{ request('capacity') == '1' ? 'selected' : '' }}>1 personne</option>
                            <option value="2" {{ request('capacity') == '2' ? 'selected' : '' }}>2 personnes</option>
                            <option value="3" {{ request('capacity') == '3' ? 'selected' : '' }}>3 personnes</option>
                            <option value="4" {{ request('capacity') == '4' ? 'selected' : '' }}>4 personnes</option>
                            <option value="5+" {{ request('capacity') == '5+' ? 'selected' : '' }}>5+ personnes</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="filter-group">
                        <label class="filter-label">Fourchette de prix</label>
                        <select name="price_range" class="form-select">
                            <option value="">Tous les prix</option>
                            <option value="0-50000" {{ request('price_range') == '0-50000' ? 'selected' : '' }}>
                                0 - 50,000 FCFA
                            </option>
                            <option value="50000-100000" {{ request('price_range') == '50000-100000' ? 'selected' : '' }}>
                                50,000 - 100,000 FCFA
                            </option>
                            <option value="100000-150000" {{ request('price_range') == '100000-150000' ? 'selected' : '' }}>
                                100,000 - 150,000 FCFA
                            </option>
                            <option value="150000-200000" {{ request('price_range') == '150000-200000' ? 'selected' : '' }}>
                                150,000 - 200,000 FCFA
                            </option>
                            <option value="200000+" {{ request('price_range') == '200000+' ? 'selected' : '' }}>
                                200,000+ FCFA
                            </option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="filter-group">
                        <label class="filter-label">&nbsp;</label>
                        <button type="submit" class="btn-filter w-100">
                            <i class="fas fa-search me-2"></i>
                            Rechercher
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Liste des chambres -->
@if($rooms && $rooms->count() > 0)
<section class="container">
    <div class="room-grid">
        @foreach($rooms as $room)
        <div class="room-card">
            @if($room->images->count() > 0)
            <img src="{{ asset('storage/' . $room->images->first()->image_path) }}" 
                 class="room-image" 
                 alt="{{ $room->name }}">
            @else
            <div class="room-image d-flex align-items-center justify-content-center" 
                 style="background: #f4f1e8; color: #654321;">
                <i class="fas fa-bed fa-2x"></i>
            </div>
            @endif
            
            <div class="room-body">
                <h5 class="room-title">{{ $room->name }}</h5>
                
                <div class="room-price">
                    {{ number_format($room->price, 0, ',', ' ') }} FCFA
                    <small>/nuit</small>
                </div>
                
                <div class="room-features">
                    @if($room->capacity)
                    <span class="feature-tag">
                        <i class="fas fa-users me-1"></i>
                        {{ $room->capacity }} personnes
                    </span>
                    @endif
                    
                    @if($room->type)
                    <span class="feature-tag">
                        <i class="fas fa-tag me-1"></i>
                        {{ $room->type->name }}
                    </span>
                    @endif
                    
                    @if($room->room_status)
                    <span class="feature-tag">
                        <i class="fas fa-check-circle me-1"></i>
                        {{ $room->room_status->name }}
                    </span>
                    @endif
                </div>
                
                <div class="d-grid gap-2">
                    <a href="{{ route('multitenant.room.details', $room->id) }}" 
                       class="btn-room">
                        <i class="fas fa-eye me-1"></i>
                        Détails
                    </a>
                    
                    <a href="{{ route('multitenant.reservation') }}?room_id={{ $room->id }}" 
                       class="btn-room">
                        <i class="fas fa-calendar-check me-1"></i>
                        Réserver
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    @if($rooms->hasPages())
    <div class="pagination-hotel">
        {{ $rooms->links() }}
    </div>
    @endif
</section>
@else
<section class="container">
    <div class="text-center py-5">
        <i class="fas fa-bed fa-4x mb-4" style="color: #654321;"></i>
        <h3>Aucune chambre trouvée</h3>
        <p class="lead">Aucune chambre ne correspond à vos critères de recherche.</p>
        <a href="{{ route('multitenant.rooms') }}" class="btn-room">
            <i class="fas fa-redo me-2"></i>
            Réinitialiser les filtres
        </a>
    </div>
</section>
@endif
@endsection
