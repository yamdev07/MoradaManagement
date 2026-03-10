@extends('template.master')

@section('title', 'Room Details')

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
    
    --blue:     #3b82f6;
    --blue-dim: rgba(59,130,246,.15);
    --grn:      #10b981;
    --grn-dim:  rgba(16,185,129,.15);
    --yel:      #eab308;
    --yel-dim:  rgba(234,179,8,.15);
    --red:      #ef4444;
    --red-dim:  rgba(239,68,68,.15);
    --purple:   #8b5cf6;
    --purple-dim: rgba(139,92,246,.15);
    --cyan:     #06b6d4;
    --cyan-dim: rgba(6,182,212,.15);
    
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
.rd-header {
    background: var(--surf);
    border-bottom: 1px solid var(--brd);
    padding: 20px 28px;
    margin-bottom: 24px;
}
.rd-header__inner {
    max-width: 1600px;
    margin: 0 auto;
}
.rd-header__title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 24px;
    font-weight: 800;
    letter-spacing: -.5px;
    margin-bottom: 8px;
}
.rd-header__title i {
    font-size: 22px;
    color: var(--blue);
}
.breadcrumb {
    margin: 0;
    padding: 0;
    background: none;
    font-size: 13px;
}
.breadcrumb-item + .breadcrumb-item::before {
    content: "/";
    color: var(--txt3);
}
.breadcrumb-item a {
    color: var(--txt3);
    text-decoration: none;
}
.breadcrumb-item a:hover {
    color: var(--blue);
}
.breadcrumb-item.active {
    color: var(--txt2);
}

/* ══════════════════════════════════════
   MAIN CONTAINER
══════════════════════════════════════ */
.rd-container {
    max-width: 1600px;
    margin: 0 auto;
    padding: 0 28px 48px;
}
.rd-grid {
    display: grid;
    grid-template-columns: 320px 1fr 380px;
    gap: 20px;
}

/* ══════════════════════════════════════
   CARD
══════════════════════════════════════ */
.card {
    background: var(--surf);
    border: 1px solid var(--brd);
    border-radius: var(--r);
    overflow: hidden;
    transition: all .2s;
}
.card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,.06);
}
.card__head {
    padding: 14px 20px;
    border-bottom: 1px solid var(--brd);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}
.card__head--blue {
    background: linear-gradient(135deg, var(--blue), #2563eb);
    color: white;
    border-bottom: none;
}
.card__title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 700;
    font-size: 15px;
}
.card__title i { font-size: 16px; }
.card__body {
    padding: 20px;
}

/* ══════════════════════════════════════
   BUTTONS
══════════════════════════════════════ */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 600;
    border: 1px solid;
    text-decoration: none;
    transition: all .14s;
    cursor: pointer;
    white-space: nowrap;
}
.btn--primary {
    background: var(--blue);
    border-color: var(--blue);
    color: white;
}
.btn--primary:hover {
    background: #2563eb;
    border-color: #2563eb;
    color: white;
    transform: translateY(-1px);
}
.btn--danger {
    background: var(--red-dim);
    border-color: rgba(239,68,68,.3);
    color: var(--red);
}
.btn--danger:hover {
    background: rgba(239,68,68,.25);
    border-color: var(--red);
    color: var(--red);
}

/* ══════════════════════════════════════
   GUEST SECTION
══════════════════════════════════════ */
.guest-avatar {
    width: 100%;
    aspect-ratio: 1;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 16px;
}
.guest-name {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 16px;
}
.guest-info {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.guest-info__item {
    display: flex;
    gap: 10px;
    font-size: 13px;
}
.guest-info__icon {
    width: 20px;
    flex-shrink: 0;
    color: var(--blue);
    font-size: 12px;
}
.guest-info__text {
    flex: 1;
    color: var(--txt2);
}

/* ══════════════════════════════════════
   EMPTY STATE
══════════════════════════════════════ */
.empty {
    padding: 48px 20px;
    text-align: center;
}
.empty i {
    font-size: 40px;
    color: var(--txt3);
    opacity: .4;
    margin-bottom: 16px;
}
.empty h5 {
    font-size: 16px;
    font-weight: 700;
    color: var(--txt2);
    margin-bottom: 4px;
}
.empty p {
    font-size: 13px;
    color: var(--txt3);
    margin-bottom: 0;
}

/* ══════════════════════════════════════
   ROOM INFO CARDS
══════════════════════════════════════ */
.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-bottom: 16px;
}
.info-card {
    background: var(--surf2);
    border-radius: 10px;
    padding: 14px;
}
.info-label {
    font-size: 11px;
    font-weight: 600;
    color: var(--txt3);
    text-transform: uppercase;
    letter-spacing: .4px;
    margin-bottom: 4px;
}
.info-value {
    font-size: 16px;
    font-weight: 700;
    color: var(--txt);
}

