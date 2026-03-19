@extends('template.master')

@section('title', 'Dashboard Femmes de Chambre')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<style>
:root {
    --bg:       #f5f8fa;
    --surf:     #ffffff;
    --surf2:    #f1f5f9;
    --brd:      #e2e8f0;
    --brd2:     #cbd5e1;
    --txt:      #0f172a;
    --txt2:     #475569;
    --txt3:     #94a3b8;
    
    --red:      #654321;
    --red-dim:  rgba(101,67,33,.15);
    --ora:      #f97316;
    --ora-dim:  rgba(249,115,22,.15);
    --yel:      #eab308;
    --yel-dim:  rgba(234,179,8,.15);
    --grn:      #cd853f;
    --grn-dim:  rgba(205,133,63,.15);
    --blue:     #cd853f;
    --blue-dim: rgba(59,130,246,.15);
    --cyan:     #06b6d4;
    --cyan-dim: rgba(6,182,212,.15);
    --purple:   #cd853f;
    --purple-dim: rgba(139,92,246,.15);
    --gray:     #64748b;
    --gray-dim: rgba(100,116,139,.15);
    
    --r: 12px;
}

*, *::before, *::after { box-sizing: border-box; margin:0; padding:0; }
body {
    background: var(--bg);
    color: var(--txt);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    line-height: 1.6;
}

/* ══════════════════════════════════════
   HEADER
══════════════════════════════════════ */
.hk-header {
    background: var(--surf);
    border-bottom: 1px solid var(--brd);
    padding: 20px 28px;
    margin-bottom: 24px;
}
.hk-header__inner {
    max-width: 1800px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}
.hk-header__title h1 {
    font-size: 24px;
    font-weight: 800;
    letter-spacing: -.5px;
    margin-bottom: 4px;
}
.hk-header__title p {
    font-size: 13px;
    color: var(--txt3);
}
.hk-header__actions {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* ══════════════════════════════════════
   BUTTONS
══════════════════════════════════════ */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    border: 1px solid;
    text-decoration: none;
    transition: all .15s;
    cursor: pointer;
    white-space: nowrap;
}
.btn--primary {
    background: var(--blue);
    border-color: var(--blue);
    color: white;
}
.btn--primary:hover {
    background: #cd853f;
    border-color: #cd853f;
    color: white;
    transform: translateY(-1px);
}
.btn--outline {
    background: transparent;
    border-color: var(--brd2);
    color: var(--txt2);
}
.btn--outline:hover {
    background: var(--surf2);
    border-color: var(--brd2);
    color: var(--txt);
}
.btn i { font-size: 14px; }

/* ══════════════════════════════════════
   MAIN CONTAINER
══════════════════════════════════════ */
.hk-container {
    max-width: 1800px;
    margin: 0 auto;
    padding: 0 28px 48px;
}

/* ══════════════════════════════════════
   KPI STRIP
══════════════════════════════════════ */
.kpi-strip {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 12px;
    margin-bottom: 24px;
}
.kpi-card {
    background: var(--surf);
    border: 1px solid var(--brd);
    border-radius: var(--r);
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all .2s;
}
.kpi-card:hover {
    border-color: var(--brd2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,.06);
}
.kpi-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}
.kpi-label {
    font-size: 11px;
    font-weight: 600;
    color: var(--txt3);
    text-transform: uppercase;
    letter-spacing: .4px;
}
.kpi-value {
    font-size: 26px;
    font-weight: 800;
    letter-spacing: -.7px;
    line-height: 1;
    margin-top: 2px;
}

/* ══════════════════════════════════════
   LAYOUT GRID
══════════════════════════════════════ */
.hk-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 20px;
}

/* ══════════════════════════════════════
   CARDS
══════════════════════════════════════ */
.card {
    background: var(--surf);
    border: 1px solid var(--brd);
    border-radius: var(--r);
    overflow: hidden;
    margin-bottom: 20px;
}
.card__head {
    padding: 14px 20px;
    border-bottom: 1px solid var(--brd);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}
.card__title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 700;
    font-size: 14px;
    color: var(--txt);
}
.card__title i { font-size: 15px; }
.card__badge {
    flex-shrink: 0;
}
.card__body {
    padding: 20px;
}

