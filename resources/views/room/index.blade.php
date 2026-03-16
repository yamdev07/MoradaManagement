@extends('template.master')

@section('title', 'Room Management')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<style>
:root {
    --bg:       #fcf8f3;
    --surf:     #ffffff;
    --surf2:    #f9f0e6;
    --brd:      #f5e6d3;
    --brd2:     #e8d5c4;
    --txt:      #3d241a;
    --txt2:     #5f3c2e;
    --txt3:     #704838;
    
    --primary:  #8b4513;
    --primary-dim: rgba(139,69,19,.15);
    --blue:     #8b4513;
    --blue-dim: rgba(139,69,19,.15);
    --grn:      #a0522d;
    --grn-dim: rgba(139, 69, 19, .15);
    --yel:      #8b4513;
    --yel-dim:  rgba(139,69,19,.15);
    --red:      #ef4444;
    --red-dim:  rgba(239,68,68,.15);
    --purple:   #8b4513;
    --purple-dim: rgba(139,69,19,.15);
    
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
.rm-header {
    background: var(--surf);
    border-bottom: 1px solid var(--brd);
    padding: 20px 28px;
    margin-bottom: 24px;
}
.rm-header__inner {
    max-width: 1600px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}
.rm-header__title h1 {
    font-size: 24px;
    font-weight: 800;
    letter-spacing: -.5px;
    margin-bottom: 4px;
}
.rm-header__stats {
    font-size: 13px;
    color: var(--txt3);
}
.rm-header__stats span {
    margin-right: 16px;
}

/* ══════════════════════════════════════
   ALERTS
══════════════════════════════════════ */
.alert {
    padding: 14px 18px;
    border-radius: 10px;
    border: 1px solid;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}
.alert--success {
    background: var(--grn-dim);
    border-color: rgba(139,69,19,.3);
    color: var(--grn);
}
.alert--danger {
    background: var(--red-dim);
    border-color: rgba(239,68,68,.3);
    color: var(--red);
}
.alert i { font-size: 16px; }
.alert .btn-close {
    margin-left: auto;
    opacity: .5;
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
    background: var(--grn);
    border-color: var(--grn);
    color: white;
}
.btn--primary:hover {
    background: rgba(139, 69, 19, .25);
    border-color: var(--grn);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(139, 69, 19, .3);
}
.btn i { font-size: 14px; }

/* Action buttons */
.btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 7px;
    border: 1px solid;
    text-decoration: none;
    transition: all .14s;
    cursor: pointer;
    font-size: 13px;
}
.btn-action:hover {
    transform: translateY(-2px);
}
.btn-view {
    background: var(--primary-dim);
    border-color: rgba(139,69,19,.3);
    color: var(--primary);
}
.btn-view:hover {
    background: rgba(139,69,19,.25);
    border-color: var(--primary);
    color: var(--primary);
}
.btn-edit {
    background: var(--primary-dim);
    border-color: rgba(139,69,19,.3);
    color: var(--primary);
}
.btn-edit:hover {
    background: rgba(139,69,19,.25);
    border-color: var(--primary);
    color: var(--primary);
}
.btn-delete {
    background: var(--red-dim);
    border-color: rgba(239,68,68,.3);
    color: var(--red);
}
.btn-delete:hover {
    background: rgba(239,68,68,.25);
    border-color: var(--red);
    color: var(--red);
}

/* ══════════════════════════════════════
   MAIN CONTAINER
══════════════════════════════════════ */
.rm-container {
    max-width: 1600px;
    margin: 0 auto;
    padding: 0 28px 48px;
}

/* ══════════════════════════════════════
   CARD
══════════════════════════════════════ */
.card {
    background: var(--surf);
    border: 1px solid var(--brd);
    border-radius: var(--r);
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
}
.card__head {
    padding: 18px 24px;
    border-bottom: 1px solid var(--brd);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}
.card__title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 18px;
    font-weight: 700;
}
.card__title i { font-size: 20px; }
.card__body {
    padding: 0;
}