.stat-card {
    background: var(--surf);
    border: 1px solid var(--brd);
    border-radius: 10px;
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 14px;
}
.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}
.stat-label {
    font-size: 12px;
    color: var(--txt3);
    margin-bottom: 2px;
}
.stat-value {
    font-size: 20px;
    font-weight: 800;
    letter-spacing: -.5px;
    color: var(--txt);
}
.stat-sub {
    font-size: 11px;
    color: var(--txt3);
    margin-top: 2px;
}

/* ══════════════════════════════════════
   BADGES
══════════════════════════════════════ */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
}
.badge--success { background: var(--grn-dim); color: var(--grn); }
.badge--warning { background: var(--yel-dim); color: var(--yel); }
.badge--danger  { background: var(--red-dim); color: var(--red); }
.badge--blue    { background: var(--blue-dim); color: var(--blue); }
.badge--purple  { background: var(--purple-dim); color: var(--purple); }
.badge--cyan    { background: var(--cyan-dim); color: var(--cyan); }
.badge--gray    { background: var(--surf2); color: var(--txt3); }

/* ══════════════════════════════════════
   IMAGES GALLERY
══════════════════════════════════════ */
.img-grid {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.img-card {
    background: var(--surf);
    border: 1px solid var(--brd);
    border-radius: 10px;
    overflow: hidden;
    transition: all .2s;
}
.img-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
    transform: translateY(-2px);
}
.img-card__img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    cursor: pointer;
    transition: opacity .2s;
}
.img-card__img:hover {
    opacity: .9;
}
.img-card__foot {
    padding: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.img-date {
    font-size: 11px;
    color: var(--txt3);
    display: flex;
    align-items: center;
    gap: 4px;
}

/* ══════════════════════════════════════
   MODAL
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
.form-control {
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid var(--brd2);
    font-size: 13px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all .15s;
}
.form-control:focus {
    outline: none;
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(59,130,246,.1);
}
.form-text {
    font-size: 11px;
    color: var(--txt3);
    margin-top: 4px;
}

/* ══════════════════════════════════════
   ANIMATIONS
══════════════════════════════════════ */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.card {
    animation: fadeIn .3s ease both;
}

/* ══════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════ */
@media (max-width: 1200px) {
    .rd-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .rd-header { padding: 16px 20px; }
    .rd-container { padding: 0 20px 40px; }
    .info-grid { grid-template-columns: 1fr; }
    .stat-card { flex-direction: column; text-align: center; }
}
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════
     HEADER
══════════════════════════════════════ --}}
<div class="rd-header">
    <div class="rd-header__inner">
        <div class="rd-header__title">
            <i class="fas fa-bed"></i>
            Room Details: {{ $room->number }}
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('room.index') }}">Rooms</a></li>
                <li class="breadcrumb-item active">{{ $room->number }}</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ══════════════════════════════════════
     MAIN CONTAINER
