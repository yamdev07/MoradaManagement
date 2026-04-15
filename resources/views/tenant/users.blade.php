@extends('frontend.layouts.master')

@section('title', 'Gestion des utilisateurs - {{ $tenant->name }}')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h3 class="card-title">
                                <i class="fas fa-users"></i>
                                Gestion des utilisateurs
                            </h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('tenant.create-user', ['subdomain' => $tenant->subdomain]) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nouvel utilisateur
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        Gérez les utilisateurs de votre entreprise <strong>{{ $tenant->name }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des utilisateurs -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($users->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Date d'inscription</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user_item)
                                    <tr>
                                        <td>{{ $user_item->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-img">
                                                    <i class="fas fa-user-circle fa-2x text-muted"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <strong>{{ $user_item->name }}</strong>
                                                    @if($user_item->id === Auth::id())
                                                        <small class="text-muted d-block">(Vous)</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user_item->email }}</td>
                                        <td>
                                            <span class="badge badge-{{ $user_item->role == 'Admin' ? 'danger' : ($user_item->role == 'Receptionist' ? 'warning' : ($user_item->role == 'Housekeeping' ? 'info' : 'secondary')) }}">
                                                {{ $user_item->role }}
                                            </span>
                                        </td>
                                        <td>{{ $user_item->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @if($user_item->id !== Auth::id())
                                                    <button type="button" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $user_item->id }}, '{{ $user_item->name }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Aucun utilisateur</h4>
                            <p class="text-muted">
                                Commencez par ajouter votre premier utilisateur.
                            </p>
                            <a href="{{ route('tenant.create-user', ['subdomain' => $tenant->subdomain]) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Ajouter un utilisateur
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer l'utilisateur <strong id="deleteUserName"></strong> ?</p>
                <p class="text-danger">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(userId, userName) {
    document.getElementById('deleteUserName').textContent = userName;
    document.getElementById('confirmDeleteBtn').onclick = function() {
        // Ici vous pouvez ajouter la logique de suppression
        alert('Fonctionnalité de suppression à implémenter pour l\'utilisateur ID: ' + userId);
        $('#deleteModal').modal('hide');
    };
    $('#deleteModal').modal('show');
}
</script>
@endsection