/* ══════════════════════════════════════
   TABLE
══════════════════════════════════════ */
.tbl {
    width: 100%;
    border-collapse: collapse;
}
.tbl thead {
    background: var(--surf2);
}
.tbl th {
    padding: 12px 16px;
    font-size: 11px;
    font-weight: 600;
    color: var(--txt3);
    text-transform: uppercase;
    letter-spacing: .4px;
    text-align: left;
    border-bottom: 1px solid var(--brd);
}
.tbl td {
    padding: 16px 16px;
    font-size: 13px;
    border-bottom: 1px solid rgba(0,0,0,.03);
    vertical-align: middle;
}
.tbl tbody tr:last-child td {
    border-bottom: none;
}
.tbl tbody tr:hover {
    background: rgba(0,0,0,.01);
}

/* ══════════════════════════════════════
   TABLE CELLS
══════════════════════════════════════ */
.room-num {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 15px;
    font-weight: 600;
    background: var(--surf2);
    padding: 4px 10px;
    border-radius: 6px;
    display: inline-block;
}
.room-name {
    font-size: 14px;
    font-weight: 600;
    color: var(--txt);
    margin-bottom: 2px;
}
.room-meta {
    font-size: 12px;
    color: var(--txt3);
    display: flex;
    align-items: center;
    gap: 4px;
    margin-top: 4px;
}
.room-meta i {
    font-size: 10px;
}
.room-type {
    font-size: 13px;
    font-weight: 500;
    color: var(--txt);
}
.room-type__base {
    font-size: 11px;
    color: var(--txt3);
    margin-top: 3px;
}
.room-capacity {
    display: flex;
    align-items: center;
    gap: 6px;
}
.room-capacity i {
    color: var(--blue);
}
.room-price {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 15px;
    font-weight: 600;
    color: var(--txt);
}
.room-price__eur {
    font-size: 11px;
    color: var(--txt3);
    font-family: 'Plus Jakarta Sans', sans-serif;
    margin-top: 2px;
}
.room-price__custom {
    font-size: 11px;
    color: var(--blue);
    margin-top: 3px;
    display: flex;
    align-items: center;
    gap: 3px;
}

/* ══════════════════════════════════════
   BADGES
══════════════════════════════════════ */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}
.badge--success { background: var(--primary-dim); color: var(--primary); }
.badge--warning { background: var(--primary-dim); color: var(--primary); }
.badge--danger  { background: var(--red-dim); color: var(--red); }
.badge--blue    { background: var(--primary-dim); color: var(--primary); }
.badge--purple  { background: var(--primary-dim); color: var(--primary); }
.badge--gray    { background: var(--surf2); color: var(--txt3); }
.badge--green   { background: var(--primary-dim); color: var(--primary); }
.badge--orange  { background: var(--primary-dim); color: var(--primary); }
.badge--yellow  { background: var(--primary-dim); color: var(--primary); }
.badge--red     { background: var(--red-dim); color: var(--red); }
.badge--cyan    { background: var(--primary-dim); color: var(--primary); }

/* ══════════════════════════════════════
   EMPTY STATE
══════════════════════════════════════ */
.empty {
    padding: 64px 20px;
    text-align: center;
}
.empty i {
    font-size: 48px;
    color: var(--txt3);
    opacity: .4;
    margin-bottom: 20px;
}
.empty h5 {
    font-size: 18px;
    font-weight: 700;
    color: var(--txt);
    margin-bottom: 8px;
}
.empty p {
    font-size: 14px;
    color: var(--txt3);
    margin-bottom: 20px;
}