══════════════════════════════════════ --}}
<div class="rd-container">
    <div class="rd-grid">

        {{-- GUEST COLUMN --}}
        <div>
            @if (!empty($customer))
            <div class="card">
                <div class="card__head card__head--blue">
                    <div class="card__title">
                        <i class="fas fa-user"></i>
                        Current Guest
                    </div>
                </div>
                <div class="card__body">
                    <img class="guest-avatar" 
                         src="{{ $customer->user->getAvatar() }}" 
                         alt="{{ $customer->name }}">
                    <h4 class="guest-name">{{ $customer->name }}</h4>
                    <div class="guest-info">
                        <div class="guest-info__item">
                            <div class="guest-info__icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="guest-info__text">
                                {{ $customer->user->email }}
                            </div>
                        </div>
                        <div class="guest-info__item">
                            <div class="guest-info__icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="guest-info__text">
                                {{ $customer->job ?? 'Not specified' }}
                            </div>
                        </div>
                        <div class="guest-info__item">
                            <div class="guest-info__icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="guest-info__text">
                                {{ $customer->address ?? 'Not specified' }}
                            </div>
                        </div>
                        <div class="guest-info__item">
                            <div class="guest-info__icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="guest-info__text">
                                {{ $customer->phone ?? 'Not specified' }}
                            </div>
                        </div>
                        @if($customer->birthdate)
                        <div class="guest-info__item">
                            <div class="guest-info__icon">
                                <i class="fas fa-birthday-cake"></i>
                            </div>
                            <div class="guest-info__text">
                                {{ \Carbon\Carbon::parse($customer->birthdate)->format('d/m/Y') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card__body">
                    <div class="empty">
                        <i class="fas fa-user-slash"></i>
                        <h5>Room Available</h5>
                        <p>No guest currently staying</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- ROOM INFO COLUMN --}}
        <div>
            <div class="card">
                <div class="card__head">
                    <div class="card__title">
                        <i class="fas fa-info-circle"></i>
                        Room Information
                    </div>
                    <button type="button" class="btn btn--primary" data-bs-toggle="modal" data-bs-target="#imageUploadModal">
                        <i class="fas fa-upload"></i>
                        Upload Image
                    </button>
                </div>
                <div class="card__body">
                    <div class="info-grid">
                        <div class="info-card">
                            <div class="info-label">Room Type</div>
                            <div class="info-value">{{ $room->type->name ?? 'N/A' }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Status</div>
                            <div>
                                <span class="badge badge--{{ $room->roomStatus->color ?? 'gray' }}">
                                    {{ $room->roomStatus->name ?? 'Unknown' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-bottom:16px">
                        <div class="stat-card">
                            <div class="stat-icon" style="background:var(--blue-dim);color:var(--blue)">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <div class="stat-label">Capacity</div>
                                <div class="stat-value">{{ $room->capacity }}</div>
                                <div class="stat-sub">persons</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background:var(--grn-dim);color:var(--grn)">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div>
                                <div class="stat-label">Price</div>
                                <div class="stat-value" style="font-size:18px;font-family:'IBM Plex Mono',monospace">
                                    {{ number_format($room->price, 0, ',', ' ') }}
                                </div>
                                <div class="stat-sub">
                                    ≈ {{ number_format($room->price / 655, 2, ',', ' ') }} €
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($room->view)
                    <div class="stat-card">
                        <div class="stat-icon" style="background:var(--purple-dim);color:var(--purple)">
                            <i class="fas fa-mountain"></i>
                        </div>
                        <div>
                            <div class="stat-label">View</div>
                            <div class="stat-value" style="font-size:16px">{{ $room->view }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- IMAGES COLUMN --}}
        <div>
            <div class="card">
                <div class="card__head">
                    <div class="card__title">
                        <i class="fas fa-images"></i>
                        Room Images
                    </div>
                </div>
                <div class="card__body">
                    @php
                        $images = $room->images ?? ($room->image ?? collect());
                    @endphp
                    
                    @if($images && $images->count() > 0)
                    <div class="img-grid">
                        @foreach ($images as $image)
                        <div class="img-card">
                            <img src="{{ asset('img/room/' . $room->number . '/' . $image->url) }}" 
                                 class="img-card__img" 
                                 alt="Room Image"
                                 onclick="openImageModal('{{ asset('img/room/' . $room->number . '/' . $image->url) }}')">
                            <div class="img-card__foot">
                                <span class="img-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $image->created_at->format('d/m/Y H:i') }}
                                </span>
                                @if(auth()->user()->role === 'Super' || auth()->user()->role === 'Admin')
                                <form action="{{ route('image.destroy', $image->id) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Delete this image?')"
                                      style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn--danger" style="padding:4px 10px;font-size:11px">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty">
                        <i class="fas fa-images"></i>
                        <h5>No Images</h5>
                        <p style="margin-bottom:16px">This room doesn't have any images yet</p>
                        @if(auth()->user()->role === 'Super' || auth()->user()->role === 'Admin')
                        <button type="button" class="btn btn--primary" data-bs-toggle="modal" data-bs-target="#imageUploadModal">
                            <i class="fas fa-upload"></i>
                            Upload First Image
                        </button>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

{{-- MODAL UPLOAD --}}
<div class="modal fade" id="imageUploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-upload" style="margin-right:8px"></i>
                    Upload Room Image
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('image.store', ['room' => $room->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="margin-bottom:16px">
                        <label for="image" class="form-label">Select Image</label>
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               name="image" 
                               id="image" 
                               accept="image/*" 
                               required>
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Supported formats: JPG, PNG, GIF. Max size: 2MB.
                        </div>
                    </div>
                    <button type="submit" class="btn btn--primary w-100">
                        <i class="fas fa-upload"></i>
                        Upload Image
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL VIEW IMAGE --}}
<div class="modal fade" id="imageViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Room Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="text-align:center">
                <img id="fullSizeImage" src="" alt="Full Size" style="max-width:100%;border-radius:10px">
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openImageModal(imageUrl) {
    document.getElementById('fullSizeImage').src = imageUrl;
    const modal = new bootstrap.Modal(document.getElementById('imageViewModal'));
    modal.show();
}

@if(session('success'))
    toastr.success("{{ session('success') }}", "Success");
@endif

@if(session('failed'))
    toastr.error("{{ session('failed') }}", "Failed");
@endif

@error('image')
    toastr.error("{{ $message }}", "Upload Failed");
    document.addEventListener('DOMContentLoaded', function() {
        const modal = new bootstrap.Modal(document.getElementById('imageUploadModal'));
        modal.show();
    });
@enderror
</script>
@endpush