/* Color variants */
.card__head--red    { background: linear-gradient(135deg, var(--red), #4d3319); color: white; border-bottom: none; }
.card__head--orange { background: linear-gradient(135deg, var(--ora), #ea580c); color: white; border-bottom: none; }
.card__head--yellow { background: linear-gradient(135deg, var(--yel), #ca8a04); color: white; border-bottom: none; }
.card__head--green  { background: linear-gradient(135deg, var(--grn), #b87333); color: white; border-bottom: none; }
.card__head--blue   { background: linear-gradient(135deg, var(--blue), #cd853f); color: white; border-bottom: none; }
.card__head--cyan   { background: linear-gradient(135deg, var(--cyan), #0891b2); color: white; border-bottom: none; }
.card__head--purple { background: linear-gradient(135deg, var(--purple), #cd853f); color: white; border-bottom: none; }
.card__head--gray   { background: linear-gradient(135deg, var(--gray), #475569); color: white; border-bottom: none; }

/* ══════════════════════════════════════
   ROOM CARDS GRID
══════════════════════════════════════ */
.room-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
}
.room-card {
    background: var(--surf);
    border: 1px solid;
    border-radius: 10px;
    padding: 14px;
    transition: all .15s;
    cursor: pointer;
}
.room-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}
.room-card__head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}
.room-card__num {
    font-size: 16px;
    font-weight: 800;
    letter-spacing: -.3px;
}
.room-card__badge {
    width: 28px;
    height: 28px;
    border-radius: 7px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
}
.room-card__type {
    font-size: 11px;
    color: var(--txt3);
    margin-bottom: 12px;
}
.room-card__type i {
    font-size: 10px;
    margin-right: 4px;
}

/* Room variants */
.room-card--red {
    border-color: rgba(101,67,33,.3);
}
.room-card--red:hover {
    border-color: var(--red);
}
.room-card--red .room-card__num {
    color: var(--red);
}
.room-card--red .room-card__badge {
    background: var(--red-dim);
    color: var(--red);
}

/* ══════════════════════════════════════
   TABLE
══════════════════════════════════════ */
.tbl {
    width: 100%;
    border-collapse: collapse;
}
.tbl th {
    padding: 8px 10px;
    font-size: 11px;
    font-weight: 600;
    color: var(--txt3);
    text-transform: uppercase;
    letter-spacing: .4px;
    text-align: left;
    border-bottom: 1px solid var(--brd);
}
.tbl td {
    padding: 10px 10px;
    font-size: 13px;
    border-bottom: 1px solid rgba(0,0,0,.03);
    vertical-align: middle;
}
.tbl tr:last-child td {
    border-bottom: none;
}
.tbl tr:hover {
    background: rgba(0,0,0,.01);
}

/* ══════════════════════════════════════
   BADGES
══════════════════════════════════════ */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}
.badge--red    { background: var(--red-dim); color: var(--red); }
.badge--orange { background: var(--ora-dim); color: var(--ora); }
.badge--yellow { background: var(--yel-dim); color: var(--yel); }
.badge--green  { background: var(--grn-dim); color: var(--grn); }
.badge--blue   { background: var(--blue-dim); color: var(--blue); }
.badge--cyan   { background: var(--cyan-dim); color: var(--cyan); }
.badge--purple { background: var(--purple-dim); color: var(--purple); }
.badge--gray   { background: var(--gray-dim); color: var(--gray); }
.badge--light  { background: var(--surf2); color: var(--txt2); }

/* ══════════════════════════════════════
   MINI BUTTONS
══════════════════════════════════════ */
.btn-mini {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    border: 1px solid;
    text-decoration: none;
    transition: all .14s;
    cursor: pointer;
    white-space: nowrap;
}
.btn-mini--red {
    background: var(--red-dim);
    border-color: rgba(101,67,33,.3);
    color: var(--red);
}
.btn-mini--red:hover {
    background: rgba(101,67,33,.25);
    border-color: var(--red);
    color: var(--red);
}
.btn-mini--green {
    background: var(--grn-dim);
    border-color: rgba(205,133,63,.3);
    color: var(--grn);
}
.btn-mini--green:hover {
    background: rgba(205,133,63,.25);
    border-color: var(--grn);
    color: var(--grn);
}
.btn-mini--blue {
    background: var(--blue-dim);
    border-color: rgba(59,130,246,.3);
    color: var(--blue);
}
.btn-mini--blue:hover {
    background: rgba(59,130,246,.25);
    border-color: var(--blue);
    color: var(--blue);
}
.btn-mini--cyan {
    background: var(--cyan-dim);
    border-color: rgba(6,182,212,.3);
    color: var(--cyan);
}
.btn-mini--cyan:hover {
    background: rgba(6,182,212,.25);
    border-color: var(--cyan);
    color: var(--cyan);
}
.btn-mini--light {
    background: var(--surf);
    border-color: var(--brd);
    color: var(--txt2);
}
.btn-mini--light:hover {
    background: var(--surf2);
    border-color: var(--brd2);
    color: var(--txt);
}

/* ══════════════════════════════════════
   ALERT
══════════════════════════════════════ */
.alert {
    padding: 16px;
    border-radius: 10px;
    border: 1px solid;
    display: flex;
    align-items: center;
    gap: 12px;
}
.alert--green {
    background: var(--grn-dim);
    border-color: rgba(205,133,63,.3);
    color: var(--grn);
}
.alert__icon {
    font-size: 28px;
    flex-shrink: 0;
}
.alert__content h6 {
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 4px;
}
.alert__content p {
    font-size: 13px;
    margin: 0;
}

/* ══════════════════════════════════════
   EMPTY STATE
══════════════════════════════════════ */
.empty {
    padding: 48px 20px;
    text-align: center;
    color: var(--txt3);
}
.empty i {
    font-size: 40px;
    margin-bottom: 16px;
    opacity: .4;
}
.empty h6 {
    font-size: 15px;
    font-weight: 700;
    color: var(--txt2);
    margin-bottom: 4px;
}
.empty p {
    font-size: 13px;
}

/* ══════════════════════════════════════
   QUICK NAV
══════════════════════════════════════ */
.quick-nav {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 12px;
}
.quick-nav__btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px 12px;
    border-radius: 10px;
    background: var(--surf);
    border: 1px solid var(--brd);
    text-decoration: none;
    transition: all .15s;
    min-height: 110px;
    cursor: pointer;
}
.quick-nav__btn:hover {
    border-color: var(--brd2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}
.quick-nav__icon {
    font-size: 28px;
    margin-bottom: 10px;
}
.quick-nav__label {
    font-size: 13px;
    font-weight: 700;
    color: var(--txt);
    margin-bottom: 4px;
}
.quick-nav__count {
    font-size: 11px;
    color: var(--txt3);
}

/* Color variants */
.quick-nav__btn--red .quick-nav__icon { color: var(--red); }
.quick-nav__btn--red:hover { background: var(--red-dim); border-color: var(--red); }

.quick-nav__btn--yellow .quick-nav__icon { color: var(--yel); }
.quick-nav__btn--yellow:hover { background: var(--yel-dim); border-color: var(--yel); }

.quick-nav__btn--green .quick-nav__icon { color: var(--grn); }
.quick-nav__btn--green:hover { background: var(--grn-dim); border-color: var(--grn); }

.quick-nav__btn--cyan .quick-nav__icon { color: var(--cyan); }
.quick-nav__btn--cyan:hover { background: var(--cyan-dim); border-color: var(--cyan); }

.quick-nav__btn--purple .quick-nav__icon { color: var(--purple); }
.quick-nav__btn--purple:hover { background: var(--purple-dim); border-color: var(--purple); }

.quick-nav__btn--blue .quick-nav__icon { color: var(--blue); }
.quick-nav__btn--blue:hover { background: var(--blue-dim); border-color: var(--blue); }

/* ══════════════════════════════════════
   MODAL OVERRIDES
══════════════════════════════════════ */
.modal-content {
    border: none;
    border-radius: 12px;
    box-shadow: 0 20px 60px rgba(0,0,0,.2);
}
.modal-header {
    border-bottom: 1px solid var(--brd);
    padding: 18px 24px;
}
.modal-title {
    font-weight: 700;
    font-size: 16px;
}
.modal-body {
    padding: 24px;
}
.modal-footer {
    border-top: 1px solid var(--brd);
    padding: 16px 24px;
}

/* Form elements */
.form-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--txt2);
    margin-bottom: 6px;
}
.form-control,
.form-select {
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid var(--brd2);
    font-size: 13px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all .15s;
}
.form-control:focus,
.form-select:focus {
    outline: none;
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(59,130,246,.1);
}

/* ══════════════════════════════════════
   ANIMATIONS
══════════════════════════════════════ */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.kpi-card { animation: fadeIn .3s ease both; }
.kpi-card:nth-child(1) { animation-delay: .05s; }
.kpi-card:nth-child(2) { animation-delay: .10s; }
.kpi-card:nth-child(3) { animation-delay: .15s; }
.kpi-card:nth-child(4) { animation-delay: .20s; }
.kpi-card:nth-child(5) { animation-delay: .25s; }
.kpi-card:nth-child(6) { animation-delay: .30s; }

/* ══════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════ */
@media (max-width: 1400px) {
    .kpi-strip { grid-template-columns: repeat(3, 1fr); }
    .quick-nav { grid-template-columns: repeat(3, 1fr); }
}

@media (max-width: 1024px) {
    .hk-grid { grid-template-columns: 1fr; }
    .room-grid { grid-template-columns: repeat(3, 1fr); }
}

@media (max-width: 768px) {
    .hk-header { padding: 16px 20px; }
    .hk-header__inner { flex-direction: column; align-items: flex-start; }
    .hk-header__actions { width: 100%; justify-content: space-between; }
    .hk-container { padding: 0 20px 40px; }
    .kpi-strip { grid-template-columns: repeat(2, 1fr); gap: 10px; }
    .room-grid { grid-template-columns: repeat(2, 1fr); }
    .quick-nav { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 480px) {
    .kpi-strip { grid-template-columns: 1fr; }
    .room-grid { grid-template-columns: 1fr; }
    .quick-nav { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════
     HEADER
══════════════════════════════════════ --}}
<div class="hk-header">
    <div class="hk-header__inner">
        <div class="hk-header__title">
            <h1>Dashboard Femmes de Chambre</h1>
            <p>Gestion du nettoyage et maintenance des chambres</p>
        </div>
        <div class="hk-header__actions">
            <a href="{{ route('housekeeping.mobile') }}" class="btn btn--outline">
                <i class="fas fa-mobile-alt"></i>
                Vue Mobile
            </a>
            <a href="{{ route('housekeeping.daily-report') }}" class="btn btn--primary">
                <i class="fas fa-file-alt"></i>
                Rapport Quotidien
            </a>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════
     MAIN CONTAINER
══════════════════════════════════════ --}}
<div class="hk-container">

    {{-- KPI STRIP --}}
    <div class="kpi-strip">
        <div class="kpi-card">
            <div class="kpi-icon" style="background:var(--gray-dim);color:var(--gray)">
                <i class="fas fa-bed"></i>
            </div>
            <div>
                <div class="kpi-label">Total</div>
                <div class="kpi-value">{{ $stats['total_rooms'] }}</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon" style="background:var(--red-dim);color:var(--red)">
                <i class="fas fa-broom"></i>
            </div>
            <div>
                <div class="kpi-label">À nettoyer</div>
                <div class="kpi-value" style="color:var(--red)">{{ $stats['dirty_rooms'] }}</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon" style="background:var(--yel-dim);color:var(--yel)">
                <i class="fas fa-spinner"></i>
            </div>
            <div>
                <div class="kpi-label">En nettoyage</div>
                <div class="kpi-value" style="color:var(--yel)">{{ $stats['cleaning_rooms'] }}</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon" style="background:var(--grn-dim);color:var(--grn)">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <div class="kpi-label">Nettoyées</div>
                <div class="kpi-value" style="color:var(--grn)">{{ $stats['clean_rooms'] }}</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon" style="background:var(--cyan-dim);color:var(--cyan)">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <div class="kpi-label">Occupées</div>
                <div class="kpi-value" style="color:var(--cyan)">{{ $stats['occupied_rooms'] }}</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon" style="background:var(--purple-dim);color:var(--purple)">
                <i class="fas fa-tools"></i>
            </div>
            <div>
                <div class="kpi-label">Maintenance</div>
                <div class="kpi-value" style="color:var(--purple)">{{ $stats['maintenance_rooms'] }}</div>
            </div>
        </div>
    </div>

    {{-- MAIN GRID --}}
    <div class="hk-grid">

        {{-- LEFT COLUMN --}}
        <div>

            {{-- Chambres à nettoyer --}}
            <div class="card">
                <div class="card__head card__head--red">
                    <div class="card__title">
                        <i class="fas fa-broom"></i>
                        Chambres à nettoyer
                    </div>
                    <div class="card__badge">
                        <span class="badge badge--light">{{ $roomsByStatus['dirty']->count() }}</span>
                        <a href="{{ route('housekeeping.to-clean') }}" class="btn-mini btn-mini--light" style="margin-left:8px">
                            <i class="fas fa-list"></i> Tout voir
                        </a>
                    </div>
                </div>
                <div class="card__body">
                    @if($roomsByStatus['dirty']->count() > 0)
                    <div class="room-grid">
                        @foreach($roomsByStatus['dirty']->take(12) as $room)
                        <div class="room-card room-card--red">
                            <div class="room-card__head">
                                <div class="room-card__num">Ch. {{ $room->number }}</div>
                                <div class="room-card__badge">
                                    <i class="fas fa-broom"></i>
                                </div>
                            </div>
                            <div class="room-card__type">
                                <i class="fas fa-layer-group"></i>
                                {{ $room->type->name ?? 'Standard' }}
                            </div>
                            <button class="btn-mini btn-mini--red w-100" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#startCleaningModal{{ $room->id }}"
                                    style="width:100%">
                                Démarrer nettoyage
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @if($roomsByStatus['dirty']->count() > 12)
                    <div style="text-align:center;margin-top:16px">
                        <a href="{{ route('housekeeping.to-clean') }}" class="btn-mini btn-mini--red">
                            Voir les {{ $roomsByStatus['dirty']->count() - 12 }} autres
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    @endif
                    @else
                    <div class="empty">
                        <i class="fas fa-check-circle" style="color:var(--grn)"></i>
                        <h6>Aucune chambre à nettoyer</h6>
                        <p>Toutes les chambres sont propres</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Chambres en nettoyage --}}
            <div class="card">
                <div class="card__head card__head--yellow">
                    <div class="card__title">
                        <i class="fas fa-spinner"></i>
                        En cours de nettoyage
                    </div>
                    <div class="card__badge">
                        <span class="badge badge--light">{{ $roomsByStatus['cleaning']->count() }}</span>
                        <a href="{{ route('housekeeping.quick-list', 'cleaning') }}" class="btn-mini btn-mini--light" style="margin-left:8px">
                            <i class="fas fa-list"></i> Tout voir
                        </a>
                    </div>
                </div>
                <div class="card__body">
                    @if($roomsByStatus['cleaning']->count() > 0)
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>Chambre</th>
                                <th>Type</th>
                                <th>Démarré à</th>
                                <th>Durée</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roomsByStatus['cleaning']->take(10) as $room)
                            <tr>
                                <td><span class="badge badge--yellow">{{ $room->number }}</span></td>
                                <td>{{ $room->type->name ?? 'Standard' }}</td>
                                <td>
                                    @if($room->cleaning_started_at)
                                        <span style="font-family:'IBM Plex Mono',monospace;font-size:12px">
                                            {{ $room->cleaning_started_at->format('H:i') }}
                                        </span>
                                    @else
                                        <span style="color:var(--txt3)">N/A</span>
                                    @endif
                                </td>
                                <td style="color:var(--txt3);font-size:12px">
                                    @if($room->cleaning_started_at)
                                        {{ now()->diffForHumans($room->cleaning_started_at, true) }}
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('housekeeping.finish-cleaning', $room->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" class="btn-mini btn-mini--green">
                                            <i class="fas fa-check"></i> Terminer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="empty">
                        <i class="fas fa-clock"></i>
                        <h6>Aucune chambre en nettoyage</h6>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Chambres nettoyées aujourd'hui --}}
            <div class="card">
                <div class="card__head card__head--green">
                    <div class="card__title">
                        <i class="fas fa-check-circle"></i>
                        Chambres nettoyées aujourd'hui
                    </div>
                    <div class="card__badge">
                        <span class="badge badge--light">{{ now()->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="card__body">
                    <div class="alert alert--green">
                        <div class="alert__icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="alert__content">
                            <h6>Excellent travail !</h6>
                            <p>
                                Vous avez nettoyé <strong>{{ $stats['cleaned_today'] }}</strong> chambres aujourd'hui.
                                @if($stats['cleaned_today'] > 0)
                                    Continuez comme ça !
                                @else
                                    Commencez par les chambres à nettoyer.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN --}}
        <div>

            {{-- Départs du jour --}}
            <div class="card">
                <div class="card__head card__head--cyan">
                    <div class="card__title">
                        <i class="fas fa-sign-out-alt"></i>
                        Départs aujourd'hui
                    </div>
                    <div class="card__badge">
                        <span class="badge badge--light">{{ $todayDepartures->count() }}</span>
                    </div>
                </div>
                <div class="card__body">
                    @if($todayDepartures->count() > 0)
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>Chambre</th>
                                <th>Client</th>
                                <th>Départ (12h)</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todayDepartures->take(5) as $departure)
                            @php
                                $now = \Carbon\Carbon::now();
                                $checkOutDate = \Carbon\Carbon::parse($departure->check_out);
                                $checkOutTime = $checkOutDate->copy()->setTime(12, 0, 0);
                                $checkOutLargess = $checkOutDate->copy()->setTime(14, 0, 0);
                                
                                $isInLargess = $now->gte($checkOutTime) && $now->lte($checkOutLargess);
                                $isLate = $now->gt($checkOutLargess);
                            @endphp
                            <tr>
                                <td><span class="badge badge--cyan">{{ $departure->room->number }}</span></td>
                                <td>
                                    <div style="max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                        {{ $departure->customer->name }}
                                    </div>
                                </td>
                                <td>
                                    <span style="font-family:'IBM Plex Mono',monospace;font-size:12px;font-weight:600">
                                        12:00
                                    </span>
                                </td>
                                <td>
                                    @if($isLate)
                                        <span class="badge badge--red" style="background:var(--red-dim);color:var(--red)">
                                            <i class="fas fa-exclamation-triangle"></i> Dépassé
                                        </span>
                                    @elseif($isInLargess)
                                        <span class="badge badge--green" style="background:var(--grn-dim);color:var(--grn)">
                                            <i class="fas fa-clock"></i> Largesse (jusqu'à 14h)
                                        </span>
                                    @else
                                        <span class="badge badge--light">
                                            <i class="fas fa-hourglass-start"></i> À venir
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($todayDepartures->count() > 5)
                    <div style="text-align:center;margin-top:12px">
                        <button class="btn-mini btn-mini--cyan">
                            Voir les {{ $todayDepartures->count() - 5 }} autres
                        </button>
                    </div>
                    @endif
                    @else
                    <div class="empty" style="padding:32px 20px">
                        <i class="fas fa-calendar-check" style="font-size:32px"></i>
                        <h6>Aucun départ aujourd'hui</h6>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Arrivées du jour --}}
            <div class="card">
                <div class="card__head card__head--blue">
                    <div class="card__title">
                        <i class="fas fa-sign-in-alt"></i>
                        Arrivées aujourd'hui
                    </div>
                    <div class="card__badge">
                        <span class="badge badge--light">{{ $todayArrivals->count() }}</span>
                    </div>
                </div>
                <div class="card__body">
                    @if($todayArrivals->count() > 0)
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>Chambre</th>
                                <th>Client</th>
                                <th>Arrivée (12h)</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todayArrivals->take(5) as $arrival)
                            @php
                                $now = \Carbon\Carbon::now();
                                $checkInDate = \Carbon\Carbon::parse($arrival->check_in);
                                $checkInTime = $checkInDate->copy()->setTime(12, 0, 0); // 12h pour les arrivées
                                
                                $canCheckin = $now->gte($checkInTime);
                                $isEarly = $now->lt($checkInTime);
                            @endphp
                            <tr>
                                <td><span class="badge badge--blue">{{ $arrival->room->number }}</span></td>
                                <td>
                                    <div style="max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                        {{ $arrival->customer->name }}
                                    </div>
                                </td>
                                <td>
                                    <span style="font-family:'IBM Plex Mono',monospace;font-size:12px;font-weight:600">
                                        12:00
                                    </span>
                                </td>
                                <td>
                                    @if($canCheckin)
                                        <span class="badge badge--green" style="background:var(--grn-dim);color:var(--grn)">
                                            <i class="fas fa-check-circle"></i> Prêt pour check-in
                                        </span>
                                    @else
                                        <span class="badge badge--light">
                                            <i class="fas fa-clock"></i> À partir de 12h
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($todayArrivals->count() > 5)
                    <div style="text-align:center;margin-top:12px">
                        <button class="btn-mini btn-mini--blue">
                            Voir les {{ $todayArrivals->count() - 5 }} autres
                        </button>
                    </div>
                    @endif
                    @else
                    <div class="empty" style="padding:32px 20px">
                        <i class="fas fa-calendar-times" style="font-size:32px"></i>
                        <h6>Aucune arrivée aujourd'hui</h6>
                    </div>
                    @endif
                </div>
            </div>
            {{-- Actions rapides --}}
            <div class="card">
                <div class="card__head card__head--gray">
                    <div class="card__title">
                        <i class="fas fa-bolt"></i>
                        Actions rapides
                    </div>
                </div>
                <div class="card__body">
                    <div style="display:grid;gap:8px">
                        <a href="{{ route('housekeeping.scan') }}" class="btn-mini btn-mini--blue w-100" style="justify-content:center">
                            <i class="fas fa-qrcode"></i>
                            Scanner QR Code
                        </a>
                        <a href="{{ route('housekeeping.mobile') }}" class="btn-mini btn-mini--cyan w-100" style="justify-content:center">
                            <i class="fas fa-mobile-alt"></i>
                            Vue Mobile
                        </a>
                        <a href="{{ route('housekeeping.reports') }}" class="btn-mini btn-mini--green w-100" style="justify-content:center">
                            <i class="fas fa-chart-bar"></i>
                            Rapports
                        </a>
                        <button class="btn-mini btn-mini--light w-100" data-bs-toggle="modal" data-bs-target="#maintenanceModal" style="justify-content:center">
                            <i class="fas fa-tools"></i>
                            Signaler Maintenance
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- QUICK NAV --}}
    <div class="card" style="margin-bottom:0">
        <div class="card__head card__head--gray">
            <div class="card__title">
                <i class="fas fa-th"></i>
                Navigation rapide
            </div>
        </div>
        <div class="card__body">
            <div class="quick-nav">
                <a href="{{ route('housekeeping.to-clean') }}" class="quick-nav__btn quick-nav__btn--red">
                    <div class="quick-nav__icon"><i class="fas fa-broom"></i></div>
                    <div class="quick-nav__label">À nettoyer</div>
                    <div class="quick-nav__count">{{ $stats['dirty_rooms'] }} chambres</div>
                </a>
                <a href="{{ route('housekeeping.quick-list', 'cleaning') }}" class="quick-nav__btn quick-nav__btn--yellow">
                    <div class="quick-nav__icon"><i class="fas fa-spinner"></i></div>
                    <div class="quick-nav__label">En nettoyage</div>
                    <div class="quick-nav__count">{{ $stats['cleaning_rooms'] }} chambres</div>
                </a>
                <a href="{{ route('housekeeping.quick-list', 'clean') }}" class="quick-nav__btn quick-nav__btn--green">
                    <div class="quick-nav__icon"><i class="fas fa-check-circle"></i></div>
                    <div class="quick-nav__label">Nettoyées</div>
                    <div class="quick-nav__count">{{ $stats['clean_rooms'] }} chambres</div>
                </a>
                <a href="{{ route('housekeeping.quick-list', 'occupied') }}" class="quick-nav__btn quick-nav__btn--cyan">
                    <div class="quick-nav__icon"><i class="fas fa-users"></i></div>
                    <div class="quick-nav__label">Occupées</div>
                    <div class="quick-nav__count">{{ $stats['occupied_rooms'] }} chambres</div>
                </a>
                <a href="{{ route('housekeeping.maintenance') }}" class="quick-nav__btn quick-nav__btn--purple">
                    <div class="quick-nav__icon"><i class="fas fa-tools"></i></div>
                    <div class="quick-nav__label">Maintenance</div>
                    <div class="quick-nav__count">{{ $stats['maintenance_rooms'] }} chambres</div>
                </a>
                <a href="{{ route('housekeeping.daily-report') }}" class="quick-nav__btn quick-nav__btn--blue">
                    <div class="quick-nav__icon"><i class="fas fa-file-alt"></i></div>
                    <div class="quick-nav__label">Rapport</div>
                    <div class="quick-nav__count">Quotidien</div>
                </a>
            </div>
        </div>
    </div>

</div>

{{-- MODAL MAINTENANCE --}}
<div class="modal fade" id="maintenanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-tools" style="margin-right:8px"></i>
                    Signaler une maintenance
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="maintenanceForm">
                    @csrf
                    <div style="margin-bottom:16px">
                        <label for="room_number" class="form-label">Numéro de chambre</label>
                        <input type="text" class="form-control" id="room_number" 
                               placeholder="Ex: 101, 102..." required>
                    </div>
                    <div style="margin-bottom:16px">
                        <label for="maintenance_reason" class="form-label">Raison de la maintenance</label>
                        <select class="form-select" id="maintenance_reason" name="maintenance_reason" required>
                            <option value="">Sélectionner une raison</option>
                            <option value="Électricité">Problème électrique</option>
                            <option value="Plomberie">Fuite d'eau</option>
                            <option value="Climatisation">Climatisation défectueuse</option>
                            <option value="Meuble">Meuble cassé</option>
                            <option value="Sécurité">Problème de sécurité</option>
                            <option value="Nettoyage profond">Nettoyage profond nécessaire</option>
                            <option value="Autre">Autre raison</option>
                        </select>
                    </div>
                    <div style="margin-bottom:16px">
                        <label for="estimated_duration" class="form-label">Durée estimée (heures)</label>
                        <input type="number" class="form-control" id="estimated_duration" 
                               name="estimated_duration" min="1" max="48" value="2">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--outline" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn-mini btn-mini--light" form="maintenanceForm" style="padding:8px 16px">
                    <i class="fas fa-exclamation-triangle"></i>
                    Signaler
                </button>
            </div>
        </div>
    </div>
</div>

{{-- MODALS START CLEANING --}}
@foreach($roomsByStatus['dirty'] as $room)
<div class="modal fade" id="startCleaningModal{{ $room->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-broom" style="margin-right:8px"></i>
                    Démarrer le nettoyage
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Confirmer le début du nettoyage pour la <strong>chambre {{ $room->number }}</strong> ?</p>
                <div class="alert alert--green" style="background:var(--blue-dim);border-color:rgba(59,130,246,.3);color:var(--blue)">
                    <div class="alert__icon" style="font-size:20px">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="alert__content">
                        <p style="margin:0">Cette action changera le statut de la chambre en "En nettoyage".</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--outline" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('housekeeping.start-cleaning', $room->id) }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="btn-mini btn-mini--red" style="padding:8px 16px">
                        <i class="fas fa-broom"></i>
                        Démarrer nettoyage
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tooltips
    var tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltips.map(function(el) { return new bootstrap.Tooltip(el); });
    
    // Form maintenance
    const form = document.getElementById('maintenanceForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const roomNumber = document.getElementById('room_number').value;
            const reason = document.getElementById('maintenance_reason').value;
            const duration = document.getElementById('estimated_duration').value;
            
            alert(`Maintenance signalée pour la chambre ${roomNumber}\nRaison: ${reason}\nDurée: ${duration}h`);
            
            const modal = bootstrap.Modal.getInstance(document.getElementById('maintenanceModal'));
            modal.hide();
        });
    }
    
    // Auto-refresh (30s)
    setTimeout(() => window.location.reload(), 30000);
});
</script>
@endpush