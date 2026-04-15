@extends('layouts.app')

@section('title', 'Gestion des Hôtels')

@section('content')
<style>
.tenants-management {
    background: var(--m50);
    min-height: 100vh;
    padding: 2rem;
}

.header-section {
    margin-bottom: 2rem;
}

.tenants-table {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.table-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-action {
    padding: 0.25rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.btn-view {
    background: var(--m100);
    color: var(--m700);
}

.btn-view:hover {
    background: var(--m200);
}

.btn-toggle {
    background: var(--a100);
    color: var(--a700);
}

.btn-toggle:hover {
    background: var(--a200);
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-active {
    background: #28a745;
    color: white;
}

.status-inactive {
    background: #dc3545;
    color: white;
}
</style>

<div class="tenants-management">
    <!-- En-tête -->
    <div class="header-section">
        <h1 class="mb-3">
            <i class="fas fa-building me-2"></i>
            Gestion des Hôtels
        </h1>
        <p class="text-muted">
            Administration de tous les établissements Morada Lodge
        </p>
    </div>

    <!-- Tableau des hôtels -->
    <div class="tenants-table">
        <div class="p-3 border-bottom" style="background: var(--m600); color: white;">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>
                Liste des Hôtels ({{ $tenants->total() }} établissements)
            </h5>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Domaine</th>
                        <th>Email Contact</th>
                        <th>Utilisateurs</th>
                        <th>Chambres</th>
                        <th>Statut</th>
                        <th>Créé le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tenants as $tenant)
                    <tr>
                        <td>{{ $tenant->id }}</td>
                        <td>
                            <strong>{{ $tenant->name }}</strong>
                        </td>
                        <td>
                            <code>{{ $tenant->domain }}</code>
                        </td>
                        <td>
                            <a href="mailto:{{ $tenant->contact_email }}" class="text-muted">
                                {{ $tenant->contact_email }}
                            </a>
                        </td>
                        <td>
                            <span class="badge badge-pill badge-info">
                                {{ $tenant->users->count() }}
                            </span>
                        </td>
                        <td>{{ $tenant->rooms->count() }}</td>
                        <td>
                            <span class="status-badge {{ $tenant->status ? 'status-active' : 'status-inactive' }}">
                                {{ $tenant->status ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td>{{ $tenant->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('tenant.dashboard', $tenant->id) }}" 
                                   class="btn-action btn-view" target="_self">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form method="POST" action="{{ route('super-admin.tenant.toggle', $tenant->id) }}" 
                                      style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-action btn-toggle">
                                        <i class="fas fa-power-off"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5>Aucun hôtel trouvé</h5>
                            <p class="text-muted">Aucun établissement n'a été configuré pour le moment.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $tenants->links() }}
        </div>
    </div>
</div>
@endsection
