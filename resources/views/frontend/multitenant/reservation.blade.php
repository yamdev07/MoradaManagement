@extends('frontend.layouts.master')

@section('title', 'Réservation - ' . ($currentHotel->name ?? 'Hôtel'))

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
:root {
    /* {{ $currentHotel->name ?? 'Morada Lodge' }} Palette */
    --primary-color: {{ $currentHotel->theme_settings['primary_color'] ?? '#2c3e50' }};
    --secondary-color: {{ $currentHotel->theme_settings['secondary_color'] ?? '#3498db' }};
    --accent-color: {{ $currentHotel->theme_settings['accent_color'] ?? '#f39c12' }};
    --background-color: {{ $currentHotel->theme_settings['background_color'] ?? '#f4f1e8' }};
    --text-color: {{ $currentHotel->theme_settings['text_color'] ?? '#2c3e50' }};
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background-color: var(--background-color);
    color: var(--text-color);
}

.reservation-hero {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    padding: 80px 0 60px;
    text-align: center;
}

.reservation-form {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    padding: 40px;
    margin-top: -40px;
    position: relative;
    z-index: 10;
}

.form-label {
    font-weight: 600;
    color: var(--text-color);
    margin-bottom: 8px;
}

.form-control, .form-select {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(0,0,0,0.1);
}

.btn-primary {
    background: var(--primary-color);
    border: none;
    border-radius: 8px;
    padding: 14px 28px;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
}

