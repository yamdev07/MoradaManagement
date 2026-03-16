@extends('template.master')
@section('title', 'Room Status')
@section('content')

<style>
/* Palette Morada Lodge */
:root {
    --primary: #8b4513;
    --primary-light: #a0522d;
    --primary-dark: #704838;
    --success: #8b4513;
    --warning: #8b4513;
    --danger: #ef4444;
    --info: #8b4513;
    --light: #fcf8f3;
    --dark: #3d241a;
    --gray: #704838;
}

/* Bouton principal */
.add-item-btn {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(139, 69, 19, 0.1);
}

.add-item-btn:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--primary));
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(139, 69, 19, 0.2);
    color: white;
}

/* Container principal */
.professional-table-container {
    background: white;
    border-radius: 12px;
    border: 1px solid var(--light);
    box-shadow: 0 4px 6px rgba(139, 69, 19, 0.05);
    overflow: hidden;
}

/* Header du tableau */
.table-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    padding: 20px 24px;
    border-bottom: none;
}

.table-header h4 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
}

.table-header p {
    margin: 4px 0 0 0;
    opacity: 0.9;
    font-size: 0.875rem;
}

/* Table */
.professional-table {
    margin: 0;
}

.professional-table thead th {
    background: var(--light);
    color: var(--dark);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    border-bottom: 1px solid var(--gray);
}

.professional-table tbody tr:hover {
    background: var(--light);
}

.professional-table td {
    vertical-align: middle;
    border-bottom: 1px solid var(--light);
}

/* Footer du tableau */
.table-footer {
    background: var(--light);
    padding: 16px 24px;
    border-top: 1px solid var(--gray);
}

.table-footer h3 {
    margin: 0;
    color: var(--dark);
    font-size: 1rem;
    font-weight: 600;
}

/* Icônes */
.fas {
    color: var(--primary);
}

/* Actions */
.btn-action {
    background: var(--primary);
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-action:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}

.btn-edit {
    background: var(--primary);
    color: white;
}

.btn-delete {
    background: var(--danger);
    color: white;
}

.btn-delete:hover {
    background: #dc2626;
}
</style>

    <div class="container-fluid">
        <!-- Add Status Button -->
        <div class="row mb-4">
            <div class="col-12">
                <button id="add-button" type="button" class="add-item-btn">
                    <i class="fas fa-plus"></i>
                    Add New Status
                </button>
            </div>
        </div>

        <!-- Table Container -->
        <div class="professional-table-container">
            <!-- Table Header -->
            <div class="table-header">
                <h4><i class="fas fa-toggle-on me-2"></i>Room Status Management</h4>
                <p>Manage room availability statuses and their codes</p>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table id="roomstatus-table" class="professional-table table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">
                                <i class="fas fa-hashtag me-1"></i>#
                            </th>
                            <th scope="col">
                                <i class="fas fa-tag me-1"></i>Name
                            </th>
                            <th scope="col">
                                <i class="fas fa-code me-1"></i>Code
                            </th>
                            <th scope="col">
                                <i class="fas fa-info-circle me-1"></i>Information
                            </th>
                            <th scope="col">
                                <i class="fas fa-cog me-1"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DataTable will populate this -->
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="table-footer">
                <h3><i class="fas fa-toggle-on me-2"></i>Room Status</h3>
            </div>
        </div>
    </div>
@endsection
