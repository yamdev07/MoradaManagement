@extends('template.master')

@section('title', 'Gestion des Chambres')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

:root {
    /* ── Morada Lodge Palette ── */
    /* BROWN/BEIGE */
    --m50:  #f9f5f0;
    --m100: #f4f1e8;
    --m200: #e8dcc0;
    --m300: #d4b896;
    --m400: #c19a6b;
    --m500: #8b4513;
    --m600: #703610;
    --m700: #5a2b0d;
    --m800: #4a1f08;
    --m900: #3a1504;
    /* BLANC / SURFACE */
    --white:    #ffffff;
    --surface:  #f9f5f0;
    --surface2: #f4f1e8;
    /* GRIS */
    --s50:  #fafafa;
    --s100: #f5f5f5;
    --s200: #e5e5e5;
    --s300: #d4d4d4;
    --s400: #a3a3a3;
    --s500: #737373;
    --s600: #525252;
    --s700: #404040;
    --s800: #262626;
    --s900: #171717;

    --shadow-xs: 0 1px 2px rgba(0,0,0,.04);
    --shadow-sm: 0 1px 6px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --shadow-md: 0 4px 16px rgba(0,0,0,.08), 0 2px 4px rgba(0,0,0,.04);
    --shadow-lg: 0 12px 40px rgba(0,0,0,.10), 0 4px 12px rgba(0,0,0,.05);

    --r:   8px;
    --rl:  14px;
    --rxl: 20px;
    --transition: all .2s cubic-bezier(.4,0,.2,1);
    --font: 'DM Sans', system-ui, sans-serif;
    --mono: 'DM Mono', monospace;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.rooms-page {
    padding: 28px 32px 64px;
    background: var(--surface);
    min-height: 100vh;
    font-family: var(--font);
    color: var(--s800);
}

/* ── Animations ── */
@keyframes fadeSlide {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes scaleIn {
    from { opacity: 0; transform: scale(.96); }
    to   { opacity: 1; transform: scale(1); }
}
.anim-1 { animation: fadeSlide .4s ease both; }
.anim-2 { animation: fadeSlide .4s .08s ease both; }
.anim-3 { animation: fadeSlide .4s .16s ease both; }
.anim-4 { animation: fadeSlide .4s .24s ease both; }
.anim-5 { animation: fadeSlide .4s .32s ease both; }
.anim-6 { animation: fadeSlide .4s .40s ease both; }

/* ══════════════════════════════════════════════
   HEADER
══════════════════════════════════════════════ */
.rooms-header {
    display: flex; align-items: center;
    justify-content: space-between; flex-wrap: wrap;
    gap: 16px; margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 1.5px solid var(--s100);
}
.rooms-brand { display: flex; align-items: center; gap: 14px; }
.rooms-brand-icon {
    width: 48px; height: 48px;
    background: var(--m600); border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 1.1rem; flex-shrink: 0;
    box-shadow: 0 4px 14px rgba(139,69,19,.35);
}
.rooms-header-title {
    font-size: 1.4rem; font-weight: 700;
    color: var(--s900); line-height: 1.2; letter-spacing: -.3px;
}
.rooms-header-title em { font-style: normal; color: var(--m600); }
.rooms-header-sub {
    font-size: .8rem; color: var(--s400); margin-top: 3px;
    display: flex; align-items: center; gap: 8px;
}
.rooms-header-sub i { color: var(--m500); }
.rooms-header-actions { display: flex; align-items: center; gap: 10px; }

/* ══════════════════════════════════════════════
   BOUTONS
══════════════════════════════════════════════ */
.btn-db {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 16px; border-radius: var(--r);
    font-size: .8rem; font-weight: 500; border: none;
    cursor: pointer; transition: var(--transition);
    text-decoration: none; white-space: nowrap; line-height: 1;
    font-family: var(--font);
}
.btn-db-primary {
    background: var(--m600); color: white;
    box-shadow: 0 2px 10px rgba(139,69,19,.3);
}
.btn-db-primary:hover {
    background: var(--m700); color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(139,69,19,.35);
    text-decoration: none;
}
.btn-db-ghost {
    background: var(--white); color: var(--s600);
    border: 1.5px solid var(--s200);
}
.btn-db-ghost:hover {
    background: var(--s50); border-color: var(--s300);
    color: var(--s900); text-decoration: none;
}
.btn-db-icon {
    width: 36px; height: 36px; padding: 0;
    display: inline-flex; align-items: center; justify-content: center;
    border-radius: 8px; font-size: .8rem;
    background: var(--white); color: var(--s400);
    border: 1.5px solid var(--s200); cursor: pointer;
    transition: var(--transition); text-decoration: none;
    font-family: var(--font);
}
.btn-db-icon:hover {
    background: var(--m50); color: var(--m600);
    border-color: var(--m200); transform: translateY(-1px);
}

.btn-db-icon-danger:hover {
    background: #fee2e2; color: #b91c1c;
    border-color: #fecaca;
}

/* ✅ STYLE POUR BOUTON SALE */
.btn-db-icon-warning {
    background: #fff3cd;
    color: #856404;
    border-color: #ffeeba;
}
.btn-db-icon-warning:hover {
    background: #ffe69c;
    color: #856404;
    border-color: #ffc107;
    transform: translateY(-1px);
}

/* ✅ STYLE POUR BOUTON PROPRE */
.btn-db-icon-success {
    background: var(--m50);
    color: var(--m600);
    border-color: var(--m200);
}
.btn-db-icon-success:hover {
    background: var(--m100);
    color: var(--m700);
    border-color: var(--m300);
    transform: translateY(-1px);
}

/* ✅ STYLE POUR BOUTONS DÉSACTIVÉS */
.btn-db-icon:disabled,
.btn-db-icon.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    pointer-events: none;
    background: var(--s100);
    border-color: var(--s200);
    color: var(--s400);
}

.btn-db-icon:disabled:hover,
.btn-db-icon.disabled:hover {
    transform: none;
    box-shadow: none;
    background: var(--s100);
    color: var(--s400);
}

/* ══════════════════════════════════════════════
   STAT CARDS
══════════════════════════════════════════════ */
.stats-grid {
    display: grid; grid-template-columns: repeat(5,1fr);
    gap: 14px; margin-bottom: 24px;
}
@media(max-width:1200px){ .stats-grid{ grid-template-columns:repeat(3,1fr); } }
@media(max-width:768px){ .stats-grid{ grid-template-columns:repeat(2,1fr); } }
@media(max-width:560px) { .stats-grid{ grid-template-columns:1fr; } }

.stat-card {
    background: var(--white); border-radius: var(--rl);
    padding: 22px 20px 18px;
    border: 1.5px solid var(--s100);
    text-decoration: none; display: block;
    position: relative; overflow: hidden;
    transition: var(--transition); box-shadow: var(--shadow-xs);
}
.stat-card:hover {
    transform: translateY(-3px); box-shadow: var(--shadow-md);
    border-color: var(--m200); text-decoration: none;
}
.stat-card::after {
    content: ''; position: absolute;
    bottom: 0; left: 0; right: 0; height: 3px;
    background: var(--bar-c, var(--m400));
    border-radius: 0 0 var(--rl) var(--rl);
}

.stat-card--total { --bar-c: var(--m500); }
.stat-card--available { --bar-c: var(--m600); }
.stat-card--occupied { --bar-c: var(--m300); }
.stat-card--maintenance { --bar-c: var(--s400); }
.stat-card--dirty { --bar-c: #ffc107; }

.stat-card-head { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px; }
.stat-card-icon {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem; flex-shrink: 0;
}
.stat-card--total .stat-card-icon { background: var(--m100); color: var(--m600); }
.stat-card--available .stat-card-icon { background: var(--m50); color: var(--m600); }
.stat-card--occupied .stat-card-icon { background: var(--m50); color: var(--m500); }
.stat-card--maintenance .stat-card-icon { background: var(--s100); color: var(--s500); }
.stat-card--dirty .stat-card-icon { background: #fff3cd; color: #856404; }

.stat-card-value {
    font-size: 2.6rem; font-weight: 700; color: var(--s900);
    line-height: 1; letter-spacing: -1px; margin-bottom: 4px;
    font-family: var(--mono);
}
.stat-card-label { font-size: .8rem; color: var(--s400); margin-bottom: 4px; }
.stat-card-footer {
    display: flex; align-items: center; gap: 5px;
    font-size: .72rem; padding-top: 12px;
    border-top: 1px solid var(--s100); color: var(--s400);
}
.stat-card--total .stat-card-footer { color: var(--m600); }
.stat-card--available .stat-card-footer { color: var(--m600); }
.stat-card--dirty .stat-card-footer { color: #856404; }

/* ══════════════════════════════════════════════
   ALERTES
══════════════════════════════════════════════ */
.alert-modern {
    display: flex; align-items: center; gap: 12px;
.rooms-table tbody tr {
    animation: fadeSlide .3s ease both;
}
.rooms-table tbody tr:nth-child(1) { animation-delay: .02s; }
.rooms-table tbody tr:nth-child(2) { animation-delay: .04s; }
.rooms-table tbody tr:nth-child(3) { animation-delay: .06s; }
.rooms-table tbody tr:nth-child(4) { animation-delay: .08s; }
.rooms-table tbody tr:nth-child(5) { animation-delay: .10s; }

/* ══════════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════════ */
@media(max-width:1200px){
    .stats-grid{ grid-template-columns:repeat(3,1fr); }
}
@media(max-width:768px){
    .rooms-page{ padding: 20px; }
    .rooms-header{ flex-direction: column; align-items: flex-start; }
    .rooms-header__inner{ width: 100%; }
    .stats-grid{ grid-template-columns:repeat(2,1fr); }
    .action-bar{ flex-direction: column; align-items: stretch; }
    .action-right{ max-width: 100%; }
    .rooms-card-header{ flex-direction: column; align-items: flex-start; gap: 10px; }
    .rooms-table{ display: block; overflow-x: auto; }
    .rooms-table td{ padding: 12px; }
    .pagination-wrap{ flex-direction: column; gap: 12px; align-items: flex-start; }
}
@media(max-width:560px){
    .stats-grid{ grid-template-columns:1fr; }
}
</style>

<div class="rooms-page">
    <!-- Header -->
    <div class="rooms-header anim-1">
        <div class="rooms-brand">
            <div class="rooms-brand-icon"><i class="fas fa-bed"></i></div>
            <div>
                <h1 class="rooms-header-title">Gestion des <em>chambres</em></h1>
                <p class="rooms-header-sub">
                    <i class="fas fa-door-open me-1"></i> {{ $rooms->total() }} chambres au total
                    @if($rooms->total() > 0)
                        · Affichage {{ $rooms->firstItem() }}-{{ $rooms->lastItem() }}
                    @endif
                </p>
            </div>
        </div>
        <div class="rooms-header-actions">
            <a href="{{ route('room.create') }}" class="btn-db btn-db-primary">
                <i class="fas fa-plus-circle me-2"></i> Nouvelle chambre
            </a>
        </div>
    </div>

    <!-- Statistiques -->
    @php
        $totalRooms = $rooms->total();
        $availableRooms = $rooms->where('roomStatus.name', 'Available')->count();
        $occupiedRooms = $rooms->where('roomStatus.name', 'Occupied')->count();
        $maintenanceRooms = $rooms->where('roomStatus.name', 'Maintenance')->count();
        $dirtyRooms = $rooms->where('roomStatus.name', 'Dirty')->count();
    @endphp

    <div class="stats-grid anim-2">
        <div class="stat-card stat-card--total">
            <div class="stat-card-head">
                <div class="stat-card-icon"><i class="fas fa-building"></i></div>
            </div>
            <div class="stat-card-value">{{ $totalRooms }}</div>
            <div class="stat-card-label">Total chambres</div>
            <div class="stat-card-footer">
                <i class="fas fa-door-open"></i>
                Capacité totale
            </div>
        </div>

        <div class="stat-card stat-card--available">
            <div class="stat-card-head">
                <div class="stat-card-icon"><i class="fas fa-check-circle"></i></div>
            </div>
            <div class="stat-card-value">{{ $availableRooms }}</div>
            <div class="stat-card-label">Disponibles</div>
            <div class="stat-card-footer">
                <i class="fas fa-door-open"></i>
                Prêtes pour check-in
            </div>
        </div>

        <div class="stat-card stat-card--occupied">
            <div class="stat-card-head">
                <div class="stat-card-icon"><i class="fas fa-user"></i></div>
            </div>
            <div class="stat-card-value">{{ $occupiedRooms }}</div>
            <div class="stat-card-label">Occupées</div>
            <div class="stat-card-footer">
                <i class="fas fa-clock"></i>
                En cours
            </div>
        </div>

        <div class="stat-card stat-card--dirty">
            <div class="stat-card-head">
                <div class="stat-card-icon"><i class="fas fa-broom"></i></div>
            </div>
            <div class="stat-card-value">{{ $dirtyRooms }}</div>
            <div class="stat-card-label">À nettoyer</div>
            <div class="stat-card-footer">
                <i class="fas fa-exclamation-triangle"></i>
                Check-in bloqué
            </div>
        </div>

        <div class="stat-card stat-card--maintenance">
            <div class="stat-card-head">
                <div class="stat-card-icon"><i class="fas fa-tools"></i></div>
            </div>
            <div class="stat-card-value">{{ $maintenanceRooms }}</div>
            <div class="stat-card-label">Maintenance</div>
            <div class="stat-card-footer">
                <i class="fas fa-exclamation-triangle"></i>
                Hors service
            </div>
        </div>
    </div>

    <!-- Alertes -->
    @if(session('success'))
    <div class="alert-modern alert-success anim-2">
        <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
        <span>{{ session('success') }}</span>
        <button class="alert-close" onclick="this.parentElement.remove()">×</button>
    </div>
    @endif

    @if(session('failed'))
    <div class="alert-modern alert-danger anim-2">
        <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
        <span>{{ session('failed') }}</span>
        <button class="alert-close" onclick="this.parentElement.remove()">×</button>
    </div>
    @endif

    <!-- Action Bar -->
    <div class="action-bar anim-3">
        <div class="action-left">
            <span class="filter-badge">
                <i class="fas fa-bed"></i>
                Toutes les chambres
                <span class="badge-count">{{ $rooms->total() }}</span>
            </span>
        </div>
        
        <div class="action-right">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" 
                       class="search-input" 
                       id="searchInput"
                       placeholder="Rechercher par numéro, nom ou type..." 
                       autocomplete="off">
            </div>
        </div>
    </div>

    <!-- Tableau des chambres -->
    <div class="rooms-card anim-4">
        <div class="rooms-card-header">
            <h5 class="rooms-card-title">
                <i class="fas fa-door-open"></i>
                Liste des chambres
            </h5>
            <span class="rooms-card-badge">
                <i class="fas fa-list"></i>
                {{ $rooms->total() }} entrées
            </span>
        </div>
        <div class="rooms-card-body">
            <div style="overflow-x:auto;">
                <table class="rooms-table" id="roomsTable">
                    <thead>
                        <tr>
                            <th>N° Chambre</th>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Capacité</th>
                            <th>Prix (FCFA)</th>
                            <th>Statut</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                        @php
                            // Définir les conditions pour les boutons
                            $isDirty = $room->roomStatus->name == 'Dirty' || $room->room_status_id == 6;
                            $isOccupied = $room->roomStatus->name == 'Occupied' || $room->room_status_id == 2;
                            $isMaintenance = $room->roomStatus->name == 'Maintenance' || $room->room_status_id == 3;
                            $isAvailable = $room->roomStatus->name == 'Available' || $room->room_status_id == 1;
                            
                            $canMarkDirty = !$isDirty && !$isOccupied && !$isMaintenance;
                            $canMarkClean = $isDirty;
                            $canDelete = !$isOccupied && (auth()->user()->role === 'Super' || auth()->user()->role === 'Admin');
                        @endphp
                        <tr>
                            <td>
                                <span class="room-num">{{ $room->number }}</span>
                            </td>
                            <td>
                                <div>
                                    <div class="room-name">
                                        {{ $room->display_name ?? $room->getNameOrNumber() }}
                                    </div>
                                    @if($room->name && $room->name !== $room->display_name)
                                    <div class="room-meta">
                                        <i class="fas fa-tag"></i>
                                        {{ $room->name }}
                                    </div>
                                    @endif
                                    @if($room->view)
                                    <div class="room-meta">
                                        <i class="fas fa-mountain"></i>
                                        {{ $room->view }}
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="room-type">{{ $room->type->name ?? 'Standard' }}</div>
                                    @if($room->type && $room->type->base_price)
                                    <div class="room-type__base">
                                        Base: {{ number_format($room->type->base_price, 0, ',', ' ') }} FCFA
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="room-capacity">
                                    <i class="fas fa-users"></i>
                                    <span>{{ $room->capacity }} personne(s)</span>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="room-price">{{ number_format($room->price, 0, ',', ' ') }} FCFA</div>
                                    @if($room->price > 0)
                                    <div class="room-price__eur">
                                        ≈ €{{ number_format($room->price / 655, 2, ',', ' ') }}
                                    </div>
                                    @if($room->type && $room->type->base_price && $room->price != $room->type->base_price)
                                    <div class="room-price__custom">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Prix personnalisé
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            </td>
                            <td>
                                @php
                                    $statusColor = match($room->roomStatus->name ?? '') {
                                        'Available' => 'success',
                                        'Occupied' => 'warning',
                                        'Maintenance' => 'danger',
                                        'Dirty' => 'info',
                                        default => 'gray'
                                    };
                                @endphp
                                <span class="badge badge--{{ $statusColor }}">
                                    <i class="{{ $room->status_icon ?? 'fa-door-closed' }}"></i>
                                    {{ $room->roomStatus->name ?? 'Inconnu' }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 6px; justify-content: center; flex-wrap: wrap;">
                                    <!-- Bouton Voir (toujours actif) -->
                                    <a href="{{ route('room.show', $room->id) }}" 
                                       class="btn-db-icon" 
                                       title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <!-- Bouton Modifier (toujours actif) -->
                                    <a href="{{ route('room.edit', $room->id) }}" 
                                       class="btn-db-icon" 
                                       title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    @if(in_array(auth()->user()->role, ['Super', 'Admin', 'Housekeeping']))
                                        <!-- ✅ BOUTON MARQUER COMME SALE -->
                                        @if($canMarkDirty)
                                            <form method="POST" 
                                                  action="{{ route('room.mark-dirty', $room->id) }}"
                                                  style="display:inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="btn-db-icon btn-db-icon-warning"
                                                        title="Marquer comme sale"
                                                        onclick="return confirm('Marquer la chambre {{ $room->number }} comme sale ?')">
                                                    <i class="fas fa-broom"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn-db-icon" disabled
                                                    title="{{ $isDirty ? 'Déjà sale' : ($isOccupied ? 'Chambre occupée' : 'Action non disponible') }}">
                                                <i class="fas fa-broom"></i>
                                            </button>
                                        @endif

                                        <!-- ✅ BOUTON MARQUER COMME PROPRE -->
                                        @if($canMarkClean)
                                            <form method="POST" 
                                                  action="{{ route('room.mark-clean', $room->id) }}"
                                                  style="display:inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="btn-db-icon btn-db-icon-success"
                                                        title="Marquer comme propre"
                                                        onclick="return confirm('Marquer la chambre {{ $room->number }} comme propre ?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn-db-icon" disabled
                                                    title="{{ !$isDirty ? 'Pas besoin de nettoyage' : 'Action non disponible' }}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif
                                    @endif
                                    
                                    <!-- Bouton Supprimer (Super/Admin uniquement) -->
                                    @if(auth()->user()->role === 'Super' || auth()->user()->role === 'Admin')
                                        @if($canDelete)
                                            <form method="POST" 
                                                  action="{{ route('room.destroy', $room->id) }}"
                                                  style="display:inline"
                                                  onsubmit="return confirm('Supprimer la chambre {{ $room->number }} ? Cette action est irréversible.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn-db-icon btn-db-icon-danger"
                                                        title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn-db-icon btn-db-icon-danger" disabled
                                                    title="Impossible de supprimer une chambre occupée">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-door-closed"></i>
                                    </div>
                                    <p class="empty-title">Aucune chambre trouvée</p>
                                    <p class="empty-text">Vous n'avez pas encore ajouté de chambres.</p>
                                    <a href="{{ route('room.create') }}" class="btn-db btn-db-primary">
                                        <i class="fas fa-plus-circle me-2"></i>
                                        Ajouter une chambre
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($rooms->hasPages())
            <div class="pagination-wrap">
                <div class="pagination-info">
                    Affichage de {{ $rooms->firstItem() }} à {{ $rooms->lastItem() }} sur {{ $rooms->total() }} entrées
                </div>
                <div>
                    {{ $rooms->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Auto-hide alerts after 5 seconds
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert-modern');
    alerts.forEach(alert => {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    });
}, 5000);

// Search functionality
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('roomsTable');
    const rows = table.querySelectorAll('tbody tr');
    
    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        rows.forEach(row => {
            const roomNumber = row.querySelector('.room-num')?.textContent.toLowerCase() || '';
            const roomName = row.querySelector('.room-name')?.textContent.toLowerCase() || '';
            const roomType = row.querySelector('.room-type')?.textContent.toLowerCase() || '';
            const status = row.querySelector('.badge')?.textContent.toLowerCase() || '';
            
            if (roomNumber.includes(searchTerm) || 
                roomName.includes(searchTerm) || 
                roomType.includes(searchTerm) || 
                status.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        // Show empty message if all rows hidden
        const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
        const emptyRow = table.querySelector('tbody tr:last-child');
        
        if (visibleRows.length === 0 && rows.length > 0) {
            if (!emptyRow || !emptyRow.querySelector('.empty-state')) {
                const newEmptyRow = document.createElement('tr');
                newEmptyRow.innerHTML = `
                    <td colspan="7">
                        <div class="empty-state" style="padding: 40px 20px;">
                            <div class="empty-icon"><i class="fas fa-search"></i></div>
                            <p class="empty-title">Aucun résultat</p>
                            <p class="empty-text">Aucune chambre ne correspond à votre recherche</p>
                        </div>
                    </td>
                `;
                table.querySelector('tbody').appendChild(newEmptyRow);
            }
        } else {
            if (emptyRow && emptyRow.querySelector('.empty-state')) {
                emptyRow.remove();
            }
        }
    });
});
</script>
@endpush