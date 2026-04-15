@extends('layouts.app')

@section('title', 'Gestion des Utilisateurs')

@section('content')
<style>
.users-management {
    background: var(--m50);
    min-height: 100vh;
    padding: 2rem;
}

.header-section {
    margin-bottom: 2rem;
}

.users-table {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.badge-role {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-super {
    background: var(--a500);
    color: white;
}

.badge-admin {
    background: var(--m500);
    color: white;
}

.badge-receptionist {
    background: var(--m300);
    color: white;
}

.badge-customer {
    background: #6c757d;
    color: white;
}

.tenant-info {
    font-size: 0.8rem;
    color: #666;
}

.user-email {
    font-family: monospace;
    background: #f8f9fa;
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
    font-size: 0.85rem;
}
</style>

<div class="users-management">
    <!-- En-tête -->
    <div class="header-section">
        <h1 class="mb-3">
            <i class="fas fa-users me-2"></i>
            Gestion des Utilisateurs
        </h1>
        <p class="text-muted">
            Tous les utilisateurs du système multitenant ({{ $users->total() }} utilisateurs)
        </p>
    </div>

    <!-- Tableau des utilisateurs -->
    <div class="users-table">
        <div class="p-3 border-bottom" style="background: var(--m600); color: white;">
            <h5 class="mb-0">
                <i class="fas fa-user-friends me-2"></i>
                Liste des Utilisateurs
            </h5>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Hôtel</th>
                        <th>Dernière Connexion</th>
                        <th>Créé le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <strong>{{ $user->name }}</strong>
                        </td>
                        <td>
                            <span class="user-email">{{ $user->email }}</span>
                        </td>
                        <td>
                            <span class="badge-role badge-{{ strtolower($user->role) }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td>
                            @if($user->tenant)
                                <div>
                                    <strong>{{ $user->tenant->name }}</strong>
                                    <br>
                                    <span class="tenant-info">{{ $user->tenant->domain }}</span>
                                </div>
                            @else
                                <span class="badge-role badge-super">
                                    <i class="fas fa-crown me-1"></i>
                                    Super Admin
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($user->last_login_at)
                                {{ $user->last_login_at->format('d/m/Y H:i') }}
                            @else
                                <span class="text-muted">Jamais</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group">
                                @if($user->tenant)
                                <a href="{{ route('tenant.dashboard', $user->tenant->id) }}" 
                                   class="btn btn-sm btn-outline-primary" target="_self">
                                    <i class="fas fa-eye"></i> Voir Dashboard
                                </a>
                                @endif
                                <button class="btn btn-sm btn-outline-secondary" disabled>
                                    <i class="fas fa-cog"></i> Gérer
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                            <h5>Aucun utilisateur trouvé</h5>
                            <p class="text-muted">Aucun utilisateur n'a été trouvé dans le système.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
