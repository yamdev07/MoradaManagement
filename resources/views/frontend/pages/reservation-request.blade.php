@extends('frontend.layouts.master')

@section('title', 'Confirmation Réservation - ' . ($currentHotel->name ?? 'Hôtel'))

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
    padding: 60px 0 40px;
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
    box-shadow: 0 0 0 3px rgba(44, 62, 80, 0.1);
}

.btn-primary {
    background: var(--primary-color);
    border: none;
    padding: 14px 28px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.progress-step {
    display: flex;
    align-items: center;
    margin-bottom: 40px;
}

.step {
    flex: 1;
    text-align: center;
    position: relative;
}

.step::before {
    content: '';
    position: absolute;
    top: 15px;
    left: 50%;
    right: -50%;
    height: 2px;
    background: #e5e7eb;
    z-index: -1;
}

.step:first-child::before {
    display: none;
}

.step.active {
    color: var(--primary-color);
}

.step.active::before {
    background: var(--primary-color);
}

.step-number {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #e5e7eb;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 8px;
    font-weight: 600;
}

.step.active .step-number {
    background: var(--primary-color);
}

.step.completed .step-number {
    background: #28a745;
}

.alert {
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 20px;
}

.loading {
    display: none;
    text-align: center;
    padding: 20px;
}

.spinner {
    border: 3px solid #f3f3f3;
    border-top: 3px solid var(--primary-color);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin: 0 auto 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="reservation-hero">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Confirmation de Réservation</h1>
        <p class="lead">Vérifiez vos informations et confirmez votre réservation</p>
    </div>
</div>

<!-- Reservation Form -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="reservation-form">
                <!-- Progress Steps -->
                <div class="progress-step">
                    <div class="step completed">
                        <div class="step-number">1</div>
                        <small>Infos</small>
                    </div>
                    <div class="step completed">
                        <div class="step-number">2</div>
                        <small>Dates</small>
                    </div>
                    <div class="step active">
                        <div class="step-number">3</div>
                        <small>Chambre</small>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <small>Confirmation</small>
                    </div>
                </div>

                <!-- Alert Messages -->
                <div id="successMessage" class="alert alert-success" style="display: none;">
                    <i class="fas fa-check-circle me-2"></i>
                    <span id="successText"></span>
                </div>

                <div id="errorMessage" class="alert alert-danger" style="display: none;">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <span id="errorText"></span>
                </div>

                <!-- Loading -->
                <div id="loading" class="loading">
                    <div class="spinner"></div>
                    <p>Traitement en cours...</p>
                </div>

                <!-- Reservation Form -->
                <form id="reservationForm">
                    @csrf
                    <input type="hidden" name="room_id" id="room_id" value="{{ request('room_id') }}">
                    <input type="hidden" name="check_in" id="check_in" value="{{ request('check_in') }}">
                    <input type="hidden" name="check_out" id="check_out" value="{{ request('check_out') }}">
                    <input type="hidden" name="adults" id="adults" value="{{ request('adults', 1) }}">
                    <input type="hidden" name="children" id="children" value="{{ request('children', 0) }}">

                    <!-- Room Summary -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-bed me-2"></i>Détails de la Chambre</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Chambre:</strong> <span id="roomName">Chargement...</span></p>
                                    <p><strong>Prix:</strong> <span id="roomPrice">Chargement...</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Arrivée:</strong> {{ request('check_in') }}</p>
                                    <p><strong>Départ:</strong> {{ request('check_out') }}</p>
                                    <p><strong>Personnes:</strong> {{ request('adults', 1) }} adultes, {{ request('children', 0) }} enfants</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-user me-2"></i>Vos Informations</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nom complet *</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Téléphone *</label>
                                    <input type="tel" class="form-control" name="phone" id="phone" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Adresse *</label>
                                    <input type="text" class="form-control" name="address" id="address" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Genre *</label>
                                    <select class="form-select" name="gender" id="gender" required>
                                        <option value="">Sélectionner...</option>
                                        <option value="Homme">Homme</option>
                                        <option value="Femme">Femme</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Profession *</label>
                                    <input type="text" class="form-control" name="job" id="job" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date de naissance *</label>
                                    <input type="date" class="form-control" name="birthdate" id="birthdate" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Special Requests -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-comment me-2"></i>Demandes spéciales</h5>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" name="notes" id="notes" rows="3" placeholder="Lit bébé, étage préféré, heure d'arrivée..."></textarea>
                            <small class="text-muted">0 / 500 caractères</small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                            <i class="fas fa-check me-2"></i>Confirmer la réservation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const roomId = '{{ request("room_id") }}';
    const form = document.getElementById('reservationForm');
    const submitBtn = document.getElementById('submitBtn');
    const loading = document.getElementById('loading');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    const successText = document.getElementById('successText');
    const errorText = document.getElementById('errorText');

    // Charger les détails de la chambre
    if (roomId) {
        fetch(`/api/available-rooms?check_in={{ request('check_in') }}&check_out={{ request('check_out') }}&adults={{ request('adults', 1) }}`)
            .then(response => response.json())
            .then(data => {
                if (data.rooms && data.rooms.length > 0) {
                    const room = data.rooms.find(r => r.id == roomId);
                    if (room) {
                        document.getElementById('roomName').textContent = `${room.number} - ${room.name}`;
                        document.getElementById('roomPrice').textContent = `${room.price.toLocaleString()} FCFA / nuit`;
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
    }

    // Gérer la soumission du formulaire
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Validation basique
        const requiredFields = ['name', 'email', 'phone', 'address', 'gender', 'job', 'birthdate'];
        for (let field of requiredFields) {
            const element = document.getElementById(field);
            if (!element.value.trim()) {
                showError(`Le champ ${field} est obligatoire.`);
                element.focus();
                return;
            }
        }

        // Afficher le chargement
        submitBtn.disabled = true;
        loading.style.display = 'block';
        hideMessages();

        try {
            const formData = new FormData(form);
            
            const response = await fetch('/reservation/request', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            const data = await response.json();

            if (data.success) {
                showSuccess(data.message);
                
                // Mettre à jour les étapes de progression
                document.querySelectorAll('.step').forEach((step, index) => {
                    if (index <= 3) {
                        step.classList.add('completed');
                        step.classList.remove('active');
                    }
                });

                // Rediriger après 3 secondes
                setTimeout(() => {
                    window.location.href = '/hotel';
                }, 3000);
            } else {
                showError(data.message || 'Une erreur est survenue lors de la réservation.');
            }
        } catch (error) {
            console.error('Erreur:', error);
            showError('Erreur de connexion. Vérifiez votre réseau et réessayez.');
        } finally {
            submitBtn.disabled = false;
            loading.style.display = 'none';
        }
    });

    function showSuccess(message) {
        successText.textContent = message;
        successMessage.style.display = 'block';
        errorMessage.style.display = 'none';
    }

    function showError(message) {
        errorText.textContent = message;
        errorMessage.style.display = 'block';
        successMessage.style.display = 'none';
    }

    function hideMessages() {
        successMessage.style.display = 'none';
        errorMessage.style.display = 'none';
    }

    // Limiter les caractères des notes
    const notesField = document.getElementById('notes');
    const maxLength = 500;
    
    notesField.addEventListener('input', function() {
        const currentLength = this.value.length;
        const remaining = maxLength - currentLength;
        
        if (remaining < 0) {
            this.value = this.value.substring(0, maxLength);
            return;
        }
        
        this.nextElementSibling.textContent = `${currentLength} / ${maxLength} caractères`;
    });
});
</script>
@endpush