.room-card {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.room-card:hover {
    border-color: var(--primary-color);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.room-card.selected {
    border-color: var(--primary-color);
    background: rgba(0,0,0,0.02);
}

.no-rooms {
    text-align: center;
    padding: 60px 20px;
    color: #6b7280;
}

.no-rooms i {
    font-size: 64px;
    color: #d1d5db;
    margin-bottom: 20px;
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="reservation-hero">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Réservation</h1>
        <p class="lead">Réservez votre séjour au {{ $currentHotel->name ?? 'Hôtel' }}</p>
    </div>
</section>

<!-- Reservation Form -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="reservation-form">
                    <h3 class="mb-4">Faire une réservation</h3>
                    
                    <form id="reservationForm">
                        <!-- Dates du séjour -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Date d'arrivée</label>
                                <input type="date" class="form-control" id="check_in" name="check_in" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date de départ</label>
                                <input type="date" class="form-control" id="check_out" name="check_out" required>
                            </div>
                        </div>

                        <!-- Personnes -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Adultes</label>
                                <select class="form-select" id="adults" name="adults">
                                    <option value="1">1 adulte</option>
                                    <option value="2">2 adultes</option>
                                    <option value="3">3 adultes</option>
                                    <option value="4">4 adultes</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Enfants</label>
                                <select class="form-select" id="children" name="children">
                                    <option value="0">0 enfant</option>
                                    <option value="1">1 enfant</option>
                                    <option value="2">2 enfants</option>
                                    <option value="3">3 enfants</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Type de chambre</label>
                                <select class="form-select" id="room_type" name="room_type">
                                    <option value="">Tous les types</option>
                                    @foreach($roomTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Bouton de recherche -->
                        <div class="text-center mb-4">
                            <button type="button" class="btn btn-primary btn-lg" id="searchRooms">
                                <i class="fas fa-search me-2"></i>Rechercher des chambres
                            </button>
                        </div>

                        <!-- Résultat de la recherche -->
                        <div id="searchResults" style="display: none;">
                            <h4 class="mb-3">Chambres disponibles</h4>
                            <div id="roomsList"></div>
                        </div>

                        <!-- Message d'erreur -->
                        <div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reservationForm');
    const searchBtn = document.getElementById('searchRooms');
    const searchResults = document.getElementById('searchResults');
    const roomsList = document.getElementById('roomsList');
    const errorMessage = document.getElementById('errorMessage');

    // Définir les dates minimales
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('check_in').setAttribute('min', today);
    document.getElementById('check_out').setAttribute('min', today);

    // Mettre à jour la date minimale de départ quand la date d'arrivée change
    document.getElementById('check_in').addEventListener('change', function() {
        const checkIn = new Date(this.value);
        const minCheckOut = new Date(checkIn);
        minCheckOut.setDate(minCheckOut.getDate() + 1);
        document.getElementById('check_out').setAttribute('min', minCheckOut.toISOString().split('T')[0]);
        
        if (document.getElementById('check_out').value <= this.value) {
            document.getElementById('check_out').value = minCheckOut.toISOString().split('T')[0];
        }
    });

    // Recherche des chambres
    searchBtn.addEventListener('click', function() {
        const checkIn = document.getElementById('check_in').value;
        const checkOut = document.getElementById('check_out').value;
        const adults = document.getElementById('adults').value;
        const children = document.getElementById('children').value;
        const roomType = document.getElementById('room_type').value;

        if (!checkIn || !checkOut) {
            showError('Veuillez sélectionner les dates d\'arrivée et de départ.');
            return;
        }

        if (new Date(checkOut) <= new Date(checkIn)) {
            showError('La date de départ doit être postérieure à la date d\'arrivée.');
            return;
        }

        // Afficher le chargement
        searchBtn.disabled = true;
        searchBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Recherche en cours...';
        errorMessage.style.display = 'none';

        // Appel API pour rechercher les chambres
        fetch(`/api/available-rooms?check_in=${checkIn}&check_out=${checkOut}&adults=${adults}&children=${children}&type=${roomType}`)
            .then(response => response.json())
            .then(data => {
                searchBtn.disabled = false;
                searchBtn.innerHTML = '<i class="fas fa-search me-2"></i>Rechercher des chambres';

                if (data.rooms && data.rooms.length > 0) {
                    displayRooms(data.rooms);
                } else {
                    showNoRooms();
                }
            })
            .catch(error => {
                searchBtn.disabled = false;
                searchBtn.innerHTML = '<i class="fas fa-search me-2"></i>Rechercher des chambres';
                showError('Une erreur est survenue lors de la recherche des chambres.');
                console.error('Error:', error);
            });
    });

    function displayRooms(rooms) {
        searchResults.style.display = 'block';
        roomsList.innerHTML = '';

        rooms.forEach(room => {
            const roomCard = document.createElement('div');
            roomCard.className = 'room-card';
            roomCard.innerHTML = `
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-2">${room.name}</h5>
                        <p class="text-muted mb-2">${room.type_name || 'Standard'} - Capacité: ${room.capacity} personne(s)</p>
                        <p class="mb-0"><strong>${room.price.toLocaleString()} FCFA</strong> / nuit</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <button type="button" class="btn btn-primary" onclick="selectRoom(${room.id}, '${room.name}', ${room.price})">
                            Sélectionner
                        </button>
                    </div>
                </div>
            `;
            roomsList.appendChild(roomCard);
        });
    }

    function showNoRooms() {
        searchResults.style.display = 'block';
        roomsList.innerHTML = `
            <div class="no-rooms">
                <i class="fas fa-bed"></i>
                <h4>Aucune chambre disponible</h4>
                <p>Essayez d'autres dates ou modifiez vos critères de recherche.</p>
            </div>
        `;
    }

    function showError(message) {
        errorMessage.textContent = message;
        errorMessage.style.display = 'block';
        searchResults.style.display = 'none';
    }

    function selectRoom(roomId, roomName, price) {
        // Rediriger vers le formulaire de réservation complet
        const checkIn = document.getElementById('check_in').value;
        const checkOut = document.getElementById('check_out').value;
        const adults = document.getElementById('adults').value;
        const children = document.getElementById('children').value;
        
        window.location.href = `/reservation-request?room_id=${roomId}&check_in=${checkIn}&check_out=${checkOut}&adults=${adults}&children=${children}`;
    }
});
</script>
@endpush
