@extends('frontend.layouts.master')

@section('title', 'Transactions - {{ $tenant->name }}')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-shopping-cart"></i>
                        Transactions de {{ $tenant->name }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($transactions->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Client</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->customer->name ?? 'N/A' }}</td>
                                        <td>{{ number_format($transaction->amount, 0, ',', ' ') }} FCFA</td>
                                        <td>
                                            <span class="badge badge-{{ $transaction->status == 'completed' ? 'success' : ($transaction->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ $transaction->status }}
                                            </span>
                                        </td>
                                        <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Aucune transaction trouvée pour ce tenant.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
