@extends('frontend.layouts.master')

@section('title', 'Chambres - {{ $tenant->name }}')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-bed"></i>
                        Chambres de {{ $tenant->name }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($rooms->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Numéro</th>
                                    <th>Capacité</th>
                                    <th>Prix</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->number }}</td>
                                        <td>{{ $room->capacity }} pers.</td>
                                        <td>{{ number_format($room->price, 0, ',', ' ') }} FCFA</td>
                                        <td>
                                            <span class="badge badge-{{ $room->status == 'available' ? 'success' : ($room->status == 'occupied' ? 'danger' : 'warning') }}">
                                                {{ $room->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Aucune chambre trouvée pour ce tenant.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