/* ══════════════════════════════════════
   PAGINATION
══════════════════════════════════════ */
.pagination-wrap {
    padding: 20px 24px;
    border-top: 1px solid var(--brd);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.pagination-info {
    font-size: 13px;
    color: var(--txt3);
}

/* ══════════════════════════════════════
   ANIMATIONS
══════════════════════════════════════ */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.tbl tbody tr {
    animation: fadeIn .3s ease both;
}
.tbl tbody tr:nth-child(1) { animation-delay: .02s; }
.tbl tbody tr:nth-child(2) { animation-delay: .04s; }
.tbl tbody tr:nth-child(3) { animation-delay: .06s; }
.tbl tbody tr:nth-child(4) { animation-delay: .08s; }
.tbl tbody tr:nth-child(5) { animation-delay: .10s; }

/* ══════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════ */
@media (max-width: 768px) {
    .rm-header { padding: 16px 20px; }
    .rm-header__inner { flex-direction: column; align-items: flex-start; }
    .rm-container { padding: 0 20px 40px; }
    .card__head { padding: 16px 20px; }
    .tbl th,
    .tbl td { padding: 12px; font-size: 12px; }
    .room-num { font-size: 13px; }
    .room-name { font-size: 13px; }
    .room-price { font-size: 13px; }
}
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════
     HEADER
══════════════════════════════════════ --}}
<div class="rm-header">
    <div class="rm-header__inner">
        <div>
            <div class="rm-header__title">
                <h1>Room Management</h1>
            </div>
            <div class="rm-header__stats">
                <span><strong>{{ $rooms->total() }}</strong> rooms total</span>
                @if($rooms->total() > 0)
                    <span>Showing {{ $rooms->firstItem() }}-{{ $rooms->lastItem() }}</span>
                @endif
            </div>
        </div>
        <div>
            <a href="{{ route('room.create') }}" class="btn btn--primary">
                <i class="fas fa-plus"></i>
                Add New Room
            </a>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════
     MAIN CONTAINER
══════════════════════════════════════ --}}
<div class="rm-container">

    {{-- ALERTS --}}
    @if(session('success'))
    <div class="alert alert--success">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('failed'))
    <div class="alert alert--danger">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('failed') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- TABLE CARD --}}
    <div class="card">
        <div class="card__head">
            <div class="card__title">
                <i class="fas fa-bed"></i>
                Rooms
            </div>
        </div>
        <div class="card__body">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>Room #</th>
                        <th>Room Name</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Price (CFA)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
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
                                    <i class="fas fa-signature"></i>
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
                                <div class="room-type">{{ $room->type->name ?? 'N/A' }}</div>
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
                                <span>{{ $room->capacity }} pers.</span>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="room-price">{{ number_format($room->price, 0, ',', ' ') }} FCFA</div>
                                @if($room->price > 0)
                                <div class="room-price__eur">
                                    ≈ {{ number_format($room->price / 655, 2, ',', ' ') }} €
                                </div>
                                @if($room->type && $room->type->base_price && $room->price != $room->type->base_price)
                                <div class="room-price__custom">
                                    <i class="fas fa-exclamation-circle"></i>
                                    Custom price
                                </div>
                                @endif
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;gap:6px;flex-wrap:wrap">
                                <span class="badge badge--{{ $room->roomStatus->color ?? 'gray' }}">
                                    <i class="{{ $room->status_icon ?? 'fa-door-closed' }}"></i>
                                    {{ $room->roomStatus->name ?? 'Unknown' }}
                                </span>
                                @if($room->is_available_today)
                                <span class="badge badge--success">
                                    <i class="fas fa-check"></i>
                                    Available
                                </span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('room.show', $room->id) }}" 
                                   class="btn-action btn-view" 
                                   title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <a href="{{ route('room.edit', $room->id) }}" 
                                   class="btn-action btn-edit" 
                                   title="Edit Room">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                @if(auth()->user()->role === 'Super' || auth()->user()->role === 'Admin')
                                <form method="POST" 
                                      action="{{ route('room.destroy', $room->id) }}"
                                      style="display:inline"
                                      onsubmit="return confirm('Delete room {{ $room->number }}? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn-action btn-delete"
                                            title="Delete Room">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty">
                                <i class="fas fa-bed"></i>
                                <h5>No Rooms Found</h5>
                                <p>You haven't added any rooms yet</p>
                                <a href="{{ route('room.create') }}" class="btn btn--primary">
                                    <i class="fas fa-plus"></i>
                                    Add Your First Room
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{-- PAGINATION --}}
            @if($rooms->hasPages())
            <div class="pagination-wrap">
                <div class="pagination-info">
                    Showing {{ $rooms->firstItem() }} to {{ $rooms->lastItem() }} of {{ $rooms->total() }} entries
                </div>
                <div>
                    {{ $rooms->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
// Auto-hide alerts
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    });
}, 5000);

// Tooltips
document.addEventListener('DOMContentLoaded', () => {
    const tooltips = [].slice.call(document.querySelectorAll('[title]'));
    tooltips.map(el => new bootstrap.Tooltip(el));
});
</script>
@endpush